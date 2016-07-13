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
require __DIR__ . '/../plugins/htmlMimeMail-2.5.1/htmlMimeMail5.php';

//Free PDF: Classe Racine
//$fpdf_path = '../plugins/fpdf/';
//define('RELATIVE_PATH', $fpdf_path;
//define('FPDF_FONTPATH', RELATIVE_PATH . 'font/';
//require_once ($fpdf_path . 'fpdf.php';
//Extension Free PDF Import: Etend la Classe FPDF vers FPDI
//require  __DIR__ .'/../plugins/fpdi/fpdi.php';
// Inclusions génériques
require __DIR__ . '/../lib/class/configuration/GlobalConfig.php';
require __DIR__ . '/../lib/functions.php';
require __DIR__ . '/../lib/functions.mail.php';
require __DIR__ . '/../lib/functions.mysql.php';
//require __DIR__ . '/../lib/functions.pdf.php';
//require __DIR__ . '/../lib/functions.html.php';
//require __DIR__ . '/../lib/class/acl/Acl.php';
require __DIR__ . '/../lib/class/Lib.php';
//require __DIR__ . '/../lib/class/log/Logger.php';
require __DIR__ . '/../lib/class/user_interface/UserInterfaceMessage.php';
require __DIR__ . '/../lib/class/user_interface/UserInterfaceLabel.php';
//require __DIR__ . '/../lib/class/session/SessionSaveAndRestoreAbstract.php';

// Configuration des environnements
require __DIR__ . '/../conf/EnvironmentConf.php';
require __DIR__ . '/../conf/EnvironmentAbstract.php';
require __DIR__ . '/../conf/EnvironmentInit.php';

// Fta2Arcadia 
require __DIR__ . '/../../fta2Arcadia/class/controller/Fta2ArcadiaController.php';
require __DIR__ . '/../../fta2Arcadia/class/controller/Arcadia2FtaController.php';

// Fta (Model
//require __DIR__ . '/../fta/class/AccueilFta.php';
//require __DIR__ . '/../fta/class/Chapitre.php';
//require __DIR__ . '/../fta/class/MoteurDeRecherche.php';
//require __DIR__ . '/../fta/class/Navigation.php';
//require __DIR__ . '/../fta/class/ObjectFta.php';

// View
//require __DIR__ . '/../fta/class/view/AbstractView.php';
//require __DIR__ . '/../fta/class/view/FtaView.php';
//require __DIR__ . '/../fta/class/view/UserView.php';
//require __DIR__ . '/../fta/class/view/FtaComposantView.php';
//require __DIR__ . '/../fta/class/view/FtaProcessusDelaiView.php';
//require __DIR__ . '/../fta/class/view/TableauFicheView.php';

// Controller
//require __DIR__ . '/../fta/class/controller/FtaController.php';

// Moteur de base de données
//require __DIR__ . '/../lib/class/database/DatabaseConnection.php';
//require __DIR__ . '/../lib/class/database/DatabaseOperation.php';
//require __DIR__ . '/../lib/class/database/DatabaseDescription.php';
//require __DIR__ . '/../lib/class/database/DatabaseDescriptionField.php';
//require __DIR__ . '/../lib/class/database/DatabaseDescriptionTable.php';
//require __DIR__ . '/../lib/class/database/DatabaseDataField.php';
//require __DIR__ . '/../lib/class/database/DatabaseRecord.php';

//Règles de validation
//require __DIR__ . '/../lib/class/rules_validation/AbstractRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/DataNotEmptyRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/DataNotRealEmptyRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/DataNotSmallRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/DataNotSpecialRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/Less35CaractereRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/Less5CaractereRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/Less8CaractereRulesValidation.php';
//require __DIR__ . '/../lib/class/rules_validation/Mandatory14CaractereRulesValidation.php';


// Configuration des models de base de données
//require __DIR__ . '/../lib/class/model/ModelTableAssociation.php';


// Modèles des tables en base de données
require __DIR__ . '/../lib/class/model/AbstractModelInterface.php';
require __DIR__ . '/../lib/class/model/AbstractModel.php';
//require __DIR__ . '/../lib/class/model/AccessMaterielServiceModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeModeEtiquetteModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeAgrologicArticleCodificationModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeEmballageGroupeModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeEmballageGroupeTypeModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeEmballageModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeEnvironnementConservationGroupeModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeGestionDesEtiquettesModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeGestionEtiquetteRectoVersoModel.php';
//require __DIR__ . '/../lib/class/model/AnnexeUniteFacturationModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaCategorieProduitOptiventesModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaCelluleArticleModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaFamilleBudgetModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaFamilleEcoEmballagesModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaFamilleVenteModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaGammeCoopModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaGammeFamilleBudgetModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaMarqueModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaSousFamilleModel.php';
//require __DIR__ . '/../lib/class/model/ArcadiaTypeCartonModel.php';
//require __DIR__ . '/../lib/class/model/CatsoproModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationActiviteFamilleVentesArcadiaModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationActiviteSousFamilleArcadiaModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationArborescenceArticleCategorieContenuModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationArborescenceArticleCategorieModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationArborescenceArticleModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationFtaModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationFta2Model.php';
//require __DIR__ . '/../lib/class/model/ClassificationGammeFamilleBudgetArcadiaModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationMarqueArcadiaModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationRaccourcisAssociationModel.php';
//require __DIR__ . '/../lib/class/model/ClassificationRaccourcisModel.php';
//require __DIR__ . '/../lib/class/model/CodesoftEtiquettesLogoModel.php';
//require __DIR__ . '/../lib/class/model/CodesoftEtiquettesModel.php';
//require __DIR__ . '/../lib/class/model/CodesoftStyleParagrapheModel.php';
//require __DIR__ . '/../lib/class/model/DataSyncServeurModel.php';
//require __DIR__ . '/../lib/class/model/DataSyncTransfertModel.php';
//require __DIR__ . '/../lib/class/model/DroitftModel.php';
require __DIR__ . '/../lib/class/model/UserModel.php';
require __DIR__ . '/../lib/class/model/Fta2ArcadiaTransactionModel.php';
//require __DIR__ . '/../lib/class/model/FtaActionRoleModel.php';
//require __DIR__ . '/../lib/class/model/FtaActionSiteModel.php';
//require __DIR__ . '/../lib/class/model/FtaConditionnementModel.php';
//require __DIR__ . '/../lib/class/model/FtaComposantModel.php';
//require __DIR__ . '/../lib/class/model/FtaProcessusCycleModel.php';
require __DIR__ . '/../lib/class/model/FtaModel.php';
//require __DIR__ . '/../lib/class/model/FtaEtatHistoriqueModel.php';
//require __DIR__ . '/../lib/class/model/FtaEtatModel.php';
//require __DIR__ . '/../lib/class/model/FtaProcessusEtatModel.php';
//require __DIR__ . '/../lib/class/model/FtaProcessusModel.php';
//require __DIR__ . '/../lib/class/model/FtaChapitreModel.php';
//require __DIR__ . '/../lib/class/model/FtaSuiviProjetModel.php';
//require __DIR__ . '/../lib/class/model/FtaProcessusDelaiModel.php';
//require __DIR__ . '/../lib/class/model/FtaProcessusMultisiteModel.php';
//require __DIR__ . '/../lib/class/model/FtaRoleModel.php';
//require __DIR__ . '/../lib/class/model/FtaTransitionModel.php';
//require __DIR__ . '/../lib/class/model/FtaVerrouillageChampsModel.php';
//require __DIR__ . '/../lib/class/model/FtaWorkflowModel.php';
//require __DIR__ . '/../lib/class/model/FtaWorkflowStructureModel.php';
//require __DIR__ . '/../lib/class/model/FteFournisseurModel.php';
//require __DIR__ . '/../lib/class/model/GeoArcadiaModel.php';
//require __DIR__ . '/../lib/class/model/GeoModel.php';
//require __DIR__ . '/../lib/class/model/HtmlResultModel.php';
//require __DIR__ . '/../lib/class/model/IntranetActionsModel.php';
//require __DIR__ . '/../lib/class/model/IntranetColumnInfoModel.php';
//require __DIR__ . '/../lib/class/model/IntranetDescriptionModel.php';
//require __DIR__ . '/../lib/class/model/IntranetDroitsAccesModel.php';
//require __DIR__ . '/../lib/class/model/IntranetModulesModel.php';
//require __DIR__ . '/../lib/class/model/IntranetNiveauAccesModel.php';
//require __DIR__ . '/../lib/class/model/LogModel.php';
//require __DIR__ . '/../lib/class/model/LuModel.php';
//require __DIR__ . '/../lib/class/model/ModesModel.php';
//require __DIR__ . '/../lib/class/model/PersoModel.php';
//require __DIR__ . '/../lib/class/model/PlanningPresenceDetailModel.php';
//require __DIR__ . '/../lib/class/model/PlanningPresenceSemaineVisibleModel.php';
//require __DIR__ . '/../lib/class/model/ServicesModel.php';
//require __DIR__ . '/../lib/class/model/StaticStandardModel.php';
//require __DIR__ . '/../lib/class/model/TypeModel.php';

// Standard HTML
//require __DIR__ . '/../lib/class/html/Html.php';
//require __DIR__ . '/../lib/class/html/standard/AbstractAllHtmlParameters.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AbstractAttributeTypeGenericValue.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AbstractAttributeTypeMixed.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AbstractAttributeTypeUnique.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AbstractAttributeTypeTrueFalse.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AbstractAttributeTypeYesNo.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeClass.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeContextMenu.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeAccessKey.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeAccept.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeAlt.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeAutocomplete.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeAutofocus.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeChecked.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeClass.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeCols.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeContentEditable.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeContextMenu.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeDataCustom.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeDir.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeDisabled.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeDraggable.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeDropZone.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeForm.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeFormAction.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeFormEncType.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeFormMethod.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeFormNoValidate.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeFormTarget.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeHeight.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeHidden.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeId.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeInputType.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeLabel.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeLang.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeList.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeMax.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeMaxLength.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeMin.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeMultiple.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeName.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributePattern.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributePlaceHolder.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeReadOnly.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeRequired.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeRows.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeSelected.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeSize.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeSpellCheck.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeSrc.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeStep.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeStyle.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeTabIndex.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeTitle.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeTranslate.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeValue.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeWidth.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/AttributeWrap.php';
//require __DIR__ . '/../lib/class/html/standard/Attribute/StandardGlobalAttributes.php';
//require __DIR__ . '/../lib/class/html/standard/Event/HtmlStandardEventsForm.php';
//require __DIR__ . '/../lib/class/html/standard/Event/HtmlStandardEventsMouse.php';
//require __DIR__ . '/../lib/class/html/standard/HtmlStandardStylesCSS.php';
//require __DIR__ . '/../lib/class/html/standard/Tag/InterfaceHtmlStandardTag.php';
//require __DIR__ . '/../lib/class/html/standard/Tag/HtmlStandardTagInput.php';
//require __DIR__ . '/../lib/class/html/standard/Tag/HtmlStandardTagOption.php';
//require __DIR__ . '/../lib/class/html/standard/Tag/HtmlStandardTagSelect.php';
//require __DIR__ . '/../lib/class/html/standard/Tag/HtmlStandardTagTextArea.php';

//// Classe de représentation d'objet HTML
//require __DIR__ . '/../lib/class/html/AttributesGlobal.php';
//require __DIR__ . '/../lib/class/html/AttributesInput.php';
//require __DIR__ . '/../lib/class/html/AttributesOption.php';
//require __DIR__ . '/../lib/class/html/AttributesSelect.php';
//require __DIR__ . '/../lib/class/html/AttributesTextArea.php';
//require __DIR__ . '/../lib/class/html/EventsForm.php';
//require __DIR__ . '/../lib/class/html/EventsMouse.php';
//require __DIR__ . '/../lib/class/html/CustomStyleCSS.php';
//require __DIR__ . '/../lib/class/html/HtmlTagOption.php';
//require __DIR__ . '/../lib/class/html/AbstractHtmlGlobalElement.php';
//require __DIR__ . '/../lib/class/html/AbstractHtmlInput.php';
//require __DIR__ . '/../lib/class/html/HtmlInputText.php';
//require __DIR__ . '/../lib/class/html/HtmlInputNumber.php';
//require __DIR__ . '/../lib/class/html/HtmlInputKg.php';
//require __DIR__ . '/../lib/class/html/HtmlInputCalendar.php';
//require __DIR__ . '/../lib/class/html/AbstractHtmlList.php';
//require __DIR__ . '/../lib/class/html/HtmlListSelect.php';
//require __DIR__ . '/../lib/class/html/HtmlListSelectTagName.php';
//require __DIR__ . '/../lib/class/html/HtmlListBoolean.php';
//require __DIR__ . '/../lib/class/html/HtmlSubForm.php';
//require __DIR__ . '/../lib/class/html/HtmlSubForm_R1N.php';
//require __DIR__ . '/../lib/class/html/HtmlSubForm_RNN.php';
//require __DIR__ . '/../lib/class/html/HtmlTextArea.php';
//require __DIR__ . '/../lib/class/html/HtmlCheckbox.php';
//require __DIR__ . '/../lib/class/html/TraitDataFieldToHtml.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlInputText.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlListSelect.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlListBoolean.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlInputCalendar.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlInputNumber.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlTextArea.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlSubForm_R1N.php';
//require __DIR__ . '/../lib/class/html/DataFieldToHtmlSubForm_RNN.php';
//require __DIR__ . '/../lib/class/ModuleConfigLib.php';

// Session utilisateur
//require __DIR__ . '/../lib/session_cli.php';


// Variables locales à la page PHP
//Lib::setModule();
//$module = Lib::getModule();

// Inclusions propres au module
//if ($module != 'lib') {

    //Inclusion de la configuration propre au module
//    $module_conf_file = '../' . $module . '/class/ModuleConfig.php';

//    if (file_exists($module_conf_file)) {
//        require __DIR__ . '/' . $module_conf_file;
//    }

    //Inclusion de la librairie de fonction propre au module
//    require __DIR__ . '/../' . $module . '/functions.php';
//}
//$globalConfig = $_SESSION['globalConfig'];
//GlobalConfig::setExecDebugTimeStart();

