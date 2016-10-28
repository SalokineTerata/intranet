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
 * @author franckwastaken
 */
class Fta2ArcadiaController {

    const ESPACE = "\r";
    const SAUT_DE_LIGNE = "\n";
    const TABULATION = "    ";
    const TABLE_START = "    <Tables>\n";
    const TABLE_END = "    </Tables>\n";
    const ARTICLE_REF_START = "        <ARTICLE_TRAIT_NEW>\n";
//    const ARTICLE_REF_START = "        <ARTICLE_REF>\n";
//    const ARTICLE_REF_END = "        </ARTICLE_REF>\n";
    const ARTICLE_REF_END = "        </ARTICLE_TRAIT_NEW>\n";
    const DATA_IMPORT_START = "            <DataToImport>\n";
    const DATA_IMPORT_END = "            </DataToImport>\n";
    const ESP_PRODUITS_FINIS_START = "        <ESP_PRODUITS_FINIS>\n";
    const ESP_PRODUITS_FINIS_END = "        </ESP_PRODUITS_FINIS>\n";
    const DUN14_START = "        <DUN14>\n";
    const DUN14_END = "        </DUN14>\n";
    const ART_SITE_START = "        <ART_SITE>\n";
    const ART_SITE_END = "        </ART_SITE>\n";
    const ART_SITE_DATE_FIN_EFFET = "31/12/2029";
    const RECORDSET_END = "                </Recordset>\n";
    const CREATE = "create";
    const AJOUT_DUN_RECORDSET = "1";
    const UPDATE = "update";
    const DELETE = "delete";
    const COD_SOCIETE_AGIS = "40";
    const CNUF_AGIS = "336676";
    const NB_UNITE_CONDITIONNEMENT = "1";
    const LIEU_PRODUIT_FINI = "1";
    const OUI = "1";
    const NON = "0";
    const LIMIT_NUMBER_COD_NDP = "8";
    const LINK_DEV = "";
    const LINK_COD = "";
    const LINK_PRD = "";
    const CDATA_OPEN = "<![CDATA[";
    const CDATA_CLOSE = "]]>";
    const FALSE = FALSE;
    const TRUE = TRUE;
    const ACTION_DELETE_DISABLED =
    FALSE;
    const ACTION_DELETE_ENABLED =
    TRUE;
    const ACTION_CREATE_ENABLED =
    TRUE;
    const ACTION_CREATE_DISABLED =
    FALSE;

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
    private $XMLarcadiaArticleRefLicProduction;
    private $XMLarcadiaLibelleTarif;
    private $XMLarcadiaParametre;
    private $XMLarcadiaEanArticle;
    private $XMLarcadiaDLC;
    private $XMLarcadiaCommentairePrive;
    private $XMLarcadiaDureeDeVie;
    private $XMLrecordsetBalise;
    private $XMLrecordsetBaliseEspProduitFini;
    private $XMLrecordsetBaliseDun14;
    private $XMLrecordsetBaliseDun14Delete;
    private $XMLrecordsetBaliseArtSiteOne;
    private $XMLrecordsetBaliseArtSiteTwo;
    private $XMLrecordsetArtSiteTwo;
    private $XMLrecordsetBaliseArtSiteUpdateOne;
    private $XMLrecordsetBaliseArtSiteUpdateTwo;
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
    private $XMLarcadiaMethodeDePreparation;
    private $XMLarcadiaTypePreparationAcquisition;
    private $XMLarcadiaCelluleArticle;
    private $XMLarcadiaFamilleEcoEmballages;
    private $XMLarcadiaCNUF;
    private $XMLarcadiaCodPoidsCstUvc;
    private $XMLarcadiaCodSociete;
    private $XMLarcadiaProlongationDLC;
    private $XMLarcadiaIsHallal;
    private $XMLarcadiaCodGeneriqueFm;
    private $XMLarcadiaExport;
    private $XMLarcadiaCodSousFam;
    private $XMLarcadiaCodFamVte;
    private $XMLarcadiaEnvironConserv;
    private $XMLarcadiaCodTypeConditPub;
    private $XMLarcadiaUniteConditionnement;
    private $XMLarcadiaSiteRefEcoEmb;
    private $XMLarcadiaOptiventes;
    private $XMLarcadiaFamilleBudget;
    private $XMLarcadiaGammeFamilleBudget;
    private $XMLarcadiaGammeCoop;
    private $XMLarcadiaFestif;
    private $XMLarcadiaFamilleDeclCaClient;
    private $XMLarcadiaMarque;
    private $XMLarcadiaCodProduit;
    private $XMLarcadiaAcregSite;
    private $XMLarcadiaAcregLieu;
    private $XMLarcadiaAcregNoquai;
    private $XMLarcadiaAcregNomethode;
    private $XMLarcadiaAcregSiteSecondaire;
    private $XMLarcadiaAcregLieuSecondaire;
    private $XMLarcadiaAcregTypeProdEmplacement;
    private $XMLarcadiaAcregQuantiteEmplacement;
    private $XMLarcadiaSiteValo;
    private $XMLarcadiaCodPCB;
    private $XMLarcadiaDun14;
    private $XMLarcadiaDunPalette;
    private $XMLarcadiaColisSpecifique;
    private $XMLarcadiaColisStandard;
    private $XMLarcadiaTypeCarton;
    private $XMLarcadiaArtSiteDateDebutEffet;
    private $XMLarcadiaArtSiteDateFinEffet;
    private $XMLarcadiaArtSiteCodPosteCC;
    private $XMLarcadiaArtSiteCodAtelier;
    private $XMLarcadiaArtSiteSiteAffectRes;
    private $XMLCommentEntete;
    private $XMLCommentAdmPole;
    private $XMLCommentContGestion;
    private $XMLCommentQualite;
    private $XMLCommentAdv;
    private $XMLCommentPreparCde;
    private $XMLCommentPdsMiniMaxi;
    private $XMLCommentInfoFact;
    private $XMLCommentExportCompta;
    private $XMLCommentTelevente;
    private $XMLCommentFourniture;
    private $XMLCommentInfoTech;
    private $XMLCommentRegateAcAchat;
    private $XMLCommentRegateAcStock;
    private $actionProposal;
    private $arcadiaExportResult;
    private $arcadiaProduitFiniCheck;
    private $arcadiaDun14Check;
    private $arcadiaDun14RecordValue;
    private $arcadiaArtSiteCheck;
    private $arcadiaArtSiteRecordTwoCheck;
    private $arcadiaArtSiteRecordValue;
    private $arcadiaPublicData;
    private $arcadiaDun14Create;

    public function __construct
             (FtaModel $paramFtaModel,

    $paramType, $paramToNotGenerateFile = NULL) {
    /**
     * Inisialisation du model Fta
     */
    $this->  setFtaModel(
            $paramFtaModel);

    /**
     * On récupère et initialise le model de l'idFta à comparer
     */
    $this->setDatabaseRecordToCompare();

    /**
     * Generation de la proposal en BDD
     */
    $this->setActionProposal($this->getFtaModel()->getActionProposal(), $paramType);

    /**
     * On vérifie si un id transaction est initialisé pou l'id Fta encours
     */
    if ($this->getKeyValueProposal()) {
        /**
         * Initialisation des balises
         */
        $this->setAllBalise();

        /**
         * On décide si oui ou non affcihe les données publiques
         */
        $this->setPublicBalise();

        /**
         * On vérifie les champs différents de la version précédent.
         */
        $this->transformAll();

        /**
         * On vérifie si un commentaitre doit être ajouter
         */
        $this->checkComment();

        /**
         * Generation du text xml
         */
        $this->generateXmlText();

        /**
         * Géneration du fichier xml
         * Vide ou false on génère le fichier
         * TRUE on ne genère pas le fichier XML
         */
        if (!$paramToNotGenerateFile) {
            $this->saveExportXmlToFile();
        }
    } else {
        /**
         * Affichage du message informant de la non génération du fichier XML
         */
        $this->generateXmlTextNO();
    }
}

function getGlobalConfigModel() {
    $globalConfig = new GlobalConfig();
    return $globalConfig;
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

function getKeyValueProposal() {
    return $this->keyValuePorposal;
}

function setKeyValuePorposal($paramType) {
    $codeArticleLdc = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
    $idFta = $this->getFtaModel()->getKeyValue();
    switch ($paramType) {
        case Fta2ArcadiaTransactionModel::SUMMARY_PAGE:
            $this->keyValuePorposal = Fta2ArcadiaTransactionModel::checkIdArcadiaTransaction($idFta);

            break;
        case Fta2ArcadiaTransactionModel::XML:
            $idUser = $this->getGlobalConfigModel()->getAuthenticatedUser()->getKeyValue();
            $this->keyValuePorposal = Fta2ArcadiaTransactionModel::createNewRecordset(
                            array(Fta2ArcadiaTransactionModel::FIELDNAME_ID_FTA => $idFta
                                , Fta2ArcadiaTransactionModel::FIELDNAME_CODE_ARTICLE_LDC => $codeArticleLdc
                                , Fta2ArcadiaTransactionModel::FIELDNAME_DATE_ENVOI => date("Y-m-d H:i:s")
                                , Fta2ArcadiaTransactionModel::FIELDNAME_ID_USER => $idUser
            ));
            Fta2ArcadiaTransactionModel::updateIdArcadiaTransaction($idFta, $this->keyValuePorposal);
            break;
    }
}

function getActionProposal() {
    return $this->actionProposal;
}

function setActionProposal($actionProposal, $paramType) {
    /**
     * Initialisation de la key proposal en BDD
     */
    $this->setKeyValuePorposal($paramType);

    /**
     * Actualisation du type d'action
     */
    if ($this->getKeyValueProposal()) {
        $fta2ArcadiaTrasactionModel = new Fta2ArcadiaTransactionModel($this->getKeyValueProposal());
        $fta2ArcadiaTrasactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_TAG_TYPE_TRANSACTION)->setFieldValue($actionProposal);
        $fta2ArcadiaTrasactionModel->saveToDatabase();
        $this->setXMLRecordsetBalise($actionProposal);
        $this->setXMLRecordsetBaliseEspProduitFini($actionProposal);
        $this->actionProposal = $actionProposal;
    }
}

/**
 * Vérification de tous les champs de balises
 */
function transformAll() {
    $this->transformDIN();
    $this->transformEanArticle();
    $this->transformExport();
    $this->transformEnvironConserv();
    $this->transformCodFamVte();
    $this->transformCodSousFamille();
    $this->transformLibelleTarif();
    $this->transformCodeDouane();
    $this->transformLogoEmballage();
    $this->transformDLC();
    $this->transformCommentairePrive();
    $this->transformDureeDeVie();
    $this->transformDTS();
    $this->transformPoidsMaxiAndMini();
    $this->transformUniteFacturation();
    $this->transformCelluleArticleArcadia();
    $this->transformFamilleEcoEmballagesArcadia();
    $this->transformMarqueArcadia();
    $this->transformCREATE();
    $this->transformSiteDePorduction();
    $this->transformGammeCoop();
    $this->transformGammeFamilleBudget();
    $this->transformFamilleBudget();
    $this->transformFestif();
    $this->transformCodPoidsCstUvc();
    $this->transformOptiventes();
    $this->transformSiteDePreparationReception();
    $this->transformCodPCB();
    $this->transformAcregQuantieEmplacement();
    $this->transformDun14();
    $this->transformTypeCarton();
    $this->transformDunPalette();
    $this->transformArtSite();
}

/**
 * Initialisation des balises avec le code article ldc et idFta 
 * (ou autres colones clé tel que numero variante pour les produits fini)
 */
function setAllBalise() {
    $this->transformNoArtKey();
    $this->setXMLArcadiaParametre();
    $this->setXMLArcadiaCodProduit();
}

/**
 * On détermine si oui ou non on affiche les données public
 */
function setPublicBalise() {
    /**
     * On n'affiche pas les donées publiques
     *  car une conditions de validation est demandé lors du pré-chargement
     */
    $this->setArcadiaPublicDataTrue();
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
        $this->transformIsHallal();
//        $this->transformGeneriqueFm();  // voir comentaire de la fonction
        $this->transformTypeConditPub();
        $this->transformUniteConditionnement();
        $this->transformAcregLieu();
    }
}

/**
 * Initialisation des balises dont la valeur ne change pas 
 */
function transformIsHallal() {
    $this->setXMLArcadiaIsHallal();
}

/**
 * Si le code artcile n'est pas renseigné alors on affiche un code article vide
 */
function transformNoArtKey() {
    $codeArticleLDC = " ";
    if ($this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()) {
        $codeArticleLDC = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
    }
    $this->setXMLArcadiaNoArtKey($codeArticleLDC);
}

/**
 * Initialisation des balises dont la valeur ne change pas 
 */
function transformAcregLieu() {
    $this->setXMLArcadiaAcregLieu();
    $this->setXMLArcadiaAcregLieuSecondaire();
}

/**
 * Initialisation des balises dont la valeur ne change pas
 */
function transformColisageSpecifique() {
    $this->setXMLArcadiaColisSpecifique();
}

/**
 * Initialisation des balises dont la valeur ne change pas
 */
function transformColisageStandard() {
    $this->setXMLArcadiaColisStandard();
}

/**
 * Initialisation des balises dont la valeur ne change pas 
 */
function transformTypeConditPub() {
    $this->setXMLArcadiaCodTypeConditPub();
}

/**
 * Initialisation des balises dont la valeur ne change pas
 * Cette fonction n'est pas active mais implémenté
 * Lors de la création d'un article ce champ et automatiquement renseigné
 * et il ne bouge pas lors des mise à jour. 
 */
function transformGeneriqueFm() {
    $this->setXMLArcadiaCodGeneriqueFm();
}

/**
 * Initialisation des balises dont la valeur ne change pas 
 */
function transformUniteConditionnement() {
    $this->setXMLArcadiaUniteConditionnement();
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
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
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
        $this->setXMLarcadiaSiteValo($geoModel);
        $this->setXMLArcadiaFamilleDeclCaClient($geoModel->getDataField(geomodel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue());
    }
}

/**
 * On vérifie si le site d'expedition de la Fta a été modifié
 * Cela concerne le site principale et le site secondaire
 */
function transformSiteDePreparationReception() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $geoModel = $this->getFtaModel()->getModelSiteExpedition();
        $this->setXMLArcadiaAcregSite($geoModel);
        $this->setXMLArcadiaAcregSiteSecondaire($geoModel);
        $this->transformFileDePrepAndMethodeDePrep();

        /**
         * Si le site d'expedition change on affiche la table Produit Fini
         */
        $this->setArcadiaProduitFiniCheckTrue();
        /**
         * On vérifie sie le site d'expediction est PLB 
         * si oui 
         */
        if ($geoModel->getKeyValue() == GeoModel::ID_SITE_PLB) {
            $idMarque = $this->getFtaModel()->getModelClassificationFta2()->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
            /**
             * Si départ PLB et marque TDA ou Marie alors "2 - PLB - MARIE - TDA"
             */
            if ($idMarque == ClassificationFta2Model::ID_CLASSIFICATION_MARIE or $idMarque == ClassificationFta2Model::ID_CLASSIFICATION_TRADITION_DASIE) {
                $XMLarcadiaAcregTypeProdEmplacement = GeoArcadiaModel::CODE_TYPE_PRODUIT_PLB_MARIE_TDA;
            } else
            /**
             * Si départ PLB et différent de marque TDA ou Marie alors "3 - PLB - AGIS"
             */ {
                $XMLarcadiaAcregTypeProdEmplacement = GeoArcadiaModel::CODE_TYPE_PRODUIT_PLB_AGIS;
            }
        } else
        /**
         * Sinon : 50 ( Rodolphe peut être amené à mettre 51 )
         */ {
            $XMLarcadiaAcregTypeProdEmplacement = GeoArcadiaModel::CODE_TYPE_PRODUIT_PLATEFORME;
        }
        $this->setXMLArcadiaAcregTypeProdEmplacement($XMLarcadiaAcregTypeProdEmplacement);
    } else {
        /**
         * Si le site d'expedition ne change  pas on n'affiche pas la table Produit Fini
         */
        $this->setArcadiaProduitFiniCheckFalse();
    }
}

/**
 * Si le site de production a été modifié on actualise le file et methode de préparation
 */
function transformFileDePrepAndMethodeDePrep() {

    $geoArcadiaModel = $this->getFtaModel()->getModelGeoArcadiaExpe();
    $filePrep = $geoArcadiaModel->getDataField(GeoArcadiaModel::FIELDNAME_FILE_PREP)->getFieldValue();
    $methodePrep = $geoArcadiaModel->getDataField(GeoArcadiaModel::FIELDNAME_METHODE_PREP)->getFieldValue();

    $this->setXMLArcadiaAcregNomethode($methodePrep);
    $this->setXMLArcadiaAcregNoquai($filePrep);
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
 * On vérifie si la désignation commerciale de la Fta a été modifié
 */
function transformLibelleTarif() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $designationCommertialeValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
        $this->setXMLArcadiaLibelleTarif($designationCommertialeValue);
    }
}

/**
 * On vérifie si la EAN Article de la Fta a été modifié
 * En effet cette donnée concerne le Gencod Administratif
 */
function transformEanArticle() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
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
 * On vérifie si le commentaire sur la Fta a été modifié
 * En effet cette données concerne le commentaire privée
 */
function transformCommentairePrive() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_COMMENTAIRE)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $commentairePriveValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_COMMENTAIRE)->getFieldValue();
        if ($commentairePriveValue) {
            $this->setXMLArcadiaCommentairePrive($commentairePriveValue);
        }
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
 * Et on récupère les 8 premiers caractères 
 */
function transformCodeDouane() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $codeDouaneTmp = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA)->getFieldValue();
        $codeDouaneValue = FtaController::getFirstStringNumber($codeDouaneTmp, self::LIMIT_NUMBER_COD_NDP);
        $this->setXMLArcadiaCodeDouane($codeDouaneValue);
    }
}

/**
 * On vérifie si la classification a pour rayon "Libre service"
 * Si oui la balise Eco-Emballages est à oui et  la balise site de reference Eco Emballages est obligatoire
 * d'aprés le site de production
 * Si non la balise Eco-Emballages est à non
 */
function transformLogoEmballage() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $soumiEcoEmballageValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUMIS_ECO_EMBALLAGE)->getFieldValue();
        if ($soumiEcoEmballageValue) {
            $geoModel = $this->getFtaModel()->getModelSiteProduction();
            $this->setXMLArcadiaSiteRefEcoEmb($geoModel->getDataField(geomodel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue());
        }
        $this->setXMLArcadiaLogoEcoEmballage($soumiEcoEmballageValue);
    }
}

/**
 * On vérifie si l'unité de facturation a été modifié
 */
function transformUniteFacturation() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $uniteFacturationArcadiaValue = $this->getFtaModel()->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_UNITE_FACTURATION)->getFieldValue();
        $methodeDePreparationArcadiaValue = $this->getFtaModel()->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_METHODE_DE_PREPARATION)->getFieldValue();
        $typePreparationAcquisitionArcadiaValue = $this->getFtaModel()->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_TYPE_PREPA_ACQUISITION)->getFieldValue();
        $this->setXMLArcadiaUniteDeFacturation($uniteFacturationArcadiaValue);
        $this->setXMLArcadiaMethodeDePreparation($methodeDePreparationArcadiaValue);
        $this->setXMLArcadiaTypePreparationAcquisition($typePreparationAcquisitionArcadiaValue);
    }
}

/**
 * On vérifie si la cellule de l'article arcadia a été modifié
 */
function transformCelluleArticleArcadia() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_CELLULE_ARTICLE)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $CelluleArticleArcadiaValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_CELLULE_ARTICLE)->getFieldValue();
        $this->setXMLArcadiaCelluleArticle($CelluleArticleArcadiaValue);
    }
}

/**
 * On vérifie si la famille eco emballages arcadia a été modifié
 */
function transformFamilleEcoEmballagesArcadia() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_ECO_EMBALLAGES)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $FamilleEcoEmballagesArcadiaValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_ECO_EMBALLAGES)->getFieldValue();
        $this->setXMLArcadiaFamilleEcoEmballages("0" . $FamilleEcoEmballagesArcadiaValue);
    }
}

/**
 * On vérifie si la marque arcadia a été modifié
 */
function transformMarqueArcadia() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $idArcadiaMarque = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE)->getFieldValue();
        $this->setXMLArcadiaMarque($idArcadiaMarque);
    }
}

/**
 * On vérifie si la famille budget a été modifié
 */
function transformFamilleBudget() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $idFamilleBudget = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET)->getFieldValue();
        $this->setXMLArcadiaFamilleBudget($idFamilleBudget);
    }
}

/**
 * On vérifie si la gamme famille budgete a été modifié
 */
function transformGammeFamilleBudget() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $idGammeFamillleBudget = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldValue();
        $this->setXMLArcadiaGammeFamilleBudget($idGammeFamillleBudget);
    }
}

/**
 * On vérifie si la gamme coop a été modifié
 */
function transformGammeCoop() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $idArcadiaGammeCoop = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP)->getFieldValue();
        $this->setXMLArcadiaGammeCoop($idArcadiaGammeCoop);
    }
}

/**
 * On vérifie si la classification a été modifié
 * si oui on verifie si la saisonalité est festive alors COD_FESTIF est à oui
 */
function transformFestif() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $idClassificationFta2 = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        $idSaisonalite = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE);
        if ($idSaisonalite == ClassificationFta2Model::ID_CLASSIFICATION_FESTIF) {
            $festifValue = self::OUI;
        } else {
            $festifValue = self::NON;
        }
        $this->setXMLArcadiaFestif($festifValue);
    }
}

/**
 * On vérifie si la catégorie du produit optivente a été modifié
 */
function transformOptiventes() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $CategorieProduitOptiventes = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES)->getFieldValue();
        $this->setXMLArcadiaOptiventes($CategorieProduitOptiventes);
    }
}

/**
 * On vérifie si la sous famille a été modifié
 */
function transformCodSousFamille() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $codSousFamilleValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->getFieldValue();
        $this->setXMLArcadiaCodSousFam($codSousFamilleValue);
    }
}

/**
 * On vérifie si la famille vente a été modifié
 */
function transformCodFamVte() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $codFamilleVenteValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldValue();
        $this->setXMLArcadiaCodFamVte($codFamilleVenteValue);
    }
}

/**
 * On vérifie si l'environnement de conservation a été modifié
 */
function transformEnvironConserv() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION)->isFieldDiff();
    if (($checkDiff and $this->IsArcadiaPublicDataCheck()) or $this->getActionProposal() == self::CREATE) {
        $idArcaciaEnvConservValue = $this->getFtaModel()->getModelAnnexeEnvironnementConservationGroupe()->getDataField(AnnexeEnvironnementConservationGroupeModel::FIELDNAME_CORRESPONDANCE_ARCADIA)->getFieldValue();
        $this->setXMLArcadiaEnvironConserv($idArcaciaEnvConservValue);
    }
}

/**
 * On vérifie si la classification a été modifié 
 * si oui on vérifie si la classification à pour réseau export 
 * si oui export est à oui sinon par défaut à non
 */
function transformExport() {
    /**
     * Vérifie la classification actuelle
     */
    $exportValue = self::NON;
    $idClassification2 = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
    $classification2Model = new ClassificationFta2Model($idClassification2);
    $idClassificationCheck = $classification2Model->getIdClassificationByTypeName(ClassificationFta2Model::FIELDNAME_ID_RESEAU);
    if ($idClassificationCheck == ClassificationFta2Model::ID_CLASSIFICATION_EXPORT) {
        $exportValue = self::oui;
    }
    /**
     * Vérifie l'actualisation de la données
     */
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE) {
        $this->setXMLArcadiaExport($exportValue);
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

/**
 * Actualisation de la quantité standard
 */
function transformAcregQuantieEmplacement() {

    /**
     * Pour les produits à marque L'ILASIA, laisser la valeur par défaut car inutilisée.
     */
    $nombresColisParPalette = "";
    $idMarque = $this->getFtaModel()->getModelClassificationFta2()->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
    if ($idMarque <> ClassificationFta2Model::ID_CLASSIFICATION_LIASIA) {
        /**
         * FTA > palettisation > Nombre total de Carton par palette
         */
        $return = $this->getFtaModel()->buildArrayEmballageTypePalette();
        $nombresColisParPalette = $return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON];
    }

    $this->setXMLArcadiaAcregQuantiteEmplacement($nombresColisParPalette);
}

/**
 * On vérifie si le PCB a été modifié et on adapte la table Dun14 en fonction
 */
function transformCodPCB() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->isFieldDiff();
    if ($checkDiff) {
        /**
         * Si le PCB est diférrent on supprimer le pcb de l'ancienne version
         * Activation : ACTION_DELETE_ENABLED
         * Désactivation : ACTION_DELETE_DISABLED
         */
        if (self::ACTION_DELETE_DISABLED) {
            $pcbOldVersionData = $this->getFtaModel()->getDataToCompare();
            $pcbOldVersionValue = $pcbOldVersionData->getFieldValue(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON);
            $this->setArcadiaDun14RecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseDun14Delete($pcbOldVersionValue);
        }
        /**
         * On ajout le nouvelle enregistrement         
         */
        $action = self::CREATE;
        $this->setArcadiaDun14RecordValue(self::AJOUT_DUN_RECORDSET);
        $this->setXMLRecordsetBaliseDun14($action);
        /**
         * Le PCB a été modifié dont il faut afficher la table dun14 dans tous les cas
         */
        $this->setArcadiaDun14CheckTrue();
    } else {
        /**
         * Si le PCB n'est pas différent 
         * On vérifie si il s'agit d'une mise à jour de donnée ou une création
         * @todo Après des test unitaire la création Dun14 ne fonctionnent pas on bloque se fonctionnnement 
         */
        $action = $this->getActionProposal();
        $this->checkDun14ActionType();
        $this->setArcadiaDun14RecordValue(self::AJOUT_DUN_RECORDSET);
        $this->setXMLRecordsetBaliseDun14($action);
        /**
         * Le PCB n'a pas été modifié mais on initalise quand même la valeur,
         *  dans le cas les autres valeurs sont initalisées.
         */
        $this->setArcadiaDun14CheckFalse();
    }
    /**
     * Dans tous les cas on initialise le cod PCB
     */
    $pcbValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
    $this->setXMLArcadiaCodPCB($pcbValue);

    /**
     * Initialisation des colisages pour le nouvelle enregistrement
     */
    $this->transformColisageSpecifique();
    $this->transformColisageStandard();
}

/**
 * Vérification du type d'action
 */
function checkDun14ActionType() {
    if ($this->getActionProposal() == self::CREATE) {
        /**
         * Lors des test il a fallut désactiver la table dun14 afin de le rendre fonctionnelle
         */
//        $this->setArcadiaDun14CreateFalse();
        $this->setArcadiaDun14CreateTrue();
    } else {
        $this->setArcadiaDun14CreateTrue();
    }
}

/**
 * On vérifie si EAN Colis a été modifié
 * si oui il renseigne le Dun14.
 */
function transformDun14() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE or $this->getArcadiaDun14Check()) {
        $eanColisValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldValue();
        $this->setXMLArcadiaDun14($eanColisValue);
        /**
         * Si l'EAN Colis a été modifié alors on affiche la table Dun14
         */
        $this->setArcadiaDun14CheckTrue();
    } else {
        $this->setArcadiaDun14CheckFalse();
    }
}

/**
 * On vérifie si Type de Carton colis a été modifié
 * si oui il renseigne le TypeCarton.
 */
function transformTypeCarton() {
    $checkDiff = $this->getFtaModel()->checkEmballageDuColisIsDiff();
    if ($checkDiff or$this->getActionProposal() == self::CREATE or $this->getArcadiaDun14Check()) {
        $idTypeCartonArcadia = $this->getFtaModel()->getIdArcadiaTypeCarton();

        $this->setXMLArcadiaTypeCarton($idTypeCartonArcadia);
        /**
         * Si l'EAN Palette a été modifié alors on affiche la table Dun14
         */
        $this->setArcadiaDun14CheckTrue();
    } else {
        $this->setArcadiaDun14CheckFalse();
    }
}

/**
 * On vérifie si EAN Palette a été modifié
 * si oui il renseigne le DunPalette.
 */
function transformDunPalette() {
    $checkDiff = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->isFieldDiff();
    if ($checkDiff or $this->getActionProposal() == self::CREATE or $this->getArcadiaDun14Check()) {
        $eanPaletteValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->getFieldValue();
        $this->setXMLArcadiaDunPalette($eanPaletteValue);
        /**
         * Si l'EAN Palette a été modifié alors on affiche la table Dun14
         */
        $this->setArcadiaDun14CheckTrue();
    } else {
        $this->setArcadiaDun14CheckFalse();
    }
}

/**
 * On vérifie les différents conditions pour la table ArtSite selon le site d'expédition et le site de production
 */
function transformArtSite() {
    $checkDiffExpe = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA)->isFieldDiff();
    $checkDiffProduc = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->isFieldDiff();
    $geoModelExp = $this->getFtaModel()->getModelSiteExpedition();
    $geoModelProd = $this->getFtaModel()->getModelSiteProduction();
    if ($this->getActionProposal() == self::CREATE) {
        /**
         * On vérifie auparavant si il y a un ou deux enregistrement 
         * pour la table artsite dans le cas d'une création de données
         */
        $checkValueNumberRecordset = $this->isArtSitePrimaireTwo();

        if ($checkValueNumberRecordset) {
            /**
             * Le site d'expedition est différent de celui de production
             */
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteOne($geoModelExp);

            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteTwo($geoModelProd);
            /**
             * On informe qu'il y a bien deux enregistrements
             */
            $this->setArcadiaArtSiteRecordTwoCheckTrue();

            /**
             * On initalise les valeurs du recordset two
             */
            $this->initiateArtSiteRecordsetTwo();
            /**
             * On initalise les valeurs du recordset one
             */
            $this->initiateArtSiteRecordsetOne();
        } else {
            /**
             * Le site d'expedition est le même que celui de production
             */
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);

            $this->setXMLRecordsetBaliseArtSiteOne($geoModelExp);

            /**
             * On informe qu'il y a bien un enregistrements
             */
            $this->setArcadiaArtSiteRecordTwoCheckFalse();
            /**
             * On initalise les valeurs du recordset one
             */
            $this->initiateArtSiteRecordsetOne();
        }

        /**
         * On ajoute la table artisite
         */
        $this->setArcadiaArtSiteCheckTrue();
    } elseif ($checkDiffProduc or $checkDiffExpe) {
        /**
         * On vérifie auparavant si il y a un ou deux enregistrement 
         * pour la table artsite pour la version précedente et actuelle
         * dans le cas d'une mise à jour de données
         */
        $checkValueNumberRecordsetOldVersion = $this->isArtSitePrimaireTwoForPreviousVersionFta();
        $siteExpeditionValue = $this->getFtaModel()->getDataToCompare()->getFieldValue(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);
        $geoModelExpeOld = new GeoModel($siteExpeditionValue);

        if ($checkValueNumberRecordsetOldVersion) {
            /**
             * Le site d'expedition est différent de celui de production
             */
            $siteDeProductionValue = $this->getFtaModel()->getDataToCompare()->getFieldValue(FtaModel::FIELDNAME_SITE_PRODUCTION);
            $geoModelProdOld = new GeoModel($siteDeProductionValue);

            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteUpdateTwo($geoModelExpeOld, $geoModelProdOld);
        } else {
            /**
             * Le site d'expedition est le même que celui de production
             */
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);

            $this->setXMLRecordsetBaliseArtSiteUpdateOne($geoModelExpeOld);
        }

        $checkValueNumberRecordsetNewVersion = $this->isArtSitePrimaireTwo();

        if ($checkValueNumberRecordsetNewVersion) {
            /**
             * Le site d'expedition est différent de celui de production
             */
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteOne($geoModelExp);
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteTwo($geoModelProd);
            /**
             * On informe qu'il y a bien deux enregistrements
             */
            $this->setArcadiaArtSiteRecordTwoCheckTrue();

            /**
             * On initalise les valeurs du recordset two
             */
            $this->initiateArtSiteRecordsetTwo();
            /**
             * On initalise les valeurs du recordset one
             */
            $this->initiateArtSiteRecordsetOne();
        } else {
            /**
             * Le site d'expedition est le même que celui de production
             */
            $this->setArcadiaArtSiteRecordValue(self::AJOUT_DUN_RECORDSET);
            $this->setXMLRecordsetBaliseArtSiteOne($geoModelExp);
            /**
             * On informe qu'il y a bien deux enregistrements
             */
            $this->setArcadiaArtSiteRecordTwoCheckFalse();
            /**
             * On initalise les valeurs du recordset one
             */
            $this->initiateArtSiteRecordsetOne();
        }
        /**
         * On ajoute la table artisite
         */
        $this->setArcadiaArtSiteCheckTrue();
    } else {
        /**
         * On n'ajoute pas la table artisite
         */
        $this->setArcadiaArtSiteCheckFalse();
    }
}

/**
 * On initalise les valeurs du recordset one
 *  On récupère les différents éléments du deuxième recordset
 */
function initiateArtSiteRecordsetTwo() {
    /**
     * On initalise les valeurs du recordset one
     */
    $ArtSiteCodPosteCC = $this->getFtaModel()->getModelGeoArcadiaProd()->getDataField(GeoArcadiaModel::FIELDNAME_CODE_POSTE_ARCADIA)->getFieldValue();
    $this->setXMLArcadiaArtSiteCodPosteCC($ArtSiteCodPosteCC);
    $this->setXMLArcadiaArtSiteCodAtelier(GeoArcadiaModel::CODE_ATELIER);
    $this->setXMLArcadiaArtSiteSiteAffectRes();
    $this->setXMLArcadiaArtSiteDateDebutEffet();
    $this->setXMLArcadiaArtSiteDateFinEffet();

    /**
     * On récupère les différents éléments du deuxième recordset
     */
    $XMLrecordsetArtSiteTwo = $this->getXMLArcadiaArtSiteCodPosteCC()
            . $this->getXMLArcadiaArtSiteCodAtelier()
            . $this->getXMLArcadiaArtSiteSiteAffectRes();
    $this->setXMLrecordsetArtSiteTwo($XMLrecordsetArtSiteTwo);
}

/**
 * On initalise les valeurs du recordset one
 */
function initiateArtSiteRecordsetOne() {
    /**
     * On initalise les valeurs du recordset one
     */
    $ArtSiteCodPosteCC = $this->getFtaModel()->getModelGeoArcadiaExpe()->getDataField(GeoArcadiaModel::FIELDNAME_CODE_POSTE_ARCADIA)->getFieldValue();
    $this->setXMLArcadiaArtSiteCodPosteCC($ArtSiteCodPosteCC);
    $this->setXMLArcadiaArtSiteCodAtelier(GeoArcadiaModel::CODE_ATELIER);
    $this->setXMLArcadiaArtSiteSiteAffectRes();
    $this->setXMLArcadiaArtSiteDateDebutEffet();
    $this->setXMLArcadiaArtSiteDateFinEffet();
}

/**
 * On vérifie le site de production et le même que le site d'expedition
 * Si il y a deux enregistrement TRUE ou un seul enregistremetn FALSE
 */
function isArtSitePrimaireTwo() {

    $siteDeProductionValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
    $siteExpeditionValue = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA)->getFieldValue();
    /**
     * Si oui alors on ne traite qu'un enregistrement 
     * pour le site primaire
     */
    if ($siteDeProductionValue <> $siteExpeditionValue) {
        $isArtSitePrimaireTwo = self::TRUE;
    } else {
        $isArtSitePrimaireTwo = self::FALSE;
    }
    return $isArtSitePrimaireTwo;
}

/**
 * On vérifie le site de production et le même que le site d'expedition 
 * pour la version précédent de la Fta encours
 * Si il y a deux enregistrement TRUE ou un seul enregistremetn FALSE
 */
function isArtSitePrimaireTwoForPreviousVersionFta() {

    $siteDeProductionValue = $this->getFtaModel()->getDataToCompare()->getFieldValue(FtaModel::FIELDNAME_SITE_PRODUCTION);
    $siteExpeditionValue = $this->getFtaModel()->getDataToCompare()->getFieldValue(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);
    /**
     * Si oui alors on ne traite qu'un enregistrement 
     * pour le site primaire
     */
    if ($siteDeProductionValue == $siteExpeditionValue) {
        $isArtSitePrimaireTwo = self::FALSE;
    } else {
        $isArtSitePrimaireTwo = self::TRUE;
    }
    return $isArtSitePrimaireTwo;
}

function IsArcadiaPublicDataCheck() {
    return $this->arcadiaPublicData;
}

function setIsArcadiaPublicDataCheck($arcadiaPublicData) {
    $this->arcadiaPublicData = $arcadiaPublicData;
}

function setArcadiaPublicDataFalse() {
    $this->setIsArcadiaPublicDataCheck(self::FALSE);
}

function setArcadiaPublicDataTrue() {
    $this->setIsArcadiaPublicDataCheck(self::TRUE);
}

function getXMLRecordsetBalise() {
    return $this->XMLrecordsetBalise;
}

function setXMLRecordsetBalise($actionProposal) {
    $this->XMLrecordsetBalise = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"1\" action=\"" . $actionProposal . "\">" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaNoArtKey() {
    return $this->XMLarcadiaNoArtKey;
}

function setXMLArcadiaNoArtKey($paramCodeArticleLDC) {
    if ($paramCodeArticleLDC == " ") {
        $xmlArtKey = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<NO_ART key=\"TRUE\"></NO_ART>" . self::SAUT_DE_LIGNE;
    } else {
        $xmlArtKey = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
                . "<NO_ART key=\"TRUE\">" . $paramCodeArticleLDC . "</NO_ART>" . self::SAUT_DE_LIGNE;
    }
    $this->XMLarcadiaNoArtKey = $xmlArtKey;
}

function getXMLArcadiaParametre() {
    return $this->XMLarcadiaParametre;
}

function setXMLArcadiaParametre() {
    $codeArtcileLDC = " ";
    if ($this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()) {
        $codeArtcileLDC = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
    }
    $this->XMLarcadiaParametre = self::TABULATION . "<Parameters>" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . "<IdFirm>" . self::COD_SOCIETE_AGIS . "</IdFirm><!-- Agis -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . "<IdArcadia>" . $codeArtcileLDC . "</IdArcadia><!-- Code article dans Arcadia -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . "<IdFta>" . $this->getFtaModel()->getDataField(FtaModel::KEYNAME)->getFieldValue() . "</IdFta><!-- N° de la FTA -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . "</Parameters>" . self::SAUT_DE_LIGNE;
}

function getArcadiaExportResult() {
    return $this->arcadiaExportResult;
}

function setArcadiaExportResult($arcadiaExportResult) {
    $this->arcadiaExportResult = $arcadiaExportResult;
}

function getXMLArcadiaExport() {
    return $this->XMLarcadiaExport;
}

function setXMLArcadiaExport($XMLarcadiaExport) {
    $this->XMLarcadiaExport = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<IS_EXPORT>" . $XMLarcadiaExport . "</IS_EXPORT>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaArticleRefLicCcial() {
    return $this->XMLarcadiaArticleRefLicCcial;
}

function getXMLArcadiaArticleRefLicProduction() {
    return $this->XMLarcadiaArticleRefLicProduction;
}

function setXMLArcadiaArticleRefLicCcial($paramArcadiaArticleRefLicCcial) {
    $value = "";
    if ($paramArcadiaArticleRefLicCcial) {
        $value = self::CDATA_OPEN . $paramArcadiaArticleRefLicCcial . self::CDATA_CLOSE;
    }
    $this->XMLarcadiaArticleRefLicCcial = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<LIB_CCIAL>" . $value . "</LIB_CCIAL>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaArticleRefLicProduction($paramArcadiaArticleRefLicProduction) {
    $value = "";
    if ($paramArcadiaArticleRefLicProduction) {
        $value = self::CDATA_OPEN . $paramArcadiaArticleRefLicProduction . self::CDATA_CLOSE;
    }
    $this->XMLarcadiaArticleRefLicProduction = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<LIB_PRODUCTION>" . $value . "</LIB_PRODUCTION>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaEanArticle() {
    return $this->XMLarcadiaEanArticle;
}

function setXMLArcadiaEanArticle($paramArcadiaEanArticle) {
    $this->XMLarcadiaEanArticle = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_GENCOD_ADM>" . $paramArcadiaEanArticle . "</COD_GENCOD_ADM>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodeDouane() {
    return $this->XMLarcadiaCodeDouane;
}

function setXMLArcadiaCodeDouane($paramArcadiaCodeDouane) {
    $this->XMLarcadiaCodeDouane = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_NDP>" . $paramArcadiaCodeDouane . "</COD_NDP>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaLogoEcoEmballage() {
    return $this->XMLarcadiaLogoEcoEmballage;
}

function setXMLArcadiaLogoEcoEmballage($paramArcadiaLogoEcoEmballage) {
    $this->XMLarcadiaLogoEcoEmballage = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<SOUMIS_ECO_EMBALLAGE>" . $paramArcadiaLogoEcoEmballage . "</SOUMIS_ECO_EMBALLAGE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaIsHallal() {
    return $this->XMLarcadiaIsHallal;
}

function setXMLArcadiaIsHallal() {
    $this->XMLarcadiaIsHallal = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<IS_HALLAL>" . self::NON . "</IS_HALLAL><!-- Non --> " . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodGeneriqueFm() {
    return $this->XMLarcadiaCodGeneriqueFm;
}

function setXMLArcadiaCodGeneriqueFm() {
    $this->XMLarcadiaCodGeneriqueFm = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_GENERIQUE_FM>" . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() . "</COD_GENERIQUE_FM> " . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodSousFam() {
    return $this->XMLarcadiaCodSousFam;
}

function setXMLArcadiaCodSousFam($XMLarcadiaCodSousFam) {
    $this->XMLarcadiaCodSousFam = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SOUSFAM>" . $XMLarcadiaCodSousFam . "</COD_SOUSFAM>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodFamVte() {
    return $this->XMLarcadiaCodFamVte;
}

function setXMLArcadiaCodFamVte($XMLarcadiaCodFamVte) {
    $this->XMLarcadiaCodFamVte = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_FAMVTE>" . $XMLarcadiaCodFamVte . "</COD_FAMVTE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaEnvironConserv() {
    return $this->XMLarcadiaEnvironConserv;
}

function setXMLArcadiaEnvironConserv($XMLarcadiaEnvironConser) {
    $this->XMLarcadiaEnvironConserv = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<FRAIS_CONGELE>" . $XMLarcadiaEnvironConser . "</FRAIS_CONGELE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodTypeConditPub() {
    return $this->XMLarcadiaCodTypeConditPub;
}

function setXMLArcadiaCodTypeConditPub() {
    $this->XMLarcadiaCodTypeConditPub = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_TYP_CONDIT_PUB>" . self::NON . "</COD_TYP_CONDIT_PUB>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaUniteConditionnement() {
    return $this->XMLarcadiaUniteConditionnement;
}

function setXMLArcadiaUniteConditionnement() {
    $this->XMLarcadiaUniteConditionnement = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<UC>" . self::NB_UNITE_CONDITIONNEMENT . "</UC>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaSiteRefEcoEmb() {
    return $this->XMLarcadiaSiteRefEcoEmb;
}

function setXMLArcadiaSiteRefEcoEmb($XMLarcadiaSiteRefEcoEmb) {
    $this->XMLarcadiaSiteRefEcoEmb = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<SITE_REF_ECO_EMB>" . $XMLarcadiaSiteRefEcoEmb . "</SITE_REF_ECO_EMB>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaOptiventes() {
    return $this->XMLarcadiaOptiventes;
}

function setXMLArcadiaOptiventes($XMLarcadiaOptiventes) {
    $this->XMLarcadiaOptiventes = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_CIRCUIT>" . $XMLarcadiaOptiventes . "</COD_CIRCUIT>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaLibelleTarif() {
    return $this->XMLarcadiaLibelleTarif;
}

function setXMLArcadiaLibelleTarif($XMLarcadiaLibelleTarif) {
    $value = "";
    if ($XMLarcadiaLibelleTarif) {
        $value = self::CDATA_OPEN . $XMLarcadiaLibelleTarif . self::CDATA_CLOSE;
    }
    $this->XMLarcadiaLibelleTarif = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<LIBELLE_TARIF>" . $value . "</LIBELLE_TARIF>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaFamilleBudget() {
    return $this->XMLarcadiaFamilleBudget;
}

function getXMLArcadiaGammeFamilleBudget() {
    return $this->XMLarcadiaGammeFamilleBudget;
}

function getXMLArcadiaGammeCoop() {
    return $this->XMLarcadiaGammeCoop;
}

function getXMLArcadiaFestif() {
    return $this->XMLarcadiaFestif;
}

function getXMLArcadiaFamilleDeclCaClient() {
    return $this->XMLarcadiaFamilleDeclCaClient;
}

function setXMLArcadiaFamilleBudget($XMLarcadiaFamilleBudget) {
    $this->XMLarcadiaFamilleBudget = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_FAM_BUDGET>" . $XMLarcadiaFamilleBudget . "</COD_FAM_BUDGET>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaGammeFamilleBudget($XMLarcadiaGammeFamilleBudget) {
    $this->XMLarcadiaGammeFamilleBudget = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_GAM_FAM_BUDGET>" . $XMLarcadiaGammeFamilleBudget . "</COD_GAM_FAM_BUDGET>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaGammeCoop($XMLarcadiaGammeCoop) {
    $this->XMLarcadiaGammeCoop = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_GAM_COOP>" . $XMLarcadiaGammeCoop . "</COD_GAM_COOP>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaFestif($XMLarcadiaFestif) {
    $this->XMLarcadiaFestif = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_FESTIF>" . $XMLarcadiaFestif . "</COD_FESTIF>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaFamilleDeclCaClient($XMLarcadiaFamilleDeclCaClient) {
    $this->XMLarcadiaFamilleDeclCaClient = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_FAM_DECL_CA_CLIENT>" . $XMLarcadiaFamilleDeclCaClient . "</COD_FAM_DECL_CA_CLIENT>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaMarque() {
    return $this->XMLarcadiaMarque;
}

function setXMLArcadiaMarque($XMLarcadiaMarque) {
    $this->XMLarcadiaMarque = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_MARQUE>" . $XMLarcadiaMarque . "</COD_MARQUE>" . self::SAUT_DE_LIGNE;
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

function getXMLarcadiaSiteValo() {
    return $this->XMLarcadiaSiteValo;
}

function setXMLarcadiaSiteValo(GeoModel $paramArcadiaSiteDeProdModel) {

    $recordsetGeoArcadia = new GeoArcadiaModel($paramArcadiaSiteDeProdModel->getKeyValue());
    $idSiteValorisation = $recordsetGeoArcadia->getDataField(GeoArcadiaModel::FIELDNAME_ID_SITE_VALORISATION)->getFieldValue();

    $this->XMLarcadiaSiteValo = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<SITE_VALO>"
            //. $paramArcadiaSiteDeProdModel->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() 
            . $idSiteValorisation
            . "</SITE_VALO><!-- "
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
            . "<UNITE_FACT>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT>" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<UNITE_FACT_PRIVE>" . $paramArcadiaUniteDeFacturation . "</UNITE_FACT_PRIVE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaMethodeDePreparation() {
    return $this->XMLarcadiaMethodeDePreparation;
}

function getXMLArcadiaTypePreparationAcquisition() {
    return $this->XMLarcadiaTypePreparationAcquisition;
}

function setXMLArcadiaMethodeDePreparation($XMLarcadiaMethodeDePreparation) {
    $this->XMLarcadiaMethodeDePreparation = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<REG_METH_PREPA>" . $XMLarcadiaMethodeDePreparation . "</REG_METH_PREPA>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaTypePreparationAcquisition($XMLarcadiaTypePreparationAcquisition) {
    $this->XMLarcadiaTypePreparationAcquisition = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<REG_TYPREPA_ACQUISITION>" . $XMLarcadiaTypePreparationAcquisition . "</REG_TYPREPA_ACQUISITION>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCelluleArticle() {
    return $this->XMLarcadiaCelluleArticle;
}

function getXMLArcadiaFamilleEcoEmballages() {
    return $this->XMLarcadiaFamilleEcoEmballages;
}

function setXMLArcadiaCelluleArticle($paramArcadiaCelluleArticle) {
    $this->XMLarcadiaCelluleArticle = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<CELLULE>" . $paramArcadiaCelluleArticle . "</CELLULE>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaFamilleEcoEmballages($paramArcadiaFamilleEcoEmballages) {
    $this->XMLarcadiaFamilleEcoEmballages = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_FAMECOEMB>" . $paramArcadiaFamilleEcoEmballages . "</COD_FAMECOEMB>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaPoidsMini() {
    return $this->XMLarcadiaPoidsMini;
}

function getXMLArcadiaPoidsMaxi() {
    return $this->XMLarcadiaPoidsMaxi;
}

function setXMLArcadiaPoidsMini($paramArcadiaPoidsMini) {
    $this->XMLarcadiaPoidsMini = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
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
            . "<DLC_CCIAL>" . $arcadiaDLC . "</DLC_CCIAL>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCommentairePrive() {
    return $this->XMLarcadiaCommentairePrive;
}

function setXMLArcadiaCommentairePrive($XMLarcadiaCommentairePrive) {
    $this->XMLarcadiaCommentairePrive = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COM_PRIVE>" . self::CDATA_OPEN . $XMLarcadiaCommentairePrive . self::CDATA_CLOSE . "</COM_PRIVE>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaDureeDeVie($arcadiaDureeDeVie) {
    $this->XMLarcadiaDureeDeVie = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DUREE_VIE>" . $arcadiaDureeDeVie . "</DUREE_VIE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodProduit() {
    return $this->XMLarcadiaCodProduit;
}

function setXMLArcadiaCodProduit() {
    $codeArtcileLDC = " ";
    if ($this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()) {
        $codeArtcileLDC = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
    }
    $this->XMLarcadiaCodProduit = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_PRODUIT key=\"TRUE\">" . $codeArtcileLDC . "</COD_PRODUIT>" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NO_VAR>" . self::NON . "</NO_VAR><!-- Numéro variante -->" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaAcregSite() {
    return $this->XMLarcadiaAcregSite;
}

function getXMLArcadiaAcregLieu() {
    return $this->XMLarcadiaAcregLieu;
}

function getXMLArcadiaAcregNoQuai() {
    return $this->XMLarcadiaAcregNoquai;
}

function getXMLArcadiaAcregNoMethode() {
    return $this->XMLarcadiaAcregNomethode;
}

function setXMLArcadiaAcregSite(GeoModel $XMLarcadiaAcregSite) {
    $this->XMLarcadiaAcregSite = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_SITE>"
            . $XMLarcadiaAcregSite->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() . "</ACREG_SITE><!-- "
            . $XMLarcadiaAcregSite->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->"
            . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregLieu() {
    $this->XMLarcadiaAcregLieu = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_LIEU>" . self::LIEU_PRODUIT_FINI . "</ACREG_LIEU>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregNoquai($XMLarcadiaAcregNoquai) {
    $this->XMLarcadiaAcregNoquai = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_NOQUAI>" . $XMLarcadiaAcregNoquai . "</ACREG_NOQUAI>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregNomethode($XMLarcadiaAcregNomethode) {
    $this->XMLarcadiaAcregNomethode = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_NOMETHODE>" . $XMLarcadiaAcregNomethode . "</ACREG_NOMETHODE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaAcregSiteSecondaire() {
    return $this->XMLarcadiaAcregSiteSecondaire;
}

function getXMLArcadiaAcregLieuSecondaire() {
    return $this->XMLarcadiaAcregLieuSecondaire;
}

function getXMLArcadiaAcregTypeProdEmplacement() {
    return $this->XMLarcadiaAcregTypeProdEmplacement;
}

function getXMLArcadiaAcregQuantiteEmplacement() {
    return $this->XMLarcadiaAcregQuantiteEmplacement;
}

function setXMLArcadiaAcregSiteSecondaire(GeoModel $XMLarcadiaAcregSiteSecondaire) {
    $this->XMLarcadiaAcregSiteSecondaire = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_SITESECONDAIRE>" . $XMLarcadiaAcregSiteSecondaire->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() . "</ACREG_SITESECONDAIRE><!-- "
            . $XMLarcadiaAcregSiteSecondaire->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->"
            . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregLieuSecondaire() {
    $this->XMLarcadiaAcregLieuSecondaire = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_LIEUSECONDAIRE>" . self::LIEU_PRODUIT_FINI . "</ACREG_LIEUSECONDAIRE>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregTypeProdEmplacement($XMLarcadiaAcregTypeProdEmplacement) {
    $this->XMLarcadiaAcregTypeProdEmplacement = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_TYPE_PROD_EMPLACEMENT>" . $XMLarcadiaAcregTypeProdEmplacement . "</ACREG_TYPE_PROD_EMPLACEMENT>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaAcregQuantiteEmplacement($XMLarcadiaAcregQuantiteEmplacement) {
    $this->XMLarcadiaAcregQuantiteEmplacement = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<ACREG_QUANTITE_EMPLACEMENT>" . $XMLarcadiaAcregQuantiteEmplacement . "</ACREG_QUANTITE_EMPLACEMENT>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaCodPCB() {
    return $this->XMLarcadiaCodPCB;
}

function getXMLArcadiaDun14() {
    return $this->XMLarcadiaDun14;
}

function getXMLArcadiaDunPalette() {
    return $this->XMLarcadiaDunPalette;
}

function setXMLArcadiaCodPCB($XMLarcadiaCodPCB) {
    $this->XMLarcadiaCodPCB = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_PCB key=\"TRUE\">" . $XMLarcadiaCodPCB . "</COD_PCB>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaDun14($XMLarcadiaDun14) {
    $this->XMLarcadiaDun14 = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DUN14>" . $XMLarcadiaDun14 . "</DUN14>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaDunPalette($XMLarcadiaDunPalette) {
    $this->XMLarcadiaDunPalette = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DUN_PALETTE>" . $XMLarcadiaDunPalette . "</DUN_PALETTE>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaTypeCarton() {
    return $this->XMLarcadiaTypeCarton;
}

function setXMLArcadiaTypeCarton($XMLarcadiaTypeCarton) {
    $this->XMLarcadiaTypeCarton = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<TYPE_CARTON>" . $XMLarcadiaTypeCarton . "</TYPE_CARTON>" . self::SAUT_DE_LIGNE;
}

function getXMLArcadiaColisSpecifique() {
    return $this->XMLarcadiaColisSpecifique;
}

function getXMLArcadiaColisStandard() {
    return $this->XMLarcadiaColisStandard;
}

function setXMLArcadiaColisSpecifique() {
    $this->XMLarcadiaColisSpecifique = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<IS_SPECIFIQUE>" . self::NON . "</IS_SPECIFIQUE>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaColisStandard() {
    $this->XMLarcadiaColisStandard = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<IS_STANDARD>" . self::OUI . "</IS_STANDARD>" . self::SAUT_DE_LIGNE;
}

function getArcadiaDun14Check() {
    return $this->arcadiaDun14Check;
}

function setArcadiaDun14Check($arcadiaDun14Check) {
    $this->arcadiaDun14Check = $arcadiaDun14Check;
}

function setArcadiaDun14CheckFalse() {
    $this->setArcadiaDun14Check(self::FALSE);
}

function setArcadiaDun14CheckTrue() {
    $this->setArcadiaDun14Check(self::TRUE);
}

function getArcadiaProduitFiniCheck() {
    return $this->arcadiaProduitFiniCheck;
}

function setArcadiaProduitFiniCheck($arcadiaProduitFiniCheck) {
    $this->arcadiaProduitFiniCheck = $arcadiaProduitFiniCheck;
}

function setArcadiaProduitFiniCheckFalse() {
    $this->setArcadiaProduitFiniCheck(self::FALSE);
}

function setArcadiaProduitFiniCheckTrue() {
    $this->setArcadiaProduitFiniCheck(self::TRUE);
}

function getArcadiaDun14Create() {
    return $this->arcadiaDun14Create;
}

function setArcadiaDun14Create($arcadiaDun14Create) {
    $this->arcadiaDun14Create = $arcadiaDun14Create;
}

function setArcadiaDun14CreateFalse() {
    $this->setArcadiaDun14Check(self::ACTION_CREATE_DISABLED);
}

function setArcadiaDun14CreateTrue() {
    $this->setArcadiaDun14Check(self::ACTION_CREATE_ENABLED);
}

function getArcadiaArtSiteCheck() {
    return $this->arcadiaArtSiteCheck;
}

function setArcadiaArtSiteCheck($arcadiaArtSiteCheck) {
    $this->arcadiaArtSiteCheck = $arcadiaArtSiteCheck;
}

function setArcadiaArtSiteCheckFalse() {
    $this->setArcadiaArtSiteCheck(self::FALSE);
}

function setArcadiaArtSiteCheckTrue() {
    $this->setArcadiaArtSiteCheck(self::TRUE);
}

function getArcadiaArtSiteRecordTwoCheck() {
    return $this->arcadiaArtSiteRecordTwoCheck;
}

function setArcadiaArtSiteRecordTwoCheck($arcadiaArtSiteRecordTwoCheck) {
    $this->arcadiaArtSiteRecordTwoCheck = $arcadiaArtSiteRecordTwoCheck;
}

function setArcadiaArtSiteRecordTwoCheckFalse() {
    $this->setArcadiaArtSiteRecordTwoCheck(self::FALSE);
}

function setArcadiaArtSiteRecordTwoCheckTrue() {
    $this->setArcadiaArtSiteRecordTwoCheck(self::TRUE);
}

function getArcadiaArtSiteRecordValue() {
    return $this->arcadiaArtSiteRecordValue;
}

function setArcadiaArtSiteRecordValue($arcadiaArtSiteRecordValue) {
    $this->arcadiaArtSiteRecordValue += $arcadiaArtSiteRecordValue;
}

function getXMLRecordsetBaliseArtSiteOne() {
    return $this->XMLrecordsetBaliseArtSiteOne;
}

function getXMLRecordsetBaliseArtSiteTwo() {
    return $this->XMLrecordsetBaliseArtSiteTwo;
}

function getXMLRecordsetBaliseArtSiteUpdateOne() {
    return $this->XMLrecordsetBaliseArtSiteUpdateOne;
}

function getXMLRecordsetBaliseArtSiteUpdateTwo() {
    return $this->XMLrecordsetBaliseArtSiteUpdateTwo;
}

function setXMLRecordsetBaliseArtSiteOne(GeoModel $paramGeoModelExpe) {
    $this->XMLrecordsetBaliseArtSiteOne = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"" . $this->getArcadiaArtSiteRecordValue() . "\" action=\"" . self::CREATE . "\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SITE_GRP key=\"TRUE\">" . $paramGeoModelExpe->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue()
            . "</COD_SITE_GRP><!--" . $paramGeoModelExpe->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NIVEAU key=\"TRUE\">1</NIVEAU><!-- Primaire -->" . self::SAUT_DE_LIGNE
    ;
}

function setXMLRecordsetBaliseArtSiteTwo(GeoModel $paramGeoModelProd) {
    $this->XMLrecordsetBaliseArtSiteTwo = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"" . $this->getArcadiaArtSiteRecordValue() . "\" action=\"" . self::CREATE . "\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SITE_GRP key=\"TRUE\">" . $paramGeoModelProd->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue()
            . "</COD_SITE_GRP><!--" . $paramGeoModelProd->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NIVEAU key = \"TRUE\">2</NIVEAU><!-- Secondaire -->" . self::SAUT_DE_LIGNE;
}

function setXMLRecordsetBaliseArtSiteUpdateOne(GeoModel $paramGeoModelSiteExpe) {
    $this->XMLrecordsetBaliseArtSiteUpdateOne = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"1\" action=\"update\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SITE_GRP key=\"TRUE\">" . $paramGeoModelSiteExpe->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue()
            . "</COD_SITE_GRP><!--" . $paramGeoModelSiteExpe->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NIVEAU key=\"TRUE\">1</NIVEAU><!-- Primare -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DATE_FIN_EFFET>" . date("d/m/Y") . "</DATE_FIN_EFFET>" . self::SAUT_DE_LIGNE
            . self::RECORDSET_END . self::SAUT_DE_LIGNE;
}

function setXMLRecordsetBaliseArtSiteUpdateTwo(GeoModel $paramGeoModelSiteExpe, GeoModel $paramGeoModelSiteProd) {
    $this->XMLrecordsetBaliseArtSiteUpdateTwo = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"1\" action=\"update\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SITE_GRP key=\"TRUE\">" . $paramGeoModelSiteExpe->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue()
            . "</COD_SITE_GRP><!--" . $paramGeoModelSiteExpe->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NIVEAU key=\"TRUE\">1</NIVEAU><!-- Primare -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DATE_FIN_EFFET>" . date("d/m/Y") . "</DATE_FIN_EFFET>" . self::SAUT_DE_LIGNE
            . self::RECORDSET_END . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"2\" action=\"update\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_SITE_GRP key=\"TRUE\">" . $paramGeoModelSiteProd->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue()
            . "</COD_SITE_GRP><!--" . $paramGeoModelSiteProd->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue() . " -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<NIVEAU key=\"TRUE\">2</NIVEAU><!-- Secondaire -->" . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DATE_FIN_EFFET>" . date("d/m/Y") . "</DATE_FIN_EFFET>" . self::SAUT_DE_LIGNE
            . self::RECORDSET_END . self::SAUT_DE_LIGNE

    ;
}

function getXMLArcadiaArtSiteDateDebutEffet() {
    return $this->XMLarcadiaArtSiteDateDebutEffet;
}

function getXMLArcadiaArtSiteDateFinEffet() {
    return $this->XMLarcadiaArtSiteDateFinEffet;
}

function getXMLArcadiaArtSiteCodPosteCC() {
    return $this->XMLarcadiaArtSiteCodPosteCC;
}

function getXMLArcadiaArtSiteCodAtelier() {
    return $this->XMLarcadiaArtSiteCodAtelier;
}

function getXMLArcadiaArtSiteSiteAffectRes() {
    return $this->XMLarcadiaArtSiteSiteAffectRes;
}

function setXMLArcadiaArtSiteDateDebutEffet() {
    /**
     * Date+1 jours
     */
    $date = date_create(date("d-m-Y"));
    date_modify($date, '+1 day');
    $date1 = date_format($date, "d/m/Y");

    $this->XMLarcadiaArtSiteDateDebutEffet = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DATE_DEBUT_EFFET>" . $date1 . "</DATE_DEBUT_EFFET>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaArtSiteDateFinEffet() {
    $this->XMLarcadiaArtSiteDateFinEffet = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<DATE_FIN_EFFET>" . self::ART_SITE_DATE_FIN_EFFET . "</DATE_FIN_EFFET>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaArtSiteCodPosteCC($XMLarcadiaArtSiteCodPosteCC) {
    $this->XMLarcadiaArtSiteCodPosteCC = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_POSTE_CC>" . $XMLarcadiaArtSiteCodPosteCC . "</COD_POSTE_CC>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaArtSiteCodAtelier($XMLarcadiaArtSiteCodAtelier) {
    $this->XMLarcadiaArtSiteCodAtelier = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_ATELIER>" . $XMLarcadiaArtSiteCodAtelier . "</COD_ATELIER>" . self::SAUT_DE_LIGNE;
}

function setXMLArcadiaArtSiteSiteAffectRes() {
    $this->XMLarcadiaArtSiteSiteAffectRes = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<SIT_AFFECT_RES>" . $this->getFtaModel()->getModelSiteProduction()->getDataField(GeoModel::FIELDNAME_ID_SITE_GROUPE)->getFieldValue() . "</SIT_AFFECT_RES>" . self::SAUT_DE_LIGNE;
}

function getXMLRecordsetArtSiteTwo() {
    return $this->XMLrecordsetArtSiteTwo;
}

function setXMLrecordsetArtSiteTwo($XMLrecordsetArtSiteTwo) {
    $this->XMLrecordsetArtSiteTwo = $XMLrecordsetArtSiteTwo;
}

function getXMLRecordsetBaliseDun14() {
    return $this->XMLrecordsetBaliseDun14;
}

function getXMLRecordsetBaliseDun14Delete() {
    return $this->XMLrecordsetBaliseDun14Delete;
}

function setXMLRecordsetBaliseDun14($paramAction) {
    $this->XMLrecordsetBaliseDun14 = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"" . $this->getArcadiaDun14RecordValue() . "\" action=\"" . $paramAction . "\">" . self::SAUT_DE_LIGNE;
}

function setXMLRecordsetBaliseDun14Delete($XMLrecordsetBaliseDun14Delete) {
    $this->XMLrecordsetBaliseDun14Delete = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"" . $this->getArcadiaDun14RecordValue() . "\" action=\"" . self::DELETE . "\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaNoArtKey()
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<COD_PCB key=\"TRUE\">" . $XMLrecordsetBaliseDun14Delete . "</COD_PCB>" . self::SAUT_DE_LIGNE
            . self::RECORDSET_END . self::SAUT_DE_LIGNE;
}

function getXMLRecordsetBaliseEspProduitFini() {
    return $this->XMLrecordsetBaliseEspProduitFini;
}

function setXMLRecordsetBaliseEspProduitFini($paramActionType) {
    $this->XMLrecordsetBaliseEspProduitFini = self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<Recordset id=\"1\" action=\"" . $paramActionType . "\">" . self::SAUT_DE_LIGNE;
}

function getArcadiaDun14RecordValue() {
    return $this->arcadiaDun14RecordValue;
}

function setArcadiaDun14RecordValue($arcadiaDun14RecordValue) {
    $this->arcadiaDun14RecordValue += $arcadiaDun14RecordValue;
}

function getXMLCommentEntete() {
    return $this->XMLCommentEntete;
}

function getXMLCommentAdmPole() {
    return $this->XMLCommentAdmPole;
}

function getXMLCommentContGestion() {
    return $this->XMLCommentContGestion;
}

function getXMLCommentQualite() {
    return $this->XMLCommentQualite;
}

function getXMLCommentAdv() {
    return $this->XMLCommentAdv;
}

function getXMLCommentPreparCde() {
    return $this->XMLCommentPreparCde;
}

function getXMLCommentPdsMiniMaxi() {
    return $this->XMLCommentPdsMiniMaxi;
}

function getXMLCommentInfoFact() {
    return $this->XMLCommentInfoFact;
}

function getXMLCommentExportCompta() {
    return $this->XMLCommentExportCompta;
}

function getXMLCommentTelevente() {
    return $this->XMLCommentTelevente;
}

function getXMLCommentFourniture() {
    return $this->XMLCommentFourniture;
}

function getXMLCommentInfoTech() {
    return $this->XMLCommentInfoTech;
}

function setXMLCommentEntete() {
    $this->XMLCommentEntete = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Entête -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentAdmPole() {
    $this->XMLCommentAdmPole = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Adm.Pole -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentContGestion() {
    $this->XMLCommentContGestion = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Cont.Gestion -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentQualite() {
    $this->XMLCommentQualite = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Qualite -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentAdv() {
    $this->XMLCommentAdv = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- ADV -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentPreparCde() {
    $this->XMLCommentPreparCde = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Prepar.Cde -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentPdsMiniMaxi() {
    $this->XMLCommentPdsMiniMaxi = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Pds Mini/Maxi -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentInfoFact() {
    $this->XMLCommentInfoFact = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Info Fact -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentExportCompta() {
    $this->XMLCommentExportCompta = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Export -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentTelevente() {
    $this->XMLCommentTelevente = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Televente -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentFourniture() {
    $this->XMLCommentFourniture = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Fourniture -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentInfoTech() {
    $this->XMLCommentInfoTech = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- Info Tech -->" . self::SAUT_DE_LIGNE;
}

function getXMLCommentRegateAcAchat() {
    return $this->XMLCommentRegateAcAchat;
}

function getXMLCommentRegateAcStock() {
    return $this->XMLCommentRegateAcStock;
}

function setXMLCommentRegateAcAchat() {
    $this->XMLCommentRegateAcAchat = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- RegateAC Achat -->" . self::SAUT_DE_LIGNE;
}

function setXMLCommentRegateAcStock() {
    $this->XMLCommentRegateAcStock = self::ESPACE . self::SAUT_DE_LIGNE
            . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION . self::TABULATION
            . "<!-- RegateAC Stock -->" . self::SAUT_DE_LIGNE;
}

/**
 * On vérifie si le commentaire doit être ajouté
 */
function checkComment() {
    $this->checkCommentEnteteProdFini();
    $this->checkCommentEntete();
    $this->checkCommentAdmPole();
    $this->checkCommentContGestion();
    $this->checkCommentAdv();
    $this->checkCommentPreparCde();
    $this->checkCommentQualite();
    $this->checkCommentExportCompta();
    $this->checkCommentTelevente();
    $this->checkCommentInfoTech();
    $this->checkCommentEnteteProdFini();
    $this->checkCommentRegateAcAchat();
    $this->checkCommentRegateAcStock();
}

/**
 * Si un élement d'entête est présent on affiche le commentaire
 */
function checkCommentEntete() {
    if ($this->getXMLArcadiaNoArtKey() //<!-- Entête -->
            or $this->getXMLArcadiaArticleRefLicCcial()
            or $this->getXMLArcadiaMarque()
            or $this->getXMLArcadiaCodFamVte()
            or $this->getXMLArcadiaCodSousFam()
    ) {
        $this->setXMLCommentEntete();
    }
}

/**
 * Si un élement d'entête est présent on affiche le commentaire
 */
function checkCommentEnteteProdFini() {
    if ($this->getXMLArcadiaCodProduit()) {
        $this->setXMLCommentEntete();
    }
}

/**
 * Si un élement de RegateAC Achat  est présent on affiche le commentaire
 */
function checkCommentRegateAcAchat() {
    if ($this->getXMLArcadiaAcregSite()
            or $this->getXMLArcadiaAcregLieu()
            or $this->getXMLArcadiaAcregNoQuai()
            or $this->getXMLArcadiaAcregNoMethode()
            or $this->getXMLarcadiaSiteValo()
    ) {
        $this->setXMLCommentRegateAcAchat();
    }
}

/**
 * Si un élement de RegateAC Stock  est présent on affiche le commentaire
 */
function checkCommentRegateAcStock() {
    if ($this->getXMLArcadiaAcregSiteSecondaire()
            or $this->getXMLArcadiaAcregLieuSecondaire()
            or $this->getXMLArcadiaAcregTypeProdEmplacement()
            or $this->getXMLArcadiaAcregQuantiteEmplacement()
    ) {
        $this->setXMLCommentRegateAcStock();
    }
}

/**
 * Si un élement de Cont.Gestion est présent on affiche le commentaire
 */
function checkCommentContGestion() {
    if ($this->getXMLArcadiaArticleRefLicProduction()
            or $this->getXMLArcadiaSiteDeProd()
            or $this->getXMLArcadiaCommentairePrive()
            or $this->getXMLArcadiaFestif()
            or $this->getXMLArcadiaPoidsMoyenCal()
            or $this->getXMLArcadiaPoidsMini()
            or $this->getXMLArcadiaPoidsMaxi()
            or $this->getXMLArcadiaPoidsMiniBarq()
            or $this->getXMLArcadiaPoidsMaxiBarq()
            or $this->getXMLArcadiaCodPoidsCstUvc()
            or $this->getXMLArcadiaPoidsCstUvc()
    ) {
        $this->setXMLCommentContGestion();
    }
}

/**
 * Si un élement d'Administration Pole est présent on affiche le commentaire
 */
function checkCommentAdmPole() {
    if ($this->getXMLArcadiaUtilisableGroupe()
            or $this->getXMLArcadiaEanArticle()
            or $this->getXMLArcadiaCNUF()
            or $this->getXMLArcadiaLogoEcoEmballage()
            or $this->getXMLArcadiaFamilleEcoEmballages()
            or $this->getXMLArcadiaSiteRefEcoEmb()
            or $this->getXMLArcadiaIsHallal()
            or $this->getXMLArcadiaExport()
            or $this->getXMLArcadiaEnvironConserv()
            or $this->getXMLArcadiaCodTypeConditPub()
            or $this->getXMLArcadiaUniteDeFacturation()
    ) {
        $this->setXMLCommentAdmPole();
    }
}

/**
 * Si un élement de qualité est présent on affiche le commentaire
 */
function checkCommentQualite() {
    if ($this->getXMLArcadiaDLC()
            or $this->getXMLArcadiaDureeDeVie()
            or $this->getXMLArcadiaDTS()
            or $this->getXMLArcadiaProlongationDLC()
    ) {
        $this->setXMLCommentQualite();
    }
}

/**
 * Si un élement d'Adv est présent on affiche le commentaire
 */
function checkCommentAdv() {
    if ($this->getXMLArcadiaCodSociete()
            or $this->getXMLArcadiaUniteConditionnement()
            or $this->getXMLArcadiaLibelleTarif()
            or $this->getXMLArcadiaGammeCoop()
            or $this->getXMLArcadiaFamilleBudget()
            or $this->getXMLArcadiaGammeFamilleBudget()
    ) {
        $this->setXMLCommentAdv();
    }
}

/**
 * Si un élement de Prepar.Cde est présent on affiche le commentaire
 */
function checkCommentPreparCde() {
    if ($this->getXMLArcadiaMethodeDePreparation()
            or $this->getXMLArcadiaTypePreparationAcquisition()
    ) {
        $this->setXMLCommentPreparCde();
    }
}

/**
 * Si un élement de Pds Mini/Maxi est présent on affiche le commentaire
 */
function checkCommentPdsMiniMaxi() {
    if ($this->getXMLArcadiaPoidsMini()
            or $this->getXMLArcadiaPoidsMaxi()
    ) {
        $this->setXMLCommentPdsMiniMaxi();
    }
}

/**
 * Si un élement de Info fact est présent on affiche le commentaire
 */
function checkCommentInfoFact() {
    if ($this->getXMLArcadiaUniteDeFacturation()
    ) {
        $this->setXMLCommentInfoFact();
    }
}

/**
 * Si un élement d'export compta est présent on affiche le commentaire
 */
function checkCommentExportCompta() {
    if ($this->getXMLArcadiaCodeDouane()
    ) {
        $this->setXMLCommentExportCompta();
    }
}

/**
 * Si un élement de Televente est présent on affiche le commentaire
 */
function checkCommentTelevente() {
    if ($this->getXMLArcadiaOptiventes()
    ) {
        $this->setXMLCommentTelevente();
    }
}

/**
 * Si un élement de Fourniture est présent on affiche le commentaire
 */
function checkCommentFourniture() {
    if ($this->getXMLArcadiaLogoEcoEmballage()
            or $this->getXMLArcadiaSiteRefEcoEmb()
            or $this->getXMLArcadiaFamilleEcoEmballages()
    ) {
        $this->setXMLCommentFourniture();
    }
}

/**
 * Si un élement de Info Tech est présent on affiche le commentaire
 */
function checkCommentInfoTech() {
    if ($this->getXMLArcadiaCelluleArticle()
            or $this->getXMLArcadiaFamilleDeclCaClient()
    ) {
        $this->setXMLCommentInfoTech();
    }
}

/**
 * Affiche au format Xml la table de correspondance concernant le Dun14
 * @return string
 */
function xmlDunc14() {
    $xmlText = "";

//    if ($this->getArcadiaDun14Create()) {
    if ($this->getArcadiaDun14Check()) {
        $xmlText = self::DUN14_START
                . self::DATA_IMPORT_START
                . $this->getXMLRecordsetBaliseDun14Delete()
                . $this->getXMLRecordsetBaliseDun14()
                . $this->getXMLArcadiaNoArtKey()
                . $this->getXMLArcadiaCodPCB()
                . $this->getXMLArcadiaDun14()
                . $this->getXMLArcadiaTypeCarton()
                . $this->getXMLArcadiaColisStandard()
                . $this->getXMLArcadiaColisSpecifique()
                . $this->getXMLArcadiaDunPalette()
                . self::RECORDSET_END
                . self::DATA_IMPORT_END
                . self::DUN14_END

        ;
    }
//    }
    return $xmlText;
}

/**
 * Affiche au formet Xml la table de correspondance concernant ArtSite
 */
function xmlArtSite() {
    $xmlTextRecordSetTwo = "";
    $xmlText = "";
    /**
     * Si il y a un deuxième enregistrement à ajouter on l'affiche
     */
    /**
     * On l'active que pour un créate
     */
    if ($this->getArcadiaArtSiteRecordTwoCheck()) {
        $xmlTextRecordSetTwo = $this->getXMLRecordsetBaliseArtSiteTwo()
                . $this->getXMLArcadiaArtSiteDateDebutEffet()
                . $this->getXMLArcadiaArtSiteDateFinEffet()
                . $this->getXMLRecordsetArtSiteTwo()
                . self::RECORDSET_END;
    }
    if ($this->getArcadiaArtSiteCheck()) {
        $xmlText = self::ART_SITE_START
                . self::DATA_IMPORT_START
                . $this->getXMLRecordsetBaliseArtSiteUpdateTwo()
                . $this->getXMLRecordsetBaliseArtSiteUpdateOne()
                . $this->getXMLRecordsetBaliseArtSiteOne()
                . $this->getXMLArcadiaArtSiteDateDebutEffet()
                . $this->getXMLArcadiaArtSiteDateFinEffet()
                . $this->getXMLArcadiaArtSiteCodPosteCC()
                . $this->getXMLArcadiaArtSiteCodAtelier()
                . $this->getXMLArcadiaArtSiteSiteAffectRes()
                . self::RECORDSET_END
                . $xmlTextRecordSetTwo
                . self::DATA_IMPORT_END
                . self::ART_SITE_END
        ;
    }
    return $xmlText;
}

/**
 * Affiche au format Xml la table de correspondances avec les produit fini
 * @return string
 */
function xmlProduitFinis() {
    $xmlText = "";

    /**
     * On l'active que pour un créate
     */
    if ($this->getArcadiaProduitFiniCheck()) {
        $xmlText = self::ESP_PRODUITS_FINIS_START
                . self::DATA_IMPORT_START
                . $this->getXMLRecordsetBaliseEspProduitFini()
                . $this->getXMLCommentEntete()
                . $this->getXMLArcadiaCodProduit()
                . $this->getXMLCommentRegateAcAchat()
                . $this->getXMLArcadiaAcregSite()
                . $this->getXMLArcadiaAcregLieu()
                . $this->getXMLArcadiaAcregNoQuai()
                . $this->getXMLArcadiaAcregNoMethode()
                . $this->getXMLCommentRegateAcStock()
                . $this->getXMLArcadiaAcregSiteSecondaire()
                . $this->getXMLArcadiaAcregLieuSecondaire()
                . $this->getXMLarcadiaSiteValo()
                . $this->getXMLArcadiaAcregTypeProdEmplacement()
                . $this->getXMLArcadiaAcregQuantiteEmplacement()
                . self::RECORDSET_END
                . self::DATA_IMPORT_END
                . self::ESP_PRODUITS_FINIS_END;
    }
    return $xmlText;
}

/**
 * Affiche au format Xml la table de correspondances avec les Articles Ref
 * @return string
 */
function xmlArticleRef() {
    $xmlText = "";

    /**
     * On l'active que pour un créate
     */
    $xmlText = self::ARTICLE_REF_START
            . self::DATA_IMPORT_START
            . $this->getXMLRecordsetBalise()
            . $this->getXMLCommentEntete()
            //<!-- Entête -->
            . $this->getXMLArcadiaNoArtKey()
            . $this->getXMLArcadiaArticleRefLicCcial()
            . $this->getXMLArcadiaMarque()
            . $this->getXMLArcadiaCodFamVte()
            . $this->getXMLArcadiaCodSousFam()
            // <!-- Adm. Pole -->
            . $this->getXMLCommentAdmPole()
            . $this->getXMLArcadiaUtilisableGroupe()
            . $this->getXMLArcadiaEanArticle()
            . $this->getXMLArcadiaCNUF()
            . $this->getXMLArcadiaLogoEcoEmballage()
            . $this->getXMLArcadiaFamilleEcoEmballages()
            . $this->getXMLArcadiaSiteRefEcoEmb()
            . $this->getXMLArcadiaIsHallal()
            . $this->getXMLArcadiaExport()
            . $this->getXMLArcadiaEnvironConserv()
            . $this->getXMLArcadiaCodTypeConditPub()
            . $this->getXMLArcadiaUniteDeFacturation()
            // <!-- Cont.Gestion -->
            . $this->getXMLCommentContGestion()
            . $this->getXMLArcadiaArticleRefLicProduction()
            . $this->getXMLArcadiaSiteDeProd()
            . $this->getXMLArcadiaCommentairePrive()
            . $this->getXMLArcadiaFestif()
            . $this->getXMLArcadiaPoidsMoyenCal()
            . $this->getXMLArcadiaPoidsMini()
            . $this->getXMLArcadiaPoidsMaxi()
            . $this->getXMLArcadiaPoidsMiniBarq()
            . $this->getXMLArcadiaPoidsMaxiBarq()
            . $this->getXMLArcadiaCodPoidsCstUvc()
            . $this->getXMLArcadiaPoidsCstUvc()
            //<!-- ADV-->
//            . $this->getXMLArcadiaCodGeneriqueFm()
            . $this->getXMLCommentAdv()
            . $this->getXMLArcadiaCodSociete()
            . $this->getXMLArcadiaUniteConditionnement()
            . $this->getXMLArcadiaLibelleTarif()
            . $this->getXMLArcadiaGammeCoop()
            . $this->getXMLArcadiaFamilleBudget()
            . $this->getXMLArcadiaGammeFamilleBudget()
            //<!-- Prepar.Cde -->
            . $this->getXMLCommentPreparCde()
            . $this->getXMLArcadiaMethodeDePreparation()
            . $this->getXMLArcadiaTypePreparationAcquisition()
            // <!-- Qualite -->
            . $this->getXMLCommentQualite()
            . $this->getXMLArcadiaDLC()
            . $this->getXMLArcadiaDureeDeVie()
            . $this->getXMLArcadiaDTS()
            . $this->getXMLArcadiaProlongationDLC()
            //<!-- Televente -->
            . $this->getXMLCommentTelevente()
            . $this->getXMLArcadiaOptiventes()
            //<!-- Export -->
            . $this->getXMLCommentExportCompta()
            . $this->getXMLArcadiaCodeDouane()
            //<!-- Info Tech -->
            . $this->getXMLCommentInfoTech()
            //. $this->getXMLArcadiaFamilleDeclCaClient()
            . $this->getXMLArcadiaCelluleArticle()
            . self::ESPACE . self::SAUT_DE_LIGNE
            . self::RECORDSET_END
            . self::DATA_IMPORT_END
            . self::ARTICLE_REF_END;

    return $xmlText;
}

/**
 * Mise en forme du text contenu dans le fichier XML
 * l'art site et le dun14 sont mise en commentaire 
 */
function generateXmlText() {
    $xmlText .= '<?xml version="1.0" encoding="UTF-8"?>' . self::SAUT_DE_LIGNE . self::ESPACE
            . "<Transaction id=\"" . $this->getKeyValueProposal() . "\" version=\"1.1\" type=\"proposal\">" . self::SAUT_DE_LIGNE
            . $this->getXMLArcadiaParametre()
            . self::TABLE_START
            . $this->xmlArticleRef()
            . $this->xmlProduitFinis()
            . $this->xmlArtSite()
            . $this->xmlDunc14()
            . self::TABLE_END . self::SAUT_DE_LIGNE
            . "</Transaction>" . self::SAUT_DE_LIGNE
            . self::SAUT_DE_LIGNE
    ;


    $this->setXmlText($xmlText);
}

/**
 * Message informant de la non génération du fichier XML 
 */
function generateXmlTextNO() {
    $xmlText .= UserInterfaceMessage::FR_ARCADIA_XML_NOT_GENERATE;


    $this->setXmlText($xmlText);
}

/**
 * Géneration du fichier xml
 */
function saveExportXmlToFile() {
    $linkData = $this->linkXmlFileDataSend();
    $returnData = FALSE;
    $linkOk = $this->linkXmlFileOkSend();
    $returnOk = FALSE;

    /**
     * On créer le  nouveau fichier si un lien est initialiser
     */
    if ($linkData) {
        $holdpwd = getcwd();
        $returnData = file_put_contents($linkData, $this->getXmlText());
    }
    /**
     * On créer le  nouveau fichier si un lien est initialiser
     */
    if ($linkOk) {
        $returnOk = file_put_contents($linkOk, "ok");
    }
}

/**
 * Affiche le code XML 
 */
function showExportXmlFile() {
    $xmlText = $this->getXmlText();
    /**
     * Mise en forme
     */
    $return = "<td >Fichier XML</td><tr class=contenu><td>Fichier XML</td><td > <pre style=font-size:medium;>" . htmlspecialchars($xmlText) . "</pre></td ></tr>";
    return $return;
}

/**
 * Génération du lien vers le dossier data d'envoi
 * @return string
 */
function linkXmlFileDataSend() {
    $link = $this->getlinkProposalXml(
            Fta2ArcadiaConfig::EAI_EXPORT_DATA_SUBDIR
            , Fta2ArcadiaConfig::EAI_FILENAME_PROPOSAL_EXTENSION_DATA
    );
    return $link;
}

/**
 * Génération du lien vers le dossier ok d'envoi
 * @return string
 */
function linkXmlFileOkSend() {
    $link = $this->getlinkProposalXml(
            Fta2ArcadiaConfig::EAI_EXPORT_OK_SUBDIR
            , Fta2ArcadiaConfig::EAI_FILENAME_PROPOSAL_EXTENSION_OK
    );
    return $link;
}

private function getlinkProposalXml($paramSubdir, $paramExtension) {
    $link = $this->getGlobalConfigModel()->getConf()->getUrlEai() . "/"
            . $paramSubdir . "/"
            . Fta2ArcadiaConfig::EAI_FILENAME_PREFIXE . Fta2ArcadiaConfig::EAI_FILENAME_DELIMITER
            . $this->getKeyValueProposal() . Fta2ArcadiaConfig::EAI_FILENAME_DELIMITER
            . $this->getFtaModel()->getDataField(FtaModel::KEYNAME)->getFieldValue() . Fta2ArcadiaConfig::EAI_FILENAME_DELIMITER
            . $paramExtension;
    return $link;
}

}
