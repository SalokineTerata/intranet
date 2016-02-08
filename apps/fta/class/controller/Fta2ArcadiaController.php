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
    const CREATE = "create";
    const UPDATE = "update";
    const COD_SOCIETE_AGIS = "40";
    const CNUF_AGIS = "336676";
    const OUI = "1";
    const NON = "0";

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
    private $arcadiaUtilisableGroupe;
    private $arcadiaSiteDeProd;
    private $arcadiaArticleRefLicCcial;
    private $arcadiaArticleRefLicProduction;
    private $arcadiaParametre;
    private $arcadiaEanArticle;
    private $arcadiaDLC;
    private $arcadiaDureeDeVie;
    private $actionProposal;
    private $recordsetBalise;
    private $arcadiaNoArtKey;
    private $arcadiaCodeDouane;
    private $arcadiaLogoEcoEmballage;
    private $arcadiaDTS;
    private $arcadiaPoidsMini;
    private $arcadiaPoidsMaxi;
    private $arcadiaPoidsMoyenCal;
    private $arcadiaPoidsMiniBarq;
    private $arcadiaPoidsMaxiBarq;
    private $arcadiaPoidsCstUvc;
    private $arcadiaUniteDeFacturation;
    private $arcadiaCNUF;
    private $arcadiaCodPoidsCstUvc;
    private $arcadiaCodSociete;
    private $arcadiaProlongationDLC;

    public function __construct($paramFtaModel) {
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
        $this->setActionProposal($this->getFtaModel()->getActionProposal());

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

    /**
     * Vérification
     */
    function transformAll() {
        $this->transformDIN();
        $this->transformEanArticle();
        $this->transformCodeDouane();
        $this->transformLogoEmballage();
        $this->transformDLC();
        $this->transformDureeDeVie();
        $this->transformDTS();
        $this->transformPoidsMaxiAndMini();
        $this->transformUniteFacturation();
        $this->transformCREATE();
        $this->transformSiteDePorduction();
    }

    function setAllBalise() {
        $this->setArcadiaNoArtKey();
        $this->setArcadiaParametre();
    }

    function transformCREATE() {
        if ($this->getActionProposal() == self::CREATE) {
            $this->transformCNUF();
            $this->transformUtilisableGroupe();
            $this->transformCodPoidsCstUvc();
            $this->transformCodSociete();
            $this->transformProlongationDLC();
        }
    }

    function transformProlongationDLC() {
        $this->setArcadiaProlongationDLC();
    }

    function transformCNUF() {
        $this->setArcadiaCNUF();
    }

    function transformCodSociete() {
        $this->setArcadiaCodSociete();
    }

    function transformCodPoidsCstUvc() {
        $this->setArcadiaCodPoidsCstUvc();
    }

    function transformUtilisableGroupe() {
        $this->setArcadiaUtilisableGroupe();
    }

    function transformSiteDePorduction() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $geoModel = $this->getFtaModel()->getModelSiteProduction();
            $this->setArcadiaSiteDeProd($geoModel);
        }
    }

    function transformDIN() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dinValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
            $this->setArcadiaArticleRefLicCcial($dinValue);
            $this->setArcadiaArticleRefLicProduction($dinValue);
        }
    }

    function transformEanArticle() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $eanArticleValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue();
            $this->setArcadiaEanArticle($eanArticleValue);
        }
    }

    function transformDLC() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dlcValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue();
            $this->setArcadiaDLC($dlcValue);
        }
    }

    function transformDureeDeVie() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dureeDeVieValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
            $this->setArcadiaDureeDeVie($dureeDeVieValue);
        }
    }

    function transformCodeDouane() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $codeDouaneValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->getFieldValue();
            $this->setArcadiaCodeDouane($codeDouaneValue);
        }
    }

    function transformLogoEmballage() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $logoEmballageValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE)->getFieldValue();
            $this->setArcadiaLogoEcoEmballage($logoEmballageValue);
        }
    }

    function transformUniteFacturation() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $uniteFacturationArcadiaValue = $this->getFtaModel()->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_UNITE_FACTURATION)->getFieldValue();
            $this->setArcadiaUniteDeFacturation($uniteFacturationArcadiaValue);
        }
    }

    function transformDTS() {
        $checkDiffDLC = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->isFieldDiff();
        $checkDiffDurreDeVie = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->isFieldDiff();
        if ($checkDiffDurreDeVie or $checkDiffDLC or $this->getActionProposal() == self::CREATE) {
            $dlcValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue();
            $dureeDeVieValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
            $dtsValue = $dureeDeVieValue - $dlcValue;
            $this->setArcadiaDTS($dtsValue);
        }
    }

    function transformPoidsMaxiAndMini() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $poidsUVFValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
            $poidsUVFValueCalcul = $poidsUVFValue * FtaModel::CONVERSION_KG_EN_G;
            $this->setArcadiaPoidsMaxi($poidsUVFValueCalcul);
            $this->setArcadiaPoidsMini($poidsUVFValueCalcul);
            $this->setArcadiaPoidsMiniBarq($poidsUVFValueCalcul);
            $this->setArcadiaPoidsMaxiBarq($poidsUVFValueCalcul);
            $this->setArcadiaPoidsCstUvc($poidsUVFValueCalcul);
            $this->setArcadiaPoidsMoyenCal($poidsUVFValueCalcul);
        }
    }

    function getRecordsetBalise() {
        return $this->recordsetBalise;
    }

    function setRecordsetBalise($actionProposal) {
        $this->recordsetBalise = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . "<Recordset id=\"1\" action=\"" . $actionProposal . "\">" . self::SAUT_DE_LIGNE;
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
        $value = "";
        if ($paramArcadiaArticleRefLicCcial) {
            $value = "<![CDATA[" . $paramArcadiaArticleRefLicCcial . "]]>";
        }
        $this->arcadiaArticleRefLicCcial = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_CCIAL>" . $value . "</LIB_CCIAL><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaArticleRefLicProduction($paramArcadiaArticleRefLicProduction) {
        $value = "";
        if ($paramArcadiaArticleRefLicProduction) {
            $value = "<![CDATA[" . $paramArcadiaArticleRefLicProduction . "]]>";
        }
        $this->arcadiaArticleRefLicProduction = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_PRODUCTION>" . $value . "</LIB_PRODUCTION><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
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

    function getArcadiaCodeDouane() {
        return $this->arcadiaCodeDouane;
    }

    function setArcadiaCodeDouane($paramArcadiaCodeDouane) {
        $this->arcadiaCodeDouane = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Export/Compta -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_NDP>" . $paramArcadiaCodeDouane . "</COD_NDP>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaLogoEcoEmballage() {
        return $this->arcadiaLogoEcoEmballage;
    }

    function setArcadiaLogoEcoEmballage($paramArcadiaLogoEcoEmballage) {
        $this->arcadiaLogoEcoEmballage = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Fourniture -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<SOUMIS_ECO_EMBALLAGE>" . $paramArcadiaLogoEcoEmballage . "</SOUMIS_ECO_EMBALLAGE>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaProlongationDLC() {
        return $this->arcadiaProlongationDLC;
    }

    function setArcadiaProlongationDLC() {
        $this->arcadiaProlongationDLC = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<PROLOGATION_DLC>" . self::NON . "</PROLOGATION_DLC><!-- Non --> " . self::SAUT_DE_LIGNE;
    }

    function getArcadiaCodSociete() {
        return $this->arcadiaCodSociete;
    }

    function setArcadiaCodSociete() {
        $this->arcadiaCodSociete = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_SOCIETE_RESP_PV>" . self::COD_SOCIETE_AGIS . "</COD_SOCIETE_RESP_PV><!-- Agis --> " . self::SAUT_DE_LIGNE;
    }

    function getArcadiaCodPoidsCstUvc() {
        return $this->arcadiaCodPoidsCstUvc;
    }

    function setArcadiaCodPoidsCstUvc() {
        $this->arcadiaCodPoidsCstUvc = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_POID_CST_UVC>1</COD_POID_CST_UVC>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaCNUF() {
        return $this->arcadiaCNUF;
    }

    function setArcadiaCNUF() {
        $this->arcadiaCNUF = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<CNUF>" . self::CNUF_AGIS . "</CNUF>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaUtilisableGroupe() {
        return $this->arcadiaUtilisableGroupe;
    }

    function setArcadiaUtilisableGroupe() {
        $this->arcadiaUtilisableGroupe = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info générales -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UTILISABLE_SITE>" . self::OUI . "</UTILISABLE_SITE><!-- Oui -->" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaSiteDeProd() {
        return $this->arcadiaSiteDeProd;
    }

    function setArcadiaSiteDeProd(GeoModel $paramArcadiaSiteDeProdModel) {
        $this->arcadiaSiteDeProd = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<SITE_PROD_EE>"
                . $paramArcadiaSiteDeProdModel->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() . "</SITE_PROD_EE><!-- "
                . $paramArcadiaSiteDeProdModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaDTS() {
        return $this->arcadiaDTS;
    }

    function setArcadiaDTS($paramArcadiaDTS) {
        $this->arcadiaDTS = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DTS>" . $paramArcadiaDTS . "</DTS>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaUniteDeFacturation() {
        return $this->arcadiaUniteDeFacturation;
    }

    function setArcadiaUniteDeFacturation($paramArcadiaUniteDeFacturation) {
        $this->arcadiaUniteDeFacturation = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info Fact -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UNITE_FACT>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT>" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UNITE_FACT_PRIVE>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT_PRIVE>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaPoidsMini() {
        return $this->arcadiaPoidsMini;
    }

    function getArcadiaPoidsMaxi() {
        return $this->arcadiaPoidsMaxi;
    }

    function setArcadiaPoidsMini($paramArcadiaPoidsMini) {
        $this->arcadiaPoidsMini = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Pds Mini/Maxi -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MINI>" . $paramArcadiaPoidsMini . "</POIDS_MINI>" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaPoidsMaxi($paramArcadiaPoidsMAxi) {
        $this->arcadiaPoidsMaxi = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MAXI>" . $paramArcadiaPoidsMAxi . "</POIDS_MAXI>" . self::SAUT_DE_LIGNE;
    }

    function getArcadiaPoidsMoyenCal() {
        return $this->arcadiaPoidsMoyenCal;
    }

    function getArcadiaPoidsMiniBarq() {
        return $this->arcadiaPoidsMiniBarq;
    }

    function getArcadiaPoidsCstUvc() {
        return $this->arcadiaPoidsCstUvc;
    }

    function getArcadiaPoidsMaxiBarq() {
        return $this->arcadiaPoidsMaxiBarq;
    }

    function setArcadiaPoidsMoyenCal($paramArcadiaPoidsMoyenCal) {
        $this->arcadiaPoidsMoyenCal = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info Prod 1 -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MOY_CALCULE>" . $paramArcadiaPoidsMoyenCal . "</POIDS_MOY_CALCULE>" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaPoidsMiniBarq($paramArcadiaPoidsMiniBarq) {
        $this->arcadiaPoidsMiniBarq = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_POIDS_MINI_BARQ>" . $paramArcadiaPoidsMiniBarq . "</COD_POIDS_MINI_BARQ>" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaPoidsCstUvc($paramArcadiaPoidsCstUvc) {
        $this->arcadiaPoidsCstUvc = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_CST_UVC>" . $paramArcadiaPoidsCstUvc . "</POIDS_CST_UVC>" . self::SAUT_DE_LIGNE;
    }

    function setArcadiaPoidsMaxiBarq($paramArcadiaPoidsMaxiBarq) {
        $this->arcadiaPoidsMaxiBarq = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MAXI_BARQ>" . $paramArcadiaPoidsMaxiBarq . "</POIDS_MAXI_BARQ>" . self::SAUT_DE_LIGNE;
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
                . $this->getArcadiaNoArtKey() //<!-- Entête -->
                . $this->getArcadiaArticleRefLicCcial()
                . $this->getArcadiaArticleRefLicProduction()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Info générales -->
                . $this->getArcadiaUtilisableGroupe()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Class./Ident. -->
                . $this->getArcadiaEanArticle()
                . $this->getArcadiaCNUF()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Qualite -->
                . $this->getArcadiaDLC()
                . $this->getArcadiaDureeDeVie()
                . $this->getArcadiaDTS()
                . $this->getArcadiaProlongationDLC()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Prod 1 -->
                . $this->getArcadiaPoidsMoyenCal()
                . $this->getArcadiaPoidsMiniBarq()
                . $this->getArcadiaPoidsMaxiBarq()
                . $this->getArcadiaCodPoidsCstUvc()
                . $this->getArcadiaPoidsCstUvc()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Prod 2 -->
                . $this->getArcadiaSiteDeProd()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Pds Mini/Maxi -->
                . $this->getArcadiaPoidsMini()
                . $this->getArcadiaPoidsMaxi()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Fact -->
                . $this->getArcadiaUniteDeFacturation()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Export/Compta -->
                . $this->getArcadiaCodeDouane()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Fourniture -->
                . $this->getArcadiaLogoEcoEmballage()
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
                . "-" . $this->getFtaModel()->getDataField(FtaModel::KEYNAME)->getFieldValue()
                . "-proposal.xml"
                , $this->getXmlText());
    }

}
