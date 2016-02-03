<?php

/*
 * Copyright (C) 2016 tp4300001
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of Fta2ArcadiaController
 *
 * @author tp4300001
 */
class Fta2ArcadiaController {

    const ESPACE = "\r";
    const SAUT_DE_LIGNE = "\n";
    const TABULATION = "\t";
    const TABLE_START = "\t<Tables>\n";
    const TABLE_END = "\t</Tables>\n";
    const ARTICLE_REF_START = "\t\t<ARTICLE_REF>\n";
    const ARTICLE_REF_END = "\t\t</ARTICLE_REF>\n";
    const DATA_IMPORT_START = "\t\t\t<DataToImport>\n";
    const DATA_IMPORT_END = "\t\t\t</DataToImport>\n";
    const RECORDSET_END = "\t\t\t\t</Recordset>\n";

    /**
     * FTA associée
     * @var FtaModel
     */
    private $ftaModel;

    /**
     * FTA associée
     * @var FtaModel
     */
    private $databaseRecordToCompare;

    /**
     * Nouvel id de l'enregistrment de la table fta2arcadiatransaction
     * @var int 
     */
    private $keyValuePorposal;

    /**
     * Text du ficher xml
     * @var string
     */
    private $xmlText;
    private $arcadiaArticleRefLicCcial;
    private $arcadiaArticleRefLicProduction;
    private $arcadiaParametre;
    private $arcadiaEanArticle;
    private $arcadiaDLC;
    private $arcadiaDureeDeVie;
    private $actionProposal;
    private $recordsetBalise;
    private $arcadiaNoArtKey;

    public function __construct($paramFtaModel, $paramTypeAction) {
        /**
         * Inisialisation du model Fta
         */
        $this->setFtaModel($paramFtaModel);
        /**
         * On récupère et initialise le model de l'idFta à comparer
         */
        $this->setDatabaseRecordToCompare();

        /**
         * Generation de la proposal en BDD
         */
        $this->setActionProposal($paramTypeAction);

        /**
         * Initialisation des balises
         */
        $this->setAllBalise();

        /**
         * On vérifie les champs différents de la version précédent.
         */
        $this->transformAll();

        /**
         * Generation du text xml
         */
        $this->generateXmlText();

        /**
         * Géneration du fichier xml
         */
        $this->saveExportXmlToFile();
    }

    function getFtaModel() {
        return $this->ftaModel;
    }

    function setFtaModel(FtaModel $ftaModel) {
        $this->ftaModel = $ftaModel;
    }

    function getIdFtaToCompare() {
        $idFtaToCompare = $this->getFtaModel()->getIdFtaToCompare();
        return $idFtaToCompare;
    }

    function getDatabaseRecordToCompare() {
        return $this->databaseRecordToCompare;
    }

    function setDatabaseRecordToCompare() {
        if (!$this->getFtaModel()->getDataToCompare()) {
            $idFtaToCompare = $this->getIdFtaToCompare();
            if ($idFtaToCompare) {
                $this->databaseRecordToCompare = new DatabaseRecord(FtaModel::TABLENAME, $idFtaToCompare);
            }
            $this->getFtaModel()->setDataToCompare($this->databaseRecordToCompare);
        }
    }

    function getXmlText() {
        return $this->xmlText;
    }

    function setXmlText($xmlText) {
        $this->xmlText .= $xmlText;
    }

    function getArcadiaNoArtKey() {
        return $this->arcadiaNoArtKey;
    }

    function setArcadiaNoArtKey() {
        $this->arcadiaNoArtKey = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . "<!-- Entête -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<NO_ART key=\"TRUE\">" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()
                . "</NO_ART>" . self::SAUT_DE_LIGNE;
    }

    function getKeyValuePorposal() {
        return $this->keyValuePorposal;
    }

    function setKeyValuePorposal() {
        $codeArticleLdc = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
        $this->keyValuePorposal = Fta2ArcadiaTransactionModel::createNewRecordset($codeArticleLdc);
    }

    function getActionProposal() {
        return $this->actionProposal;
    }

    function setActionProposal($actionProposal) {
        /**
         * Initialisation de la key proposal en BDD
         */
        $this->setKeyValuePorposal();

        /**
         * Actualisation du type d'action
         */
        $fta2ArcadiaTrasactionModel = new Fta2ArcadiaTransactionModel($this->getKeyValuePorposal());
        $fta2ArcadiaTrasactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_TAG_TYPE_TRANSACTION)->setFieldValue($actionProposal);
        $fta2ArcadiaTrasactionModel->saveToDatabase();
        $this->setRecordsetBalise($actionProposal);
        $this->actionProposal = $actionProposal;
    }

    function transformAll() {

        /**
         * Vérification
         */
        $this->transformDIN();
    }

    function setAllBalise() {
        $this->setArcadiaNoArtKey();
        $this->setArcadiaParametre();
    }

    function transformDIN() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->isFieldDiff();
        if ($checkDiff) {
            $dinValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
            $this->setArcadiaArticleRefLicCcial($dinValue);
            $this->setArcadiaArticleRefLicProduction($dinValue);
        }
    }

    function transformEanArticle() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->isFieldDiff();
        if ($checkDiff) {
            $eanArticleValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue();
            $this->setArcadiaEanArticle($eanArticleValue);
        }
    }

    function transformDLC() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->isFieldDiff();
        if ($checkDiff) {
            $dlcValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue();
            $this->setArcadiaDLC($dlcValue);
        }
    }

    function transformDureeDeVie() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->isFieldDiff();
        if ($checkDiff) {
            $dureeDeVieValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
            $this->setArcadiaDureeDeVie($dureeDeVieValue);
        }
    }

    function getRecordsetBalise() {
        return $this->recordsetBalise;
    }

    function setRecordsetBalise($actionProposal) {
        $this->recordsetBalise = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . "<Recordset id=\"1\" action=\"" . $actionProposal . "\">" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaParametre() {
        return $this->arcadiaParametre;
    }

    function setArcadiaParametre() {
        $this->arcadiaParametre = self::TABULATION . "<Parameters>" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdFirm>40" . "</IdFirm><!-- Agis -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdArcadia>" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() . "</IdArcadia><!-- Code article dans Arcadia -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdFta>" . $this->getFtaModel()->getDataField(FtaModel::KEYNAME)->getFieldValue() . "</IdFta><!-- N° de la FTA -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . "</Parameters>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaArticleRefLicCcial() {
        return $this->arcadiaArticleRefLicCcial;
    }

    function getArcadiaArticleRefLicProduction() {
        return $this->arcadiaArticleRefLicProduction;
    }

    function setArcadiaArticleRefLicCcial($paramArcadiaArticleRefLicCcial) {
        $this->arcadiaArticleRefLicCcial = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_CCIAL><![CDATA[" . $paramArcadiaArticleRefLicCcial . "]]></LIB_CCIAL><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaArticleRefLicProduction($paramArcadiaArticleRefLicProduction) {

        $this->arcadiaArticleRefLicProduction = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_PRODUCTION><![CDATA[" . $paramArcadiaArticleRefLicProduction . "]]></LIB_PRODUCTION><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaEanArticle() {
        return $this->arcadiaEanArticle;
    }

    function setArcadiaEanArticle($paramArcadiaEanArticle) {
        $this->arcadiaEanArticle = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Class./Ident. -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_GENCOD_ADM>" . $paramArcadiaEanArticle . "</COD_GENCOD_ADM>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaDLC() {
        return $this->arcadiaDLC;
    }

    function getArcadiaDureeDeVie() {
        return $this->arcadiaDureeDeVie;
    }

    function setArcadiaDLC($arcadiaDLC) {
        $this->arcadiaDLC = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Qualite -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DLC_CCIAL>" . $arcadiaDLC . "</DLC_CCIAL>" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaDureeDeVie($arcadiaDureeDeVie) {
        $this->arcadiaDureeDeVie = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DUREE_VIE>" . $arcadiaDureeDeVie . "</DUREE_VIE>" . self::SAUT_DE_LIGNE;
    }

    function generateXmlText() {
        $xmlText .='<?xml version="1.0" encoding="UTF-8" ?>' . self::SAUT_DE_LIGNE . self::ESPACE
                . "<Transaction id=\"" . $this->getKeyValuePorposal() . "\" version=\"1.1\" type=\"proposal\">" . self::SAUT_DE_LIGNE
                . $this->getArcadiaParametre()
                . self::TABLE_START
                . self::ARTICLE_REF_START
                . self::DATA_IMPORT_START
                . $this->getRecordsetBalise()
                . $this->getArcadiaNoArtKey()
                . $this->getArcadiaArticleRefLicCcial()
                . $this->getArcadiaArticleRefLicProduction()
                . self::ESPACE . self::SAUT_DE_LIGNE
                . $this->getArcadiaDLC()
                . $this->getArcadiaDureeDeVie()
                . self::ESPACE . self::SAUT_DE_LIGNE
                . self::RECORDSET_END
                . self::DATA_IMPORT_END
                . self::ARTICLE_REF_END
                . self::TABLE_END . self::SAUT_DE_LIGNE
                . "</Transaction>" . self::SAUT_DE_LIGNE
                . self::SAUT_DE_LIGNE
        ;


        $this->setXmlText($xmlText);
    }

    /**
     * Géneration du fichier xml
     */
    function saveExportXmlToFile() {
        file_put_contents(
                "../../eai/export/fta2arcadia-40-"
                . $this->getKeyValuePorposal()
                . "-" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()
                . "-proposal.xml"
                , $this->getXmlText());
    }

}
