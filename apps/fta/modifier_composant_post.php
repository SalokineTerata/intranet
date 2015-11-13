<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
require_once '../inc/main.php';

$action = Lib::getParameterFromRequest('action');
$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$creation = Lib::getParameterFromRequest('creation');
$id_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::KEYNAME);
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$comeback = Lib::getParameterFromRequest('comeback');
$synthese_action = Lib::getParameterFromRequest('synthese_action');
$proprietaire = Lib::getParameterFromRequest('proprietaire');
$globalConfig = new GlobalConfig();
      UserModel::ConnexionFalse($globalConfig);

$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

/*
  -----------------
  ACTION A TRAITER
  -----------------
  -----------------------------------
  Détermination de l'action en cours
  -----------------------------------

  Cette page est appelée pour effectuer un traitement particulier
  en fonction de la variable "$action". Ensuite elle redirige le
  résultat vers une autre page.

  Le plus souvent, le traitement est délocalisé sous forme de
  fonction située dans le fichier "functions.php"

 */
switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':

        //Redirection
        header("Location: index.php");

        break;


    case 'valider':
        if ($id_fta_composant and $proprietaire) {
            $ftaComposantModel = new FtaComposantModel($id_fta_composant);
            $idAnnexeAgroArtCodification = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION)->getFieldValue();
            if ($idAnnexeAgroArtCodification) {
                $annexexAgrologicModel = new AnnexeAgrologicArticleCodificationModel($idAnnexeAgroArtCodification);
                $prefixe_code_produit_agrologic_fta_nomenclature = $annexexAgrologicModel->getDataField(AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD)->getFieldValue();

                /**
                 * Les Produits toujours en Kg
                 */
                if ($prefixe_code_produit_agrologic_fta_nomenclature == "13" or $prefixe_code_produit_agrologic_fta_nomenclature == "11") {
                    $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE)->setFieldValue("kg");
                }

                /**
                 * Les Produits toujours en L
                 */
                if ($prefixe_annexe_agrologic_article_codification == "17") {
                    $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE)->setFieldValue("L");
                }

                /**
                 * Création de la nomenclature orpheline
                 */
                if (
                        (//Cas Général (sauf Tarare)
                        $prefixe_annexe_agrologic_article_codification == "30"
                        )
                        or ( //Cas Tarare)
                        $prefixe_annexe_agrologic_article_codification == "14"
                        )
                        or ( //Cas Tarare)
                        $prefixe_annexe_agrologic_article_codification == "29"
                        )
                        or (
                        $prefixe_annexe_agrologic_article_codification == "15"
                        )
                ) {
                    if ($creation) {
                        //Valeur par défaut      
                        $nom_fta_nomenclature = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION)->getFieldValue();
                        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->setFieldValue($nom_fta_nomenclature);
                        $site_production_fta_nomenclature = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION)->getFieldValue();
                        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->setFieldValue($site_production_fta_nomenclature);
                        $poids_fta_nomenclature = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION)->getFieldValue();
                        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->setFieldValue($poids_fta_nomenclature);
                        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION)->setFieldValue("1");
                        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT)->setFieldValue("1");
                    }
                } else {
                    $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT)->setFieldValue("0");
                }

                $ftaComposantModel->saveToDatabase();
            }
        }
        header("Location: modification_fiche.php"
                . "?id_fta=" . $id_fta
                . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours
                . "&synthese_action=" . $synthese_action
                . "&comeback=" . $comeback
                . "&id_fta_etat=" . $idFtaEtat
                . "&abreviation_fta_etat=" . $abreviationFtaEtat
                . "&id_fta_role=" . $idFtaRole
        );

        break;



    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

