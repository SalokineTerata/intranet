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
    const LINK_DEV = "";
    const LINK_COD = "";
    const LINK_PRD = "";

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
    private $XMLarcadiaUtilisableGroupe;
    private $XMLarcadiaSiteDeProd;
    private $XMLarcadiaArticleRefLicCcial;
    private $arcadiaArticleRefLicProduction;
    private $XMLarcadiaParametre;
    private $XMLarcadiaEanArticle;
    private $XMLarcadiaDLC;
    private $XMLarcadiaDureeDeVie;
    private $actionProposal;
    private $recordsetBalise;
    private $XMLarcadiaNoArtKey;
    private $XMLarcadiaCodeDouane;
    private $XMLarcadiaLogoEcoEmballage;
    private $XMLarcadiaDTS;
    private $XMLarcadiaPoidsMini;
    private $XMLarcadiaPoidsMaxi;
    private $XMLarcadiaPoidsMoyenCal;
    private $XMLarcadiaPoidsMiniBarq;
    private $XMLarcadiaPoidsMaxiBarq;
    private $XMLarcadiaPoidsCstUvc;
    private $XMLarcadiaUniteDeFacturation;
    private $XMLarcadiaCNUF;
    private $XMLarcadiaCodPoidsCstUvc;
    private $XMLarcadiaCodSociete;
    private $XMLarcadiaProlongationDLC;

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
        $this->setXMLRecordsetBalise($actionProposal);
        $this->actionProposal = $actionProposal;
    }

    /**
     * Vérification de tous les champs de balises
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
        $this->transformCodPoidsCstUvc();
    }

    /**
     * Initialisation des balises 
     */
    function setAllBalise() {
        $this->setXMLArcadiaNoArtKey();
        $this->setXMLArcadiaParametre();
    }

    /**
     * Initialisation des balises dont la valeur ne change pas 
     */
    function transformCREATE() {
        if ($this->getActionProposal() == self::CREATE) {
            $this->transformCNUF();
            $this->transformUtilisableGroupe();
            $this->transformCodSociete();
            $this->transformProlongationDLC();
        }
    }

    /**
     * Initialisation des balises dont la valeur ne change pas 
     */
    function transformProlongationDLC() {
        $this->setXMLArcadiaProlongationDLC();
    }

    /**
     * Initialisation des balises dont la valeur ne change pas 
     */
    function transformCNUF() {
        $this->setXMLArcadiaCNUF();
    }

    /**
     * Initialisation des balises dont la valeur ne change pas 
     */
    function transformCodSociete() {
        $this->setXMLArcadiaCodSociete();
    }

    /**
     * Initialisation des balises dont la valeur ne change pas 
     */
    function transformUtilisableGroupe() {
        $this->setXMLArcadiaUtilisableGroupe();
    }

    /**
     * Le Code Poids Constant UVC est à oui sauf si unité de facturation est poids variable
     */
    function transformCodPoidsCstUvc() {
        /**
         * Vérifie la donnée de l'unité de facturation
         */
        $codPoidsCstUvc = self::OUI;
        $uniteFactValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->getFieldValue();
        if ($uniteFactValue == AnnexeUniteFacturationModel::ID_KG_POIDS_VARIABLE) {
            $codPoidsCstUvc = self::NON;
        }
        /**
         * Vérifie l'actualisation de la données
         */
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $this->setXMLArcadiaCodPoidsCstUvc($codPoidsCstUvc);
        }
    }

    /**
     * On vérifie si le site de production de la Fta a été modifié
     */
    function transformSiteDePorduction() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $geoModel = $this->getFtaModel()->getModelSiteProduction();
            $this->setXMLArcadiaSiteDeProd($geoModel);
        }
    }

    /**
     * On vérifie si la DIN de la Fta a été modifié
     * En effet cette donnée concerne le Libellé Production et Libellé Commercial
     */
    function transformDIN() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dinValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
            $this->setXMLArcadiaArticleRefLicCcial($dinValue);
            $this->setXMLArcadiaArticleRefLicProduction($dinValue);
        }
    }

    /**
     * On vérifie si la EAN Article de la Fta a été modifié
     * En effet cette donnée concerne le Gencod Administratif
     */
    function transformEanArticle() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $eanArticleValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue();
            $this->setXMLArcadiaEanArticle($eanArticleValue);
        }
    }

    /**
     * On vérifie si la Durée de vie garantie client (en jours) de la Fta a été modifié
     * En effet cette donnée concerne la DLC Commerciale
     */
    function transformDLC() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dlcValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue();
            $this->setXMLArcadiaDLC($dlcValue);
        }
    }

    /**
     * On vérifie si la  Durée de vie Production (en jours) de la Fta a été modifié
     * En effet cette donnée concerne la Duree de vie
     */
    function transformDureeDeVie() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $dureeDeVieValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
            $this->setXMLArcadiaDureeDeVie($dureeDeVieValue);
        }
    }

    /**
     * On vérifie si la  Durée de vie Production (en jours)
     *  ou  la Durée de vie garantie client (en jours) de la Fta a été modifié
     * En effet une modification engengre le recalcule de DTS
     */
    function transformDTS() {
        $checkDiffDLC = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->isFieldDiff();
        $checkDiffDurreDeVie = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->isFieldDiff();
        if ($checkDiffDurreDeVie or $checkDiffDLC or $this->getActionProposal() == self::CREATE) {
            $dlcValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue();
            $dureeDeVieValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
            $dtsValue = $dureeDeVieValue - $dlcValue;
            $this->setXMLArcadiaDTS($dtsValue);
        }
    }

    /**
     * On vérifie si la  code douane de la Fta a été modifié
     * Et on récupère les 8 premiers caractères si la Fta n'est pas export
     * si il s'agit d'un export récupérer le code complet
     */
    function transformCodeDouane() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $codeDouaneValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->getFieldValue();
            $this->setXMLArcadiaCodeDouane($codeDouaneValue);
        }
    }

    /**
     * On vérifie si la classification a pour rayon "Libre service"
     * Si oui la balise Eco-Emballages est à oui et on ajoute la balise site de reference Eco Emballages
     * d'apères le site de production
     * Si non la balise Eco-Emballages est à non
     */
    function transformLogoEmballage() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $logoEmballageValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE)->getFieldValue();
            $this->setXMLArcadiaLogoEcoEmballage($logoEmballageValue);
        }
    }

    /**
     * On vérifie si l'unité de facturation a été modifié
     */
    function transformUniteFacturation() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $uniteFacturationArcadiaValue = $this->getFtaModel()->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_UNITE_FACTURATION)->getFieldValue();
            $this->setXMLArcadiaUniteDeFacturation($uniteFacturationArcadiaValue);
        }
    }

    /**
     * On vérifie Poids net de l'unité de vente facturée (en Kg) a été modifié
     * si oui il renseigne le poid maxi, mini, mini barq, maxi barq, cst uvc et moyenne calculé.
     */
    function transformPoidsMaxiAndMini() {
        $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->isFieldDiff();
        if ($checkDiff or $this->getActionProposal() == self::CREATE) {
            $poidsUVFValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
            $poidsUVFValueCalcul = $poidsUVFValue * FtaModel::CONVERSION_KG_EN_G;
            $this->setXMLArcadiaPoidsMaxi($poidsUVFValueCalcul);
            $this->setXMLArcadiaPoidsMini($poidsUVFValueCalcul);
            $this->setXMLArcadiaPoidsMiniBarq($poidsUVFValueCalcul);
            $this->setXMLArcadiaPoidsMaxiBarq($poidsUVFValueCalcul);
            $this->setXMLArcadiaPoidsCstUvc($poidsUVFValueCalcul);
            $this->setXMLArcadiaPoidsMoyenCal($poidsUVFValueCalcul);
        }
    }

    function getXMLRecordsetBalise() {
        return $this->recordsetBalise;
    }

    function setXMLRecordsetBalise($actionProposal) {
        $this->recordsetBalise = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . "<Recordset id=\"1\" action=\"" . $actionProposal . "\">" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaNoArtKey() {
        return $this->XMLarcadiaNoArtKey;
    }

    function setXMLArcadiaNoArtKey() {
        $this->XMLarcadiaNoArtKey = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . "<!-- Entête -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<NO_ART key=\"TRUE\">" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()
                . "</NO_ART>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaParametre() {
        return $this->XMLarcadiaParametre;
    }

    function setXMLArcadiaParametre() {
        $this->XMLarcadiaParametre = self::TABULATION . "<Parameters>" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdFirm>40" . "</IdFirm><!-- Agis -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdArcadia>" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() . "</IdArcadia><!-- Code article dans Arcadia -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . "<IdFta>" . $this->getFtaModel()->getDataField(FtaModel::KEYNAME)->getFieldValue() . "</IdFta><!-- N° de la FTA -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . "</Parameters>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaArticleRefLicCcial() {
        return $this->XMLarcadiaArticleRefLicCcial;
    }

    function getXMLArcadiaArticleRefLicProduction() {
        return $this->arcadiaArticleRefLicProduction;
    }

    function setXMLArcadiaArticleRefLicCcial($paramArcadiaArticleRefLicCcial) {
        $value = "";
        if ($paramArcadiaArticleRefLicCcial) {
            $value = "<![CDATA[" . $paramArcadiaArticleRefLicCcial . "]]>";
        }
        $this->XMLarcadiaArticleRefLicCcial = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_CCIAL>" . $value . "</LIB_CCIAL><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaArticleRefLicProduction($paramArcadiaArticleRefLicProduction) {
        $value = "";
        if ($paramArcadiaArticleRefLicProduction) {
            $value = "<![CDATA[" . $paramArcadiaArticleRefLicProduction . "]]>";
        }
        $this->arcadiaArticleRefLicProduction = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<LIB_PRODUCTION>" . $value . "</LIB_PRODUCTION><!-- DIN de la FTA -->" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaEanArticle() {
        return $this->XMLarcadiaEanArticle;
    }

    function setXMLArcadiaEanArticle($paramArcadiaEanArticle) {
        $this->XMLarcadiaEanArticle = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Class./Ident. -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_GENCOD_ADM>" . $paramArcadiaEanArticle . "</COD_GENCOD_ADM>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaCodeDouane() {
        return $this->XMLarcadiaCodeDouane;
    }

    function setXMLArcadiaCodeDouane($paramArcadiaCodeDouane) {
        $this->XMLarcadiaCodeDouane = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Export/Compta -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_NDP>" . $paramArcadiaCodeDouane . "</COD_NDP>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaLogoEcoEmballage() {
        return $this->XMLarcadiaLogoEcoEmballage;
    }

    function setXMLArcadiaLogoEcoEmballage($paramArcadiaLogoEcoEmballage) {
        $this->XMLarcadiaLogoEcoEmballage = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Fourniture -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<SOUMIS_ECO_EMBALLAGE>" . $paramArcadiaLogoEcoEmballage . "</SOUMIS_ECO_EMBALLAGE>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaProlongationDLC() {
        return $this->XMLarcadiaProlongationDLC;
    }

    function setXMLArcadiaProlongationDLC() {
        $this->XMLarcadiaProlongationDLC = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<PROLOGATION_DLC>" . self::NON . "</PROLOGATION_DLC><!-- Non --> " . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaCodSociete() {
        return $this->XMLarcadiaCodSociete;
    }

    function setXMLArcadiaCodSociete() {
        $this->XMLarcadiaCodSociete = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_SOCIETE_RESP_PV>" . self::COD_SOCIETE_AGIS . "</COD_SOCIETE_RESP_PV><!-- Agis --> " . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaCodPoidsCstUvc() {
        return $this->XMLarcadiaCodPoidsCstUvc;
    }

    function setXMLArcadiaCodPoidsCstUvc($paramArcadiaCodPoidsCsrUvc) {
        $this->XMLarcadiaCodPoidsCstUvc = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_POID_CST_UVC>" . $paramArcadiaCodPoidsCsrUvc . "</COD_POID_CST_UVC>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaCNUF() {
        return $this->XMLarcadiaCNUF;
    }

    function setXMLArcadiaCNUF() {
        $this->XMLarcadiaCNUF = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<CNUF>" . self::CNUF_AGIS . "</CNUF>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaUtilisableGroupe() {
        return $this->XMLarcadiaUtilisableGroupe;
    }

    function setXMLArcadiaUtilisableGroupe() {
        $this->XMLarcadiaUtilisableGroupe = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info générales -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UTILISABLE_SITE>" . self::OUI . "</UTILISABLE_SITE><!-- Oui -->" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaSiteDeProd() {
        return $this->XMLarcadiaSiteDeProd;
    }

    function setXMLArcadiaSiteDeProd(GeoModel $paramArcadiaSiteDeProdModel) {
        $this->XMLarcadiaSiteDeProd = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<SITE_PROD_EE>"
                . $paramArcadiaSiteDeProdModel->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() . "</SITE_PROD_EE><!-- "
                . $paramArcadiaSiteDeProdModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaDTS() {
        return $this->XMLarcadiaDTS;
    }

    function setXMLArcadiaDTS($paramArcadiaDTS) {
        $this->XMLarcadiaDTS = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DTS>" . $paramArcadiaDTS . "</DTS>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaUniteDeFacturation() {
        return $this->XMLarcadiaUniteDeFacturation;
    }

    function setXMLArcadiaUniteDeFacturation($paramArcadiaUniteDeFacturation) {
        $this->XMLarcadiaUniteDeFacturation = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info Fact -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UNITE_FACT>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT>" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<UNITE_FACT_PRIVE>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT_PRIVE>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaPoidsMini() {
        return $this->XMLarcadiaPoidsMini;
    }

    function getXMLArcadiaPoidsMaxi() {
        return $this->XMLarcadiaPoidsMaxi;
    }

    function setXMLArcadiaPoidsMini($paramArcadiaPoidsMini) {
        $this->XMLarcadiaPoidsMini = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Pds Mini/Maxi -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MINI>" . $paramArcadiaPoidsMini . "</POIDS_MINI>" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaPoidsMaxi($paramArcadiaPoidsMAxi) {
        $this->XMLarcadiaPoidsMaxi = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MAXI>" . $paramArcadiaPoidsMAxi . "</POIDS_MAXI>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaPoidsMoyenCal() {
        return $this->XMLarcadiaPoidsMoyenCal;
    }

    function getXMLArcadiaPoidsMiniBarq() {
        return $this->XMLarcadiaPoidsMiniBarq;
    }

    function getXMLArcadiaPoidsCstUvc() {
        return $this->XMLarcadiaPoidsCstUvc;
    }

    function getXMLArcadiaPoidsMaxiBarq() {
        return $this->XMLarcadiaPoidsMaxiBarq;
    }

    function setXMLArcadiaPoidsMoyenCal($paramArcadiaPoidsMoyenCal) {
        $this->XMLarcadiaPoidsMoyenCal = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Info Prod 1 -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MOY_CALCULE>" . $paramArcadiaPoidsMoyenCal . "</POIDS_MOY_CALCULE>" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaPoidsMiniBarq($paramArcadiaPoidsMiniBarq) {
        $this->XMLarcadiaPoidsMiniBarq = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<COD_POIDS_MINI_BARQ>" . $paramArcadiaPoidsMiniBarq . "</COD_POIDS_MINI_BARQ>" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaPoidsCstUvc($paramArcadiaPoidsCstUvc) {
        $this->XMLarcadiaPoidsCstUvc = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_CST_UVC>" . $paramArcadiaPoidsCstUvc . "</POIDS_CST_UVC>" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaPoidsMaxiBarq($paramArcadiaPoidsMaxiBarq) {
        $this->XMLarcadiaPoidsMaxiBarq = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<POIDS_MAXI_BARQ>" . $paramArcadiaPoidsMaxiBarq . "</POIDS_MAXI_BARQ>" . self::SAUT_DE_LIGNE;
    }

    function getXMLArcadiaDLC() {
        return $this->XMLarcadiaDLC;
    }

    function getXMLArcadiaDureeDeVie() {
        return $this->XMLarcadiaDureeDeVie;
    }

    function setXMLArcadiaDLC($arcadiaDLC) {
        $this->XMLarcadiaDLC = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<!-- Qualite -->" . self::SAUT_DE_LIGNE
                . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DLC_CCIAL>" . $arcadiaDLC . "</DLC_CCIAL>" . self::SAUT_DE_LIGNE;
    }

    function setXMLArcadiaDureeDeVie($arcadiaDureeDeVie) {
        $this->XMLarcadiaDureeDeVie = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<DUREE_VIE>" . $arcadiaDureeDeVie . "</DUREE_VIE>" . self::SAUT_DE_LIGNE;
    }

    function generateXmlText() {
        $xmlText .='<?xml version="1.0" encoding="UTF-8" ?>' . self::SAUT_DE_LIGNE . self::ESPACE
                . "<Transaction id=\"" . $this->getKeyValuePorposal() . "\" version=\"1.1\" type=\"proposal\">" . self::SAUT_DE_LIGNE
                . $this->getXMLArcadiaParametre()
                . self::TABLE_START
                . self::ARTICLE_REF_START
                . self::DATA_IMPORT_START
                . $this->getXMLRecordsetBalise()
                . $this->getXMLArcadiaNoArtKey() //<!-- Entête -->
                . $this->getXMLArcadiaArticleRefLicCcial()
                . $this->getXMLArcadiaArticleRefLicProduction()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Info générales -->
                . $this->getXMLArcadiaUtilisableGroupe()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Class./Ident. -->
                . $this->getXMLArcadiaEanArticle()
                . $this->getXMLArcadiaCNUF()
                . self::ESPACE . self::SAUT_DE_LIGNE // <!-- Qualite -->
                . $this->getXMLArcadiaDLC()
                . $this->getXMLArcadiaDureeDeVie()
                . $this->getXMLArcadiaDTS()
                . $this->getXMLArcadiaProlongationDLC()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Prod 1 -->
                . $this->getXMLArcadiaPoidsMoyenCal()
                . $this->getXMLArcadiaPoidsMiniBarq()
                . $this->getXMLArcadiaPoidsMaxiBarq()
                . $this->getXMLArcadiaCodPoidsCstUvc()
                . $this->getXMLArcadiaPoidsCstUvc()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Prod 2 -->
                . $this->getXMLArcadiaSiteDeProd()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Pds Mini/Maxi -->
                . $this->getXMLArcadiaPoidsMini()
                . $this->getXMLArcadiaPoidsMaxi()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Info Fact -->
                . $this->getXMLArcadiaUniteDeFacturation()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Export/Compta -->
                . $this->getXMLArcadiaCodeDouane()
                . self::ESPACE . self::SAUT_DE_LIGNE //<!-- Fourniture -->
                . $this->getXMLArcadiaLogoEcoEmballage()
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
