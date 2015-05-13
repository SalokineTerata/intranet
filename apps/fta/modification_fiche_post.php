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
//include ("./functions.php");

require_once '../inc/main.php';


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

/**
 * Valeurs récupérées
 */
$action = Lib::getParameterFromRequest("action");
$new_correction_fta_suivi_projet = Lib::getParameterFromRequest("new_correction_fta_suivi_projet");
$paramIdFta = Lib::getParameterFromRequest("id_fta");
$paramIdFtaChapitre = Lib::getParameterFromRequest("id_fta_chapitre_encours");
$temp_colis_activation_codesoft_arti2 = Lib::getParameterFromRequest("temp_colis_activation_codesoft_arti2");
$temp_composition_activation_codesoft_arti2 = Lib::getParameterFromRequest("temp_composition_activation_codesoft_arti2");
$conditionnement_expedition = Lib::getParameterFromRequest("conditionnement_expedition");
$synthese_action = Lib::getParameterFromRequest("synthese_action");
$societe_demandeur_fta = Lib::getParameterFromRequest("societe_demandeur_fta");
//$id_classification_fta = Lib::getParameterFromRequest("id_classification_fta");
$signature_validation_suivi_projet = Lib::getParameterFromRequest(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET);

switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':

        //Redirection
        header("Location: index.php");

        break;

    //Gestion des Erreurs
    case 'correction':

        if ($new_correction_fta_suivi_projet) {
            $id_chapitre = $paramIdFtaChapitre;
            $option["correction_fta_suivi_projet"] = $new_correction_fta_suivi_projet;
            $noredirection = correction_chapitre($paramIdFta, $id_chapitre, $option);
        } else {
            $titre = "Informations manquantes";
            $message = "Vous devez spécifier l'objet de votre correction.";
            Lib::showMessage($titre, $message);
            $noredirection = 1;
        }
        break;

    case 'suppression_classification_chemin':

        //Suppresion du chemin
        //$id_classification_fta;             //From URL
        //$id_fta;                            //From URL
        //mysql_table_operation("classification_fta", "delete");
        ObjectFta::deleteClassification();
        break;

    case 'valider':

        //Définition des variables locales  ***********************************************
        //$id_fta = Lib::getParameterFromRequest("id_fta");
        //$objectFta = new ObjectFta($id_fta);
        $modelFta = new FtaModel($paramIdFta);
//        $recordChapitre = new DatabaseRecord(
//                $table_name = "fta_chapitre", $key_value = $id_fta_chapitre_encours);
        //$objectFta = ObjectFta::restoreSession($id_fta);
        //$objectFta->updatePropertiesFromHttpRequest();
        $modelFta->saveToDatabase();


        /**
         * Enregistrement de la signature
         */
        $modelFta;
        $paramIdFtaChapitre;
        $signature_validation_suivi_projet;
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdFtaChapitre);
        $modeFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $modeFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->setFieldValue($signature_validation_suivi_projet);
        
        
        $date_echeance_fta = $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "date_echeance_fta");
        //$date_echeance_fta = $modelFta->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue();

        $abreviation_fta_etat = $objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat");
        //$abreviation_fta_etat = $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION);
        //$id_fta_chapitre_encours = $objectFta->getFieldValue(ObjectFta::TABLE_SUIVI_PROJET_NAME, "id_fta_chapitre");
        //$signature_validation_suivi_projet = $objectFta->getFieldValue(ObjectFta::TABLE_SUIVI_PROJET_NAME, "signature_validation_suivi_projet");
        //$id_fta_chapitre = $id_fta_chapitre_encours;
//        $recordChapitre = new DatabaseRecord("fta_chapitre", $id_fta_chapitre_encours);
        $id_fta_processus_encours = $recordChapitre->getFieldValue("id_fta_processus");
        $nom_fta_chapitre_encours = $recordChapitre->getFieldValue(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE);
//        $nom_fta_chapitre_encours = $recordChapitre->getFieldValue("nom_fta_chapitre");
        //Calcul des éléments de palettisation (tout est issu de cette fonction)
        //$palettisation = calcul_palettisation_fta($id_fta);
        //$poids_net_colis = $palettisation["colis_net"];
        //Fin de Définition des variables locales ***********************************************
        //Les champs obligatoires ont-ils été saisie ?
        //Ce contrôle n'est effectué que si le chapitre doit être validé
//        if ($signature_validation_suivi_projet) {
//            $signature_validation_suivi_projet = $objectFta->checkMandatoryFields($nom_fta_chapitre_encours);
//        }
        //Controle de cohérence
//        if ($poids_net_colis != null) {
//            if ($poids_net_colis > ModuleConfig::MAX_POIDS_NET_COLIS
//                    or $poids_net_colis < $objectFta->getFieldValue(ObjectFta::TABLE_ARTI_NAME, "Poids_ELEM")) {
//                $signature_validation_suivi_projet = 0; //On empêche la validation du chapitre
//                $titre = "Poids Net Colis";
//                $message = "Le Poids Net Colis saisie n'est pas valide:<br>"
//                        . "- Il ne peut pas être inférieur au poids de l'UVC (" . $objectFta->getFieldValue(ObjectFta::TABLE_ARTI_NAME, "Poids_ELEM") . " Kg)<br>"
//                        . "- Il ne peut pas être supérieur à 10 Kg"
//                ;
//                afficher_message($titre, $message, $redirection);
//                $noredirection = 1;
//            }
//        }
//        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "designation_commerciale_fta")) {
//            $objectFta->setFieldValue(
//                    ObjectFta::TABLE_FTA_NAME, "designation_commerciale_fta", strtoupper(
//                            $objectFta->getFieldValue(
//                                    ObjectFta::TABLE_FTA_NAME, "designation_commerciale_fta"
//            )));
//        }
        //echo $date_validation_suivi_projet;
        //Récupération des dates MySQL
//        $tab_date = array(array("name" => "date_echeance_fta"
//                , "default" => "0000-00-00"
//                , "force" => ""
//                , "recordset" => ObjectFta::TABLE_FTA_NAME
//            )
//            , array("name" => "date_transfert_industriel"
//                , "default" => "0000-00-00"
//                , "force" => ""
//                , "recordset" => ObjectFta::TABLE_FTA_NAME
//            )
//            , array("name" => "date_demarrage_chapitre_fta_suivi_projet"
//                , "default" => "Y-m-d"
//                , "force" => ""
//                , "recordset" => ObjectFta::TABLE_SUIVI_PROJET_NAME
//            )
//            , array("name" => "date_validation_suivi_projet"
//                , "default" => "Y-m-d"
//                , "force" => "Y-m-d"
//                , "recordset" => ObjectFta::TABLE_SUIVI_PROJET_NAME
//            )
//        );
//        foreach ($tab_date as $current_date) {
//            //Initialisation des variables locales
//            $nom_date = $current_date["name"];
//            $${"nom_date"} = Lib::getParameterFromRequest($current_date["name"]);
//            $txt1 = "jour_date_" . $nom_date;
//            $jour_date = Lib::getParameterFromRequest($txt1);
//            $txt1 = "mois_date_" . $nom_date;
//            $mois_date = Lib::getParameterFromRequest($txt1);
//            $txt1 = "annee_date_" . $nom_date;
//            $annee_date = Lib::getParameterFromRequest($txt1);
//
//            //Valeur par défaut
//            if ($$nom_date == "0000-00-00") {
//                $$nom_date = date($current_date["default"]);
//            }
//
//            //Si la date est cohérente, affectation de la bonne valeur
//            if ($jour_date and $mois_date and $annee_date) {
//                $$nom_date = recuperation_date_pour_mysql($jour_date, $mois_date, $annee_date, $nom_date);
//            }
//
//            //Affectation forcée de la date
//            if ($current_date["force"]) {
//                $$nom_date = date($current_date["force"]);
//            }
//
//            //Enregistrement de la date au bon format
//            //$current_date["recordset"]->setFieldValue($nom_date, $$nom_date);
//            $objectFta->setFieldValue($current_date["recordset"], $nom_date, $$nom_date);
//        }
//
//        //Conditionnement d'expédition
//        if ($conditionnement_expedition) {
//            //Recherche de la palette déjà sélectionnée
//            $req = "SELECT id_fta_conditionnement "
//                    . "FROM fta_conditionnement, annexe_emballage, annexe_emballage_groupe "
//                    . "WHERE id_fta=$id_fta "
//                    . "AND annexe_emballage_groupe.id_annexe_emballage_groupe=10 " //Palette
//                    . "AND fta_conditionnement.id_annexe_emballage=annexe_emballage.id_annexe_emballage "
//                    . "AND annexe_emballage_groupe.id_annexe_emballage_groupe=annexe_emballage.id_annexe_emballage_groupe "
//            ;
//            $result = DatabaseOperation::query($req);
//            $nombre_resultat = mysql_num_rows($result);
//            if ($nombre_resultat > 1) {
//                $titre = "Erreur";
//                $message = "Il y a plus d'une palette pour cette palettisation!";
//                //afficher_message($titre, $message, $redirection);
//                Lib::showMessage($titre, $message);
//            } else {
//                //Préparation des données
//                $hauteur_emballage_fta_conditionnement = 3;  //La hauteur de l'emballage sera considérer comme hauteur dans la palettisation
//                $quantite_emballage_fta_conditionnement = 1; //Qu'une palette par palettisation !!
//                $id_annexe_emballage = $conditionnement_expedition;
//
//                switch ($nombre_resultat) {
//                    case 0: //Aucune palette donc ajout
//
//
//                        $id_fta;
//
//                        mysql_table_operation("fta_conditionnement", "insert");
//
//                        break;
//
//                    case 1: //Il y en a déjà une. Donc mise à jour
//
//                        $id_fta_conditionnement = mysql_result($result, 0);
//                        mysql_table_operation("fta_conditionnement", "rewrite");
//
//                        break;
//                }
//                mysql_table_load("fta_conditionnement");
//                mysql_table_load("annexe_emballage");
//                //$poids_annexe_emballage;
//            }
//        }
//
//        //Préparation des données et règles de gestion
//        //Coût de la plateforme
//        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "site_expedition_fta") == 6) {
//            // //plateforme
//            $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "Cout_PF", 1);
//        } else {
//            $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "Cout_PF", 0);
//        }
//
//        //10 = Coupe et 70 = LS
//        //Rayon
//        $id_element = "4"; //Recherche du Rayon
//        $extension[0] = 1; //Passage en mode recherche d'une catégorie
//        $champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
//        switch ($champ[1]) {
//            //Libre Service: valeur 70
//            case 5:
//                $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "Rayon", 70);
//                break;
//
//            //Traiteur: valeur 10
//            case 21:
//                $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "Rayon", 10);
//                break;
//            //Non géré
//
//            default:
//                $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "Rayon", 99);
//        }
//        //echo $Rayon;
//        //Mise à jour de NB_UV_PAR_US1
//        $objectFta->buildNbUvParUs1();
//
//        //Préparation des données Etiquettes
//        if ($id_fta_chapitre_encours == 101) { //Chapitre Etiquette
//            $objectFta->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "activation_codesoft_arti2", $temp_colis_activation_codesoft_arti2 + $temp_composition_activation_codesoft_arti2);
//        }
        //Gestion des délais (Attention, uniquement sur le chapitre identité)
        //echo $nom_fta_chapitre_encours;
        //echo $proprietaire;
        if ($nom_fta_chapitre_encours == "identite") {
            // //Si oui, dans ce cas, Récupération de la liste des processus affectés
            $req = "SELECT DISTINCT id_init_fta_processus, nom_fta_processus, delai_fta_processus "
                    . "FROM fta_processus_cycle, fta_processus "
                    . "WHERE id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' "
                    . "AND id_init_fta_processus=id_fta_processus "
                    . "ORDER BY id_init_fta_processus"
            ;
            $result = DatabaseOperation::query($req);
            $date_echeance_processus_last = $date_echeance_fta;
            while ($rows = mysql_fetch_array($result)) {

                //Construction de la liste de processus
                $html_date.="";
                $champ_date_echeance_processus = "date_echeance_processus_" . $rows["id_init_fta_processus"];

                //Une date d'échéance pour la FTA a-t-elle été saisie ?
                if ($date_echeance_fta) {
                    //Dans ce cas on cherche à renregistrer la date d'échéance des processus
                    $$champ_date_echeance_processus = Lib::getParameterFromRequest($champ_date_echeance_processus);

                    //Une date a-t-elle été saisie ?
                    if ($$champ_date_echeance_processus) {
                        //Controle de cohérence
                        //Récupération de la liste des processus précédent pour ce cycle de vie
                        $req = "SELECT DISTINCT id_init_fta_processus, nom_fta_processus, delai_fta_processus "
                                . "FROM fta_processus_cycle, fta_processus "
                                . "WHERE id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' "
                                . "AND id_init_fta_processus=id_fta_processus "
                                . "AND id_next_fta_processus=" . $rows["id_init_fta_processus"] . " "
                                . "ORDER BY id_init_fta_processus"
                        ;
                        $result_last_processus = DatabaseOperation::query($req);
                        if (mysql_num_rows($result_last_processus)) {
                            while ($rows_last_processus = mysql_fetch_array($result_last_processus)) {
                                $champ_previous = "date_echeance_processus_" . $rows_last_processus["id_init_fta_processus"];
                                if ($$champ_previous > $$champ_date_echeance_processus) {
                                    //echo ": ".$rows_last_processus["nom_fta_processus"]."=".$$champ_previous." vs ".$rows["nom_fta_processus"]."=".$$champ."<br>";
                                    $titre = "Erreur de date d'échéance";
                                    $message = "Date d'échéance pour " . $rows["nom_fta_processus"] . "=" . $$champ_date_echeance_processus
                                            . "<br>Date d'échéance pour " . $rows_last_processus["nom_fta_processus"] . "=" . $$champ_previous
                                            . "<br><br>Le processus " . $rows["nom_fta_processus"] . " doit être validé <b>APRES</b> le processus " . $rows_last_processus["nom_fta_processus"]
                                    ;
                                    afficher_message($titre, $message, $redirection);
                                }
                            }
                        } else {
                            //Il s'agit du dernier processus, controler directement avec la date d'échéanc de la FTA  
                            if ($$champ_date_echeance_processus > $date_echeance_fta) {
                                $titre = "Erreur de date d'échéance";
                                $message = "La date d'échéance pour le processus " . $rows["nom_fta_processus"] . " est trop courte";
                                afficher_message($titre, $message, $redirection);
                            }
                        }
                    } else {
                        //Calculer les dates théoriques automatiquement à partir de la date d'échéance de validation

                        $annee_date_echeance_fta = substr($date_echeance_fta, 0, 4);
                        $mois_date_echeance_fta = substr($date_echeance_fta, 5, 2);
                        $jour_date_echeance_fta = substr($date_echeance_fta, 8, 2);
                        $delai_jour = $rows["delai_fta_processus"] * 7;
                        $timestamp_date_echeance_fta = mktime(0, 0, 0, $mois_date_echeance_fta, $jour_date_echeance_fta - $delai_jour, $annee_date_echeance_fta);
                        $$champ_date_echeance_processus = date("Y-m-d", $timestamp_date_echeance_fta);
                        //echo  ${$champ}."<br>";
                    }
                } else {
                    //Si il n'y a pas de date d'échéance de validation de la FTA, on efface les éventuelles anciennes saisies
                    $$champ_date_echeance_processus = "0000-00-00";
                }
                //Enregistrement des délais de processus
                //echo $id_fta." - ".$rows["id_init_fta_processus"]." - ".$$champ_date_echeance_processus."<br>";
                //Recherche d'enregistrement déjà existant pour mise à jour, sinon insertion
                $req = "SELECT id_fta_processus_delai FROM fta_processus_delai "
                        . "WHERE id_fta='" . $paramIdFta . "' "
                        . "AND id_fta_processus = '" . $rows["id_init_fta_processus"] . "' "
                ;
                $result_fta_processus_delai = DatabaseOperation::query($req);
                if (mysql_num_rows($result_fta_processus_delai)) {
                    //Si l'enregistrement existe, alors mise à jour des informations
                    $operation = "update";

                    //Récupération de l'identifiant pour permettre la mise à jour de celui-ci
                    $id_fta_processus_delai = mysql_result($result_fta_processus_delai, 0, "id_fta_processus_delai");
                } else {
                    //Sinon insertion d'un nouvel enregistrement
                    $operation = "insert";
                }
                //Opération d'enregistrement des informations
                $id_fta_processus = $rows["id_init_fta_processus"];
                $date_echeance_processus = $$champ_date_echeance_processus;
                $table = "fta_processus_delai";
                mysql_table_operation($table, $operation);

                //Mise à jour de la validation de l'échéance
                fta_processus_validation_delai($paramIdFta, $id_fta_processus);
            }//Fin du parcours des échéances par processus
        }//Si non, désactivation de la gestion des échéances au niveau processus
//Enregistrement des informations
        $paramIdFta; //Valeur donnée en URL
        $operation = "update";
        $table = "fta";
        //$objectFta->setFieldValue(ObjectFta::TABLE_FTA_NAME, "societe_demandeur_fta", $societe_demandeur_fta);
        mysql_table_operation($table, $operation);
        mysql_table_load($table);
//     echo $id_access_arti2;

        /* $table="infog";
          mysql_table_operation($table, $operation);
          mysql_table_load($table); */

        //Suivi de dossier
        if ($id_fta_suivi_projet) {
            $operation = "update";
        } else {
            $operation = "insert";
        }
        $id_fta_chapitre = $paramIdFtaChapitre;
        if (!$signature_validation_suivi_projet) {
            $signature_validation_suivi_projet = 0;
        }
        $table = "fta_suivi_projet";
        mysql_table_operation($table, $operation);

        //Controle des donnée et access_arti2
        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "LIBELLE")) {
            $objectFta->setFieldValue(
                    ObjectFta::TABLE_FTA_NAME, "LIBELLE", mb_convert_case(
                            stripslashes(
                                    $objectFta->getFieldValue(
                                            ObjectFta::TABLE_FTA_NAME, "LIBELLE")
                            ), MB_CASE_UPPER, "utf-8")
            );
        }

        //Nom de l'étiquette par défaut si on enregistre sur le chapitre Gestion des articles (cf. table fta_chapitre)
        if (($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "LIBELLE_CLIENT") == null) and ( $nom_fta_chapitre == "activation_article")) {
            $objectFta->setFieldValue(ObjectFta::TABLE_FTA_NAME, "LIBELLE_CLIENT", $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "LIBELLE"));
        }
        $table = "fta";
        $operation = "update";
        mysql_table_operation($table, $operation);
        mysql_table_load($table);

        //echo $id_fta;
        //     echo "Site_de_production:".$Site_de_production."<br>";
        /* $req = "SELECT id_access_arti2 FROM access_arti2 WHERE id_fta='".$id_fta."' ";
          $result=DatabaseOperation::query($req);
          $id_access_arti2=mysql_result($result, 0, "id_access_arti2");
         */


        //Cohérence des durées de vie (restrictino du message uniquement au niveau du processus Qualité)
        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "duree_vie_technique_fta") < $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "Duree_de_vie_technique") and ( $paramIdFtaChapitre == 100)) {

            $titre = "Différences dans les Durées de vie";
            $message = "Votre <b>" . mysql_field_desc("fta", "duree_vie_technique_fta") . "</b> est inférieure à la <b>" . mysql_field_desc("access_arti2", "Durée_de_vie_technique") . "</b>.<br>"
            ;
            afficher_message($titre, $message, $redirection);
            $erreur = 1;
        }

        //Cohérence du Code LDC
        // ************** GESTION MULTI PCB POUR MEME CODE GROUPE
        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "code_article_ldc") and ModuleConfig::CODE_LDC_UNIQUE) {
            //if($code_article_ldc and false)
            $req = "SELECT `fta`.`id_fta` FROM `fta`, fta_etat "
                    . "WHERE `fta`.`id_dossier_fta` <> '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_dossier_fta") . "' "
                    . "AND fta_etat.id_fta_etat=fta.id_fta_etat "
                    . "AND abreviation_fta_etat<>'R' "
            ;
//            $req = "SELECT `fta`.`id_fta` FROM `fta`, `access_arti2`, fta_etat "
//                    . "WHERE `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` "
//                    . "AND `fta`.`id_fta` = `access_arti2`.`id_fta`  "
//                    . "AND  `access_arti2`.`code_article_ldc` = '" . $objectFta->getFieldValue(ObjectFta::TABLE_ARTI_NAME, "code_article_ldc") . "' "
//                    . "AND `fta`.`id_dossier_fta` <> '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_dossier_fta") . "' "
//                    . "AND fta_etat.id_fta_etat=fta.id_fta_etat "
//                    . "AND abreviation_fta_etat<>'R' "
//            ;
            $result = DatabaseOperation::query($req);
            if (mysql_num_rows($result)) {//Si le code est déjà affecté à une autre FTA, on informe, et on suppime l'affectation sur la FTA en cours
                $titre = "Code Article déjà affecté";
                $message = "Attention, le code LDC est déjà affecté à la FTA n°" . mysql_result($result, 0, "id_fta") . "<br>"
                        . "Votre code ne sera pas enregistré."
                ;
                afficher_message($titre, $message, $redirection);
                $objectFta->setFieldValue(ObjectFta::TABLE_FTA_NAME, "code_article_ldc", null);
                $erreur = 1;
            }
        }

        //Cohérence du Code Agrologic
        if ($objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_article_agrologic")) {
            $req = "SELECT `fta`.`id_fta` FROM `fta` "
                    . "WHERE `fta`.`id_article_agrologic` = '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_article_agrologic") . "' "
                    . "AND `fta`.`id_dossier_fta` <> '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_dossier_fta") . "' "
                    . "AND (`fta`.id_fta_etat=1 OR `fta`.id_fta_etat=3) "
            ;
            $result = DatabaseOperation::query($req);
            if (mysql_num_rows($result)) {//Si le code est déjà affecté à une autre FTA, on informe, et on suppime l'affectation sur la FTA en cours
                $titre = "Code Article Agrologic déjà affecté";
                $message = "Attention, le code Agrologic est déjà affecté à la FTA n°" . mysql_result($result, 0, "id_fta") . "<br>"
                        . "Votre code ne sera pas enregistré."
                ;
                afficher_message($titre, $message, $redirection);

//                $req = "UPDATE fta SET id_article_agrologic = NULL WHERE id_fta='" . $id_fta . "'  ";
//                DatabaseOperation::query($req);
                $objectFta->setFieldValue(ObjectFta::TABLE_FTA_NAME, "id_article_agrologic", null);
                $erreur = 1;
            }
        }

        if (!$erreur) {
            //Mise à jour de la validation de l'échéance
            $paramIdFta;
            $id_fta_processus = $id_fta_processus_encours;
            //echo $id_fta_processus."<br>";
            //$id_fta_processus=5;
            fta_processus_validation_delai($paramIdFta, $id_fta_processus);

            //Notification de l'état d'Avancement de la FTA
            //afficher_message("Information de l'état d'avancement du Projet", "Les intervenants ont été informer du nouvel état d'avancement.", "");
            $liste_user = notification_suivi_projet($paramIdFta);

            if ($liste_user) {
                $noredirection = 1;
            }

            //Redirection
            //header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        } else {
//            $req = "UPDATE fta_suivi_projet SET signature_validation_suivi_projet=0 WHERE id_fta_suivi_projet=$id_fta_suivi_projet";
//            DatabaseOperation::query($req);
            $objectFta->setFieldValue(ObjectFta::TABLE_SUIVI_PROJET_NAME, "signature_validation_suivi_projet", 0);
        }

        //Sauvegarde des enregistrements dans la base de données.
        $objectFta->updateDatabaseOnly();

        break;

    case 'suppression_tarif':

        //Variables passées en URL
        $id_fta_tarif;
        $paramIdFta;
        mysql_table_operation("fta_tarif", "delete");

        //header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_conditionnement':

        //Variables passées en URL
        $paramIdFta = Lib::getParameterFromRequest("id_fta");
        $id_fta_conditionnement = Lib::getParameterFromRequest("id_fta_conditionnement");

        //Suppression du conditionnement
        //mysql_table_operation("fta_conditionnement", "delete");

        ObjectFta::deleteConditionnement($id_fta_conditionnement);

//Mise à jour des poids de l'UVC
//calcul_poids_fta($id_fta);
//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_palettisation':

//Variables passées en URL
        $paramIdFta;
        $id_fta_conditionnement;
        mysql_table_operation("fta_conditionnement", "delete");

//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_nomenclature':

//Suppression de la nomenclature
//$id_fta_nomenclature;
//recette_nomenclature_suppression($id_fta_nomenclature);
        mysql_table_operation("fta_composant", "delete");


//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_composant':

//Suppression de la nomenclature
//$id_fta_composition;
        $id_fta_composant;
        mysql_table_operation("fta_composant", "delete");

//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;
    /*     * **********
      Fin de switch
     * ********** */
}

//if(!$erreur and !$noredirection) header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
if (!$erreur) {
    header("Location: modification_fiche.php?id_fta=$paramIdFta&id_fta_chapitre_encours=$paramIdFtaChapitre&synthese_action=$synthese_action");
}
//include ("./action_bs.php");
//include ("./action_sm.php");


