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
/**
 * Récuperation des données
 */
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
$traitement = Lib::getParameterFromRequest('Traitement');
$globalConfig = new GlobalConfig();
UserModel::checkUserSessionExpired($globalConfig);

$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$proprietaire = Lib::getParameterFromRequest('proprietaire');
$valider_saisie = Lib::getParameterFromRequest('valider_saisie');

/**
 * Valeur à enregistrer
 */
$id_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION);
$nom_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION);

$duree_vie_technique_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION);
$poids_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION);
$quantite_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC);
//$ordre_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION);
$val_nut_kcal = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL);
$val_nut_sel = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_SEL);
$val_nut_proteine = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_PROTEINE);
$val_nut_sucre = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_SUCRE);
$val_nut_glucide = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_GLUCIDE);
$val_nut_acide_gras = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS);
$val_nut_mat_grasse = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE);
$val_nut_kj = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_VAL_NUT_KJ);
$SiteDeProduction = Lib::getParameterFromRequest('fta_Site_de_production_' . $id_fta);
$mode_etiquette_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION . "_" . $id_fta_composant);
$etiquette_libelle_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION);
$etiquette_id_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION);
$etiquette_duree_vie_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION . "_" . $id_fta_composant);
$etiquette_poids_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION);
$etiquette_quantite_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION);
$taille_police_ingredient_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION);
$k_style_paragraphe_ingredient_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION);
$k_etiquette = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION);
$k_etiquette_verso_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION);
$k_codesoft_etiquette_logo = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO);

$etiquette_decomposition_poids_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT);
$etiquette_information_complementaire_recto_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT);
$etiquette_libelle_legal_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION);

$ingredient_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION . "_" . $id_fta_composant);
$ingredient_fta_composition1 = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1 . "_" . $id_fta_composant);
$etiquette_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_ETIQUETTE . "_" . $id_fta_composant);
$etiquette_supplementaire_fta_composition = Lib::getParameterFromRequest(FtaComposantModel::TABLENAME . "_" . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON . "_" . $id_fta_composant);

switch ($traitement) {

    case FtaComposantModel::ENREGISTRER_LES_MODIFICATIONS :
    case FtaComposantModel::REVENIR_SURE_LA_FTA :
        $_SESSION['checkCreation'] = "0";

        if ($mode_etiquette_fta_composition == AnnexeModeEtiquetteModel::PAS_DETIQUETTE) {
            DatabaseOperation::execute(
                    'UPDATE ' . FtaComposantModel::TABLENAME
                    . ' SET ' . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION . '=' . "-1"
                    . ', ' . FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION . '=' . "-1"
                    . ' WHERE ' . FtaComposantModel::KEYNAME . '=' . $id_fta_composant
            );
        } elseif ($mode_etiquette_fta_composition == AnnexeModeEtiquetteModel::ETIQUETTE_PERSONALISE and empty($etiquette_duree_vie_fta_composition)) {
            $titre = UserInterfaceMessage::FR_WARNING_MISSING_DATA;
            $message = UserInterfaceMessage::FR_WARNING_DUREE_DE_VIE_COMPOSANT;
            Lib::showMessage($titre, $message, $redirection);
        }
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
                /**
                 * Version avec le module rewrite
                 */
//        header("Location: index.html");

                break;


            case 'valider':
                /*
                 * Initialisation des modèles
                 */
                $ftaModel = new FtaModel($id_fta);

                //Insertion ou mise à jour d'un composant ?
                if ($creation) {
                    //Création
                    //Le composant sera géré par la composition
                    $is_composition_fta_composant = 1;

                    //En revanche, un composant créé au niveau de la composition n'intervient pas dans la nomenclature
                    $ftaComposantModel = new FtaComposantModel($id_fta_composant);

                    /**
                     * Enregistrement
                     */
                    $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT)->setFieldValue($is_composition_fta_composant);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION)->setFieldValue($duree_vie_technique_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE)->setFieldValue($etiquette_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION)->setFieldValue($etiquette_duree_vie_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION)->setFieldValue($etiquette_id_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION)->setFieldValue($etiquette_libelle_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION)->setFieldValue($etiquette_poids_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON)->setFieldValue($etiquette_supplementaire_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION)->setFieldValue($id_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->setFieldValue($SiteDeProduction);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->setFieldValue($ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1)->setFieldValue($ingredient_fta_composition1);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)->setFieldValue($k_etiquette);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION)->setFieldValue($k_style_paragraphe_ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION)->setFieldValue($mode_etiquette_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->setFieldValue($nom_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION)->setFieldValue($ordre_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->setFieldValue($poids_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION)->setFieldValue($quantite_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION)->setFieldValue($taille_police_ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SEL)->setFieldValue($val_nut_sel);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE)->setFieldValue($val_nut_proteine);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE)->setFieldValue($val_nut_sucre);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE)->setFieldValue($val_nut_glucide);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS)->setFieldValue($val_nut_acide_gras);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE)->setFieldValue($val_nut_mat_grasse);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ)->setFieldValue($val_nut_kj);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL)->setFieldValue($val_nut_kcal);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->setFieldValue($SiteDeProduction);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)->setFieldValue($k_etiquette_verso_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO)->setFieldValue($k_codesoft_etiquette_logo);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT)->setFieldValue($etiquette_decomposition_poids_fta_composant);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT)->setFieldValue($etiquette_information_complementaire_recto_fta_composant);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION)->setFieldValue($etiquette_libelle_legal_fta_composition);
                    $ftaComposantModel->saveToDatabase();
                } else {

                    //Mise à jour
                    $ftaComposantModel = new FtaComposantModel($id_fta_composant);


//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION)->setFieldValue($duree_vie_technique_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE)->setFieldValue($etiquette_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION)->setFieldValue($etiquette_duree_vie_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION)->setFieldValue($etiquette_id_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION)->setFieldValue($etiquette_libelle_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION)->setFieldValue($etiquette_poids_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON)->setFieldValue($etiquette_supplementaire_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION)->setFieldValue($id_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->setFieldValue($SiteDeProduction);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->setFieldValue($ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1)->setFieldValue($ingredient_fta_composition1);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)->setFieldValue($k_etiquette);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION)->setFieldValue($k_style_paragraphe_ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION)->setFieldValue($mode_etiquette_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->setFieldValue($nom_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION)->setFieldValue($ordre_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->setFieldValue($poids_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION)->setFieldValue($quantite_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION)->setFieldValue($taille_police_ingredient_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SEL)->setFieldValue($val_nut_sel);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE)->setFieldValue($val_nut_proteine);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE)->setFieldValue($val_nut_sucre);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE)->setFieldValue($val_nut_glucide);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS)->setFieldValue($val_nut_acide_gras);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE)->setFieldValue($val_nut_mat_grasse);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ)->setFieldValue($val_nut_kj);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL)->setFieldValue($val_nut_kcal);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->setFieldValue($SiteDeProduction);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)->setFieldValue($k_etiquette_verso_fta_composition);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO)->setFieldValue($k_codesoft_etiquette_logo);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT)->setFieldValue($etiquette_decomposition_poids_fta_composant);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT)->setFieldValue($etiquette_information_complementaire_recto_fta_composant);
//            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION)->setFieldValue($etiquette_libelle_legal_fta_composition);
                    $ftaComposantModel->saveToDatabase();
                }
                if ($valider_saisie) {
                    header("Location: modification_fiche.php"
                            . "?id_fta=" . $id_fta
                            . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours
                            . "&synthese_action=" . $synthese_action
//                    . "&comeback=" . $comeback
                            . "&id_fta_etat=" . $idFtaEtat
                            . "&abreviation_fta_etat=" . $abreviationFtaEtat
                            . "&id_fta_role=" . $idFtaRole
                    );
                } else {
                    header("Location: modifier_composition.php"
                            . "?id_fta=" . $id_fta
                            . "&id_fta_composant=" . $id_fta_composant
                            . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours
                            . "&synthese_action=" . $synthese_action
                            . "&proprietaire=" . $proprietaire
//                    . "&comeback=" . $comeback
                            . "&id_fta_etat=" . $idFtaEtat
                            . "&abreviation_fta_etat=" . $abreviationFtaEtat
                            . "&id_fta_role=" . $idFtaRole
                    );
                }
                break;

            case 'consulter':
//echo $id_fta."<br>";
                //Renvoi sur la FTA
                header("Location: modification_fiche.php"
                        . "?id_fta=" . $id_fta
                        . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours
                        . "&synthese_action=" . $synthese_action
//                . "&comeback=" . $comeback
                        . "&id_fta_etat=" . $idFtaEtat
                        . "&abreviation_fta_etat=" . $abreviationFtaEtat
                        . "&id_fta_role=" . $idFtaRole
                );

                break;


            /*             * **********
              Fin de switch
             * ********** */
        }
        break;

    case FtaComposantModel::MISE_EN_EVIDENCE_ALLERGENES :


        $arrayCheckStrings = array(
            $ingredient_fta_composition, $ingredient_fta_composition1
            , $etiquette_fta_composition, $etiquette_supplementaire_fta_composition);

        $ftaComposantModel = new FtaComposantModel($id_fta_composant);
        if ($arrayCheckStrings) {
            foreach ($arrayCheckStrings as $key => $rowsString) {
                if ($rowsString) {
                    $stringCorrige = "";
                    //Convertion du text en majuscule sans accents
//                    $string = FtaController::stringToUperCaseNoAccent($rowsString);
                    //Récupération des mots du DICO des listes d'allergènes

                    $arrayValues = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . AnnexeListeAllergeneDicoModel::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO
                                    . " FROM " . AnnexeListeAllergeneDicoModel::TABLENAME
                    );

                    /**
                     * Remplacement des valeurs
                     */
                    if ($arrayValues) {
                        foreach ($arrayValues as $rowsValues) {

                            $valueToTest = $rowsValues[AnnexeListeAllergeneDicoModel::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO];

                            if ($stringCorrige) {
                                $rowsString = $stringCorrige;
                            }

                            $mot = FtaController::stringToLowerCase($valueToTest);

                            //Remplace tous les caractères du text
//                            $stringCorrige = str_replace($mot, $valueToTest, $rowsString);
                            $stringCorrige = preg_replace('/\b'.$mot.'\b/i',$valueToTest,$rowsString, 1);
                        }
                    }
                    /**
                     * Enregistrement en BDD
                     */
                    switch ($key) {
                        case "0":
                            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->setFieldValue($stringCorrige);

                            break;
                        case "1":
                            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1)->setFieldValue($stringCorrige);

                            break;
                        case "2":
                            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE)->setFieldValue($stringCorrige);

                            break;
                        case "3":
                            $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON)->setFieldValue($stringCorrige);

                            break;
                    }
                }
            }
        }

        $ftaComposantModel->saveToDatabase();

        header("Location: modifier_composition.php"
                . "?id_fta=" . $id_fta
                . "&id_fta_composant=" . $id_fta_composant
                . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours
                . "&synthese_action=" . $synthese_action
                . "&proprietaire=" . $proprietaire
//                    . "&comeback=" . $comeback
                . "&id_fta_etat=" . $idFtaEtat
                . "&abreviation_fta_etat=" . $abreviationFtaEtat
                . "&id_fta_role=" . $idFtaRole
        );
        break;
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

