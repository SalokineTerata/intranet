<?php

/**
 * Fichier d'inclusion.
 * 
 * Attention à bien ordonner les inclusions en fonction des dépendances
 * 
 */
/**
 * Détermination du cas où on est en mode HTTP ou CLI
 */
/* * ***************************************************************************
  Inclusion des plugins
 * ************************************************************************** */
require_once('../plugins/htmlMimeMail-2.5.1/htmlMimeMail5.php');

//Free PDF: Classe Racine
$fpdf_path = '../plugins/fpdf/';
define('RELATIVE_PATH', $fpdf_path);
define('FPDF_FONTPATH', RELATIVE_PATH . 'font/');
require_once ($fpdf_path . 'fpdf.php');

//Extension Free PDF Import: Etend la Classe FPDF vers FPDI
require_once ('../plugins/fpdi/fpdi.php');


// Inclusions génériques
require_once('../lib/class/configuration/GlobalConfig.php');
require_once('../lib/functions.php');
require_once('../lib/functions.mail.php');
require_once('../lib/functions.mysql.php');
require_once('../lib/functions.pdf.php');
require_once('../lib/functions.html.php');
require_once('../lib/class/acl/Acl.php');
require_once('../lib/class/Lib.php');
require_once('../lib/class/log/Logger.php');
require_once('../lib/class/user_interface/UserInterfaceMessage.php');
require_once('../lib/class/user_interface/UserInterfaceLabel.php');
require_once('../lib/class/session/SessionSaveAndRestoreAbstract.php');

// Configuration des environnements
require_once('../conf/EnvironmentConf.php');
require_once('../conf/EnvironmentAbstract.php');
require_once('../conf/EnvironmentInit.php');

// Fta2Arcadia 
require_once('../fta2Arcadia/class/configuration/Fta2ArcadiaConfig.php');
require_once('../fta2Arcadia/class/controller/Fta2ArcadiaController.php');
require_once('../fta2Arcadia/class/controller/Arcadia2FtaController.php');

// Fta (Model)
require_once('../fta/class/AccueilFta.php');
require_once('../fta/class/Chapitre.php');
require_once('../fta/class/MoteurDeRecherche.php');
require_once('../fta/class/Navigation.php');
require_once('../fta/class/ObjectFta.php');

// View
require_once('../fta/class/view/AbstractView.php');
require_once('../fta/class/view/FtaView.php');
require_once('../fta/class/view/UserView.php');
require_once('../fta/class/view/FtaComposantView.php');
require_once('../fta/class/view/FtaProcessusDelaiView.php');
require_once('../fta/class/view/TableauFicheView.php');

// Controller
require_once('../fta/class/controller/FtaController.php');

// Moteur de base de données
require_once('../lib/class/database/DatabaseConnection.php');
require_once('../lib/class/database/DatabaseOperation.php');
require_once('../lib/class/database/DatabaseDescription.php');
require_once('../lib/class/database/DatabaseDescriptionField.php');
require_once('../lib/class/database/DatabaseDescriptionTable.php');
require_once('../lib/class/database/DatabaseDataField.php');
require_once('../lib/class/database/DatabaseDataJquery.php');
require_once('../lib/class/database/DatabaseRecord.php');

//Règles de validation
require_once('../lib/class/rules_validation/AbstractRulesValidation.php');
require_once('../lib/class/rules_validation/DataNotEmptyRulesValidation.php');
require_once('../lib/class/rules_validation/DataNotRealEmptyRulesValidation.php');
require_once('../lib/class/rules_validation/DataNotSmallRulesValidation.php');
require_once('../lib/class/rules_validation/DataNotSpecialRulesValidation.php');
require_once('../lib/class/rules_validation/Less255CaractereRulesValidation.php');
require_once('../lib/class/rules_validation/Less35CaractereRulesValidation.php');
require_once('../lib/class/rules_validation/Less5CaractereRulesValidation.php');
require_once('../lib/class/rules_validation/Less8CaractereRulesValidation.php');
require_once('../lib/class/rules_validation/Mandatory14CaractereRulesValidation.php');


// Configuration des models de base de données
require_once('../lib/class/model/ModelTableAssociation.php');


// Modèles des tables en base de données
require_once('../lib/class/model/AbstractModelInterface.php');
require_once('../lib/class/model/AbstractModel.php');
require_once('../lib/class/model/AccessMaterielServiceModel.php');
require_once('../lib/class/model/AnnexeModeEtiquetteModel.php');
require_once('../lib/class/model/AnnexeAgrologicArticleCodificationModel.php');
require_once('../lib/class/model/AnnexeEmballageGroupeModel.php');
require_once('../lib/class/model/AnnexeEmballageGroupeTypeModel.php');
require_once('../lib/class/model/AnnexeEmballageModel.php');
require_once('../lib/class/model/AnnexeEnvironnementConservationGroupeModel.php');
require_once('../lib/class/model/AnnexeGestionDesEtiquettesModel.php');
require_once('../lib/class/model/AnnexeGestionEtiquetteRectoVersoModel.php');
require_once('../lib/class/model/AnnexeListeAllergeneDicoModel.php');
require_once('../lib/class/model/AnnexeUniteFacturationModel.php');
require_once('../lib/class/model/ArcadiaCategorieProduitOptiventesModel.php');
require_once('../lib/class/model/ArcadiaCelluleArticleModel.php');
require_once('../lib/class/model/ArcadiaFamilleBudgetModel.php');
require_once('../lib/class/model/ArcadiaFamilleEcoEmballagesModel.php');
require_once('../lib/class/model/ArcadiaFamilleVenteModel.php');
require_once('../lib/class/model/ArcadiaGammeCoopModel.php');
require_once('../lib/class/model/ArcadiaGammeFamilleBudgetModel.php');
require_once('../lib/class/model/ArcadiaMarqueModel.php');
require_once('../lib/class/model/ArcadiaSousFamilleModel.php');
require_once('../lib/class/model/ArcadiaTypeCartonModel.php');
require_once('../lib/class/model/CatsoproModel.php');
require_once('../lib/class/model/ClassificationActiviteFamilleVentesArcadiaModel.php');
require_once('../lib/class/model/ClassificationActiviteSousFamilleArcadiaModel.php');
require_once('../lib/class/model/ClassificationArborescenceArticleCategorieContenuModel.php');
require_once('../lib/class/model/ClassificationArborescenceArticleCategorieModel.php');
require_once('../lib/class/model/ClassificationArborescenceArticleModel.php');
require_once('../lib/class/model/ClassificationFtaModel.php');
require_once('../lib/class/model/ClassificationFta2Model.php');
require_once('../lib/class/model/ClassificationGammeFamilleBudgetArcadiaModel.php');
require_once('../lib/class/model/ClassificationMarqueArcadiaModel.php');
require_once('../lib/class/model/ClassificationRaccourcisAssociationModel.php');
require_once('../lib/class/model/ClassificationRaccourcisModel.php');
require_once('../lib/class/model/CodesoftEtiquettesLogoModel.php');
require_once('../lib/class/model/CodesoftEtiquettesModel.php');
require_once('../lib/class/model/CodesoftStyleParagrapheModel.php');
require_once('../lib/class/model/DataSyncServeurModel.php');
require_once('../lib/class/model/DataSyncTransfertModel.php');
require_once('../lib/class/model/DroitftModel.php');
require_once('../lib/class/model/UserModel.php');
require_once('../lib/class/model/Fta2ArcadiaTransactionModel.php');
require_once('../lib/class/model/FtaActionRoleModel.php');
require_once('../lib/class/model/FtaActionSiteModel.php');
require_once('../lib/class/model/FtaConditionnementModel.php');
require_once('../lib/class/model/FtaComposantModel.php');
require_once('../lib/class/model/FtaProcessusCycleModel.php');
require_once('../lib/class/model/FtaModel.php');
require_once('../lib/class/model/FtaEtatHistoriqueModel.php');
require_once('../lib/class/model/FtaEtatModel.php');
require_once('../lib/class/model/FtaProcessusEtatModel.php');
require_once('../lib/class/model/FtaProcessusModel.php');
require_once('../lib/class/model/FtaChapitreModel.php');
require_once('../lib/class/model/FtaSuiviProjetModel.php');
require_once('../lib/class/model/FtaProcessusDelaiModel.php');
require_once('../lib/class/model/FtaProcessusMultisiteModel.php');
require_once('../lib/class/model/FtaRoleModel.php');
require_once('../lib/class/model/FtaTransitionModel.php');
require_once('../lib/class/model/FtaVerrouillageChampsModel.php');
require_once('../lib/class/model/FtaWorkflowModel.php');
require_once('../lib/class/model/FtaWorkflowStructureModel.php');
require_once('../lib/class/model/FteFournisseurModel.php');
require_once('../lib/class/model/GeoArcadiaModel.php');
require_once('../lib/class/model/GeoModel.php');
require_once('../lib/class/model/HtmlResultModel.php');
require_once('../lib/class/model/IntranetActionsModel.php');
require_once('../lib/class/model/IntranetColumnInfoModel.php');
require_once('../lib/class/model/IntranetDescriptionModel.php');
require_once('../lib/class/model/IntranetDroitsAccesModel.php');
require_once('../lib/class/model/IntranetModulesModel.php');
require_once('../lib/class/model/IntranetNiveauAccesModel.php');
require_once('../lib/class/model/LogModel.php');
require_once('../lib/class/model/LuModel.php');
require_once('../lib/class/model/ModesModel.php');
require_once('../lib/class/model/PersoModel.php');
require_once('../lib/class/model/PlanningPresenceDetailModel.php');
require_once('../lib/class/model/PlanningPresenceSemaineVisibleModel.php');
require_once('../lib/class/model/ServicesModel.php');
require_once('../lib/class/model/StaticStandardModel.php');
require_once('../lib/class/model/TypeModel.php');

// Standard HTML
require_once('../lib/class/html/Html.php');
require_once('../lib/class/html/standard/AbstractAllHtmlParameters.php');
require_once('../lib/class/html/standard/Attribute/AbstractAttributeTypeGenericValue.php');
require_once('../lib/class/html/standard/Attribute/AbstractAttributeTypeMixed.php');
require_once('../lib/class/html/standard/Attribute/AbstractAttributeTypeUnique.php');
require_once('../lib/class/html/standard/Attribute/AbstractAttributeTypeTrueFalse.php');
require_once('../lib/class/html/standard/Attribute/AbstractAttributeTypeYesNo.php');
require_once('../lib/class/html/standard/Attribute/AttributeClass.php');
require_once('../lib/class/html/standard/Attribute/AttributeContextMenu.php');
require_once('../lib/class/html/standard/Attribute/AttributeAccessKey.php');
require_once('../lib/class/html/standard/Attribute/AttributeAccept.php');
require_once('../lib/class/html/standard/Attribute/AttributeAlt.php');
require_once('../lib/class/html/standard/Attribute/AttributeAutocomplete.php');
require_once('../lib/class/html/standard/Attribute/AttributeAutofocus.php');
require_once('../lib/class/html/standard/Attribute/AttributeChecked.php');
require_once('../lib/class/html/standard/Attribute/AttributeClass.php');
require_once('../lib/class/html/standard/Attribute/AttributeCols.php');
require_once('../lib/class/html/standard/Attribute/AttributeContentEditable.php');
require_once('../lib/class/html/standard/Attribute/AttributeContextMenu.php');
require_once('../lib/class/html/standard/Attribute/AttributeDataCustom.php');
require_once('../lib/class/html/standard/Attribute/AttributeDir.php');
require_once('../lib/class/html/standard/Attribute/AttributeDisabled.php');
require_once('../lib/class/html/standard/Attribute/AttributeDraggable.php');
require_once('../lib/class/html/standard/Attribute/AttributeDropZone.php');
require_once('../lib/class/html/standard/Attribute/AttributeForm.php');
require_once('../lib/class/html/standard/Attribute/AttributeFormAction.php');
require_once('../lib/class/html/standard/Attribute/AttributeFormEncType.php');
require_once('../lib/class/html/standard/Attribute/AttributeFormMethod.php');
require_once('../lib/class/html/standard/Attribute/AttributeFormNoValidate.php');
require_once('../lib/class/html/standard/Attribute/AttributeFormTarget.php');
require_once('../lib/class/html/standard/Attribute/AttributeHeight.php');
require_once('../lib/class/html/standard/Attribute/AttributeHidden.php');
require_once('../lib/class/html/standard/Attribute/AttributeId.php');
require_once('../lib/class/html/standard/Attribute/AttributeInputType.php');
require_once('../lib/class/html/standard/Attribute/AttributeLabel.php');
require_once('../lib/class/html/standard/Attribute/AttributeLang.php');
require_once('../lib/class/html/standard/Attribute/AttributeList.php');
require_once('../lib/class/html/standard/Attribute/AttributeMax.php');
require_once('../lib/class/html/standard/Attribute/AttributeMaxLength.php');
require_once('../lib/class/html/standard/Attribute/AttributeMin.php');
require_once('../lib/class/html/standard/Attribute/AttributeMultiple.php');
require_once('../lib/class/html/standard/Attribute/AttributeName.php');
require_once('../lib/class/html/standard/Attribute/AttributePattern.php');
require_once('../lib/class/html/standard/Attribute/AttributePlaceHolder.php');
require_once('../lib/class/html/standard/Attribute/AttributeReadOnly.php');
require_once('../lib/class/html/standard/Attribute/AttributeRequired.php');
require_once('../lib/class/html/standard/Attribute/AttributeRows.php');
require_once('../lib/class/html/standard/Attribute/AttributeSelected.php');
require_once('../lib/class/html/standard/Attribute/AttributeSize.php');
require_once('../lib/class/html/standard/Attribute/AttributeSpellCheck.php');
require_once('../lib/class/html/standard/Attribute/AttributeSrc.php');
require_once('../lib/class/html/standard/Attribute/AttributeStep.php');
require_once('../lib/class/html/standard/Attribute/AttributeStyle.php');
require_once('../lib/class/html/standard/Attribute/AttributeTabIndex.php');
require_once('../lib/class/html/standard/Attribute/AttributeTitle.php');
require_once('../lib/class/html/standard/Attribute/AttributeTranslate.php');
require_once('../lib/class/html/standard/Attribute/AttributeValue.php');
require_once('../lib/class/html/standard/Attribute/AttributeWidth.php');
require_once('../lib/class/html/standard/Attribute/AttributeWrap.php');
require_once('../lib/class/html/standard/Attribute/StandardGlobalAttributes.php');
require_once('../lib/class/html/standard/Event/HtmlStandardEventsForm.php');
require_once('../lib/class/html/standard/Event/HtmlStandardEventsMouse.php');
require_once('../lib/class/html/standard/HtmlStandardStylesCSS.php');
require_once('../lib/class/html/standard/Tag/InterfaceHtmlStandardTag.php');
require_once('../lib/class/html/standard/Tag/HtmlStandardTagInput.php');
require_once('../lib/class/html/standard/Tag/HtmlStandardTagOption.php');
require_once('../lib/class/html/standard/Tag/HtmlStandardTagSelect.php');
require_once('../lib/class/html/standard/Tag/HtmlStandardTagTextArea.php');

// Classe de représentation d'objet HTML
require_once('../lib/class/html/AttributesGlobal.php');
require_once('../lib/class/html/AttributesInput.php');
require_once('../lib/class/html/AttributesOption.php');
require_once('../lib/class/html/AttributesSelect.php');
require_once('../lib/class/html/AttributesTextArea.php');
require_once('../lib/class/html/EventsForm.php');
require_once('../lib/class/html/EventsMouse.php');
require_once('../lib/class/html/CustomStyleCSS.php');
require_once('../lib/class/html/HtmlTagOption.php');
require_once('../lib/class/html/AbstractHtmlGlobalElement.php');
require_once('../lib/class/html/AbstractHtmlInput.php');
require_once('../lib/class/html/HtmlInputText.php');
require_once('../lib/class/html/HtmlInputNumber.php');
require_once('../lib/class/html/HtmlInputKg.php');
require_once('../lib/class/html/HtmlInputCalendar.php');
require_once('../lib/class/html/AbstractHtmlList.php');
require_once('../lib/class/html/HtmlListSelect.php');
require_once('../lib/class/html/HtmlListSelectTagName.php');
require_once('../lib/class/html/HtmlListBoolean.php');
require_once('../lib/class/html/HtmlSubForm.php');
require_once('../lib/class/html/HtmlSubForm_R1N.php');
require_once('../lib/class/html/HtmlSubForm_RNN.php');
require_once('../lib/class/html/HtmlTextArea.php');
require_once('../lib/class/html/HtmlCheckbox.php');
require_once('../lib/class/html/TraitDataFieldToHtml.php');
require_once('../lib/class/html/DataFieldToHtmlInputText.php');
require_once('../lib/class/html/DataFieldToHtmlListSelect.php');
require_once('../lib/class/html/DataFieldToHtmlListBoolean.php');
require_once('../lib/class/html/DataFieldToHtmlInputCalendar.php');
require_once('../lib/class/html/DataFieldToHtmlInputNumber.php');
require_once('../lib/class/html/DataFieldToHtmlTextArea.php');
require_once('../lib/class/html/DataFieldToHtmlSubForm_R1N.php');
require_once('../lib/class/html/DataFieldToHtmlSubForm_RNN.php');
require_once('../lib/class/ModuleConfigLib.php');

// Session utilisateur
require_once('../lib/session.php');


// Variables locales à la page PHP
Lib::setModule();
$module = Lib::getModule();

// Inclusions propres au module
if ($module != 'lib') {

    //Inclusion de la configuration propre au module
    $module_conf_file = '../' . $module . '/class/ModuleConfig.php';

    if (file_exists($module_conf_file)) {
        require_once ($module_conf_file);
    }

    //Inclusion de la librairie de fonction propre au module
    require_once ('../' . $module . '/functions.php');
}
//$globalConfig = $_SESSION['globalConfig'];
GlobalConfig::setExecDebugTimeStart();

