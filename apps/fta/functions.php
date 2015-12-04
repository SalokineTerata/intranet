<?php

/* * *********
  AUTORISATION
 * ********* */
/*
  Autorisation de consulter le module:
  En effet cette page est chargée par toutes les pages de ce module
 */

/* * *************************
  VARIABLES GLOBALES DU MODULE
 * ************************* */

/* * *************************
  FONCTIONS GLOBALES DU MODULE
 * ************************* */

/* * ****************
  DEBUT DES FONCTIONS
 * **************** */

function show_din_produit($id_fta_composant) {

    /* $req = "SELECT * FROM fta_nomenclature, annexe_agrologic_article_codification, geo "
      . "WHERE fta_nomenclature.id_fta_nomenclature=$id_fta_nomenclature "
      . "AND annexe_agrologic_article_codification.id_annexe_agrologic_article_codification=fta_nomenclature.id_annexe_agrologic_article_codification "
      . "AND site_production_fta_nomenclature=id_geo "
      ;
     */
    $req = "SELECT nom_fta_nomenclature,suffixe_agrologic_fta_nomenclature,"
            . "prefixe_annexe_agrologic_article_codification,poids_fta_nomenclature,id_annexe_unite,"
            . "raccourci_site_agis,quantite_piece_par_carton,"
            . "abreviation_annexe_agrologic_article_codification,"
            . " FROM fta_composant, annexe_agrologic_article_codification, geo "
            . "WHERE fta_composant.id_fta_composant=$id_fta_composant "
            . "AND annexe_agrologic_article_codification.id_annexe_agrologic_article_codification=fta_composant.id_annexe_agrologic_article_codification "
            . "AND site_production_fta_nomenclature=geo.id_geo "
    ;
    $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    foreach ($array as $rows) {
        $value = $rows["nom_fta_nomenclature"] . " " . $rows["suffixe_agrologic_fta_nomenclature"];
        switch ($rows["prefixe_annexe_agrologic_article_codification"]) {
            case "00": //Produit Fini en carton
                //$value .= " ".round($poids_fta_nomenclature).$id_annexe_unite;
                $value .= " " . $rows["poids_fta_nomenclature"] . $rows["id_annexe_unite"];
                break;

            case "01": //Cuit
            case "02": //Cru
                //Cas Particulier de Tarare
                if ($rows["raccourci_site_agis"] == "TAR") {
                    if ($rows["prefixe_annexe_agrologic_article_codification"] == "01") {
                        //$value .= " ".round($poids_fta_nomenclature).$id_annexe_unite." PCE";
                        $value .= " " . $rows["poids_fta_nomenclature"] . $rows["id_annexe_unite"] . " PCE";
                    }
                    if ($rows["prefixe_annexe_agrologic_article_codification"] == "02") {
                        //$value .= " ".$quantite_piece_par_carton."x".round($poids_fta_nomenclature).$id_annexe_unite." SURG";
                        $value .= " " . $rows["quantite_piece_par_carton"] . "x" . $rows["poids_fta_nomenclature"] . $rows["id_annexe_unite"] . " SURG";
                    }
                } else {   //Cas général
                    //$value .= " ".round($poids_fta_nomenclature).$id_annexe_unite." ".$abreviation_annexe_agrologic_article_codification;
                    $value .= " " . $rows["poids_fta_nomenclature"] . $rows["id_annexe_unite"] . " " . $rows["abreviation_annexe_agrologic_article_codification"];
                }
                break;
            case "03": //Surgelé
                $value .= " " . $rows["quantite_piece_par_carton"] . "x" . $rows["poids_fta_nomenclature"] . $rows["id_annexe_unite"];
                break;
            case "05": //Sauce
            case "06": //Farce
            case "07": //Préparation
                $value = $rows["abreviation_annexe_agrologic_article_codification"] . " " . $value . " " . $rows["id_annexe_unite"];
                break;
        }
    }
    $value = mb_strtoupper($value);
    return $value;
}

//Envoi un mail d'information global (pour une liste de FTA)
function envoi_mail_global($selection_fta, $liste_diffusion, $subject) {
    $where = "";
    $operator = "";
    $last_site = "";
    $text = "Bonjour,\n"
            . "\tNous vous informons de la validation des Fiches Techniques Articles suivantes:\n"
    ;
    foreach ($selection_fta as $id_fta) {
        $where.= $operator . "fta.id_fta=$id_fta ";
        $operator = "OR ";
    }
    $req = "SELECT * FROM fta, access_arti2, geo "
            . "WHERE ( $where ) "
            . "AND geo.id_site=fta.Site_de_production "
            . "ORDER BY libelle_site_agis, CODE_ARTICLE "
    ;
    $_SESSION["log_transition"].="\n\n" . $req;
    $result = DatabaseOperation::query($req);

    //Parcours des FTA classé par site
    while ($rows_fta = mysql_fetch_array($result)) {
        //Classement par site d'assemblage
        if ($last_site <> $rows_fta["libelle_site_agis"]) {
            $text.="\n\nSite d'assemblage: " . $rows_fta["libelle_site_agis"] . "\n";
        }

        //Récupération de la liste des produits
        $text_prod = "";
        /* $req = "SELECT * "
          . "FROM fta_nomenclature, annexe_agrologic_article_codification "
          . "WHERE fta_nomenclature.id_fta=".$rows_fta["id_fta"]." "
          . "AND fta_nomenclature.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
          . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
          ;
         */
        $req = "SELECT * "
                . "FROM fta_composant, annexe_agrologic_article_codification "
                . "WHERE fta_composant.id_fta=" . $rows_fta["id_fta"] . " "
                . "AND fta_composant.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
                . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
        ;
        $_SESSION["log_transition"].="\n\n" . $req;
        $result_prod = DatabaseOperation::query($req);
        if (mysql_num_rows($result_prod)) {
            while ($rows_prod = mysql_fetch_array($result_prod)) {
                //Chargement du code de codification
                /* $id_annexe_agrologic_article_codification=$rows_prod["id_annexe_agrologic_article_codification"];
                  mysql_table_load("annexe_agrologic_article_codification");
                 */
                $prefixe_annexe_agrologic_article_codification;
                $text_prod.= $rows_prod["prefixe_annexe_agrologic_article_codification"]
                        . $rows_prod["code_produit_agrologic_fta_nomenclature"]
                        . ", "
                ;
            }
        }

        //Insertion de la ligne d'article
        $text.=$rows_fta["CODE_ARTICLE"] . " (" . $rows_fta["code_article_ldc"] . ") " . $rows_fta["LIBELLE"] . "\t\t" . $text_prod . "\n";

        //Enregistrement du site
        $last_site = $rows_fta["libelle_site_agis"];
    }
    $sujetmail = "FTA/Validation: " . $subject;
    $text.= "\n"
            . "Ces Articles sont maintenant disponibles et à jour dans l'ensemble de notre système informatique\n"
            . "\n"
            . "Bonne journée.\n"
            . "Intranet - FTA\n"
            . "\n"
            . "\n"
            . "NB : une ligne d'article est composée du code Agrologic, du code Arcadia (entre parenthèse), du libellé et des codes des composants";

//Envoi du mail d'information
    foreach ($liste_diffusion as $mail_validation) {
//echo "test";
//print_r($mail_validation);
        $destinataire = $mail_validation["mail"];
        $liste_destinataire .=$mail_validation["prenom_nom"]
                . ": "
                . $destinataire
                . "\n"
        ;
        $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
        if ($_SESSION["notification_suivi_projet"]) {
            envoismail($sujetmail, $text, $destinataire, $expediteur);
            //echo "envoismail($sujetmail,$text,$destinataire,$expediteur)";
        }
    }

//Envoi du mail de contrôle
    $sujetmail = "FTA/Information \"" . $subject;
    $corp = "DESTINATAIRES:\n"
            . $liste_destinataire . "\n"
            . "\n"
            . "Message envoyé:\n"
            . "\n"
            . $text
            . "\n\n"
            . $_SESSION["log_transition"]
    ;
//if ($_SESSION["notification_suivi_projet"])
    {
        $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
        envoismail($sujetmail, $corp, $_SESSION["mail_user"], $expediteur);
        //echo "envoismail($sujetmail,$corp,".$_SESSION["mail_user"].",".$_SESSION["login"].")";
    }
}

//Envoi un mail d'information détaillé (pour une FTA uniquement)
function BuildEnvoiMailDetail($id_fta, $liste_diffusion, $commentaire) {

//Déclaration des variables
    $liste_diffusion; //Tableau contenant les adresses emails et les nom des destinataires
    //$liste_diffusion["mail"]: Adresse email
    //$liste_diffusion["prenom_nom"]: Prenom Nom
//Chargement des données
    $_SESSION["id_fta"] = $id_fta;
    mysql_table_load("fta");
    mysql_table_load("access_arti2");

//Récupération du nom du site d'assemblage
    $req = "SELECT libelle_site_agis FROM geo WHERE id_site = " . $_SESSION["Site_de_production"] . " ";
    $result_libelle_site_agis = DatabaseOperation::query($req);
    $libelle_site_agis = mysql_result($result_libelle_site_agis, 0, "libelle_site_agis");


//Récupération de la liste des produits (nomenclatures)
    /* $req = "SELECT * "
      . "FROM fta_nomenclature, annexe_agrologic_article_codification "
      . "WHERE fta_nomenclature.id_fta=".$_SESSION["id_fta"]." "
      . "AND fta_nomenclature.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
      . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
      ;
     */
    $req = "SELECT * "
            . "FROM fta_composant, annexe_agrologic_article_codification "
            . "WHERE fta_composant.id_fta=" . $_SESSION["id_fta"] . " "
            . "AND is_nomenclature_fta_composant=1 "
            . "AND fta_composant.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
            . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
    ;
    $_SESSION["log_transition"].="\n\n" . $req;
    $result_prod = DatabaseOperation::query($req);
    if (mysql_num_rows($result_prod)) {
        $text_prod = "";
        while ($rows_prod = mysql_fetch_array($result_prod)) {
            //Chargement du code de codification
            $id_annexe_agrologic_article_codification = $rows_prod["id_annexe_agrologic_article_codification"];
            mysql_table_load("annexe_agrologic_article_codification");
            $prefixe_annexe_agrologic_article_codification;
            $text_prod.= $rows_prod["prefixe_annexe_agrologic_article_codification"]
                    . $rows_prod["code_produit_agrologic_fta_nomenclature"]
                    . ", "
            ;
        }
    }//Fin de la récupération de la liste des produits
//Contenu du message d'information conernant la validation de la FTA
    $sujetmail = "FTA/Validée: \"" . $_SESSION["CODE_ARTICLE"] . " - " . $_SESSION["LIBELLE"] . "\"";
    $text = "La Fiche Technique Article \"" . $_SESSION["CODE_ARTICLE"] . " - " . $_SESSION["LIBELLE"] . "\" "
            . "vient d'être validée.\n"
            . "Cet Article est maintenant actif et disponible dans l'ensemble de notre système informatique.\n"
            . "\n"
            . "INFORMATIONS PRINCIPALES:\n"
            . mysql_field_desc("access_arti2", "Site_de_production", 0) . ": " . $libelle_site_agis . "\n"
            . "Identifiant dans Agrologic: " . $_SESSION["CODE_ARTICLE"] . "\n"
            . "\n"
            . "Listes des produits créés:\n"
            . $text_prod . "\n"
            . "\n"
            . "INFORMATIONS SUPPLEMENTAIRES:\n"
            . mysql_field_desc("access_arti2", "code_article_ldc", 0) . ": " . $_SESSION["code_article_ldc"] . "\n"
            . mysql_field_desc("access_arti2", "EAN_UVC", 0) . ": " . $_SESSION["EAN_UVC"] . "\n"
            . mysql_field_desc("access_arti2", "EAN_COLIS", 0) . ": " . $_SESSION["EAN_COLIS"] . "\n"
            . mysql_field_desc("access_arti2", "NB_UNIT_ELEM", 0) . ": " . $_SESSION["NB_UNIT_ELEM"] . "\n"
            . mysql_field_desc("access_arti2", "Poids_ELEM", 0) . ": " . $_SESSION["Poids_ELEM"] . "\n"
            . "Identifiant du Dossier Technique: " . $_SESSION["id_dossier_fta"] . "-v" . $_SESSION["id_version_dossier_fta"] . "\n"
    ;
    switch ($_SESSION["Unité_Facturation"]) {
        case 2: //Pièce
            $temp = "Pièce";
            break;
        case 3: //Kilo
            $temp = "Kilo";
            break;
    }
    $text.= mysql_field_desc("access_arti2", "Unité_Facturation", 0) . ": " . $temp . "\n"
            . mysql_field_desc("access_arti2", "Durée_de_vie", 0) . ": " . $_SESSION["Durée_de_vie"] . "\n"
            . mysql_field_desc("access_arti2", "Durée_de_vie_technique", 0) . ": " . $_SESSION["Durée_de_vie_technique"] . "\n"
            . mysql_field_desc("fta", "designation_commerciale_fta", 0) . ": " . $_SESSION["designation_commerciale_fta"] . "\n"
            . "\n"
            . "\n"
    ;
    if ($commentaire) {
        $text.= "COMMENTAIRE:\n"
                . stripslashes($commentaire)
                . "\n"
                . "\n"
        ;
    }
    $text.= "Bonne journée à tous.\n"
            . "Ce message a été envoyé automatiquement par le module Intranet - Fiche Technique Article.\n"
    ;
    $typeMail = "Validation";
//echo $text;
//Envoi du mail d'information
    foreach ($liste_diffusion as $mail_validation) {
//echo "test";
//print_r($mail_validation);
        $destinataire = $mail_validation["mail"];
        $liste_destinataire .=$mail_validation["prenom_nom"]
                . ": "
                . $destinataire
                . "\n"
        ;
        $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
        if ($_SESSION["notification_suivi_projet"]) {
            envoismail($sujetmail, $text, $destinataire, $expediteur, $typeMail);
        }
    }

//Envoi du mail de contrôle
    $sujetmail = "FTA/Information \"" . $_SESSION["CODE_ARTICLE"] . " - " . $_SESSION["LIBELLE"] . "\"";
    $corp = "DESTINATAIRES:\n"
            . $liste_destinataire . "\n"
            . "\n"
            . "Message envoyé:\n"
            . "\n"
            . $text
            . "\n"
            . "INFORMATIONS DE DEBUGGAGE:\n"
            . $_SESSION["log_transition"]
    ;
//if ($_SESSION["notification_suivi_projet"])
    {
        $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
        envoismail($sujetmail, $corp, $_SESSION["mail_user"], $expediteur, $typeMail);
    }
}

//Fin de la fonction
//Définit la liste de diffusion après la transition de "I" vers "V" d'une FTA données
function liste_diffusion_transition($id_fta) {
    /*
      Cette fonction retourne une liste d'adresse email distinctes sous la
      forme du tableau suivant:
      $return[mail]:       adresse email
      $return[prenom_nom]: prénom et nom du destinataire
     */

//Déclaration des variables
//Chargement des données Articles
    $req = "SELECT * FROM fta, access_arti2, fta_etat "
            . "WHERE fta.id_fta='" . $id_fta . "' "
            . "AND fta.id_fta=access_arti2.id_fta "      //Liaison
            . "AND fta_etat.id_fta_etat=fta.id_fta_etat "          //Liaison
    ;
    $_SESSION["log_transition"].="\n\nLISTE DIFFUSION\n" . $req;
    $r_fta = DatabaseOperation::query($req);
    $fta = mysql_fetch_array($r_fta);

//if($fta["abreviation_fta_etat"]=="V")     //Condition necessaire pour effectuer la liste de diffusion
    {

        $fta["liste_chapitre_maj_fta"];    //Liste des chapitres ayant été coché pour effectuer la mise à jour de la fta
        $ok = 0;

        if ($fta["liste_chapitre_maj_fta"]) {
            //Détermination des chapitres du processus Initiateur du cycle de vie "I"
            $req = "SELECT DISTINCT id_fta_chapitre "
                    //. ", precedent.id_next_fta_processus "
                    //. ", precedent.id_etat_fta_processus_cycle "
                    //. ", fta_processus_cycle.* "
                    . "FROM fta_processus_cycle LEFT JOIN fta_processus_cycle as precedent "
                    . "ON precedent.id_next_fta_processus=fta_processus_cycle.id_init_fta_processus "
                    . ", fta_chapitre "
                    . "WHERE precedent.id_next_fta_processus IS NULL "
                    . "AND fta_processus_cycle.id_etat_fta_processus_cycle='I' "
                    //. "AND precedent.id_etat_fta_processus_cycle='I' "
                    . "AND fta_chapitre.id_fta_processus=fta_processus_cycle.id_init_fta_processus "
            ;
            $_SESSION["log_transition"].="\n\n" . $req;
            $r_id_chapitre_initiateur = DatabaseOperation::query($req);

            //L'un des chapitres initiateurs est-il dans la liste des chapitres mis à jour sur la fta ?
            while ($r_initiateur = mysql_fetch_array($r_id_chapitre_initiateur)) {
                //echo $fta["liste_chapitre_maj_fta"]." ".$r_initiateur["id_fta_chapitre"]."<br>";
                //echo strstr($fta["liste_chapitre_maj_fta"], $r_initiateur["id_fta_chapitre"].";");
                if (strstr($fta["liste_chapitre_maj_fta"], $r_initiateur["id_fta_chapitre"] . ";")) {
                    $ok = 1;
                }
            }
        } else {
            $ok = 1; //Diffusion globale
        }

        if ($fta["id_version_dossier_fta"] == 0 or $ok == 1) {
            //Log de la diffusion globale
            $_SESSION["log_transition"].="\n\nDiffusion Globale Activée";

            //Diffusion dans le cadre d'une création (version =v0) ou processus initiateur du cycle de vie modifié
            //Ce réfère à la requête de diffusion suivante:
            $where_chapitre = "";

            //Ajout des services et sites supplémentaires liés à une diffusion globale
            $where_supplementaire = "geo.raccourci_site_agis='PF' "     //Plateforme
                    //. "OR geo.raccourci_site_agis='SGE' " //Siège
                    . "OR id_service=38  "                //Compta
                    . "OR id_service=66  "                //Approvisionnement
                    . "OR id_service=40  "                //Expédition
            ;
        } else {
            //Log de la diffusion globale
            $_SESSION["log_transition"].="\n\nDiffusion Globale Désactivée";

            //Diffusion dans le cadre d'une mise à jour (>v0)
            //N'informe que les chapitres étant à l'origine de la mise à jour. (cf. fta.liste_chapitre_maj_fta)
            //Détermination des chapitres concernés
            $tab_liste_chapitre = explode(";", $fta["liste_chapitre_maj_fta"]);
            $where_chapitre = "AND (";
            $where_chapitre_tmp = "";
            $where_chapitre_operator = "";
            foreach ($tab_liste_chapitre as $id_chapitre) {
                if ($id_chapitre) {
                    $where_chapitre_tmp.=$where_chapitre_operator . "fta_chapitre.id_fta_chapitre='" . $id_chapitre . "' ";
                    $where_chapitre_operator = "OR ";
                }
            }
            if ($where_chapitre_tmp) {
                $where_chapitre.=$where_chapitre_tmp . ") ";
            } else {
                $where_chapitre = "";
            }

            //Ajout des services et sites supplémentaires liés à une diffusion de mise à jour
            //$where_supplementaire="";
            $where_supplementaire = "id_service=66 "                    //Approvisionnement
                    . "OR id_service=40  "                //Expédition
            //. "OR geo.raccourci_site_agis='SGE' " //Siège
            //. "OR id_service=38  "                //Compta
            ;
        }


        //Récupération de la liste des services (et sites) étant intervenu sur la validation de la FTA
        //et qu'il faut donc inclure dans la liste de diffusion
        $req = "SELECT id_service, lieu_geo, MIN(multisite_fta_processus) as min_multisite_fta_processus "
                . "FROM fta_suivi_projet "
                . ", salaries "
                . ", access_materiel_service "
                . ", fta_chapitre "
                . ", fta_processus "
                . "WHERE id_fta='" . $fta["id_fta"] . "' "
                . "AND actif ='oui' "                                                   //maj 2007-08-13 sm sélection des salariés actifs uniquement
                . "AND id_user=signature_validation_suivi_projet "                      //Liaison
                . "AND id_service=K_service "                                           //Liaison
                . "AND fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "  //Liaison
                . "AND fta_chapitre.id_fta_processus=fta_processus.id_fta_processus "   //Liaison
                . $where_chapitre                                                       //Restriction dans le cas d'une mise à jour
                . "GROUP BY id_service, lieu_geo "
        ;
        $_SESSION["log_transition"].="\n\n" . $req;
        $result = DatabaseOperation::query($req);
        $where = " AND ( ";
        $where_operator = "";
        if (mysql_num_rows($result)) {
            $where = " AND ( ";
            while ($rows_service_fta = mysql_fetch_array($result)) {
                $where.= $where_operator . "(id_service='" . $rows_service_fta["id_service"] . "' ";


                //Dans le cas de processus multisite on n'intègre que les personnes du site concerné
                if ($rows_service_fta["min_multisite_fta_processus"]) {
                    $where.="AND lieu_geo='" . $rows_service_fta["lieu_geo"] . "' ) ";
                } else {
                    $where.=")";
                }
                $where_operator = "OR ";
            }
            //Ajout des services et sites supplémentaires liés à une diffusion globale
            if ($where_supplementaire) {
                $where.=$where_operator . $where_supplementaire;
            }
            $where.=")";
        } else {
            //Ne doit pas arriver !
            $where = "";
        }



//Il est impératif d'avoir une condition Where dans le requête de diffusion
//Si ce n'est pas le cas, la diffusion s'étend à l'ensemble des utiisateurs du système Intranet !
//Il est necessaire d'interdire celà.
        if ($where) {
            //Création de la liste des destinataires
            $req = "SELECT salaries.id_user, nom, prenom, mail "
                    . "FROM salaries "
                    . ", intranet_droits_acces "
                    . ", intranet_modules "
                    . ", intranet_actions "
                    . ", geo "
                    //Début Droits d'accès de diffusion
                    . "WHERE `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "                                    //Liaison
                    . "AND `salaries`.`actif` ='oui' "                                                                     //maj 2007-08-13 sm sélection des salariés actifs uniquement         . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "      //Liaison
                    . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "      //Liaison
                    . "AND `intranet_actions`.`nom_intranet_actions` = 'diffusion' "                                       //Droits de diffusion
                    . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` = 1 "                                    //Droits de diffusion
                    . "AND `intranet_modules`.`nom_intranet_modules` = 'fta' "                                             //Module FTA
                    . "AND `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` "      //Lien entre le module et les droits
                    . "AND geo.id_geo=salaries.lieu_geo "
                    //Début Droits d'accès de diffusion
                    . $where                                  //Restriction au niveau du service et site de rattachement
            ;
            $_SESSION["log_transition"].="\n\n" . $req . "\nFIN DIFFUSION";
            $r_liste_destinataire = DatabaseOperation::query($req);
            while ($rows_destinataire = mysql_fetch_array($r_liste_destinataire)) {
                $return[$rows_destinataire["id_user"]]["mail"] = $rows_destinataire["mail"];
                $return[$rows_destinataire["id_user"]]["prenom_nom"] = $rows_destinataire["nom"] . " " . $rows_destinataire["prenom"];
            }
        } else {
            //Erreur critique, risque de diffusion généralisée à l'ensemble de l'Intranet
            $titre = "Erreur critique dans la liste de diffusion";
            $message = "L'ensemble des utilisateurs de l'Intranet était visé par cette diffusion.<br>"
                    . "L'envoi des mails d'information vient d'être avorté mais"
                    . "Le reste du traitement continue.<br><br>"
                    . "<pre>"
                    . $_SESSION["log_transition"]
                    . "</pre>"
            ;
            $redirection = "";
            afficher_message($titre, $message, $redirection);
            $return = 0;
        }
        return $return;
    }//Fin de la vérification que la FTA est bien validé
}

//Fin de la fonction
//Fonction transitant une fiche vers un etat donné
function transition_fta($id_fta, $abreviation_fta_transition, $commentaire_maj_fta) {
//Codes de retour de la fonction:
    /*
      0: FTA correctement transitée
      1: FTA non transité car risque de doublon
      3: Erreur autre
     */
    $return = 0;

//Chargement de l'enregistrement
    $_SESSION["id_fta"] = $id_fta;
    mysql_table_load("fta");
    mysql_table_load("access_arti2");
    mysql_table_load("fta_etat");
    $initial_abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];

//Préparation des données
    $new_commentaire_maj_fta = $commentaire_maj_fta;
    $nouveau_maj_fta = "\n\n"
            . "==============================\n"
            . "==============================\n"
            . "Date: " . date('Y-m-d') . "\n"
            . "Login du modificateur: " . $_SESSION["login"] . "\n\n"
            . $new_commentaire_maj_fta
            . $_SESSION["commentaire_maj_fta"]
    ;
//$_SESSION["commentaire_maj_fta"]=$nouveau_maj_fta;

    /*     * *****************************************************************************
      Pré-traitement spécifique
     * ***************************************************************************** */
    switch (TRUE) {
        case $abreviation_fta_transition == 'V': //Passer en Validée
            //Retirer les versions obsolètes
            $req = "UPDATE fta SET id_fta_etat='6' " //Identifiant de "retirer"
                    . "WHERE id_dossier_fta='" . $_SESSION["id_dossier_fta"] . "' "
            ;
            $result = DatabaseOperation::query($req);

            //Mise à jour de la date de validation
            $_SESSION["date_derniere_maj_fta"] = date('Y-m-d');

            //Dans le cas de FTA de type "KIT PLV"
            if ($_SESSION["id_fta_categorie"] == 2) {
                //champ NB UV PAR US1 = vide
                //$_SESSION["NB_UV_PAR_US1"]=NULL;
                //champ unité_facturation = vide
                //$_SESSION["Unité_Facturation"]=NULL;
                //champ FAMILLE BUDGET = vide
                //$_SESSION["FAMILLE_BUDGET"]=NULL;
                $req = "UPDATE access_arti2 "
                        . "SET NB_UV_PAR_US1=NULL "
                        . ", Unité_Facturation=NULL "
                        . ", FAMILLE_BUDGET=NULL "
                        . "WHERE id_fta='" . $_SESSION["id_fta"] . "' "
                ;
                $result = DatabaseOperation::query($req);
            }

            //Suppression du vérrou pour qu'on puisse à nouveau modifier cette fiche - DEBUGGER
            //$verrou_transite_fta=0;
            //Pas de commentaire pour une validation
            $nouveau_maj_fta = "";

            break;

        case $abreviation_fta_transition == 'I': //Passer en Initialisation
        case $abreviation_fta_transition == 'M': //Passer en Mise à jour
        case $abreviation_fta_transition == 'T': //Passer en mise à jour du Tarif
        case $abreviation_fta_transition == 'P': //Passer en Fiche Présentation
            //Vérification que le dossier n'a pas une fiche déjà en Mise à jour
            $req = "SELECT id_fta FROM fta, fta_etat "
                    . "WHERE id_dossier_fta=" . $_SESSION["id_dossier_fta"] . " "
                    . "AND fta.id_fta_etat=fta_etat.id_fta_etat "    //Liaison
                    . "AND (abreviation_fta_etat<>'V' "
                    . "AND abreviation_fta_etat<>'R' "
                    . "AND abreviation_fta_etat<>'P' "
                    . "AND abreviation_fta_etat<>'A' ) "
            ;
            $verrou = mysql_num_rows(DatabaseOperation::query($req));
            if ($verrou and ! $_SESSION["mode_debug"]) {
                $titre = "Action vérrouillée";
                $message = "Cette fiche est déjà en cours de modification.";
                $redirection = "";
                $erreur = 1;
                afficher_message($titre, $message, $redirection);
                $return = 1;
                return $return;
                exit;
            }

            //Dans le cas d'une mise à jour, récupération des Chapitres à corriger.
            //$req = "SELECT * FROM fta_chapitre ORDER BY nom_usuel_fta_chapitre";
            $req = "SELECT * FROM fta_chapitre ORDER BY nom_usuel_fta_chapitre";
            $result = DatabaseOperation::query($req);
            $liste_chapitre_maj_fta = ";";
            while ($rows_chapitre = mysql_fetch_array($result)) {//Parcours des chapitres
                //Si le chapitre a été sélectionné, on l'enregistre dans le tableau de résultat
                $current_chapter_name = "nom_fta_chapitre-" . $rows_chapitre["id_fta_chapitre"];
                $current_chapter_value = Lib::isDefined($current_chapter_name);
                if ($current_chapter_value == 1) {
                    //echo $rows_chapitre["id_fta_chapitre"]."<br>";
                    $selection_chapitre[] = $rows_chapitre["id_fta_chapitre"];
                    $liste_chapitre_maj_fta.=$rows_chapitre["id_fta_chapitre"] . ";";
                }
            }

            // Retirer la FTA de présentation avant de créer la nouvelle version en modification.
            if ($initial_abreviation_fta_etat == 'P') {
                //Retirer la version de présentation
                $req = "UPDATE fta SET id_fta_etat='6' " //Identifiant de "retirer"
                        . "WHERE id_fta='" . $_SESSION["id_fta"] . "' "
                ;
                $result = DatabaseOperation::query($req);
            }

            //Duplication de la fiche
            $id_fta_original = $_SESSION["id_fta"];
            $action_duplication = "version";
            $option_duplication["abreviation_etat_destination"] = $abreviation_fta_transition;
            $option_duplication["selection_chapitre"] = $selection_chapitre;
            $option_duplication["nouveau_maj_fta"] = $nouveau_maj_fta;
            $id_fta_new = duplication_fta($id_fta_original, $action_duplication, $option_duplication);
            $_SESSION["id_fta"] = $id_fta_new;
            //$_SESSION["commentaire_maj_fta"]=$nouveau_maj_fta;
            break;

        default;
            //$_SESSION["commentaire_maj_fta"]=$nouveau_maj_fta;
            break;
    }//Fin Pré-traitement spécifique

    /*     * *****************************************************************************
      Traitement Commun
     * ***************************************************************************** */

    //Récupération du nouvel état de la fiche
    $req = "SELECT id_fta_etat FROM fta_etat "
            . "WHERE abreviation_fta_etat='$abreviation_fta_transition'"
    ;
    $result = DatabaseOperation::query($req);
    $_SESSION["commentaire_maj_fta"] = $nouveau_maj_fta;
    $_SESSION["id_fta_etat"] = mysql_result($result, 0);
    $_SESSION["signature_validation_fta"] = $_SESSION["id_user"];
    mysql_table_operation("fta", "update");
    mysql_table_load("fta");
    //Fin Traitement Commun

    /*     * *****************************************************************************
      Post-traitement
     * ***************************************************************************** */

    switch ($abreviation_fta_transition) {
        case 'M':
        case 'I':
        case 'T':
            //Enregistrement des chapitres concernés par la mise à jour
            $req = "UPDATE fta "
                    . "SET liste_chapitre_maj_fta='" . $liste_chapitre_maj_fta . "' "
                    . "WHERE id_fta='" . $_SESSION["id_fta"] . "' "
            ;
            DatabaseOperation::query($req);

            break;

        case 'V':

            //Désactivation de l'ancien Code Article Agrologic
            $req = "UPDATE access_arti2 "
                    . "SET CODE_ARTICLE=NULL "
                    . "WHERE CODE_ARTICLE='" . $_SESSION["id_article_agrologic"] . "' "
            ;
            DatabaseOperation::query($req);

            //Activation du nouvel Article
            $req = "UPDATE access_arti2 "
                    . "SET CODE_ARTICLE='" . $_SESSION["id_article_agrologic"] . "', actif='-1' "
                    . "WHERE id_fta='" . $_SESSION["id_fta"] . "' "
            ;
            DatabaseOperation::query($req);

            //Chargement de l'enregistrement access_arti2
            mysql_table_load("access_arti2");

            break;

        case 'A':
        case 'R':

            $_SESSION["actif"] = "0";
            mysql_table_operation("access_arti2", "update");

            break;
    }
    //Fin Post-traitement
    //Redirection
    /* if(!$erreur)
      {
      if($open_erpdatasync)
      {
      header ("Location: open_erpdatasync.php?open_erpdatasync=$open_erpdatasync");
      }
      else
      {
      header ("Location: index.php");
      }
      } */

    return $return;
}

//Fin de la fonction




/*
  Cette fonction indique si l'utilisateur gère a un moment du cycle de vie de la FTA ce site d'assemblage
 */

function gestion_site($id_salaries, $id_site) {
    //Initialisation des variables
    $return = 0;

    //Consultation du site de rattachement

    $req = "SELECT id_geo FROM geo WHERE id_site='" . $id_site . "' ";
    $result_id_geo = DatabaseOperation::query($req);
    $id_geo = mysql_result($result_id_geo, 0, "id_geo");

    $req = "SELECT lieu_geo FROM salaries WHERE id_user='" . $id_salaries . "' ";
    $result_lieu_geo = DatabaseOperation::query($req);
    $lieu_geo = mysql_result($result_lieu_geo, 0, "lieu_geo");

    if ($id_geo == $lieu_geo) {
        $return = 1;
    } else {
        //Consultation des sites de processus multisite
        //Parcours de tous les processus sur lequel l'utilisateurs a les doits
        $req = "SELECT `intranet_droits_acces`.*, `intranet_droits_acces`.*, `intranet_droits_acces`.*, "
                . "`fta_processus_multisite`.`id_site_assemblage_fta_processus_multisite` "
                . "FROM `intranet_actions`, `fta_processus`, `intranet_droits_acces`, `fta_processus_multisite` "
                . "WHERE ( `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "
                . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "
                . "AND `fta_processus_multisite`.`id_processus_fta_processus_multisite` = `fta_processus`.`id_fta_processus` ) "
                . "AND ( ( `fta_processus`.`multisite_fta_processus` = 1 "   //Processus multisite
                . "AND `intranet_droits_acces`.`id_intranet_modules` = 19 "  //Module FTA
                . "AND `intranet_droits_acces`.`id_user` = '" . $id_salaries . "' "
                . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 "
                . "AND `fta_processus_multisite`.`id_site_assemblage_fta_processus_multisite` = '" . $id_site . "' ) )"
        ;
        $result_processus = DatabaseOperation::query($req);
        if (mysql_num_rows($result_processus)) {
            $return = 1;
        }
    }

    return $return;
}

/* * ********************
  Correction d'une FTA
 * ******************** */

//Pour une FTA données, correction d'un chapitre et dévalidation des processus suivants
function correction_chapitre($id_fta, $id_fta_chapitre, $option) {
    $option["no_message_ecran"];                       //0=affichage à l'ecran, 1=rien
    $option["correction_fta_suivi_projet"];            //Commentaire justifiant la correction du chapitre
    //Chargement des données
    $_SESSION["id_fta"] = $id_fta;
    $_SESSION["id_fta_chapitre"] = $id_fta_chapitre;
    mysql_table_load("fta");
    mysql_table_load("fta_etat");     //Récupération de $_SESSION["abreviation_fta_etat"];
    mysql_table_load("fta_chapitre"); //Récupération de $_SESSION["id_fta_processus"]
    $req = "SELECT correction_fta_suivi_projet FROM fta_suivi_projet "
            . "WHERE id_fta=" . $_SESSION["id_fta"] . " AND id_fta_chapitre=" . $id_fta_chapitre . " "
    ;
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        $current_correction_fta_suivi_projet = mysql_result($result, 0, "correction_fta_suivi_projet");
    }
    //Intégration du commentaire de la correction
    $new_correction_fta_suivi_projet.= $current_correction_fta_suivi_projet . "\n\n" . date("Y-m-d") . ": "
            . $_SESSION["prenom"] . " " . $_SESSION["nom"] . ": "
            . $option["correction_fta_suivi_projet"]
    ;
    $new_correction_fta_suivi_projet = mysql_real_escape_string($new_correction_fta_suivi_projet);

    //Dévalidation du chapitre en cours
    $req = "UPDATE fta_suivi_projet SET signature_validation_suivi_projet=0, correction_fta_suivi_projet=\"" . $new_correction_fta_suivi_projet . "\" "
            . "WHERE id_fta=" . $_SESSION["id_fta"] . " AND id_fta_chapitre=" . $id_fta_chapitre . " "
    ;
    DatabaseOperation::query($req);

    //Mise à jour de la validation de l'échéance du processus
    $id_fta = $_SESSION["id_fta"];
    $id_fta_processus = $_SESSION["id_fta_processus"];
    BuildFtaProcessusValidationDelai($id_fta, $id_fta_processus);


    //Dévalidation des processus suivants
    $return = devalidation_chapitre($_SESSION["id_fta"], $_SESSION["id_fta_processus"]);
    //print_r($return["mail"]);      //Tableau contenant les adresses emails des personnes concernées par la dévalidation
    $return["processus"]; //Tableau contenant les identifiants des processus dévalidés
    //Informations
    if ($return) {
        foreach ($return["processus"] as $id_fta_processus) {
            $_SESSION["id_fta_processus"] = $id_fta_processus;
            mysql_table_load("fta_processus");
            $message.=$_SESSION["nom_fta_processus"] . "<br>";
        }
        if (!$message) {
            $message = "Aucun processus n'a été dévalidé.";
        }
        $titre = "Liste des Processus dévalidés";
        if (!$option["no_message_ecran"]) {
            afficher_message($titre, $message, $redirection);
        }

        //Envoi des mails
        $show_din = show_din($_SESSION["id_fta"]);
        $name = $show_din;

        foreach ($return["mail"] as $mail) {
            $sujetmail = "FTA/Correction: $name";
            $destinataire = $mail;
            $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
            $text = "Vos chapitres viennent d'être dévalidés suite à une correction apportée par "
                    . $_SESSION["prenom"]
                    . " "
                    . $_SESSION["nom_famille_ses"] . ".\n\n"
                    . "OBJET DE LA CORRECTION:\n"
                    . "\t" . stripslashes($option["correction_fta_suivi_projet"])
            ;
            $typeMail = "Correction";
            if ($_SESSION["notification_suivi_projet"]) {
                envoismail($sujetmail, $text, $destinataire, $expediteur, $typeMail);
            }
        }
    }//Fin du traitement des processus suivants
    return 1;
}

//Renvoi la valeur en kilogramme du poids net colis
function calcul_poids_net_colis($id_fta) {
    //Définition des variables
    $poids_net_colis = 0;    //Poids net du colis en gramme
    //Corps de la fonction
    //$req = "SELECT * FROM fta_composition WHERE id_fta='".$id_fta."' ";
    $req = "SELECT quantite_fta_composition,poids_fta_composition FROM fta_composant WHERE id_fta='" . $id_fta . "' AND is_composition_fta_composant=1 ";
    $arrayComposition = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    foreach ($arrayComposition as $rows) {
        $poids_net_colis = $poids_net_colis + ($rows["quantite_fta_composition"] * $rows["poids_fta_composition"]);
    }
    $poids_net_colis = $poids_net_colis / 1000; //Conversion en g --> Kg
    if (!$poids_net_colis) {
        $req = "SELECT Poids_ELEM,NB_UNIT_ELEM FROM fta WHERE id_fta='" . $id_fta . "' ";
        $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        foreach ($arrayFta as $rows) {
            $Poids_ELEM = $rows["Poids_ELEM"];
            $NB_UNIT_ELEM = $rows["NB_UNIT_ELEM"];
        }
        $poids_net_colis = $Poids_ELEM * $NB_UNIT_ELEM;
    }
    return $poids_net_colis;
}

function calcul_NB_UV_PAR_US1($id_fta) {
    //Cette fonction permet de calculer la vaelur de NB_UV_PAR_US1
//NB_UV_PAR_US1
    $req = "SELECT * FROM access_arti2 WHERE id_fta='" . $id_fta . "' ";
    $result = DatabaseOperation::query($req);
    $Unite_Facturation = mysql_result($result, 0, "Unite_Facturation");
    $NB_UNIT_ELEM = mysql_result($result, 0, "NB_UNIT_ELEM");
    $Poids_ELEM = mysql_result($result, 0, "Poids_ELEM");

//Determination de NB_UV_PAR_US1
    if ($Unite_Facturation) {
        switch ($Unite_Facturation) {
            case 2:
                $NB_UV_PAR_US1 = $NB_UNIT_ELEM;
                break;
            case 3:
                $NB_UV_PAR_US1 = $Poids_ELEM * $NB_UNIT_ELEM;
                break;
        }

//Mise à jour des valeurs
        $req = "UPDATE access_arti2 SET NB_UV_PAR_US1='" . $NB_UV_PAR_US1 . "'  WHERE id_fta='" . $id_fta . "' ";
        DatabaseOperation::query($req);

        return $NB_UV_PAR_US1;
    }
}

//Fin de la fonction

/*
  Dévalidation des chapitres des processus suivants
  Retourne un tableau contenant les adresses email pour l'information de la dévalidation
 */

function devalidation_chapitre($id_fta, $id_fta_processus) {
    //Déclarion des variables
    $return["mail"];        //Tableau contenant les adresses email des utilisateurs concerné par la dévalidation.
    $return["processus"];   //Tableau contenant la liste des identifiants des processus dévalidés
    //Récupération des données
    $req = "SELECT * FROM fta WHERE id_fta='" . $id_fta . "' ";
    $result_fta = DatabaseOperation::query($req);
    $id_fta_etat = mysql_result($result_fta, 0, "id_fta_etat");

    $req = "SELECT * FROM fta_etat WHERE id_fta_etat='" . $id_fta_etat . "' ";
    $result_fta = DatabaseOperation::query($req);
    $abreviation_fta_etat = mysql_result($result_fta, 0, "abreviation_fta_etat");

    //Dénotification des chapitres en cours
    $req = "UPDATE `fta_chapitre`, `fta_suivi_projet` "
            . "SET notification_fta_suivi_projet=0 "
            . "WHERE ( `fta_chapitre`.`id_fta_chapitre` = `fta_suivi_projet`.`id_fta_chapitre` ) "
            . "AND ( ( `fta_chapitre`.`id_fta_processus` = '" . $id_fta_processus . "' "
            . "AND `fta_suivi_projet`.`id_fta` = '" . $id_fta . "' ) )"
    ;
    DatabaseOperation::query($req);

    //Recherches des processus suivants
    $req = "SELECT * FROM fta_processus_cycle, fta_processus "
            . "WHERE id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' "
            . "AND fta_processus.id_fta_processus=fta_processus_cycle.id_next_fta_processus "
            . "AND id_init_fta_processus='" . $id_fta_processus . "' "
            . "AND id_next_fta_processus IS NOT NULL"
    ;
    $result_fta_processus_cycle = DatabaseOperation::query($req);

    //Parcour des processus suivants
    while ($rows = mysql_fetch_array($result_fta_processus_cycle)) {
        //Recherche et Dévalidation des chapitres dans le suivi de projet
        $id_fta_processus = $rows["id_next_fta_processus"];
        $multisite_fta_processus = $rows["multisite_fta_processus"];
        $req = "UPDATE `fta_chapitre`, `fta_suivi_projet` "
                . "SET signature_validation_suivi_projet=0 "
                . "WHERE ( `fta_chapitre`.`id_fta_chapitre` = `fta_suivi_projet`.`id_fta_chapitre` ) "
                . "AND ( ( `fta_chapitre`.`id_fta_processus` = '" . $id_fta_processus . "' "
                . "AND `fta_suivi_projet`.`id_fta` = '" . $id_fta . "' ) )"
        ;
        DatabaseOperation::query($req);

        if (mysql_affected_rows()) { //Si le processus a été dévalidé, alors on informe
            //Dénotification
            $req = "UPDATE `fta_chapitre`, `fta_suivi_projet` "
                    . "SET notification_fta_suivi_projet=0 "
                    . "WHERE ( `fta_chapitre`.`id_fta_chapitre` = `fta_suivi_projet`.`id_fta_chapitre` ) "
                    . "AND ( ( `fta_chapitre`.`id_fta_processus` = '" . $id_fta_processus . "' "
                    . "AND `fta_suivi_projet`.`id_fta` = '" . $id_fta . "' ) )"
            ;
            DatabaseOperation::query($req);
            //Enregistrement du processus
            $return["processus"][] = $id_fta_processus;
            //echo "Dévalidation FTA n°".$id_fta." / Processus n°".$id_fta_processus."... OK.<br>";
            //Récupération de l'adresse mail de la dévalidation du processus (en fonction d'un processus multisite)
            switch ($multisite_fta_processus) { //Récuparation des adresses emails
                case 0: //Processus centralisé
                    $req = "SELECT `mail` "
                            . "FROM `intranet_actions`, `fta_processus`, `intranet_droits_acces`, `salaries`, `fta_chapitre`, `fta_suivi_projet` "
                            . "WHERE ( `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "       //Liaison
                            . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "   //Liaison
                            . "AND `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "                                   //Liaison
                            . "AND `fta_chapitre`.`id_fta_processus` = `fta_processus`.`id_fta_processus` "                     //Liaison
                            . "AND `fta_suivi_projet`.`id_fta_chapitre` = `fta_chapitre`.`id_fta_chapitre` ) "                  //Liaison
                            . "AND ( ( `fta_processus`.`id_fta_processus` = '" . $id_fta_processus . "' "
                            . "AND `fta_processus`.`multisite_fta_processus` = '" . $multisite_fta_processus . "' "
                            . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` = 1 "
                            . "AND `fta_suivi_projet`.`id_fta` = '" . $id_fta . "' ) ) "
                            . "GROUP BY `salaries`.`mail`"
                    ;
                    break;

                case 1: //Processus multisite
                    $req = "SELECT `mail` "
                            . "FROM `intranet_actions`, `fta_processus`, `intranet_droits_acces`, "
                            . " `salaries`, `fta_chapitre`, `fta_suivi_projet`, `fta`, `access_arti2`, `geo` "
                            . "WHERE ( `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "
                            . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "
                            . "AND `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "
                            . "AND `fta_chapitre`.`id_fta_processus` = `fta_processus`.`id_fta_processus` "
                            . "AND `fta_suivi_projet`.`id_fta_chapitre` = `fta_chapitre`.`id_fta_chapitre` "
                            . "AND `fta`.`id_fta` = `fta_suivi_projet`.`id_fta` "
                            . "AND `fta`.`id_fta` = `access_arti2`.`id_fta` "
                            . "AND `geo`.`id_site_agis` = `access_arti2`.`Site_de_production` "
                            . "AND `salaries`.`lieu_geo` = `geo`.`id_geo` ) "
                            . "AND ( ( `fta_processus`.`id_fta_processus` = '" . $id_fta_processus . "' "
                            . "AND `fta_processus`.`multisite_fta_processus` = '" . $multisite_fta_processus . "' "
                            . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` = 1 "
                            . "AND `fta_suivi_projet`.`id_fta` = '" . $id_fta . "' ) ) "
                            . "GROUP BY `salaries`.`mail`"
                    ;
                    break;
            }
            //echo $req."<br>";
            $result_mail = DatabaseOperation::query($req);
            if (mysql_num_rows($result_mail)) {
                while ($rows_mail = mysql_fetch_array($result_mail)) {
                    $return["mail"][] = $rows_mail["mail"];
                }
            }
        }//Fin de l'information de la dévalidation
        //Mise à jour de la validation de l'échéance du processus
        $id_fta;
        $id_fta_processus;
        BuildFtaProcessusValidationDelai($id_fta, $id_fta_processus);

        //Appel récursif de la fonction pour continuer à dévalider les processus suivants
        $sub_return = devalidation_chapitre($id_fta, $id_fta_processus);

        //Fusion du tableaux de résultat contenant la liste des adresses email
        if ($sub_return != NULL) {
            $return = array_merge_recursive($return, $sub_return);
            $return["mail"] = array_unique(array_merge_recursive($return["mail"], $sub_return["mail"]));
            $return["processus"] = array_unique(array_merge_recursive($return["processus"], $sub_return["processus"]));
        }
        //print_r($return["mail"]);
    }

    //Retour de la fonction
    return $return;
}

/*
  Cette fonction retourne le nom DIN, Désignation Interne Normalisée d'une FTA
 */

function show_din($id_fta) {

//Déclaration des variables
    $_SESSION["id_fta"] = $id_fta;
    $error = 0;                    //On part du principe qu'il n'y a pas pour l'instant d'erreur
//Chargement des données
    mysql_table_load("fta");
    mysql_table_load("access_arti2");


//Règle d'intégrité
    $din = "";

//Code
    if ($_SESSION["id_article_agrologic"]) {
        $din.= $_SESSION["id_article_agrologic"];
    } else {
        $din.= $_SESSION["id_dossier_fta"] . "v" . $_SESSION["id_version_dossier_fta"];
    }

    $din.=" - ";

//Désignation
    if (!$_SESSION["LIBELLE"]) {
        //Il manque des informaions necessaires à la construction du DIN
        $din.= $_SESSION["designation_commerciale_fta"];
    } else {
        //DIN - Désignation Interne Normalisée
        $din.= $_SESSION["LIBELLE"];
    }

    return $din;
}

/*
  Cette fonction permet de dupliquer une Fiche Technique Article pour faire les actions suivantes:

  $action
  -------
  "totale":       Créer un nouveau dossier en recopiant l'intégralité de la fiche d'origine
  "selective":(pas géré)    Créer un nouveau dossier en ne recopiant que certains processus
  "version":      Créer une nouvelle fiche au sein du même dossier

  $option:
  --------
  - Dans le cas d'une duplication "selective", cette variable contient le tableau des id_processus des processus sélectionnés
  - Dans le cas d'une duplication "version", cette variable contient le nouvel état de la FTA (I, A, ...).
  Si vide, alors l'état par défaut sera de type I, initialisation

  Retour de la fonction:
  ----------------------
  La fonction renvoi l'id_fta nouvellement créé.

 */

function duplication_fta($id_fta, $action, $option) {

    /*     * ****************************************
      Déclaration et initialisation des variables
     * **************************************** */

    $_SESSION['id_fta'] = $id_fta;              //Identifiant de la fiche technique article à dupliquer
    $id_fta_original = $id_fta;                //Sauvegarde de la clef initiale.
    $option["abreviation_etat_destination"]; //Etat vers lequel doit aller la FTA
    $option["selection_chapitre"];           //Tableau contenant les id_fta_chapitre des chapitres à corriger
    $option["designation_commerciale_fta"];  //Nouveau nom commerciale de la FTA
    $option["nouveau_maj_fta"];              //Nouveau commentaire de la nouvelle FTA
//print_r($option["selection_chapitre"]);

    switch ($action) {
        case "version":

            //récupération de l'identifiant de l'état
            if ($option["abreviation_etat_destination"] == "") {
                //Si aucun Etat n'a été donné, l'état   Intialisation est choisi par défaut
                $option["abreviation_etat_destination"] = "I";
            }
            $req = "SELECT id_fta_etat FROM fta_etat WHERE abreviation_fta_etat='" . $option["abreviation_etat_destination"] . "'";
            $result = DatabaseOperation::query($req);
            $id_fta_etat_new = mysql_result($result, 0, "id_fta_etat");
    }

    /*     * *****************************************************************************
      Traitement Principal
     * ****************************************************************************** */



    /*     * *************************
      Traitement de la table "fta"
     * ************************* */

    //Restauration de la clef initiale.
    $_SESSION['id_fta'] = $id_fta_original;                  //Restauration de la clef initiale.
    //Copie de l'enregistrement
    $nom_table = 'fta';                                   //Identification de la table
    $nom_clef = 'id_' . $nom_table;                         //Identifiacation de la clef
    $_SESSION[$nom_clef] = $$nom_clef;                       //Chargement de la clef
    mysql_table_load($nom_table);                         //Chargement de l'enregistrement
    $return = mysql_table_operation($nom_table, 'copy');     //Duplication de l'enregsitrement
    $key_new = substr(strchr($return, "="), 1);             //Récupération de la nouvelle clef
    $id_fta_new = $key_new;                                 //Sauvegarde de la clef de la nouvelle FTA
    //Mise à jour du nouvel enregistrement
    $_SESSION[$nom_clef] = $key_new;                         //Chargement de la nouvelle clef
    mysql_table_load($nom_table);                         //Chargement de l'enregistrement
    //$_SESSION["id_access_arti2"]=$id_access_arti2_new; //Affectation du nouvel enregsitrement access_arti2
    $_SESSION["date_echeance_fta"] = "";                 //La date d'échéance sera à redéfinir
    switch ($action) {                                   //Suivant l'action, certaines données sont à mettre à jour
        case "totale":                                //Création d'un nouveau dossier
            $_SESSION["id_dossier_fta"] = $_SESSION[$nom_clef];         //Dans le cas d'un nouveau dossier, son identifiant correspond à l'identifiant de sa première FTA
            $_SESSION["id_version_dossier_fta"] = 0;                   //La première FTA commence en version "0"
            $_SESSION["id_fta_etat"] = 1;                              //La première FTA commence en état "Initialisation"  (cf. table fta_etat)
            $_SESSION["id_article_agrologic"] = 0;
            $_SESSION["designation_commerciale_fta"] = $option["designation_commerciale_fta"]; //Renommage de la nouvelle FTA
            $_SESSION["nom_abrege_fta"];                              //Le nom abrégé est réinitilisé

            break;
        case "version":                                //Création d'une nouvelle version de la FTA
            $_SESSION["id_version_dossier_fta"] ++;                   //La première FTA commence en version "0"
            $_SESSION["id_fta_etat"] = $id_fta_etat_new;               //Nouvel éta de la FTA données par l'argument $option de la fonction (cf. table fta_etat)
            break;
    }
    $_SESSION["createur_fta"] = $_SESSION["id_user"];

    //Enregsitrement des mises à jour
    mysql_table_operation($nom_table, 'update');



    /*     * **********************************
      Traitement de la table "access_arti2"
     * ********************************** */

    //Récupération de la clef access_arti2
    /* $req = "SELECT id_access_arti2 FROM access_arti2 WHERE id_fta=$id_fta_original";
      $result=DatabaseOperation::query($req);
      $id_access_arti2_original=mysql_result($result, 0, "id_access_arti2");
     */

    $id_access_arti2_original = $_SESSION["id_access_arti2"];

    //echo  "CODE".$id_access_arti2_original;
    //Copie de l'enregistrement
    $nom_table = 'access_arti2';                          //Identification de la table
    $nom_clef = 'id_' . $nom_table;                         //Identifiacation de la clef
    $$nom_clef = $id_access_arti2_original;                 //Chargement de la clef
    $_SESSION[$nom_clef] = $$nom_clef;
    mysql_table_load($nom_table);                         //Chargement de l'enregistrement
    //Mise à jour de l'enregistrement
    $_SESSION[$nom_clef] = "";
    $_SESSION["id_fta"] = $id_fta_new;
    $_SESSION["date_creation_access_arti2"] = date("Y-m-d");   //Date de la création de cet Article
    $_SESSION["CODE_ARTICLE"] = NULL;                          //Le Code Article Agrologic ne peut être présent 2 fois (index unique)
    $_SESSION["actif"] = "0";                                  //Tant que la fiche n'est pas activée, la flag reste à 0.

    switch ($action) {                                   //Suivant l'action, certaines données sont à mettre à jour
        case "totale":                                //Création d'un nouveau dossier
            $_SESSION["LIBELLE"] = NULL;                //Dans le cas d'un nouveau dossier, son identifiant correspond à l'identifiant de sa première FTA
            $_SESSION["code_article_ldc"] = NULL;       //Suppression Code LDC
            $_SESSION["EAN_UVC"] = NULL;                //Suppression EAN Article
            $_SESSION["EAN_COLIS"] = NULL;              //Suppression EAN Colis
            $_SESSION["EAN_PALETTE"] = NULL;            //Suppression EAN Palette

            break;
        case "version":                                //Création d'une nouvelle version de la FTA
            break;
    }

    $return = mysql_table_operation($nom_table, 'insert');   //Duplication de l'enregsitrement
    $key_new = substr(strchr($return, "="), 1);             //Récupération de la nouvelle clef
    $id_access_arti2_new = $key_new;                        //Sauvegarde de la nouvelle clef
    //Correction de l'enregistrement FTA
    $_SESSION["id_fta"] = $id_fta_new;
    mysql_table_load("fta");
    $_SESSION["id_access_arti2"] = $id_access_arti2_new;
    mysql_table_operation("fta", 'update');

    //Mise à jour du nouvel enregistrement
    /*     $_SESSION[$nom_clef]=$key_new;                         //Chargement de la nouvelle clef
      mysql_table_load($nom_table);                         //Chargement de l'enregistrement

      switch($action)                                   //Suivant l'action, certaines données sont à mettre à jour
      {
      case "totale":                                //Création d'un nouveau dossier
      case "version":
      $_SESSION["date_creation_access_arti2"]=date("Y-m-d");   //Date de la création de cet Article
      $_SESSION["CODE_ARTICLE"]="";                            //Le Code Article Agrologic ne peut être présent que lors de la validation de la FTA
      $_SESSION["actif"]="0";                                  //Tant que la fiche n'est pas activée, la flag reste à 0.
      break;
      }
     */    //Enregsitrement des mises à jour
//         mysql_table_operation($nom_table,'update');



    /*     * ***************************
      Traitement des tables esclaves
     * *************************** */

    /*     * ******************************************************************************************
      Les tables esclaves sont des tables contenant le champ "id_fta" dans la liste de leurs champs
     * ****************************************************************************************** */

    $tablename_slave = array(
        "classification_fta",
        "fta_conditionnement",
        //"fta_composition",
        //"fta_nomenclature",
        "fta_composant",
        "fta_tarif",
        "fta_suivi_projet"
    );

    foreach ($tablename_slave as $nom_table) {//Parcours des tables esclaves
        //Restauration de la clef initiale.
        $_SESSION['id_fta'] = $id_fta_original;                  //Restauration de la clef initiale.
        //Récupération des informations
        $nom_clef = 'id_' . $nom_table;                         //Identification de la clef
        $req = "SELECT * "
                . "FROM " . $nom_table . " "
                . "WHERE id_fta=" . $id_fta_original . " "
        ;
        $result = DatabaseOperation::query($req);
        /*         * *********************************************************************** Log
          if($nom_table=="fta_composition")
          {
          echo $req."<br>";
          }
         * ************************************************************************ Log */
        while ($rows_fta = mysql_fetch_array($result)) {
            /*             * *********************************************************************** Log
              if($nom_table=="fta_composition")
              {
              echo "&nbsp;&nbsp;&nbsp;CLef d'origine: ".$rows_fta[$nom_clef]." --> ";
              }
             * ************************************************************************ Log */

            //Chargement des données d'origine
            $_SESSION[$nom_clef] = $rows_fta[$nom_clef];        //Chargement de la clef d'origine
            mysql_table_load($nom_table);                    //Chargement de l'enregistrement d'origine
            $_SESSION[$nom_clef] = "";                          //Effacement de la clef de l'enregistrement pour générer un INSERT
            $_SESSION['id_fta'] = $id_fta_new;                  //Restauration de la nouvelle clef FTA.
            $_SESSION['last_' . $nom_clef] = $rows_fta[$nom_clef];
            $t = mysql_table_operation($nom_table, "insert");     //Enregistrement du nouvel enregsitrement
            /*             * *********************************************************************** Log
              if($nom_table=="fta_composition")
              {
              echo "$t<br>";
              $t="";
              }
             * ************************************************************************ Log */
        }
    }//Fin du parcours des tables esclaves
//Mise à jour des associations des composants avec leur nouvelle nomenclature
    $id_fta_new;
    $id_fta_original;

    /*
      - Récupérér les composants de la nouvelle FTA
      - Pour chaque produit (id_fta_nomenclature)
      - Récupérer l'identifiant de la version précédente (noté: [last_id_fta_nomenclature])
      - Sur la FTA précédente, retrouver l'identifiant composant associé à cette ancienne version du produit (noté: [last_id_fta_composant])
      - Sur le nouvelle FTA, retrouver l'identifiant composant associé à ce [last_id_fta_composant]
      - Sur ce nouveau composant, remplacer l'association nomenclature par [id_fta_nomenclature]
     */

    /* echo $req = "SELECT * FROM fta_nomenclature, fta_composition "
      . "WHERE fta_nomenclature.id_fta=$id_fta_new "
      . "AND fta_nomenclature.last_id_fta_nomenclature=fta_composition.id_fta_nomenclature "
      ;
     */
    /*
      $req = "UPDATE fta_nomenclature, fta_composition "
      . "SET fta_composition.id_fta_nomenclature=fta_nomenclature.id_fta_nomenclature "
      . "WHERE fta_nomenclature.id_fta=$id_fta_new "
      . "AND fta_nomenclature.last_id_fta_nomenclature=fta_composition.id_fta_nomenclature "
      ;
      $result=DatabaseOperation::query($req);
     */

    /*     * *****************************************************************************
      Traitement POST
     * ****************************************************************************** */
    switch ($action) {
        case "version":
            $new_abreviation_fta_etat = $option["abreviation_etat_destination"]; //Nouvel état
            //Récupération de la liste des chapitres a dévalider
            $selection_chapitre = $option["selection_chapitre"];
            $option["no_message_ecran"] = 1;
            foreach ($selection_chapitre as $id_fta_chapitre) {

                //Correction des chapitres
                //echo $option["correction_fta_suivi_projet"]=$_SESSION["commentaire_maj_fta"];
                //echo $option["correction_fta_suivi_projet"]=$_SESSION["nouveau_maj_fta"];
                $option["correction_fta_suivi_projet"] = $option["nouveau_maj_fta"];
                correction_chapitre($id_fta_new, $id_fta_chapitre, $option);
            }


            if ($new_abreviation_fta_etat == "I" and ! $selection_chapitre) {//Suppression des validations
                //Recherche des chapitres affectés au cycle de vie correspondant à l'état
                $req = "SELECT DISTINCT * "
                        . "FROM fta_processus_cycle, fta_chapitre  "
                        . "WHERE id_etat_fta_processus_cycle='" . $new_abreviation_fta_etat . "' "              //Etat du cycle
                        . "AND fta_chapitre.id_fta_processus=fta_processus_cycle.id_init_fta_processus "    //Jointure
                ;
                //echo $req."<br>";
                $result = DatabaseOperation::query($req);
                if (mysql_num_rows($result)) {  //Si ce cycle de vie necessite l'intervention de processus, alors                            //On supprime la validation du suivi de projet des processus concernés
                    $req = "DELETE FROM fta_suivi_projet WHERE ";
                    $or = " ";
                    while ($rows = mysql_fetch_array($result)) {

                        //Vérification qu'il ne s'agissent pas du processus initiateur du nouveau cycle de vie
                        $req_first = "SELECT id_fta_suivi_projet "
                                . "FROM fta_processus_cycle, fta_chapitre, fta_suivi_projet  "
                                . "WHERE id_etat_fta_processus_cycle='" . $new_abreviation_fta_etat . "' "              //Etat du cycle
                                . "AND fta_chapitre.id_fta_processus=fta_processus_cycle.id_init_fta_processus "    //Jointure
                                . "AND fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "              //Jointure
                                . "AND fta_suivi_projet.id_fta='" . $id_fta_new . "' "                                  //Nouvelle FTA
                                . "AND fta_processus_cycle.id_next_fta_processus='" . $rows["id_init_fta_processus"] . "' "//Est-ce le premier processus ?
                        ;
                        //echo $req_first."<br>";
                        $result_first = DatabaseOperation::query($req_first);
                        if (mysql_num_rows($result_first)) {//Si il ne s'agit pas du chapitre appartenant au processus initial, on supprime
                            $req.=$or . "(id_fta_chapitre='" . $rows["id_fta_chapitre"] . "' AND id_fta='" . $id_fta_new . "') ";
                            $or = "OR ";
                        } else {

                            //Sinon, Supprimer uniquement la validation et on notifie les chapitres
                            $req_update = "UPDATE fta_suivi_projet "
                                    . "SET signature_validation_suivi_projet='', date_validation_suivi_projet='', date_demarrage_chapitre_fta_suivi_projet='', notification_fta_suivi_projet='1' "
                                    . "WHERE (id_fta_chapitre='" . $rows["id_fta_chapitre"] . "' AND id_fta='" . $id_fta_new . "') "
                            ;
                            DatabaseOperation::query($req_update);
                            //echo     $req_update."<br>";
                        }
                    }
                    //echo $req."<br>";
                    DatabaseOperation::query($req);
                }
                //Fin de Recherche des notifications relatives aux processus trouvées
            }//Fin de la dévalidation suite à une initialisation
            //Vérrouillage des chapitre ne correspondant pas au cycle de vie.
            if ($new_abreviation_fta_etat == "P") {
                //Condition where
                $where = "";

                //Récupération des chapitres concernés par ce cycle de vie
                $req = "SELECT DISTINCT `id_init_fta_processus` "
                        . "FROM `fta_processus_cycle` "
                        //. "WHERE `id_etat_fta_processus_cycle` = '".$new_abreviation_fta_etat."' AND id_next_fta_processus IS NOT NULL"
                        . "WHERE `id_etat_fta_processus_cycle` = '" . $new_abreviation_fta_etat . "' "
                ;
                $result = DatabaseOperation::query($req);
                while ($rows = mysql_fetch_array($result)) {
                    $where .= " AND fta_processus.id_fta_processus <> " . $rows["id_init_fta_processus"] . " ";
                }

                //Récupération des chapitres à vérrouiller
                $req = "SELECT DISTINCT id_fta_chapitre "
                        . "FROM `fta_processus`, `fta_chapitre` "
                        . "WHERE ( `fta_processus`.`id_fta_processus` = `fta_chapitre`.`id_fta_processus` ) "
                        . "AND ( ( fta_processus.id_fta_processus <>1 $where ) )"
                ;
                $result = DatabaseOperation::query($req);
                while ($rows = mysql_fetch_array($result)) {
                    //Le suivi existe-il déjà ?
                    $req = "SELECT id_fta_suivi_projet, signature_validation_suivi_projet FROM fta_suivi_projet "
                            . "WHERE id_fta='" . $id_fta_new . "' AND id_fta_chapitre='" . $rows["id_fta_chapitre"] . "' "
                    ;
                    //echo "<br>".$req;
                    $result_existe = DatabaseOperation::query($req);
                    if (mysql_num_rows($result_existe)) {
                        //Mise à jour de l'existant si il n'y a pas de vérrou existant
                        if (!mysql_result($result_existe, 0, "signature_validation_suivi_projet")) {
                            $id_fta_suivi_projet = mysql_result($result_existe, 0, "id_fta_suivi_projet");
                            $rows["id_fta_chapitre"];
                            $id_fta_new;
                            $req = "UPDATE fta_suivi_projet "
                                    . "SET signature_validation_suivi_projet='-1' "
                                    . "WHERE id_fta_suivi_projet='" . $id_fta_suivi_projet . "' "
                            ;
                            DatabaseOperation::query($req);
                        }
                    } else {

                        //Création des suivi
                        $rows["id_fta_chapitre"];
                        $id_fta_new;
                        $req = "INSERT fta_suivi_projet "
                                . "SET id_fta_chapitre='" . $rows["id_fta_chapitre"] . "', "
                                . "id_fta='" . $id_fta_new . "', "
                                . "signature_validation_suivi_projet='-1' "
                        ;
                        //echo "<br>".$req;
                        DatabaseOperation::query($req);
                    }
                }
            }

            break;
//Fin du post-traitement dans le cas d'une duplication de type "version"

        case "totale":

            $new_abreviation_fta_etat = $option["abreviation_etat_destination"]; //Nouvel état
            //Suppression de tout le suivi de dossier
            $req = "DELETE FROM fta_suivi_projet "
                    . "WHERE fta_suivi_projet.id_fta='" . $id_fta_new . "' "                                  //Nouvelle FTA
            ;
            $result = DatabaseOperation::query($req);

            break;
    }//Fin du post-traitement dans le cas d'une duplication de type "totale"
    return $id_fta_new;
}

//Fin de la fonction duplication_fta()
//******************************************************************************

function notification_suivi_projet($id_fta, $paramIdChapitre) {
    /*
      Cette fonction notifie les processus en fonction de l'état d'avancement du suivi du projet.
      Cet état d'avancement est géré par la table fta_suivi_projet
      Elle ne fait que de l'information, et ne modifie pas l'état de la fiche mais uniquement son suivi
     */

    //Récupération des informations de la FTA
    $_SESSION["id_fta"] = $id_fta;
    mysql_table_load("fta");
//    mysql_table_load("access_arti2");
    mysql_table_load("fta_etat");

    //Récupération des Processus
    $req = "SELECT * FROM fta_processus ";
    $result = DatabaseOperation::query($req);
    while ($rows_processus = mysql_fetch_array($result)) {

        //Si l'utilisateur appartient au processus, il n'est pas necessaire d'informer tous son service par mail
        $req = "SELECT nom_intranet_actions "
                . "FROM intranet_actions "
                . "WHERE id_intranet_actions='" . $rows_processus["id_intranet_actions"] . "' "
        ;
        $result_action = DatabaseOperation::query($req);
        $nom_intranet_actions = mysql_result($result_action, 0, "nom_intranet_actions");

//echo      "fta_".$nom_intranet_actions.": ".$GLOBALS{"fta_".$nom_intranet_actions}."<br>";
        if ($GLOBALS{"fta_" . $nom_intranet_actions}) {
            $no_mail = 1; //Désactivation du mail pour ce processus
        } else {
            $no_mail = 0; //Activation du mail
        }


        //Ce processus est-il un processus en cours ?
        if (fta_processus_etat($id_fta, $rows_processus["id_fta_processus"]) == 2) {

            //Activation du mail
            //$no_mail=0;
            //Recherche des Notifications des chapitres
            $req = "SELECT notification_fta_suivi_projet "
                    . "FROM fta_suivi_projet, fta_chapitre, fta_processus "
                    . "WHERE (fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "          //jointure
                    . "AND `fta_processus`.`id_fta_processus` = `fta_chapitre`.`id_fta_processus` ) "  //jointure
                    . "AND fta_chapitre.id_fta_processus=" . $rows_processus["id_fta_processus"] . " "
                    . "AND fta_suivi_projet.id_fta=" . $id_fta . " "
            ;

            $result_2 = mysql_query($req);

            //L'ensemble des chapitres a-t-il été entièrement notifié ?
            // -1 = le suivi doit etre créé et le processus doit être informé
            //  0 = ce processus doit être informé
            //  1 = ce processus a déjà était informé
            if (mysql_num_rows($result_2)) {
                $notification = 1;
                while ($rows_notification = mysql_fetch_array($result_2)) {
                    $notification = $notification * $rows_notification["notification_fta_suivi_projet"];
                }
            } else {

                $notification = -1;
            }

            //Si au moins un des chapitres n'a pas été notifié ou qu'il n' y a pas encore de suivi
            if ($notification <= 0 and $rows_processus["id_fta_processus"] <> 1) {


                //Initialisation du tableau des destinataires (mail + identifiant)
                $liste_mail = "";
                $liste_user = "";

                //Si le mail reste actif, on construit la listes des utilisateurs à informer
                if (!$no_mail) {
                    //Recherche de la liste des utilisateurs à informer
                    switch ($rows_processus["multisite_fta_processus"]) {
                        case 0:
                            //1. Cas de processus mono-site
                            //-----------------------------
                            //Est-ce que seul le service du chef de projet doit être informé ?
                            if ($rows_processus["information_service_chef_projet_fta_processus"]) {

                                //Rechercher du service du chef de projet
                                $req = "SELECT `salaries`.`id_service` "
                                        . "FROM `fta_suivi_projet`,  `salaries` "
                                        . "WHERE ( `fta_suivi_projet`.`signature_validation_suivi_projet` = `salaries`.`id_user` ) "
                                        . "AND ( ( `fta_suivi_projet`.`id_fta` = " . $id_fta . " AND `fta_suivi_projet`.`id_fta_chapitre` = 1 ) ) "
                                ;
                                $result = DatabaseOperation::query($req);
                                $id_service = mysql_result($result, 0, "id_service");
                                $where = "AND salaries.id_service=" . $id_service . " ";

                                //Désactivation de l'envoi du mail dans ce cas de figure.
                                $no_mail = 1;
                            }
                            $req = "SELECT DISTINCT `salaries`.`id_user`, `salaries`.`mail`, `salaries`.`login`,`salaries`.`nom`,`salaries`.`prenom`, `fta_processus`.`id_fta_processus` "
                                    . "FROM `salaries`, `intranet_droits_acces`, `intranet_modules`, `intranet_actions`, `fta_processus` "
                                    . "WHERE ( `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "                                    //Liaison
                                    . "AND `salaries`.`actif` = 'oui' "                                                                      //maj 2007-08-13 sm                                            . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "        //Liaison
                                    . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "        //Liaison
                                    . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` ) "              //Liaison
                                    . "AND ( ( `intranet_droits_acces`.`niveau_intranet_droits_acces` <> 0 "                                 //Obtention du droit d'accès
                                    . "AND `fta_processus`.`id_fta_processus` = " . $rows_processus["id_fta_processus"] . "  "                   //Processus en cours
                                    . "AND fta_processus.multisite_fta_processus = 0 "
                                    . "AND `intranet_modules`.`nom_intranet_modules` = 'fta' ) )"
                                    . "AND salaries.id_user<>'" . $_SESSION["id_user"] . "' "
                                    . $where
                            ;

                            $result_mail = DatabaseOperation::query($req);
                            if (mysql_num_rows($result_mail)) {
                                while ($rows_mail = mysql_fetch_array($result_mail)) {

                                    //Remplissage du tableau des destinataires (mail + identifiant)
                                    $liste_mail[] = $rows_mail["mail"];
                                    $liste_user[] = "- " . $rows_mail["prenom"] . " " . $rows_mail["nom"];
                                }
                            }
                            break;

                        case 1:
                            //2. Cas de processus multi-site
                            //------------------------------
                            //Existe-t-il un processus d'un autre site qui gère ce site d'assemblage ?
                            $req = "SELECT * FROM fta_processus_multisite "
                                    . "WHERE  id_site_assemblage_fta_processus_multisite = " . $_SESSION["Site_de_production"] . " "
                                    . "AND  id_processus_fta_processus_multisite = " . $rows_processus["id_fta_processus"] . " "
                            ;
                            $result_autre_site = DatabaseOperation::query($req);
                            if (mysql_num_rows($result_autre_site)) {
                                $site_gestionnaire = mysql_result($result_autre_site, 0, "id_site_processus_fta_processus_multisite");
                            } else {

                                $site_gestionnaire = $_SESSION["Site_de_production"];
                            }
                            $req = "SELECT DISTINCT `salaries`.`id_user`, `salaries`.`mail`, `salaries`.`login`,`salaries`.`nom`,`salaries`.`prenom`, `fta_processus`.`id_fta_processus` "
                                    . "FROM `salaries`, `intranet_droits_acces`, `intranet_modules`, `intranet_actions`, `fta_processus`, geo "
                                    . "WHERE ( `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "                                    //Liaison
                                    . "AND `salaries`.`actif` = 'oui' "                                                                      //maj 2007-08-13 sm                                            . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "        //Liaison
                                    . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "        //Liaison
                                    . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "                //Liaison
                                    . "AND `geo`.`id_geo` = `salaries`.`lieu_geo`) "                                                         //Liaison
                                    . "AND ( ( `intranet_droits_acces`.`niveau_intranet_droits_acces` <> 0 "               //Obtention du droit d'accès
                                    . "AND `fta_processus`.`id_fta_processus` = " . $rows_processus["id_fta_processus"] . "  " //Processus en cours
                                    . "AND fta_processus.multisite_fta_processus = 1 "                                     //Processus Multisite
                                    . "AND `geo`.`id_site` ='" . $site_gestionnaire . "' "                                                       //Site d'assemblage
                                    . "AND `intranet_modules`.`nom_intranet_modules` = 'fta' ) )"
                                    . "AND salaries.id_user<>'" . $_SESSION["id_user"] . "' "

                            ;

                            //echo $rows_processus["multisite_fta_processus"]."<br>".$req."<br><br>";

                            $result_mail = DatabaseOperation::query($req);
                            while ($rows_mail = mysql_fetch_array($result_mail)) {

                                //Remplissage du tableau des destinataires (mail + identifiant)
                                $liste_mail[] = $rows_mail["mail"];
                                $liste_user[] = "- " . $rows_mail["prenom"] . " " . $rows_mail["nom"];
                            }
                            break;
                    }//Fin de la recherche des utilisateurs à informer
                }//Fin du controle de désactivation de mail
                //Envoi du mail de notification
                $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($id_fta, $paramIdChapitre);
                $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
                $modelFta = new FtaModel($id_fta);
                if ($liste_mail and ! $no_mail) {
                    foreach ($liste_mail as $adresse_email) {
                        $sujetmail = "FTA/" . $modelFta->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
                        $text = "Démarrage du processus: " . $rows_processus["nom_fta_processus"] . "\n"
                                . "Etat de la FTA: " . $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue() . "\n\n"
                                . "Vous pouvez consulter l'Etat d'avancenement du dossier directement sur le site http://intranet.agis.fr .\n"
                                . "\n"
                                . "Bonne journée.\n"
                                . "Intranet - Fiche Technique Article."
                        ;
                        $destinataire = $adresse_email;
                        $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
                        //if ($_SESSION["notification_fta_suivi_projet"]) {
                        if ($modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET)->getFieldValue()) {
                            envoismail($sujetmail, $text, $destinataire, $expediteur);
                        }
                    }
                }//Fin des envois de mail
                //Enregistrement de la réalisation de la notification du processus
                switch ($notification) {
                    case 0: //Mise à jour du suivi
                        $req = "UPDATE fta_chapitre, fta_suivi_projet "
                                . "SET fta_suivi_projet.notification_fta_suivi_projet=1 "
                                . "WHERE fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "
                                . "AND fta_chapitre.id_fta_processus=" . $rows_processus["id_fta_processus"] . " "
                                . "AND fta_suivi_projet.id_fta=" . $id_fta . " "
                        ;
                        DatabaseOperation::query($req);
                        break;

                    case -1: //Création du suivi
                        //Récupération des chapitres du processus
                        $req = "SELECT id_fta_chapitre FROM fta_chapitre "
                                . "WHERE id_fta_processus = '" . $rows_processus["id_fta_processus"] . "' "
                        ;
                        $result_chapitre = DatabaseOperation::query($req);
                        while ($rows_chapitre = mysql_fetch_array($result_chapitre)) {
                            $req = "INSERT fta_suivi_projet "
                                    . "SET notification_fta_suivi_projet=1 "
                                    . ", id_fta='" . $id_fta . "' "
                                    . ", id_fta_chapitre='" . $rows_chapitre["id_fta_chapitre"] . "' ";
                            ;
                            DatabaseOperation::query($req);
                        }

                        break;
                }
                //echo $req;
                //echo "<br>";
            }//Fin de la vérification par chapitre et du traitement de la notification
        }//Fin de la vérification des processus validés
    }//Fin du parcours des processsu
    //Message d'Information
    if ($liste_user) {
        $liste_user_html = implode("<br>", $liste_user);
        $titre = "Information communiquée par Mail";
        $message = "Les personnes suivantes viennent d'être informées par mail de la validation de tous vos chapitres."
                . "<br><br>" . $liste_user_html;
        afficher_message($titre, $message, $redirection);
    }


    //Retour de la fonction
    return $liste_user;
}

/* * *****************************************************************************
  Fourni la liste des identifiant des Processus en cours
  Cette liste est sous forme de tableau
 * ***************************************************************************** */

function liste_processus_encours($id_fta) {

    $tab = fta_taux_validation($id_fta);

    //La FTA a-t-elle encore des processus à valider ?
    if ($tab[0] == 1) {
        //echo "test";
        return 0;
    } else { //Parcours des processus pour connaitre ceux étant en cours
        //Chargement des données préalables
        $_SESSION["id_fta"] = $id_fta;
        mysql_table_load("fta");
        $abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];

        //Sélection des processus relatifs aux cycles de vie de l'état de la fiche
        $req = "SELECT DISTINCT id_init_fta_processus "
                . "FROM fta_processus_cycle "
                . "WHERE id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' "
        ;
        $result = DatabaseOperation::query($req);
        while ($rows = mysql_fetch_array($result)) {
            //Variables
            $id_fta_processus = $rows["id_init_fta_processus"];


            //Le processus est-il en cours ?
            if (fta_processus_etat($id_fta, $id_fta_processus) == 2) {
                $return[] = $id_fta_processus;
            }
        }//Fin du parcours des processus

        return $return;
    }//Fin du l'analyse de la FTA
}

//Fin de la fonction liste_processus_encours($id_fta)



/* * *****************************************************************************
  Utilisée pour visualiser toutes les fiches dont l'état (C, M, A)est passé en variable
 * ***************************************************************************** */

function visualiser_fiches($id_fta_etat, $choix, $isLimit, $order_common) {

//Déclaration de variables
    $largeur_html_C1 = "width=34%"; // largeur cellule type
    $largeur_html_C3 = " width=16%"; // largeur cellule type
    $compteur_ligne = 1;
    $selection_width = "1%";
    $id_fta_chapitre_encours = Lib::isDefined("id_fta_chapitre_encours");
    $javascript = Lib::isDefined("javascript");

//echo $_SESSION["id_fta"]=$id_fta;
    /*
     * Initilisation
     */
    $globalConfig = new GlobalConfig();
    UserModel::ConnexionFalse($globalConfig);

    $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
    $synthese_action = Lib::isDefined("synthese_action");
    $idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
    if ($idFtaRole == NULL) {
        $idFtaRole = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($id_user);
    }

    $id_fta_etat;    //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta

    if ($isLimit) {
        $limit = "LIMIT 0,$isLimit";
    } else {
        $limit = "";
    }
//$_SESSION["id_fta"]=$id_fta_etat;
//mysql_table_load("fta_etat");
    $abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];

    $modelfta = new FtaModel("4");



    /*
      Sélection de la requête source en fonction du choix de visualisation
      --------------------------------------------------------------------
     */

    switch ($choix) {
        //Synthèse des fiches
        case 1:

            //Récupération du site d'attachement de l'utilisateur
            $_SESSION["id_geo"] = $_SESSION["lieu_geo"];
            $id_geo = $_SESSION["id_geo"];
            //mysql_table_load("geo");
            //$recordsetGeo = new DatabaseRecordset("geo", $id_geo);
            //ToDo: voir pourquoi lors du premier passage, $id_site est vide !!
            //$id_site=Lib::isDefined("id_site",$_SESSION["id_geo"]);
            //$id_site = Lib::isDefined("id_site");
            $id_site = $modelfta->getModelSiteExpedition()->getDataField(GeoModel::KEYNAME)->getFieldValue();



            //Liste des suivis de projet que doit gérer l'utilisateur suivant l'état
            $_SESSION["id_fta_etat"] = $id_fta_etat;
            //switch($abreviation_etat)
            //Premier processus ?
            if ($_SESSION["fta_definition"]) {
                $having = "";
            } else {
                $having = "HAVING MIN(suivi_precedent.signature_validation_suivi_projet)<>0 ";
            }

            //Récupération des listes des processus que gère l'utilisateur
            $where_processus = "AND ( ";
            $where_processus_cycle = "AND ( ";
            $where_processus_OP = "";    //Opérateur SQL

            $where_Site_de_production = "( Site_de_production=$id_site "
                    //. "OR Site_de_production IS NULL "
                    . "OR Site_de_production=0 "
            //. "OR Site_de_production=\"\" "
            ;
            $where_Site_de_production_OP = "";    //Opérateur SQL
//************* Version 2.4.0 buggée
            //$where_Site_de_production_OK=0;


            $req = "SELECT DISTINCT fta_processus.id_fta_processus, multisite_fta_processus "
                    . "FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus` , fta_action_role, fta_workflow_structure "
                    . "WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` " //Liaison
                    . "AND `fta_workflow_structure`.`id_fta_role` = `fta_processus`.`id_fta_role` "
                    . "AND `fta_workflow_structure`.`id_fta_processus` = `fta_processus`.`id_fta_processus` "
                    . "AND `fta_workflow_structure`.`id_fta_role` = `fta_action_role`.`id_fta_role` "
                    . "AND `intranet_actions`.`id_intranet_actions` = `fta_action_role`.`id_intranet_actions` ) "       //Liaison
                    . "AND ( ( `intranet_droits_acces`.`id_user` = " . $id_user . " "
                    . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ))"
            ;
            //echo $req;
            $result_processus = DatabaseOperation::query($req);

            //L'utilisateur gère-t-il des processus ?
            if (mysql_num_rows($result_processus)) {
                //echo "test";
                while ($rows = mysql_fetch_array($result_processus)) {
                    $where_processus .= "$where_processus_OP chapitre_encours.id_fta_processus=" . $rows["id_fta_processus"] . " ";
                    $where_processus_OP_before = "AND";    //Opérateur SQL
                    $where_processus_before .= $where_processus_OP_before . " chapitre_precedent.id_fta_processus<>" . $rows["id_fta_processus"] . " ";
                    $where_processus_cycle .= "$where_processus_OP id_next_fta_processus=" . $rows["id_fta_processus"] . " ";
                    $where_processus_OP = "OR";    //Opérateur SQL

                    $isMonoSite = 0;       //Permet de savoir si il y a aumoins un processus mono site
                    //echo $test;
                    //echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
                    //Dans le cas d'un processus multisite, récupération des déléguations de site
                    //Récupération des sites gérés par l'utilisateur
                    if ($rows["multisite_fta_processus"] == 1 and $isMonoSite == 0) {
                        //echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
                        //$where_Site_de_production_OK=1;
                        $req = "SELECT id_site_assemblage_fta_processus_multisite "
                                . "FROM fta_processus_multisite "
                                . "WHERE id_processus_fta_processus_multisite=" . $rows["id_fta_processus"] . " "
                                . "AND id_site_processus_fta_processus_multisite=" . $id_site
                        ;
                        //echo $req;
                        $result_site = DatabaseOperation::query($req);

                        //Existe-il au moins un site ?
                        if (mysql_num_rows($result_site)) {
                            //Récupération de la liste dans un tableau
                            while ($rows_site = mysql_fetch_array($result_site)) {
                                $tab_site[] = $rows_site["id_site_assemblage_fta_processus_multisite"];
                            }

                            //Analyse et mise en forme du tableau de site pour une exploitation en tant que critère de clause WHERE
                            $tab_site = array_unique($tab_site);
                            foreach ($tab_site as $current_site) {
                                $where_Site_de_production_OP = "OR";    //Opérateur SQL
                                $where_Site_de_production .= "$where_Site_de_production_OP Site_de_production=" . $current_site . " ";
                            }
                        } else { //Sinon, c'est qu'il n'y a pas de site de production supplémentaire
                        }//Fin d'existe-il au moins un site ?
                    } else { //Il s'agit d'un processus mono-site
                        $isMonoSite = 1;

                        //Dans ce cas, l'utilisateur voit tous les sites.
                        $where_Site_de_production = " ( 1 ";
                    }//Fin des processus multisite
                }//Fin des processus
            } else { //Sinon, c'est que l'utilisateur ne gère aucun processus (cas d'utilisateur en mode consultation)
                //Vision de l'utilisateur est restreint à son site de rattachement (+ site délégué)
//             $_SESSION["id_geo"]=$_SESSION["lieu_geo"];
//             mysql_table_load("geo");
//             $id_site=$_SESSION["id_site"];
//             //$where_Site_de_production .= " AND (access_arti2.Site_de_production = $id_site ";
                //Ajout des délégations de processus cf. fta_processus_multisite
                //Selection des processus multisite où l'utilisateur à accès
                $req_deleg = "SELECT id_site_assemblage_fta_processus_multisite "
                        . "FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus`, "
                        . "fta_processus_multisite "
                        . "WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` "
                        . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "
                        . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` ) "
                        . "AND ( ( `intranet_droits_acces`.`id_user` = " . $_SESSION["id_user"] . " "
                        . "AND `fta_processus`.`multisite_fta_processus` = 1 "
                        . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ) )"
                        . "AND id_processus_fta_processus_multisite=id_fta_processus "
                        . "AND id_site_processus_fta_processus_multisite= $id_site "
                ;
                $result_deleg = DatabaseOperation::query($req_deleg);
                while ($rows = mysql_fetch_array($result_deleg)) {
                    $where_Site_de_production.= "OR fta.Site_de_production = " . $rows["id_site_assemblage_fta_processus_multisite"] . " ";
                }

                $where_processus.= "1";
                $where_processus_cycle.= "1";
            }//Fin de la recherche des processus
            //Finalisation de la mise en forme de la clause WHERE
            $where_processus.= ")";
            $where_processus_cycle.= ")";
            $where_Site_de_production.=") ";

            $AND_where_Site_de_production = "AND " . $where_Site_de_production;
            $OR_where_Site_de_production = "OR " . $where_Site_de_production;





            //Composant commun des requêtes
            //$select_common=", id_classification_arborescence_article, fta_etat.*, access_arti2.*";
            /*
              $select_common = ", abreviation_fta_etat, LIBELLE, NB_UNIT_ELEM, Poids_ELEM, suffixe_agrologic_fta, designation_commerciale_fta, "
              . "id_dossier_fta, id_version_dossier_fta, id_article_agrologic "
              ;
             */
            $select_common = "";
            $from_common = "fta LEFT JOIN classification_fta ON classification_fta.id_fta=fta.id_fta, fta_etat, fta_processus_cycle ";
            //$from_common="fta LEFT JOIN classification_fta ON classification_fta.id_fta=fta.id_fta, access_arti2";
            $where_common = "AND fta.id_fta_etat=fta_etat.id_fta_etat "
                    //. "AND fta.id_fta=access_arti2.id_fta "
                    . "AND fta.id_fta_etat=\"" . $_SESSION["id_fta_etat"] . "\" "
                    . "AND `fta`.`id_fta_workflow`=`fta_processus_cycle`.`id_fta_workflow` "
                    . "AND `fta_processus_cycle`.`id_init_fta_processus`=`fta_processus`.`id_fta_processus` "
            ;
            //$where_common="fta.id_fta=access_arti2.id_fta";
            //Classement
            if (!$order_common) { //Classement demandé par l'utlisateur
                $order_common = "suffixe_agrologic_fta, id_article_agrologic, id_classification_arborescence_article";
            }


            switch ($synthese_action) {

                case "encours":
                    $ok = 1;
                    $bgcolor = "";
                    //echo $_SESSION["abreviation_fta_etat"];
                    //Récupération des suivis de projet gérés par l'utilisateur et pas encore validé
                    $req = "SELECT DISTINCT fta.id_fta AS id_fta "
                            . $select_common
                            //. ", fta.*, access_arti2.* "
                            //. ", fta.* "
                            //. ", suivi_encours.id_fta_suivi_projet "
                            //. ", suivi_precedent.id_fta_suivi_projet "
                            //. ", MIN(suivi_precedent.signature_validation_suivi_projet) "
                            //. ", suivi_precedent.signature_validation_suivi_projet "
                            //. ", suivi_encours.* "
                            //. ", suivi_precedent.* "
                            //. ",id_next_fta_processus "
                            . "FROM fta_suivi_projet as suivi_encours, "
                            . "fta_chapitre as chapitre_encours, "
                            . "fta_suivi_projet as suivi_precedent, "
                            . "fta_workflow_structure as chapitre_precedent, "
                            . "`fta_processus`, "
                            //. "access_arti2, "
                            //. "fta_processus_cycle "
                            //. ", fta_etat "
                            . " $from_common "
                            . "WHERE suivi_encours.id_fta_chapitre=chapitre_encours.id_fta_chapitre "    //Liaison
                            //. "AND suivi_encours.id_fta=access_arti2.id_fta "                        //liaison
                            . "AND suivi_encours.id_fta=fta.id_fta "                                 //Liaison
                            . "AND suivi_precedent.id_fta=fta.id_fta "                                 //Liaison
                            . "AND suivi_precedent.id_fta_chapitre=chapitre_precedent.id_fta_chapitre "  //Liaison
                            //. "AND fta.id_fta_etat=fta_etat.id_fta_etat "                                //Liaison
                            . "$where_common "
                            . "$where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                            . "$AND_where_Site_de_production "
                            . "$where_processus_cycle "
                            . "AND fta_processus_cycle.id_init_fta_processus=chapitre_precedent.id_fta_processus "
                            . "AND suivi_encours.signature_validation_suivi_projet=0 "                                //Chapitre pas encore validé
                            . "AND id_etat_fta_processus_cycle=\"" . $modelfta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue() . "\" "             //Cycle Initialisation par défaut
                            //. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
                            //. "AND suivi_encours.id_fta_suivi_projet=suivi_precedent.id_fta_suivi_projet "
                            //. "AND suivi_precedent.signature_validation_suivi_projet<>0 "
                            . "AND (1 $where_processus_before)"
                            . "GROUP BY fta.id_fta  "
                            . $having
                            //. "GROUP BY suivi_encours.id_fta_suivi_projet "
                            //. "OR chapitre_encours.id_fta_processus=1 "
                            //. "OR suivi_precedent.id_fta_suivi_projet IS NULL"
                            . "ORDER BY $order_common "
                    ;

                    $result_liste = DatabaseOperation::query($req);
                    //echo $req;
                    break;

                case "attente":
                    $ok = 0;
                    $bgcolor = "bgcolor=#A5A5CE ";

                    //Distinction entre le En cours et le En attente
                    //Par rapport aux suivi de projets gérés, récupération des processus
                    $where_processus;

                    //Par rapport à ces processus, récupération des processus précédents
                    //et vérification qu'au moins un des chapitres précédent n'est pas validé
                    //$req = "SELECT DISTINCT fta.*, fta.id_fta AS id_fta "
                    $req = "SELECT DISTINCT fta.id_fta AS id_fta "
                            . $select_common
                            . "FROM fta_suivi_projet, fta_chapitre, `fta_processus` "
                            . ", $from_common "
                            . "WHERE id_etat_fta_processus_cycle=\"I\" "                                //Cycle Initialisation par défaut
                            . "AND fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "      //Liaison
                            . "AND id_init_fta_processus=fta_chapitre.id_fta_processus "                //Liaison
                            . "AND fta.id_fta=fta_suivi_projet.id_fta "                                 //Liaison
                            //. "AND access_arti2.id_fta=fta_suivi_projet.id_fta "                        //Liaison
                            . $where_common
                            . "$where_processus_cycle "
                            . "$AND_where_Site_de_production "
                            . "AND signature_validation_suivi_projet=0 "                                //Chapitre pas encore validé donc FTA en attente
                            //. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
                            . "ORDER BY $order_common "
                    ;
                    $result_liste = DatabaseOperation::query($req);
                    break;

                case "correction":

                    //Récupération des suivi de projet
                    //Récupération des chapitres gérés
                    //Pour un chapitre donné --> Voir le processus lié
                    //Pour le processus donné, voir l'accès

                    $ok = 2;
                    $bgcolor = "bgcolor=#AFFF5A";

                    //FTA dont les chapitres sont tous validés et surlesquels on peut faire une correction
                    //Par rapport aux suivi de projets gérés, récupération des processus
                    $where_processus;

                    //Par rapport à ces processus, récupération des processus précédents
                    //et vérification qu'au moins un des chapitres précédent n'est pas validé
                    /* $req = "SELECT fta.id_fta AS id_fta "
                      . ", fta.*, access_arti2.* "
                      . ", $select_common "
                      //. ", fta_suivi_projet.signature_validation_suivi_projet "
                      //. ", fta_suivi_projet.* "
                      //. ", MIN(fta_suivi_projet.signature_validation_suivi_projet) "
                      . "FROM fta_suivi_projet, fta_chapitre as chapitre_encours, access_arti2 "
                      . ", $from_common "
                      . "WHERE fta_suivi_projet.id_fta_chapitre=chapitre_encours.id_fta_chapitre "      //Liaison
                      . "AND fta.id_fta=fta_suivi_projet.id_fta "                                 //Liaison
                      . "AND access_arti2.id_fta=fta_suivi_projet.id_fta "                        //Liaison
                      . "AND $where_common "
                      . "$where_processus "
                      . "$where_Site_de_production "                                              //Appartenant à un site géré par l'utilisateur
                      . "AND abreviation_fta_etat=\"I\" "
                      . "GROUP BY fta.id_fta "
                      //. "GROUP BY suivi_encours.id_fta_suivi_projet "
                      . "HAVING MIN(fta_suivi_projet.signature_validation_suivi_projet)<>0 "
                      . "ORDER BY $order_common "
                      ; */

                    $req = "SELECT DISTINCT fta.id_fta AS id_fta "
                            //. ", fta.* "
                            . $select_common
                            //. ", fta_suivi_projet.* "
                            //. ", fta_processus_multisite.* "
                            . "FROM `fta_processus` LEFT JOIN `fta_processus_multisite` "
                            . "ON `fta_processus`.`id_fta_processus` = `fta_processus_multisite`.`id_processus_fta_processus_multisite` "
                            . ", `fta_chapitre` as chapitre_encours, `fta_suivi_projet` "
                            . ", $from_common "
                            . "WHERE `chapitre_encours`.`id_fta_chapitre` = `fta_suivi_projet`.`id_fta_chapitre` "
                            . "AND `fta_processus`.`id_fta_processus` = `chapitre_encours`.`id_fta_processus` "
                            . "AND `fta`.`id_fta` = `fta_suivi_projet`.`id_fta` "
                            //. "AND `access_arti2`.`id_access_arti2` = `fta`.`id_access_arti2`  "
                            . "AND fta_etat.id_fta_etat=fta.id_fta_etat "
                            . "$where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                            . $where_common                                                   //Appartenant à un Processus géré par l'utilisateur
                            //. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
                            . "AND (multisite_fta_processus=0 "
                            . "$OR_where_Site_de_production)"
                            //. "AND `fta_suivi_projet`.`id_fta` = 1233 "
                            . "GROUP BY fta.id_fta "
                            . "HAVING MIN(fta_suivi_projet.signature_validation_suivi_projet)<>0 "
                            . "ORDER BY $order_common "
                    ;
                    $result_liste = DatabaseOperation::query($req);
                    break;


                case "all": //Toutes les fiches de l'état sélectionné

                    $bgcolor = "bgcolor=#AFFF5A";

                    /*
                      switch($_SESSION["abreviation_fta_etat"])
                      {
                      case "V":
                      $order_common = "date_derniere_maj_fta DESC, suffixe_agrologic_fta, id_article_agrologic, id_classification_arborescence_article";
                      break;

                      default:
                      //$limit = "";
                      }
                     */

                    //$req = "SELECT fta.id_fta AS id_fta "
                    $select = "SELECT fta.id_fta AS id_fta, date_derniere_maj_fta ";
                    $from = " FROM " . " $from_common ";
                    $where = "WHERE access_arti2.id_fta=fta.id_fta "     //Liaison
                            . $where_common
                            . $AND_where_Site_de_production
                    ;
                    $order = "ORDER BY $order_common ";
                    $limit;

                    $req = $select . $from . $where . $order . $limit;

                    $result_liste = DatabaseOperation::query($req);
                    break;
            }

            break;

        //Moteur de recherche
        case -1:
        case 0:
            $id_fta = $id_fta_etat;    //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta
            $ftaModel = new FtaModel($id_fta);
            $id_fta_etat = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();
            $where = "fta.id_fta = '$id_fta' ";
            $_SESSION["synthese_action"] = "all";
            $synthese_action = $_SESSION["synthese_action"];

            //$req = "SELECT *, fta.id_fta AS id_fta FROM fta, fta_etat, access_arti2 "
            $req = "SELECT fta.id_fta AS id_fta FROM fta, fta_etat "
                    . "WHERE $where "
                    . "AND fta.id_fta_etat = fta_etat.id_fta_etat "
                    . "ORDER BY id_article_agrologic, designation_commerciale_fta ASC "
            ;
            //echo $req;
            $result_liste = DatabaseOperation::query($req);
            $bgcolor = -1;  //Déconfiguration du bgcolor, pour forcer sa redéfinition par la suite
            break;
    }
//MASTER REQUETE !!!!!!!!!!!!!
//echo $req."<br><br>";
    $_SESSION["visualiser_fiche_total_fta"] = mysql_num_rows($result_liste);

    /*
      boucle d'affichage des éléments du tableau
      ------------------------------------------
     */

    $tableau_fiches = "<table class=titre width=100% border=0>"
            . "<tr class=titre_principal><td></td><td>"
    ;

//Si aucune demande de classement a été demandé, on sauvegarde L'url initiale
    /* if(!$_GET["isOrdering"])
      {
      $initial_URI = $_SERVER[REQUEST_URI];
      //echo "<br>isOrdering:".$_GET["isOrdering"];
      //echo "<br>order_common:".$_GET["order_common"];

      }
      else //Sinon, on met à jour l'URL avec les critères de tris
      {

      $initial_URI = $_GET["initial_URI"];
      } */
    /*
      print_r($_SERVER);
      echo "<br>";
      echo $_SERVER[REQUEST_URI]."<br>";
      echo $_GET['order_common']."<br>";
      $_GET['order_common']="test";
      $_REQUEST['order_common']="test";
      echo $_GET['order_common']."<br>";
      echo $_SERVER[REQUEST_URI]."<br>";
      print_r($_SERVER);
      echo "<br>";
     */

    //Définition des en-têtes de tableau
    switch ($choix) {
        case 1:
        case 0:

            //Définition des fonctionnalité de classement
            //Par N°de Dossier - version
            $order_common = "id_fta";

            //Contrôle pour savoir si on est sur l'index du module
            $URL = $_SERVER["REQUEST_URI"];
            if (substr($URL, -1) == "/") {
                $URL = $URL . "index.php?";
            }

            $tableau_fiches.= "<a href=" . $URL . "&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                    . "Id"
                    . "</td><td>"
//                      . "<a href=".$URL."&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
//                      . "Class."
//                      . "</td><td>"
//                      . "<a href=".$URL."&order_common=CODE_ARTICLE><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
//                      . "Agrologic"
//                      . "</td><td>"
                    . "<a href=" . $URL . "&order_common=code_article_ldc><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                    . "Regate"
                    . "</td><td>"
                    /* . "<a href=".$URL."&order_common=designation_commerciale_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                      . mysql_field_desc("fta", "designation_commerciale_fta")
                      . "</td><td>"
                     */
                    . "<a href=" . $URL . "&order_common=LIBELLE><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                    . "Désignation"
            ;
            if ($abreviation_fta_etat == "I") {
                $tableau_fiches .="</td><td>"
                        . "<a href=" . $URL . "&order_common=date_echeance_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . mysql_field_desc("fta", "date_echeance_fta")
                ;
            }
            $tableau_fiches.= "</td>"
                    . "<td> Actions"
                    . "</td></tr>"
            ;
            break;
        case -1:
            break;
    }
    /**
     * Droits d'actions
     */
    if ($idFtaRole == '1' or $idFtaRole == '6') {
        $valueIsGestionnaire = FtaRoleModel::getValueIsGestionnaire($idFtaRole);
    }


    //Parcours des fiches techniques
    while ($rows = mysql_fetch_array($result_liste)) {

        //Chargement des données
        //$id_fta=$rows["id_fta"];
        //$_SESSION["id_fta"]=$id_fta;
        //mysql_table_load("fta");
        $req_detail = "SELECT fta.id_fta as id_fta, abreviation_fta_etat, LIBELLE, NB_UNIT_ELEM, Poids_ELEM, suffixe_agrologic_fta, designation_commerciale_fta, "
                . "id_dossier_fta, id_version_dossier_fta, id_article_agrologic,id_fta_classification2,liste_id_fta_role, "
                . "code_article_ldc, date_echeance_fta, createur_fta, nom_fta_workflow,fta.id_fta_workflow,geo.geo,Site_de_production "
                . " FROM fta, fta_etat,fta_workflow,geo "
                . " WHERE fta.id_fta=" . $rows["id_fta"] . " "
                //. "AND fta.id_fta=access_arti2.id_fta "
                . " AND fta_etat.id_fta_etat=fta.id_fta_etat "
                . " AND fta_workflow.id_fta_workflow=fta.id_fta_workflow "
                . " AND geo.id_geo=fta.Site_de_production "
        //. "AND fta.createur_fta=salaries.id_user"
        ;
        $result_detail = DatabaseOperation::query($req_detail);

        //Chargement manuel des données pour optimiser les performances
        $id_fta = mysql_result($result_detail, 0, "id_fta");
        $abreviation_fta_etat = mysql_result($result_detail, 0, "abreviation_fta_etat");
        $LIBELLE = mysql_result($result_detail, 0, "LIBELLE");
        $NB_UNIT_ELEM = mysql_result($result_detail, 0, "NB_UNIT_ELEM");
        $Poids_ELEM = mysql_result($result_detail, 0, "Poids_ELEM");
        $suffixe_agrologic_fta = mysql_result($result_detail, 0, "suffixe_agrologic_fta");
        $designation_commerciale_fta = mysql_result($result_detail, 0, "designation_commerciale_fta");
        $id_dossier_fta = mysql_result($result_detail, 0, "id_dossier_fta");
        $id_version_dossier_fta = mysql_result($result_detail, 0, "id_version_dossier_fta");
        $id_article_agrologic = mysql_result($result_detail, 0, "id_article_agrologic");
        $code_article_ldc = mysql_result($result_detail, 0, "code_article_ldc");
        $dateEcheanceFta = mysql_result($result_detail, 0, "date_echeance_fta");
        $createur_fta = mysql_result($result_detail, 0, "createur_fta");
        $workflowName = mysql_result($result_detail, 0, FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW);
        $idWorkflowFtaEncours = mysql_result($result_detail, 0, FtaWorkflowModel::KEYNAME);
        $nomSiteProduction = mysql_result($result_detail, 0, GeoModel::FIELDNAME_GEO);
        $idclassification = mysql_result($result_detail, 0, FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2);
        $listeIdFtaRole = mysql_result($result_detail, 0, FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE);
        $idSiteDeProduction = mysql_result($result_detail, 0, FtaModel::FIELDNAME_SITE_ASSEMBLAGE);

        /**
         * On obtient IdintranetAction du site de production
         */
        $idIntranetActionsSiteDeProduction = FtaActionSiteModel::getIdIntranetActionByWorkflowAndSiteDeProduction($idWorkflowFtaEncours, $idSiteDeProduction);

        $checkAccesButton = IntranetActionsModel::getIdFtaWorkflowAndSiteDeProduction($id_user, $idWorkflowFtaEncours, $idIntranetActionsSiteDeProduction);

        /**
         * Liste des processus pouvant être validé
         */
        $arrayProcessusValidation = FtaProcessusCycleModel::getArrayProcessusValidationFTA($idWorkflowFtaEncours);


        /**
         * Listes des processus auxquel l'utilisateur connecté à les droits d'accès
         */
        $arrayProcessusAcces = FtaWorkflowStructureModel::getArrayProcessusByRoleAndWorkflow($idFtaRole, $idWorkflowFtaEncours);
        $accesTransitionButton = is_null(array_intersect($arrayProcessusValidation, $arrayProcessusAcces));

        //Récupération du nom du création
        $req = "SELECT prenom, nom FROM salaries WHERE id_user='" . $createur_fta . "' ";
        $result_createur_fta = DatabaseOperation::query($req);
        if (mysql_num_rows($result_createur_fta)) {
            $createur_nom = mysql_result($result_createur_fta, 0, "nom");
            $createur_prenom = mysql_result($result_createur_fta, 0, "prenom");
        }

        //if ($choix ==1)

        $lien = "";

        //Redéfinition du bgcolor si demandé
        if ($bgcolor == -1) {
            switch ($abreviation_fta_etat) {
                case "I":
                    $bgcolor = "";
                    break;
                case "V":
                    $bgcolor = "bgcolor=#AFFF5A";
                    break;
                default:
                    $bgcolor = "bgcolor=#A5A5CE ";
            }
        }
        $bgcolor_header = "";

        /*
          Analyse des Processus en cours et détermination du flag de controle $ok
          -----------------------------------------------------------------------
          0: En attente, Il reste au moins un processus en cours, mais l'utilisateur n'en est pas propriétaire
          1: En cours, Il reste au moins un processus en cours, et l'utilsiateur en est propriétaire
          2: Effectué, Il n'y a plus de processus en cours en donc la FTA est prête à être transité
         */
//echo "test".$id_fta;

        /* if(//Doit-on afficher cette fiche ?
          ($_SESSION["synthese_action"]=="attente" and $ok==0) or
          ($_SESSION["synthese_action"]=="correction" ) or
          ($_SESSION["synthese_action"]=="encours" and $ok<>0) or
          ($_SESSION["synthese_action"]=="all")
          )
          { */
        //Calcul préalable et Etat d'avancement
        //if($_SESSION["synthese_action"]<>"all")
        $ftaModel = new FtaModel($id_fta);
        $taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($ftaModel, FALSE);
        $recap[$id_fta] = round($taux_temp[0] * 100, 0) . "%";
//            $lien .= "<h5>" . $recap[$id_fta] . "<a "
//                    . "href=historique.php"
//                    . "?id_fta=$id_fta"
//                    . "&synthese_action=$synthese_action"
//                    . "&id_fta_etat=" . $id_fta_etat
//                    . "&abreviation_fta_etat=" . $abreviation_fta_etat
//                    . "&id_fta_role=" . $idFtaRole
//                    . "&comeback=1"
//                    . "><img src=./images/graphique.png alt=\"\" title=\"Etat d'avancement\" width=\"30\" height=\"25\" border=\"0\" />"
//                    . "</a>"
//            ;
        /**
         * Lien vers l'historique de la Fta
         */
        if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            $lienHistorique = ' <a href=historique-' . $id_fta
                    . '-1'
                    . '-' . $id_fta_etat
                    . '-' . $abreviation_fta_etat
                    . '-' . $idFtaRole
                    . '-' . $synthese_action
                    . '-1'
                    . '.html >' . $recap[$id_fta] . '</a>';
        } else {
            if ($checkAccesButton) {
                $lienHistorique = ' <a href=historique-' . $id_fta
                        . '-1'
                        . '-' . $id_fta_etat
                        . '-' . $abreviation_fta_etat
                        . '-' . $idFtaRole
                        . '-' . $synthese_action
                        . '-1'
                        . '.html >' . $recap[$id_fta] . '</a>';
            }
        }
        //Gestion des délais
        if ($abreviation_fta_etat == "I") { {
                $HTML_date_echeance_fta = FtaProcessusDelaiModel::getFtaDelaiAvancement($id_fta);
                //$return["status"]
                //    0: Aucun dépassement des échéances
                //    1: Au moins un processus en cours a dépassé son échéance
                //    2: La date d'échéance de validation de la FTA est dépassée
                //    3: Il n'y a pas de date d'échéance de validation FTA saisie
                //$return["liste_processus_depasses"][$id_processus]
                //    Renvoi un tableau associatif contenant:
                //    - la listes des processus en cours ayant dépassé leur échéance
                //    - leur date d'échéance
                //$return["HTML_synthese"]
                //    Contient le code source HTML utilisé pour la fonction visualiser_fiches()
                //echo $HTML_date_echeance_fta["status"];

                switch ($HTML_date_echeance_fta["status"]) {
                    case 1:
                        $bgcolor_header = $bgcolor;
                        $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                        break;
                    case 2:
                        $bgcolor_header = "class=couleur_rouge";
                        $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                        break;
                    default:
                        //$bgcolor_header = $bgcolor;
                        $icon_header = "";
                }
            }
            /* else
              {
              $bgcolor_header = $bgcolor;
              $icon_header = "";
              } */
        }

        //Droit de consultation standard HTML
        if (
                (AclClass::getValueAccesRights("fta_modification"))
                or ( AclClass::getValueAccesRights("fta_consultation") and $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE )
        ) {
            if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                $lien .= '<a '
//                            . 'href=#'
                        . 'href=modification_fiche.php'
                        . '?id_fta=' . $id_fta
                        . '&synthese_action=' . $synthese_action
                        . '&comeback=1'
                        . '&id_fta_etat=' . $id_fta_etat
                        . '&abreviation_fta_etat=' . $abreviation_fta_etat
                        . '&id_fta_role=' . $idFtaRole
                        . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                        . '</a>'
                ;
            } else {
                if ($checkAccesButton) {
                    $lien .= '<a '
//                            . 'href=#'
                            . 'href=modification_fiche.php'
                            . '?id_fta=' . $id_fta
                            . '&synthese_action=' . $synthese_action
                            . '&comeback=1'
                            . '&id_fta_etat=' . $id_fta_etat
                            . '&abreviation_fta_etat=' . $abreviation_fta_etat
                            . '&id_fta_role=' . $idFtaRole
                            . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                }
            }
            /**
             * Version avec le module rewrite
             */
//                    $lien .= '<a '
////                            . 'href=#'
//                            . 'href=modification_fiche'
//                            . '-' . $id_fta
//                            . '-' . $synthese_action
//                            . '-1'
//                            . '-' . $id_fta_etat
//                            . '-' . $abreviation_fta_etat
//                            . '-' . $idFtaRole
////                            . ' onClick=\'modification_fiche_' . $idFta . '();\' '
//                            . '.html /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
//                            . '</a>'
            ;
        }



        //Export PDF
//echo "test".$rows["abreviation_fta_etat"];
        if (
                (AclClass::getValueAccesRights("fta_impression") and ( $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE ))
                or ( $_SESSION["mode_debug"] == 1)or ( $workflowName == 'presentation')
        ) {

            $lien .= "  "
                    . "<a "
                    . "href=pdf.php?id_fta=" . $id_fta . "&mode=client "
                    . "target=_blank"
                    . "><img src=./images/pdf.png alt=\"\" title=\"Exportation PDF\" width=\"30\" height=\"25\" border=\"0\" />"
                    . "</a>"
            ;
        }
        //echo $taux_temp[0]." ".$_SESSION["fta_article"]."<br>";
        //Transiter

        if (
                (($idFtaRole == '1' or $idFtaRole == '6' ) and $recap[$id_fta] == '100%' and $checkAccesButton )
                and AclClass::getValueAccesRights("fta_modification") and ( $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION)
                or ( $ok == '2' and $accesTransitionButton == FALSE && $recap[$id_fta] == '100%' and $checkAccesButton )
                or ( $synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL AND ( $idFtaRole == '1' or $idFtaRole == '6' ) and $checkAccesButton and $abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION )
                or ( ($idFtaRole == '1' or $idFtaRole == '6' ) and $synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $checkAccesButton )
        ) {
            $lien .= '<a '
                    . 'href=transiter.php'
                    . '?id_fta=' . $id_fta
                    . '&id_fta_role=' . $idFtaRole
                    . '><img src=./images/transiter.png alt=\'\' title=\'Transiter\' width=\'30\' height=\'30\' border=\'0\' />'
                    . '</a>'
            ;
            if ($synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $recap[$id_fta] == '100%') {
                $selection = '<input type=\'checkbox\' name=selection_fta value=\'' . $id_fta . '\' checked />';
                $traitementDeMasse = '1';
                $selection_width = '2%';
                $StringFta .= $id_fta . ',';
                $tableau_fiches .= '<input type=hidden name=arrayFta value=' . $StringFta . '>';
            }
            //<a target="_parent" href="index"></a>
        }



        /* //Modifier les processus en cours
          if($ok<>2)
          {
          $lien .= "<a "
          . "href=modification_fiche.php"
          . "?id_fta=".$rows["id_fta"]
          . "&synthese_action=$synthese_action"
          . "><img src=../lib/images/next.png alt=\"\" title=\"Modifier le Dossier Technique\" width=\"25\" height=\"25\" border=\"0\" />"
          . "</a>"
          ;
          } */

        /*
         * Action que seul les Chefs de projet peuvent faire
         */
        /*
         * Retirer une FTA en cours de modification
         */
        if ($valueIsGestionnaire == '1') {
            if ($checkAccesButton) {
                if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
                    $lien .= '<a '
                            . 'href=# '
                            . 'onClick=confirmation_correction_fta' . $id_fta . '(); '
                            . '/>'
                            . '<img src=../lib/images/supprimer.png alt=\'Retirer cette FTA\' width=\'25\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                    $javascript.='
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta' . $id_fta . '()
                                   {
                                   if(confirm(\'Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.\'))
                                   {
                                       location.href =\'transiter.php?id_fta=' . $id_fta . '&id_fta_role=' . $idFtaRole . '&synthese_action=' . $synthese_action . '&action=correction&demande_abreviation_fta_transition=R\'
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ';
                }
            }
            if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                if ($checkAccesButton) {
                    $lien .= '<a '
                            . 'href=creer_fiche.php'
                            . '?action=dupliquer_fiche'
                            . '&id_fta=' . $id_fta
                            . '&id_fta_role=' . $idFtaRole
                            . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;
                }
            } else {
                $lien .= '<a '
                        . 'href=creer_fiche.php'
                        . '?action=dupliquer_fiche'
                        . '&id_fta=' . $id_fta
                        . '&id_fta_role=' . $idFtaRole
                        . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                        . '</a>'
                ;
            }
        }


        //construction des lignes et des colonnes
        //if($ok)
        //Si accès la fiche
        //Récupération du propriétaire
        //$id_fta=$rows["id_fta"];
//        $id_element = 1;    //Propriétaire
//        $extension[0] = 1;
//        $temp = recherche_element_classification_fta($id_fta, $id_element, $extension);
        //Récupération de la marque
//        $id_element = 2;  //Marque
//        $extension[0] = 1;
//        $temp2 = recherche_element_classification_fta($id_fta, $id_element, $extension);
        //Désignation commerciale
        if (strlen($designation_commerciale_fta) > 55) {
            $designation_commerciale_fta = substr($designation_commerciale_fta, 0, 52) . "...";
        }
        if ($LIBELLE) {
            $din = $LIBELLE;
        } else {
            $din = $designation_commerciale_fta;

            if ($temp2[2]) {
                $din .= " (" . $temp[2] . " " . $NB_UNIT_ELEM . " x " . $Poids_ELEM . "Kg)";
            }
            $din = "<font size=\"1\" color=\"#808080\"><i>$din</i></font>";
        }
//        /*
//         * Initialisation des valeurs pour un commentaire
//         */
//        $ftaModel = new FtaModel($id_fta);
//        $commentaireDataField = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE);
//        $htmlField = html::getHtmlObjectFromDataField($commentaireDataField);
//        $htmlField->setHtmlRenderToTable();
//        $htmlField->setIsEditable(TRUE);
//        $commentaire = $htmlField->getHtmlResult();

        /*
         * Noms des services dans lequel la Fta se trouve
         */
//                $service = FtaRoleModel::getListeIdFtaRoleEncoursByIdFta($idFta, $idWorkflowFtaEncours);

        if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            if ($checkAccesButton) {
                $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
            }
        } else {
            $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
        }
        /**
         * Calssification
         */
        if ($idclassification) {
            $classification = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idclassification, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
        }

        //Nom de l'assistante de projet responsable:
        $createur_link = "\"Géré par $createur_prenom $createur_nom\"";

        $tableau_fiches.= "<tr class=contenu>
                              <td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>
                              ";
        $tableau_fiches.= '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                . '<td ' . $bgcolor . ' width=6%>' . $suffixe_agrologic_fta . '</td>'; // Raccourcie Class.
        //$tableau_fiches.="<td $bgcolor $largeur_html_C1>".stripslashes($designation_commerciale_fta)."</td>";
        $tableau_fiches.="<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"
                . "<td $bgcolor width=3%>" . $id_dossier_fta . "<br>v" . $id_version_dossier_fta . "</td>";

        $tableau_fiches.="<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $code_article_ldc . "</font></b></td>";
        if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
        } else {
            $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
        }
        $tableau_fiches .= '<td ' . $bgcolor . ' width=5% align=center >' . $lienHistorique . '</td>'//% Avancement FTA
                . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $lien . '</td>'; // Actions
//        $tableau_fiches.="<td $bgcolor $largeur_html_C3 align=\"right\" valign=\"middle\">$lien</td>";
        $tableau_fiches.="</tr>";
        $compteur_ligne++;
    }//fin tant que tableau_origine
    $tableau_fiches = $javascript . $tableau_fiches . "</table>";

    //Ajoute de la fonction de traitement de masse
    if ($traitementDeMasse) {
        $liste_action_groupe = FtaTransitionModel::getListeFtaGrouper($abreviation_fta_etat);

        $tableau_fiches.= '&nbsp;
            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
            <i>Transitions groupées</i>:
            ' . $liste_action_groupe . '
            <input type = \'text\' name=\'subject\' size=\'20\' />
            <input type=image src=images/transiter.png width=20 height=20 />
            <input type=hidden name=action value=transition_groupe>
                         ';
    }

    return $tableau_fiches;
}

//function visualiser_fiches */





/* * ***********************************************************************************
  Fonction donnant l'état actuel d'un processus pour une fiche technique article données
 * *********************************************************************************** */

function fta_processus_etat($id_fta, $id_fta_processus) {
//Définition des variables
    $return;        //1=En attente, 2=En cours et 3=Validé
//echo "processus=".$id_fta_processus." ";
    //Le processus a-t-il un taux de validation ?
    switch (fta_processus_validation($id_fta, $id_fta_processus)) {

        case 1: //100%, le processus est validé
            $return = 3;
            break;

        case 0: //0%, Il est necessaire de déterminé si le processus est en attente ou en cours
            //Vérification du taux des processus précédent
            $req = "SELECT `fta_processus_cycle`.`id_init_fta_processus`, `fta`.`id_fta` "
                    . "FROM `fta_etat`, `fta`, `fta_processus_cycle` "
                    . "WHERE ( `fta_etat`.`id_fta_etat` = `fta`.`id_fta_etat` "
                    . "AND `fta_processus_cycle`.`id_etat_fta_processus_cycle` = `fta_etat`.`abreviation_fta_etat` ) "
                    . "AND ( ( `fta_processus_cycle`.`id_next_fta_processus` ='" . $id_fta_processus . "' "
                    . "AND `fta`.`id_fta` ='" . $id_fta . "' ) )"
            ;
            $result = DatabaseOperation::query($req);
            if (mysql_num_rows($result)) {
                //On va prouver que le processus n'est pas en cours
                $return = 2; //Sinon il en déduira qu'il est en cours
                //Recherche d'un processus initial pas encore validé
                while ($rows = mysql_fetch_array($result)) {
                    $id_init_fta_processus = $rows["id_init_fta_processus"];
                    $taux_temp = fta_processus_validation($id_fta, $id_init_fta_processus);
                    if ($taux_temp <> 1) {
                        $return = 1;
                    }
                }
            } else {
                //Processus d'initialisation
                $return = 2;
            }
            break;

        default://Sinon, le processus est en cours
            $return = 2;
    }
//En cours
//echo "etat=".$return. "<br>";
    return $return;
}

/* * *******************************************************************
  Fonction informe de l'état de validation d'une Fiche Technique Article
 * ******************************************************************* */

function fta_taux_validation($id_fta) {

//Dictionnaire des données
    $return;        //Tableau de résultat
    $return[0];     //Pourcentage globale de la validation
    $return[1];     //Tableau de résultat par id_fta_processus des taux de validation
    $return[2];     //Tableau de résultat par id_fta_processus des état des processus (Terminé, En cours, En attente)
    $return[3];     //Tableau de résultat par id_fta_processus des dates d'échéances

    $nombre_total_processus = 0;
    $nombre_valide_processus = 0;

//Récupération du l'état de la FTA pour connatire le cycle de vie en cours
    $id_fta;
    mysql_table_load("fta");
    mysql_table_load("fta_etat");
    $abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];
    $recordFta = new ObjectFta($id_fta);

    /*
      Corps de la fonction
     */

//Sélection des processus contenu dans le cycle de vie de l'état de la FTA
    $req = "SELECT DISTINCT id_init_fta_processus "
            . "FROM fta_processus_cycle "
            . "WHERE id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' "
            . "AND `id_fta_categorie`='" . $recordFta->getFieldValue("fta", "id_fta_categorie") . "' ";
    ;
//echo $req."<br>";
    $result = DatabaseOperation::query($req);
    $nombre_total_processus = mysql_num_rows($result);


    if ($nombre_total_processus) {
        //Balayage de tous les processus
        while ($rows = mysql_fetch_array($result)) {
            //echo "FTA".$id_fta."<br>";    //Déjà déclaré
            $id_fta_processus = $rows["id_init_fta_processus"];
            $taux_validation_processus = fta_processus_validation($id_fta, $id_fta_processus);

            //echo $id_fta_processus."=".$taux_validation_processus."<br>";
            //Processus total validé
            if ($taux_validation_processus == 1) {
                $nombre_valide_processus++;
            }

            //Détail par processus
            $return[1][$id_fta_processus] = $taux_validation_processus;
        }//Fin du balayage
        //Calcul
//    echo $nombre_valide_processus.", ".$nombre_total_processus;
        $return[0] = $nombre_valide_processus / $nombre_total_processus;

        return $return;
        //print_r($return);
    } else {
        //La table des processus est vide
        /* $titre = "Table de données";
          $message = "Il n'y a pas de Cycle de vie pour cet état!";
          afficher_message($titre, $message, $redirection); */
    }//Fin de suivi de projet
}

/* * *******************************************************************
  Fonction informe de l'état de validation d'une Fiche Technique Article
 * ******************************************************************* */

function fta_taux_validation_fast($id_fta) {

//Dictionnaire des données
    $return;        //Tableau de résultat
    $return[0];     //Pourcentage globale de la validation
    $return[1];     //Tableau de résultat par id_fta_processus des taux de validation
    $return[2];     //Tableau de résultat par id_fta_processus des état des processus (Terminé, En cours, En attente)

    $nombre_total_processus = 0;
    $nombre_valide_processus = 0;

//Récupération du l'état de la FTA pour connatire le cycle de vie en cours
    $id_fta;
    $recordFta = new ObjectFta($id_fta);
    $recordFta->getFieldValue("fta", "id_fta_categorie");

//mysql_table_load("fta");
//mysql_table_load("fta_etat");
//$abreviation_fta_etat=$_SESSION["abreviation_fta_etat"];
    $abreviation_fta_etat = "I";

    /*
      Corps de la fonction
     */

//Sélection des processus contenu dans le cycle de vie de l'état de la FTA
    /* $req = "SELECT DISTINCT id_init_fta_processus "
      . "FROM fta_processus_cycle "
      . "WHERE id_etat_fta_processus_cycle='".$abreviation_fta_etat."' "
      ;
     */
    $req = "SELECT DISTINCT fta_suivi_projet.id_fta_chapitre "
            . "FROM fta_suivi_projet, fta_workflow_structure, fta_processus_cycle, fta_etat "
            . "WHERE `fta_suivi_projet`.`id_fta` = $id_fta "
            . "AND signature_validation_suivi_projet<>0 "
            . "AND `fta_workflow_structure`.`id_fta_chapitre`= `fta_suivi_projet`.`id_fta_chapitre` "
            . "AND `fta_workflow_structure`.`id_fta_processus`=`fta_processus_cycle`.`id_init_fta_processus` "
            . "AND `fta_processus_cycle`.`id_etat_fta_processus_cycle`=`fta_etat`.`abreviation_fta_etat` "
            . "AND `fta_etat`.`id_fta_etat`='" . $recordFta->getFieldValue("fta", "id_fta_etat") . "' "
            . "AND `fta_processus_cycle`.`id_fta_workflow`='" . $recordFta->getFieldValue("fta", "id_fta_workflow") . "' "
    ;
    //echo $req."<br>";
    $result = DatabaseOperation::query($req);
    $current_chapitre = mysql_num_rows($result);

    /**
     * Liste complète des chapitres de ce cycle pour cette catégorie
     */
    $req = "SELECT DISTINCT id_fta_chapitre "
            . "FROM fta_workflow_structure, fta_processus_cycle, fta_etat "
            . "WHERE `fta_workflow_structure`.`id_fta_processus`=`fta_processus_cycle`.`id_init_fta_processus` "
            . "AND `fta_processus_cycle`.`id_etat_fta_processus_cycle`=`fta_etat`.`abreviation_fta_etat` "
            . "AND `fta_etat`.`id_fta_etat`='" . $recordFta->getFieldValue("fta", "id_fta_etat") . "' "
            . "AND `fta_processus_cycle`.`id_fta_workflow`='" . $recordFta->getFieldValue("fta", "id_fta_workflow") . "' "
    ;
    //echo $req."<br>";
    $result = DatabaseOperation::query($req);
    $total_chapitre = mysql_num_rows($result);

    //$return[0]=$nombre_valide_processus/$nombre_total_processus;
    $return[0] = $current_chapitre / $total_chapitre;

    /*      echo $current_chapitre."<br>";
      echo $total_chapitre."<br>";
      echo $return[0]."<br><br>";
     */
    return $return;
    //print_r($return);
//Fin de suivi de projet
}

function fta_processus_delai_etat($id_fta) {
    /*     * *****************************************************************************
      Informe de l'état des délais et donc du respect des échéances

      Retour de fonction:
     * ******************
      $return["status"]
      0: Aucun dépassement des échéances
      1: Au moins un processus en cours a dépassé son échéance
      2: La date d'échéance de validation de la FTA est dépassée
      3: Il n'y a pas de date d'échéance de validation FTA saisie
      $return["liste_processus_depasses"][$id_processus]
      Renvoi un tableau associatif contenant:
      - la listes des processus en cours ayant dépassé leur échéance
      - leur date d'échéance
      $return["HTML_synthese"]
      Contient le code source HTML utilisé pour la fonction visualiser_fiches()

     * ***************************************************************************** */

    $return = NULL;
    $HTML_fta = "";                                                      //Partie HTML dédiée à la fta
    $HTML_processus = "";                                                //Partie HTML dédiée aux processus
    $HTML_processus_begin = "<font size=\"1\" color=\"#808080\"><i>";    //Partie HTML dédiée aux processus (warning)
    $HTML_processus_end = "</i></font>";                                 //Partie HTML dédiée aux processus (warning)
    //Liste des processus non validés qui ont dépassé leur échéances
    $req = "SELECT * FROM fta_processus_delai, fta_processus "
            . "WHERE id_fta='" . $id_fta . "' "
            . "AND fta_processus.id_fta_processus=fta_processus_delai.id_fta_processus "
            . "AND date_echeance_processus < CURDATE()  "
            . "AND valide_fta_processus_delai=0  "
            . "ORDER BY date_echeance_processus "
    ;
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        $return["status"] = 1;
        while ($rows = mysql_fetch_array($result)) {
            $return["liste_processus_depasses"][$rows["id_fta_processus"]] = $rows["date_echeance_processus"];
            $HTML_processus .= "<br>" . $rows["nom_fta_processus"] . " - " . $return["liste_processus_depasses"][$rows["id_fta_processus"]];
        }
        $HTML_processus = $HTML_processus_begin . $HTML_processus . $HTML_processus_end;
    } else {
        $return["status"] = 0;
        $HTML_processus = "";
    }

    //Recherche du dépassement de la date d'échéance de validation de fta
    $req = "SELECT date_echeance_fta FROM fta WHERE id_fta='" . $id_fta . "' ";
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        $date_echeance_fta = mysql_result($result, 0, "date_echeance_fta");
        if ($date_echeance_fta == "0000-00-00" or $date_echeance_fta == "") {
            $return["status"] = 3;
        } else {
            if ($date_echeance_fta < date("Y-m-d")) {
                $return["status"] = 2;
            }
            $HTML_fta .= $date_echeance_fta;
        }
    } else {
        $return["status"] = 3;
    }

    $return["HTML_synthese"] = $HTML_fta . $HTML_processus;
    return $return;
}

function BuildFtaProcessusValidationDelai($id_fta, $id_fta_processus) {
    /*     * *****************************************************************************
      Contrôle et corrige l'état de validation de l'échéance fixé à un processus
      Si le processus à validé tous ses chapitre, le délai est validé
      Sinon, le délai reste en attente de réalisation

      Retour de la fonction:
      0: Rien n'a été fait car le processus ne dispose pas d'enregistrement d'échéance
      1: Mise à jour effecftuée
     * ***************************************************************************** */

    $id_fta;                                //Identifiant de la FTA à controler
    $id_fta_processus;                      //Identifiant du processus à controler
    $etat_echeance = 0;                       //Contient le taux d'avancement des chapitre (exemple: 100% = 1, 90%=0.9 ...etc)
    $valide_fta_processus_delai = NULL;       //L'échéance est-elle validée ? (Oui=1, Non=0)
    $return = 0;
    $etat_echeance = fta_processus_validation($id_fta, $id_fta_processus);
    switch ($etat_echeance) {
        case 1: //Le processus à validé tous ses chapitres
            $valide_fta_processus_delai = 1;
            break;
        default://Sinon, il reste encore des chapitres à valider
            $valide_fta_processus_delai = 0;
    }

    //Existe-il déjà un enregistrement sur ce délai ?
    //Recherche d'enregistrement déjà existant pour mise à jour, sinon insertion
    $req = "SELECT id_fta_processus_delai, valide_fta_processus_delai FROM fta_processus_delai "
            . "WHERE id_fta='" . $id_fta . "' "
            . "AND id_fta_processus = '" . $id_fta_processus . "' "
    ;
    $result_fta_processus_delai = DatabaseOperation::query($req);
    if (mysql_num_rows($result_fta_processus_delai)) {   //Si l'enregistrement existe, alors mise à jour des informations
        //Si l'état enregistré en différent de celui contrôlé, alors mise à jour
        $valide_fta_processus_delai_recorded = mysql_result($result_fta_processus_delai, 0, "valide_fta_processus_delai");
        if ($valide_fta_processus_delai <> $valide_fta_processus_delai_recorded) {
            //Récupération de l'identifiant pour permettre la mise à jour de celui-ci
            $id_fta_processus_delai = mysql_result($result_fta_processus_delai, 0, "id_fta_processus_delai");
            $req = "UPDATE `fta_processus_delai` "
                    . "SET `valide_fta_processus_delai` = '" . $valide_fta_processus_delai . "' "
                    . "WHERE `id_fta_processus_delai` ='" . $id_fta_processus_delai . "' "
            ;
            DatabaseOperation::query($req);
            $return = 1;
        }
    }
    return $return;
}

/* * ************************************************************************************
  Fonction informe de l'état de validation d'un processus sur une Fiche Technique Article
 * ************************************************************************************ */

function fta_processus_validation($id_fta, $id_fta_processus) {

//echo $id_fta." ";
//echo "TEST";
//Dictionnaire des données
//echo "FTA: ".$id_fta."<br>";
//Corps de la fonction
    //Pour le processus en cours, détermination de nombre de chapitre qu'il contient(total)
//    $req = "SELECT * FROM fta_chapitre, fta_processus "
//            . "WHERE fta_chapitre.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
//            . "AND fta_processus.id_fta_processus=" . $id_fta_processus . " "
//    ;
    $req = "SELECT id_fta_chapitre FROM fta_workflow_structure, fta_processus "
            . "WHERE fta_workflow_structure.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
            . " AND fta_workflow_structure.id_fta_role=fta_processus.id_fta_role "
            . " AND fta_processus.id_fta_processus=" . $id_fta_processus . " "
    ;
    $result_temp = DatabaseOperation::query($req);
    $nombre_total_chapitre_processus = mysql_num_rows($result_temp);

    //Pour chaque processus, détermination de nombre de chapitre qu'il contient(validé)
//    $req = "SELECT * FROM fta, fta_suivi_projet, fta_chapitre, fta_processus "
//            . "WHERE fta.id_fta=fta_suivi_projet.id_fta "                          //Jointure
//            . "AND fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre " //Jointure
//            . "AND fta_chapitre.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
//            . "AND fta.id_fta=" . $id_fta . " "                                        //FTA en cours
//            . "AND fta_suivi_projet.signature_validation_suivi_projet<>0 "         //Chapitre validé
//            . "AND fta_processus.id_fta_processus=" . $id_fta_processus . " "         //Processus en cours de balayage
//    ;
    $req = "SELECT * FROM fta, fta_suivi_projet, fta_workflow_structure, fta_processus "
            . "WHERE fta.id_fta=fta_suivi_projet.id_fta "                          //Jointure
            . "AND fta_suivi_projet.id_fta_chapitre=fta_workflow_structure.id_fta_chapitre " //Jointure
            . "AND fta_workflow_structure.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
            . "AND fta.id_fta=" . $id_fta . " "                                        //FTA en cours
            . "AND fta_suivi_projet.signature_validation_suivi_projet<>0 "         //Chapitre validé
            . "AND fta_processus.id_fta_processus=" . $id_fta_processus . " "         //Processus en cours de balayage
    ;
    $result_temp = DatabaseOperation::query($req);
    $nombre_valide_chapitre_processus = mysql_num_rows($result_temp);

    //Calcul du taux de validation du processus
    $taux_validation_processus = 0;
    if ($nombre_total_chapitre_processus != 0) {
        $taux_validation_processus = $nombre_valide_chapitre_processus / $nombre_total_chapitre_processus;
    }
    //echo $taux_validation_processus."<br>";
    $return = $taux_validation_processus;

    return $return;
}

/* Recherche d'un élément de classification dans une FTA
 * ***************************************************** */

function recherche_element_classification_fta($id_fta, $id_element, $extension) {
    /*
      Dictionnaire des variables:
     */
    $id_fta;     //Identifiant de la Fiche Technique Article
    $id_element; //Identifiant du contenu de la catégorie de la classification à rechercher
    //(cf classification_arborescence_article_categorie_contenu)

    $extension;    //Tableau de variables optionnelles
    $extension[0]; //Si 0, Alors $id_element correspond à un contenu et la fonction retourne les éléments de la classification
    //Si 1, Alors $id_element correspond à une catégorie et la fonction retourne les éléments des contenus
    $return = Lib::isDefined("return");
    $return[0];    //0 ou 1: dit si l'élément a été touvé
    $return[1];    //Retourne la liste des clefs trouvées
    $return[2];    //Retourne la liste des valeurs trouvées
    $sql_where = Lib::isDefined("sql_where");
    $liste_recherche = Lib::isDefined("liste_recherche"); //Liste des éléments trouver dans l'ensemble des chemins


    switch ($extension[0]) {
        case 0:
            $champ_recherche = "classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu";
            break;

        case 1:
            $champ_recherche = "classification_arborescence_article_categorie.id_classification_arborescence_article_categorie";
            break;
    }


    /*
      Corps de la fonction
     */
//echo $id_fta;
    if (!$id_fta) { //L'ID FTA est obligatoire
        return 0;
    }
    //Recherche des chemins de classification de l'Article
    $req = "SELECT id_classification_arborescence_article_categorie_contenu, classification_fta.id_classification_arborescence_article "
            . " FROM classification_fta, classification_arborescence_article "
            . " WHERE id_fta=" . $id_fta
            . " AND classification_fta.id_classification_arborescence_article=classification_arborescence_article.id_classification_arborescence_article "
    ;
    $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if (!$array) {//Vérification de l'existance de chemin de classifications
        //L'article n'a pas de classification
        $titre = "Classification de l'article";
        $message = "Cet article n'a pas de classification";
        $redirection;
        //afficher_message($titre, $message, $redirection);
    } else {
        //Récupération de toutes les classifications
        foreach ($array as $rows) {
            $table = "classification_arborescence_article";
            $champ_valeur = "id_classification_arborescence_article_categorie_contenu";
            $champ_id_fils = "ascendant_classification_arborescence_article_categorie_contenu";
            $champ_id_pere = "id_classification_arborescence_article";
            $id_racine = $rows["id_classification_arborescence_article"];
            $extension;
            $recup = arborescence_construction($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $sql_where, $extension);
            $liste_recherche.=$recup[1];
        }

        //var_dump($liste_recherche);
        //Transformation de la liste de recherche sous forme de tableau
        $tableau_recherche = explode(",", $liste_recherche);

        //Construction de la requête de recherche
        $req = "SELECT * "
                . "FROM classification_arborescence_article, classification_arborescence_article_categorie, classification_arborescence_article_categorie_contenu "
                . "WHERE classification_arborescence_article_categorie.id_classification_arborescence_article_categorie=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie "
                . "AND classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
                . "AND $champ_recherche=$id_element "
                . "AND "
        ;
        //Intégration dans la reqûete les éléments trouvés
        $tableau_recherche;
        $first_OR = 0;
        foreach ($tableau_recherche as $id_classification_arborescence_article) {
            if ($first_OR) {
                $req .= "OR ";
            } else {
                $req .= "( ";
            }
            $req .="classification_arborescence_article.id_classification_arborescence_article=$id_classification_arborescence_article ";
            $first_OR = 1;
        }
        $req .= ") ";

        //Recupération des données
        $result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        //echo $req;
        //Si il y a des résultat
        if ($result) {
            //Il y a au moins 1 résultat
            $return[0] = 1;

            $virg_enable = 0;
            $return[1] = "";
            $return[2] = "";
            foreach ($result as $rows) {
                if ($rows["id_classification_arborescence_article_categorie_contenu"] <> 0) {
                    if ($virg_enable) {
                        $virg = ",";
                    } else {
                        $virg_enable = 1;
                    }
                    $return[1].=$virg . $rows["id_classification_arborescence_article_categorie_contenu"];
                    $return[2].=$virg . $rows["nom_classification_arborescence_article_categorie_contenu"];
                }
            }
        } else {
            //Pas d'occurence
            $return[0] = 0;
        }
    }//Fin de la vérification de l'existance de chemin de classification de l'article


    return $return;
}

//Fin de la fonction



/* Suppression d'une nomenclature avec toutes ses sous-recettes
 * ************************************************************ */

function DEPRECATED_recette_nomenclature_suppression($id_fta_nomenclature) {
    /*
      Dictionnaire des variables:
     */

    $id_fta_nomenclature;                //Valeur obligatoire pour la suppression
    $id_fta_nomenclature_save = $id_fta_nomenclature; //Sauvegarde de la clef pour utilisation à la fin du Script
    /*
      Corps de la fonction
     */

    //Recherche des sous-recettes
    $req = "SELECT id_fta_nomenclature "
            . "FROM fta_nomenclature "
            . "WHERE ascendant_fta_nomenclature=$id_fta_nomenclature "
    ;

    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num) {
        //Parcours des sous-recettes
        while ($rows = mysql_fetch_array($result)) {
            //Préparation des variables
            $id_fta_nomenclature = $rows["id_fta_nomenclature"];

            //Appel recursif de la fonction
            $id_fta_nomenclature;
            $operation;
            recette_nomenclature_suppression($id_fta_nomenclature);
        }
    }

    //Restauration de la clef initiale
    $_SESSION["id_fta_nomenclature"] = $id_fta_nomenclature_save;

    //Suppression des composants associés
    mysql_table_load("fta_nomenclature");
    $_SESSION["id_fta_composition"];
    mysql_table_operation("fta_composition", "delete");

    //Suppression du composant associé
    $req = "DELETE FROM fta_composition WHERE id_fta_nomenclature='" . $_SESSION["id_fta_nomenclature"] . "' ";
    DatabaseOperation::query($req);

    //Suppression de la nomenclature
    mysql_table_operation("fta_nomenclature", "delete");


    return $id_fta_nomenclature;
}

//Fin de la fonction


/* Ajout des recettes dans la nomenclature et dans les composants
 * ************************************************************** */

function DEPRECATED_recette_nomenclature_ajout($id_access_recette_recette, $id_fta, $ascendant_fta_nomenclature) {
    /*
      Dictionnaire des variables:
     */

    $id_fta_nomenclature;                //Valeur obligatoire pour la suppression
    $id_access_recette_recette;          //Valeur obligatoire pour l'insertion
    $id_fta;                             //Valeur obligatoire pour l'insertion
    $ascendant_fta_nomenclature;         //Nomenclature sur laquelle attacher cette nomeclature

    /*
      Corps de la fonction
     */

    //Récupération des données recettes pour intégration de la nomenclature
    $id_access_recette_recette;
    mysql_table_load("access_recettes_recette");
    mysql_table_load("fta");
    mysql_table_load("access_arti2");

    //Controle des données
    if (recette_racine($id_access_recette_recette) and ! $_SESSION["liste_ingredient_defaut"]) {
        $titre = "Répartition des Ingrédients Manquante";
        $message = "Veuillez éditer la répartition des ingrédients pour que cette recette soit utilisable dans l'Intranet";
        $redirection = "ajout_recette.php";
        afficher_message($titre, $message, $redirection);
        $err = 1;
    } else {
        //Valeur par défaut
        $_SESSION["nom_fta_nomenclature"] = $_SESSION["INTITULE_RECETTE"];
        $_SESSION["poids_fta_nomenclature"] = $_SESSION["POIDS_TOTAL"];
        //$_SESSION["id_annexe_unite"] = $_SESSION["Unité"];
        $_SESSION["site_production_fta_nomenclature"] = $_SESSION["Site_de_production"];
        //$_SESSION["environnement_conservation_fta_nomenclature"]=$_SESSION["etat_access_recettes_recette"];
        $_SESSION["quantite_piece_par_carton"] = 1;


        //Dans le cas d'une Recette Racine
        if (recette_racine($id_access_recette_recette)) {
            //Ajout du composant associé ainsi que ses valeurs par défaut
            //Valeur par défaut
            $_SESSION["ingredient_fta_composition"] = $_SESSION["liste_ingredient_defaut"];
            $_SESSION["nom_fta_composition"] = $_SESSION["nom_fta_nomenclature"];
            $_SESSION["id_geo"] = $_SESSION["site_production_fta_nomenclature"];
            $_SESSION["poids_fta_composition"] = $_SESSION["poids_fta_nomenclature"];
            $_SESSION["quantite_fta_composition"] = "1";
            $_SESSION["code_produit_agrologic_fta_nomenclature"] = $_SESSION["N_INFOLOGIC"];

            //Ajout
            $_SESSION["id_fta_composition"] = "";
            mysql_table_operation("fta_composition", "insert");
        }

        //Insertion de la recette dans la nomenclature
        $id_fta;
        $id_access_recette_recette;
        $_SESSION["id_fta_nomenclature"] = 0;
        $ascendant_fta_nomenclature;
        mysql_table_operation("fta_nomenclature", "insert");
        $id_fta_nomenclature = $_SESSION["id_fta_nomenclature"];

        //Nettoyage des variables globales
        $_SESSION["code_produit_agrologic_fta_nomenclature"] = "";

        //Dans le cas d'une Recette Racine
        if (recette_racine($id_access_recette_recette)) {

            //Préparation du rattachement des sous-recettes à cette nomenclature
            $_SESSION["ascendant_fta_nomenclature"] = $id_fta_nomenclature;
        }

        //Récupération de l'ascendant de global
        $ascendant_fta_nomenclature = $_SESSION["ascendant_fta_nomenclature"];

        //Recherche des sous-recettes
        $req = "SELECT descendant_access_recette_recette "
                . "FROM access_recettes_composition "
                . "WHERE id_access_recette_recette=$id_access_recette_recette "
        ;

        $result = DatabaseOperation::query($req);
        $num = mysql_num_rows($result);
        if ($num) {
            //Parcours des sous-recettes
            while ($rows = mysql_fetch_array($result)) {
                //Préparation des variables
                $_SESSION["id_access_recette_recette"] = $rows["descendant_access_recette_recette"];
                $id_access_recette_recette = $_SESSION["id_access_recette_recette"];
                $id_fta;

                //Appel recursif de la fonction
                $id_fta_nomenclature;
                $operation;
                recette_nomenclature_ajout($id_access_recette_recette, $id_fta, $ascendant_fta_nomenclature);
            }
        }

        return $id_fta_nomenclature;
    }//Fin du controle de cohérence
}

//Fin de la fonction


/* La recette est-elle une recette racine ou est-elle une sous-recette ?
 * ********************************************************************* */

function recette_racine($id_access_recette_recette) {
    /*
      Dictionnaire des variables:
     */

    /*
      Corps de la fonction
     */

    $req = "SELECT id_access_recette_recette "
            . "FROM access_recettes_composition "
            . "WHERE descendant_access_recette_recette=$id_access_recette_recette "
    ;
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num) {
        //Cette recette est une sous-recette
        return 0;
    } else {
        //Cette recette est une recette racine
        return 1;
    }
}

/* Affiche le chemin d'une classification
 * ************************************* */








/* Calcul toutes les informations de poids et dimension de l'emballage de la fiche technique
 * **************************************************************************************** */

function calcul_palettisation_fta($id_fta) {

    /*
      Valeurs de retours de la fonction:
     */
    //Emballages
    $return["uvc_emballage"] = 0;        //Poids de l'emballage contenu dans une UVC
    $return["colis_emballage"] = 0;      //Poids de l'emballage contenu dans un Colis
    $return["palette_emballage"] = 0;    //Poids de l'emballage contenu dans une Palette
    //Poids net
    $return["uvc_net"];
    $return["colis_net"];
    $return["palette_net"];

    //Poids brut
    $return["uvc_brut"];
    $return["colis_brut"];
    $return["palette_brut"];

    //Palettisation
    $return["pcb"];
    $return["hauteur_colis"];
    $return["hauteur_palette"];
    $return["couche_palette"];        //Combien de couche par palette
    $return["colis_couche"];          //Combien de colis par couche
    $return["total_colis"];
    $return["dimension_uvc"];         //H x L x l
    $return["dimension_colis"];
    $return["dimension_palette"];
    $return["dimension_uvc_hauteur"] = 0;       //Hauteur en mm
    $return["dimension_uvc_longueur"] = 0;      //Longueur en mm
    $return["dimension_uvc_largeur"] = 0;       //Hauteur en mm


    /*
      Dictionnaire des variables:
     */
    $id_fta;      //Identifiant de la fiche technique Article
    //$palettisation_2_3_3 = calcul_palettisation_fta_2_3_3($id_fta);         //Ancienne Données

    /*
      Corps de la fonction
     */

    //PCB
    $return["pcb"] = $temp_nb_uvc_dans_colis;
    if (!$return["pcb"]) {
        $req = "SELECT NB_UNIT_ELEM FROM fta WHERE id_fta='" . $id_fta . "' ";
        $result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        foreach ($result as $value) {
            $NB_UNIT_ELEM = $value["NB_UNIT_ELEM"];
        }
        $return["pcb"] = $NB_UNIT_ELEM;
    }

    //Calcul du poids et dimension de Emballages par UVC (Type 1)
    $id_annexe_emballage_groupe_type = 1;
    $description_annexe_emballage_groupe_type = "uvc_emballage";

    $req = "SELECT * "
            . " FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . " WHERE id_fta=" . $id_fta
            . " AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . $id_annexe_emballage_groupe_type
            . " AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . " AND ( "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . " OR "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . "    ) "
            . " ORDER BY nom_annexe_emballage_groupe_type "
    ;
    $arrayType1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if ($arrayType1) {
        foreach ($arrayType1 as $rows) {
            //Calcul du poids
            $return["$description_annexe_emballage_groupe_type"]+=$rows["poids_fta_conditionnement"] * $rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"];

            //Calcul des dimension (on recherche la taille la plus grande
            if ($return["dimension_uvc_hauteur"] < $rows["hauteur_fta_conditionnement"]) {
                $return["dimension_uvc_hauteur"] = $rows["hauteur_fta_conditionnement"];
            }
            if ($return["dimension_uvc_longueur"] < $rows["longueur_fta_conditionnement"]) {
                $return["dimension_uvc_longueur"] = $rows["longueur_fta_conditionnement"];
            }
            if ($return["dimension_uvc_largeur"] < $rows["largeur_fta_conditionnement"]) {
                $return["dimension_uvc_largeur"] = $rows["largeur_fta_conditionnement"];
            }
        }
        //$return["dimension_uvc"]=$return["dimension_uvc_hauteur"]."x".$return["dimension_uvc_longueur"]."x".$return["dimension_uvc_largeur"];
        $return["dimension_uvc"] = $return["dimension_uvc_longueur"] . "x" . $return["dimension_uvc_largeur"];

        //Si la hauteur n'est pas nulle, on l'intègre.
        if ($return["dimension_uvc_hauteur"]) {
            $return["dimension_uvc"] = $return["dimension_uvc"] . "x" . $return["dimension_uvc_hauteur"];
        }
    } else {
        //Tentative de récupération des données au format version 2.3.3
        //$return["dimension_uvc"]=$palettisation_2_3_3["dimension_uvc"];
        //$return["$description_annexe_emballage_groupe_type"]=$palettisation_2_3_3["uvc_emballage"];
    }

    //echo   "Emballage dans l'UVC: ".$return["$description_annexe_emballage_groupe_type"]."<br>";
    //Calcul du poids de Emballages par Colis (Type 2)
    $id_annexe_emballage_groupe_type = 2;
    $description_annexe_emballage_groupe_type = "colis_emballage";

    /* $req = "SELECT * "
      . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
      . "WHERE id_fta=$id_fta "
      . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=$id_annexe_emballage_groupe_type "
      . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
      . "AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
      . "ORDER BY nom_annexe_emballage_groupe_type "
      ;
     */
    $req = "SELECT * "
            . " FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . " WHERE id_fta=" . $id_fta
            . " AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . $id_annexe_emballage_groupe_type
            . " AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . " AND ( "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . " OR "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . "    ) "
            . " ORDER BY nom_annexe_emballage_groupe_type "
    ;

    $arrayType2 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if ($arrayType2) {
        foreach ($arrayType2 as $rows) { {
                $return["$description_annexe_emballage_groupe_type"]+=$rows["poids_fta_conditionnement"] * $rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"];
            }
        }
    } else {
        //Tentative de récupération des données au format version 2.3.3
        //$return["$description_annexe_emballage_groupe_type"]=$palettisation_2_3_3["$description_annexe_emballage_groupe_type"];
    }
    //echo   "Emballage dans le colis (sans l'UVC): ".$return["$description_annexe_emballage_groupe_type"]."<br>";
    //$return["$description_annexe_emballage_groupe_type"]+=$return["uvc_emballage"];
    $return["$description_annexe_emballage_groupe_type"]+=$return["uvc_emballage"] * $return["pcb"];

    //Ajout de l'emballage du Colis (Type 3)
    $id_annexe_emballage_groupe_type = 3;
    $description_annexe_emballage_groupe_type = "colis_emballage";

    /* $req = "SELECT * "
      . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
      . "WHERE id_fta=$id_fta "
      . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=$id_annexe_emballage_groupe_type "
      . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
      . "AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
      . "ORDER BY nom_annexe_emballage_groupe_type "
      ;
     */
    $req = "SELECT * "
            . " FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . " WHERE id_fta=" . $id_fta
            . " AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . $id_annexe_emballage_groupe_type
            . " AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . " AND ( "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . " OR "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . "    ) "
            . " ORDER BY nom_annexe_emballage_groupe_type "
    ;

    $arrayType3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if (count($arrayType3) > 1) {
        $titre = "Cas non géré";
        $message = "Il ne doit y avoir qu'un seul emballage Colis";
        afficher_message($titre, $message, $redirection);
    } else {
        //Il ne doit exister qu'un seul emballage Colis
        if ($arrayType3) {

            foreach ($arrayType3 as $rows) {
//echo   "Emballage du colis: ".$rows["poids_fta_conditionnement"]."<br>";
//echo   "Emballage du colis: ".$return["colis_emballage"]."<br>";
//echo $return["colis_emballage"];
                $return["hauteur_colis"] = $rows["hauteur_fta_conditionnement"];
                $return["colis_emballage"]+=$rows["poids_fta_conditionnement"];
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $temp_nb_colis_dans_palette = $return["couche_palette"] * $return["colis_couche"];
                $hauteur_total_palette = $rows["hauteur_fta_conditionnement"] * $return["couche_palette"];

                if ($rows["old_dim"]) {
                    $return["dimension_colis"] = $rows["old_dim"];
                } else {
                    $return["dimension_colis"] = $rows["longueur_fta_conditionnement"]
                            . "x"
                            . $rows["largeur_fta_conditionnement"]
                            . "x"
                            . $rows["hauteur_fta_conditionnement"]
                            . " mm"
                    ;
                }
            }

            $return["colis_emballage"]+=$return["uvc_emballage"] * $temp_nb_uvc_dans_colis;
            $return["total_colis"] = $temp_nb_colis_dans_palette;
        } else {
            //Tentative de récupération des données au format version 2.3.3
            /* $return["$description_annexe_emballage_groupe_type"]=$palettisation_2_3_3["$description_annexe_emballage_groupe_type"];
              $return["hauteur_colis"]=$palettisation_2_3_3["hauteur_colis"];
              $return["total_colis"]=$palettisation_2_3_3["total_colis"];
              $temp_nb_colis_dans_palette=$return["total_colis"];

              $return["couche_palette"]=$palettisation_2_3_3["couche_palette"];
              $return["colis_couche"]=$palettisation_2_3_3["colis_couche"]; */
        }
    }
    //echo   "Emballage total du colis: ".$return["$description_annexe_emballage_groupe_type"]."<br>";
    //Calcul du poids des emballages d'une Palette
    $id_annexe_emballage_groupe_type = 4;
    $description_annexe_emballage_groupe_type = "palette_emballage";
    /* $req = "SELECT * "
      . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
      . "WHERE id_fta=$id_fta "
      . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=$id_annexe_emballage_groupe_type "
      . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
      . "AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
      . "ORDER BY nom_annexe_emballage_groupe_type "
      ;
     */
    $req = "SELECT * "
            . " FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . " WHERE id_fta=" . $id_fta
            . " AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . $id_annexe_emballage_groupe_type
            . " AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . " AND ( "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . " OR "
            . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
            . "    ) "
            . " ORDER BY nom_annexe_emballage_groupe_type "
    ;

    $arrayType4 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if (count($arrayType4) > 1) {
        $titre = "Cas non géré";
        $message = "Il ne doit y avoir qu'une seule Palette";
        afficher_message($titre, $message, $redirection);
    } else {
        //Il ne doit exister qu'une seule Palette
        if ($arrayType4) {
            foreach ($arrayType4 as $rows) {
                $return["palette_emballage"]+=($rows["poids_fta_conditionnement"] / 1000); //Converstion de gramme en Kilo
                $return["dimension_palette"] = $rows["longueur_fta_conditionnement"]
                        . "x"
                        . $rows["largeur_fta_conditionnement"]
                        . "x"
                        . $rows["hauteur_fta_conditionnement"]
                        . " mm"
                ;
                $hauteur_palette = $rows["hauteur_fta_conditionnement"];
            }
            $return["palette_emballage"]+=($return["colis_emballage"] / 1000) * $temp_nb_colis_dans_palette; //Conversion gramme vers Kilo
        } else {
            //Tentative de récupération des données au format version 2.3.3
            //$return["palette_emballage"]=$palettisation_2_3_3["palette_emballage"];
            //$return["dimension_palette"]=$palettisation_2_3_3["dimension_palette"];
        }
    }

    //Calcul des poids net
    $ftaModel = new FtaModel($id_fta);
    $return["uvc_net"] = $ftaModel->getDataField("Poids_ELEM")->getFieldValue() * 1000;        //Conversion de Kg en Gramme
    //Le calcul du poids net colis est fonction de la composition colis
    //$return["colis_net"]=$return["pcb"] * $return["uvc_net"] / 1000;      //Conversion de g en Kg
    $return["colis_net"] = calcul_poids_net_colis($id_fta);
    $return["palette_net"] = $return["colis_net"] * $temp_nb_colis_dans_palette;

    //Poids brut
    $return["uvc_brut"] = $return["uvc_net"] + $return["uvc_emballage"];
    $return["colis_brut"] = $return["colis_net"] + ($return["colis_emballage"] / 1000);
    $return["palette_brut"] = $return["palette_net"] + $return["palette_emballage"];

    //Palettisation
    //Hauteur palette
    $hauteur_total_palette = $hauteur_total_palette + $hauteur_palette;
    $return["hauteur_palette"] = $hauteur_total_palette / 1000;


    return $return;
}

/* Calcul du poids total de l'emballage de la fiche technique
 * ********************************************************* */

function DEPRECATED_calcul_palettisation_fta_2_3_3($id_fta) {

    /*
      Valeurs de retours de la fonction:
     */
    //Emballages
    $return["uvc_emballage"] = 0;        //Poids de l'emballage contenu dans une UVC
    $return["colis_emballage"] = 0;      //Poids de l'emballage contenu dans un Colis
    $return["palette_emballage"] = 0;    //Poids de l'emballage contenu dans une Palette
    //Poids net
    $return["uvc_net"];
    $return["colis_net"];
    $return["palette_net"];

    //Poids brut
    $return["uvc_brut"];
    $return["colis_brut"];
    $return["palette_brut"];

    //Palettisation
    $return["pcb"];
    $return["hauteur_colis"];
    $return["hauteur_palette"];
    $return["couche_palette"];        //Combien de couche par palette
    $return["colis_couche"];          //Combien de colis par couche
    $return["total_colis"];
    $return["dimension_uvc"];
    $return["dimension_colis"];
    $return["dimension_palette"];


    /*
      Dictionnaire des variables:
     */
    $id_fta;      //Identifiant de la fiche technique Article


    /*
      Corps de la fonction
     */

    //Calcul du poids de tout les emballages Primaires
    $req = "SELECT * "
            . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . "WHERE id_fta=$id_fta "
            . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type<=2 "
            . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . "AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
            . "ORDER BY nom_annexe_emballage_groupe_type "
    ;

    $result = DatabaseOperation::query($req);
    while ($rows = mysql_fetch_array($result)) {
        //if($rows["dimension_uvc_fta_confitionnement"])
        //Calcul des dimension (on recherche la taille la plus grande)
        if ($return["dimension_uvc_hauteur"] < $rows["hauteur_fta_conditionnement"]) {
            $return["dimension_uvc_hauteur"] = $rows["hauteur_fta_conditionnement"];
        }
        if ($return["dimension_uvc_longueur"] < $rows["longueur_fta_conditionnement"]) {
            $return["dimension_uvc_longueur"] = $rows["longueur_fta_conditionnement"];
        }
        if ($return["dimension_uvc_largeur"] < $rows["largeur_fta_conditionnement"]) {
            $return["dimension_uvc_largeur"] = $rows["largeur_fta_conditionnement"];
        }

        $return["uvc_emballage"]+=$rows["poids_fta_conditionnement"] * $rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"];

        $temp_nb_uvc_dans_colis = $rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"];
    }
    $return["dimension_uvc"] = $return["dimension_uvc_hauteur"]
            . "x"
            . $return["dimension_uvc_longueur"]
            . "x"
            . $return["dimension_uvc_largeur"]
            . " mm";


    //Calcul du poids des emballages d'un Colis
    $req = "SELECT * "
            . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . "WHERE id_fta=$id_fta "
            . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=3 "
            . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . "AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
            . "ORDER BY nom_annexe_emballage_groupe_type "
    ;
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result) > 1) {
        $titre = "Cas non géré";
        $message = "Il ne doit y avoir qu'un seul emballage Colis";
        afficher_message($titre, $message, $redirection);
    } else {
        //Il ne doit exister qu'un seul emballage Colis
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                $return["hauteur_colis"] = mysql_result($result, 0, "hauteur_fta_conditionnement");
                $return["colis_emballage"]+=$rows["poids_fta_conditionnement"];
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $temp_nb_colis_dans_palette = $return["couche_palette"] * $return["colis_couche"];
                if ($rows["old_dim"]) {
                    $return["dimension_colis"] = $rows["old_dim"];
                } else {
                    $return["dimension_colis"] = $rows["longueur_fta_conditionnement"]
                            . "x"
                            . $rows["largeur_fta_conditionnement"]
                            . "x"
                            . $rows["hauteur_fta_conditionnement"]
                            . " mm"
                    ;
                }
            }
        }
    }
    $return["colis_emballage"]+=$return["uvc_emballage"] * $temp_nb_uvc_dans_colis;
    $return["total_colis"] = $temp_nb_colis_dans_palette;
    //PCB
    $return["pcb"] = $temp_nb_uvc_dans_colis;
    if (!$return["pcb"]) {
        $req = "SELECT * FROM access_arti2 WHERE id_fta='" . $id_fta . "' ";
        $result = DatabaseOperation::query($req);
        $NB_UNIT_ELEM = mysql_result($result, 0, "NB_UNIT_ELEM");
        $return["pcb"] = $NB_UNIT_ELEM;
    }
    //Calcul du poids des emballages d'une Palette
    $req = "SELECT * "
            . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type "
            . "WHERE id_fta=$id_fta "
            . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=4 "
            . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
            . "AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type "
            . "ORDER BY nom_annexe_emballage_groupe_type "
    ;
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result) > 1) {
        $titre = "Cas non géré";
        $message = "Il ne doit y avoir qu'une seule Palette";
        afficher_message($titre, $message, $redirection);
    } else {
        //Il ne doit exister qu'unune seule Palette
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                $return["palette_emballage"]+=($rows["poids_fta_conditionnement"] / 1000); //Converstion de gramme en Kilo
                $return["dimension_palette"] = $rows["longueur_fta_conditionnement"]
                        . "x"
                        . $rows["largeur_fta_conditionnement"]
                        . "x"
                        . $rows["hauteur_fta_conditionnement"]
                        . " mm"
                ;
            }
        }
    }
    $return["palette_emballage"]+=($return["colis_emballage"] / 1000) * $temp_nb_colis_dans_palette; //Conversion gramme vers Kilo
    //Calcul des poids net
    $req = "SELECT * FROM access_arti2 WHERE id_fta=$id_fta";
    $result = DatabaseOperation::query($req);
    $return["uvc_net"] = mysql_result($result, 0, "Poids_ELEM") * 1000;        //Conversion de Kg en Gramme
    //Le calcul du poids net colis est fonction de la composition colis
    //$return["colis_net"]=$return["pcb"] * $return["uvc_net"] / 1000;      //Conversion de g en Kg
    $return["colis_net"] = calcul_poids_net_colis($id_fta);
    $return["palette_net"] = $return["colis_net"] * $temp_nb_colis_dans_palette;

    //Poids brut
    $return["uvc_brut"] = $return["uvc_net"] + $return["uvc_emballage"];
    $return["colis_brut"] = $return["colis_net"] + ($return["colis_emballage"] / 1000);
    $return["palette_brut"] = $return["palette_net"] + $return["palette_emballage"];

    //Palettisation
    //Hauteur palette
    $req = "SELECT * "
            . "FROM fta_conditionnement, annexe_emballage_groupe "
            . "WHERE id_annexe_emballage_groupe_configuration=4 "
            . "AND id_fta=$id_fta "
            . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
    ;
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        //$hauteur_total_palette=mysql_result($result, 0, "old_hauteur_palette");
        if ($hauteur_total_palette) {
            //Conversion en mètre
            if ($hauteur_total_palette > 1000) {
                $hauteur_total_palette = $hauteur_total_palette / 1000;
            }
            if ($hauteur_total_palette > 100) {
                $hauteur_total_palette = $hauteur_total_palette / 100;
            }
            if ($hauteur_total_palette > 10) {
                $hauteur_total_palette = $hauteur_total_palette / 10;
            }
        } else {
            $hauteur_palette = mysql_result($result, 0, "hauteur_fta_conditionnement");
            $hauteur_total_palette = ($hauteur_palette + $return["hauteur_colis"] * $return["couche_palette"]) / 1000;
        }
        //$poids_palette=mysql_result($result, 0, "poids_fta_conditionnement");
    }
    $return["hauteur_palette"] = $hauteur_total_palette;



    return $return;
}

/* * ******************************************************* */
/* Fonction mail_prevention                               */
/* Envoi des mails pour prevenir les gens concernes       */
/* qu'une fiche technique a ete modifiee ou creee         */
/* * ******************************************************* */


/* * ******************************************************* */
/* Fonction mail_prevention                               */
/* Envoi des mails pour prevenir les gens concernes       */
/* qu'une fiche technique a ete modifiee ou creee         */
/* * ******************************************************* */

function mail_prevention($action, $numft, $id_user) {
    //$action : titre repris dans l'objet du message
    //$numft  : fiche technique concernée
    //$id_user: utilisateur destinataire du mail
    $reqmailfrom = "select mail from salaries where id_user='$id_user'";
    $adrenvois = DatabaseOperation::query($reqmailfrom);
    $adrfrom = mysql_result($adrenvois, 0, mail);

    // récupération d'information complémentaire à la fiche
    //$req ="select * from infog where numft='$numft'";

    $req = "select gamdesc, segdesc, nomprod_interne, infologic from infog, segment, gamme
            where infog.numgam = gamme.numgam
            and infog.numseg = segment.numseg
            and numft='$numft'";

    $result = DatabaseOperation::query($req);

    $code_infologic = mysql_result($result, 0, infologic);
    $nomprod_interne = mysql_result($result, 0, nomprod_interne);
    $gamdesc = mysql_result($result, 0, gamdesc);
    $segdesc = mysql_result($result, 0, segdesc);

    $corpsmail = "Bonjour, \n\n";

    switch ($action) {
        case 'Creation de fiche identite produit': {
                $corpsmail.="Une fiche identité vient d'être créée. \n\n";
                $corpsmail.="Gamme   : $gamdesc \n";
                $corpsmail.="Segment : $segdesc\n";
                $corpsmail.="Nom     : $nomprod_interne. (N° de fiche $numft)\n\n";
                break;
            }

        case 'Creation de fiche technique': {
                $corpsmail.="Une fiche technique vient d'être créée.";
                $corpsmail.=" Son code infologic est le n° $code_infologic. (N° $numft)\n\n";
                break;
            }

        case '': {
                $corpsmail.="Une fiche technique vient d'être modifiée.";
                $corpsmail.=" Son code infologic est le n° $code_infologic. (N° $numft)\n\n";
                $corpsmail.="Merci de procéder à sa vérification.";
                break;
            }
    }

    /* recherche des personnes a contacter sur le critere de localisation */
    $initiale = decoupe_numft($numft);
    $req = "select id_geo from geo where lettre ='$initiale[1]'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $id_geo = mysql_result($result, 0, id_geo);
        /* recherche des personnes qui ont le droit d'ecriture sur les FT */
        //    $req="select distinct mail from salaries, droitft where lieu_geo='$id_geo' and ecritureft<>'non' and droitft.id_user=salaries.id_user";
        //maj 2007-08-13 sm mise en commentaire de la req suivante et rajout du critère actif = oui pour filtrer les salariés
        // $req="select distinct mail from salaries, droitft, ftdiff where id_geo='$id_geo' and ecritureft<>'non' and ftdiff.id_user=salaries.id_user and salaries.id_user=droitft.id_user";
        $req = "select distinct mail from salaries, droitft, ftdiff where id_geo='$id_geo' and actif ='oui' and ecritureft<>'non' and ftdiff.id_user=salaries.id_user and salaries.id_user=droitft.id_user";

        $result = DatabaseOperation::query($req);
        $num = mysql_num_rows($result);
        if ($num != 0) {
            $i = 0;
            while ($i < $num) {
                $adrTo = mysql_result($result, $i, mail);
                $adrfrom = "postmaster@agis-sa.fr";
                //$rep=envoismail($action,$corpsmail,$adrTo,$adrfrom);
                //        $rep= mail($adrTo, $action, $corpsmail, $entetemail);

                $i++;
            }
        }
    }
}

;

/* * ******************************************************* */
/* Fonction verif_plein.                                  */
/* Pour un numéro de fiche donne on regarde dans toutes   */
/* les tables si les champs obligatoires sont remplis     */
/* * ******************************************************* */

function verif_plein($numft) {
    $nb = 0;
    /* Table INFOG */
    $req = "select * from infog where numft='$numft'";
    $result = DatabaseOperation::query($req);

    if ($result != false) {
        $numgam = mysql_result($result, 0, numgam);
        $numseg = mysql_result($result, 0, numseg);
        $siteorig = mysql_result($result, 0, siteorig);
        $nomprod = mysql_result($result, 0, nomprod);
        $infologic = mysql_result($result, 0, infologic);
        $infodesc = mysql_result($result, 0, infodesc);
        $poids = mysql_result($result, 0, poids);
        $gencod = mysql_result($result, 0, gencod);
        $condition = mysql_result($result, 0, condition);
        $vieclt = mysql_result($result, 0, vieclt);
        $vietech = mysql_result($result, 0, vietech);
        $agrcee = mysql_result($result, 0, agrcee);
        $transfr = mysql_result($result, 0, transfr);
        $siteass = mysql_result($result, 0, siteass);
        $siteexp = mysql_result($result, 0, siteexp);

        if ($numgam == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : num&eacutero de la gamme';
            $nb++;
        }
        if ($numseg == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : num&eacutero du segment';
            $nb++;
        }
        if ($siteorig == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : site d\'origine';
            $nb++;
        }
        if ($nomprod == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : nom du produit';
            $nb++;
        }
        if ($infologic == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : num&eacutero infologic';
            $nb++;
        }
        if ($infodesc == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : description du produit';
            $nb++;
        }
        if ($poids == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : poids';
            $nb++;
        }
        if ($gencod == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : gencod';
            $nb++;
        }
        if ($condition == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : condition';
            $nb++;
        }
        if ($vieclt == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : dur&eacutee de vie chez le client';
            $nb++;
        }
        if ($vietech == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : dur&eacutee de vie technique';
            $nb++;
        }
        if ($agrcee == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : agr&eacuteement CEE';
            $nb++;
        }
        if ($transfr == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : transformation en france';
            $nb++;
        }
        if ($siteass == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : site d\'assemblage';
            $nb++;
        }
        if ($siteexp == null) {
            $ok[$nb] = 'Information g&eacuten&eacuterales : site d\'exp&eacutedition';
            $nb++;
        }
    }

    /* Table COMPOS */
    $req = "select * from compos where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);

    if ($num != 0) {
        $nomcompos = mysql_result($result, 0, nomcompos);
        $siteprod = mysql_result($result, 0, siteprod);
        $ingredient = mysql_result($result, 0, ingredient);
        $poids = mysql_result($result, 0, poids);
        $poidsmeo = mysql_result($result, 0, poidsmeo);
        $nbportion = mysql_result($result, 0, nbportion);

        if ($nomcompos == null) {
            $ok[$nb] = 'Composition : nom du composant';
            $nb++;
        }
        if ($siteprod == null) {
            $ok[$nb] = 'Composition : site de production';
            $nb++;
        }
        if ($ingredient == null) {
            $ok[$nb] = 'Composition : ingr&eacutedient';
            $nb++;
        }
        if ($poids == null) {
            $ok[$nb] = 'Composition : poids';
            $nb++;
        }
        if ($poidsmeo == null) {
            $ok[$nb] = 'Composition : poids de mise en oeuvre';
            $nb++;
        }
        if ($nbportion == null) {
            $ok[$nb] = 'Composition : nombre de portion';
            $nb++;
        }
    } else {
        $ok[$nb] = 'Composition : nom du composant';
        $nb++;
        $ok[$nb] = 'Composition : site de production';
        $nb++;
        $ok[$nb] = 'Composition : ingr&eacutedient';
        $nb++;
        $ok[$nb] = 'Composition : poids';
        $nb++;
        $ok[$nb] = 'Composition : poids de mise en oeuvre';
        $nb++;
        $ok[$nb] = 'Composition : nombre de portion';
        $nb++;
    }
    /* Table CONSERV */
    $req = "select * from conserv where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);

    if ($num != 0) {
        $tempera = mysql_result($result, 0, tempera);
        $typecons = mysql_result($result, 0, typecons);
        $conseil = mysql_result($result, 0, conseil);

        if ($tempera == null) {
            $ok[$nb] = 'Conservation : temp&eacuterature';
            $nb++;
        }
        if ($typecons == null) {
            $ok[$nb] = 'Conservation : type de conservation';
            $nb++;
        }
        if ($conseil == null) {
            $ok[$nb] = 'Conservation : conseil';
            $nb++;
        }
    } else {
        $ok[$nb] = 'Conservation : temp&eacuterature';
        $nb++;
        $ok[$nb] = 'Conservation : type de conservation';
        $nb++;
        $ok[$nb] = 'Conservation : conseil';
        $nb++;
    }
    /* Table PALET */
    $req = "select * from palet where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);

    if ($num != 0) {
        $dimext = mysql_result($result, 0, dimext);
        $nbpiece = mysql_result($result, 0, nbpiece);
        $poidbrut = mysql_result($result, 0, poidbrut);
        $nbcouche = mysql_result($result, 0, nbcouche);
        $nbtotal = mysql_result($result, 0, nbtotal);
        $dimpal = mysql_result($result, 0, dimpal);
        $hautpal = mysql_result($result, 0, hautpal);
        $poidbrutpal = mysql_result($result, 0, poidbrutpal);
        $picking = mysql_result($result, 0, picking);
        $dimbarq = mysql_result($result, 0, dimbarq);
        $poidnet = mysql_result($result, 0, poidnet);
        $nbcouchepal = mysql_result($result, 0, nbcouchepal);
        $poidnetpal = mysql_result($result, 0, poidnetpal);

        if ($dimext == null) {
            $ok[$nb] = 'Palettisation : dimension ext&eacuterieur du carton';
            $nb++;
        }
        if ($nbpiece == null) {
            $ok[$nb] = 'Palettisation : nombre de pi&egravece par carton';
            $nb++;
        }
        if ($poidbrut == null) {
            $ok[$nb] = 'Palettisation : poids brut du carton';
            $nb++;
        }
        if ($nbcouche == null) {
            $ok[$nb] = 'Palettisation : nombre de carton par couche';
            $nb++;
        }
        if ($nbtotal == null) {
            $ok[$nb] = 'Palettisation : nombre de carton par palette';
            $nb++;
        }
        if ($dimpal == null) {
            $ok[$nb] = 'Palettisation : dimensions de la palette bois';
            $nb++;
        }
        if ($hautpal == null) {
            $ok[$nb] = 'Palettisation : hauteur de la palette';
            $nb++;
        }
        if ($poidbrutpal == null) {
            $ok[$nb] = 'Palettisation : poids brut de la palette';
            $nb++;
        }
        if ($picking == null) {
            $ok[$nb] = 'Palettisation : zone de picking';
            $nb++;
        }
        if ($dimbarq == null) {
            $ok[$nb] = 'Palettisation : dimensions de la barquette';
            $nb++;
        }
        if ($poidnet == null) {
            $ok[$nb] = 'Palettisation : poids net du carton';
            $nb++;
        }
        if ($nbcouchepal == null) {
            $ok[$nb] = 'Palettisation : nombre de couche par palette';
            $nb++;
        }
        if ($poidnetpal == null) {
            $ok[$nb] = 'Palettisation : poids net de la palette';
            $nb++;
        }
    } else {
        $ok[$nb] = 'Palettisation : dimension ext&eacuterieur du carton';
        $nb++;
        $ok[$nb] = 'Palettisation : nombre de pi&egravece par carton';
        $nb++;
        $ok[$nb] = 'Palettisation : poids brut du carton';
        $nb++;
        $ok[$nb] = 'Palettisation : nombre de carton par couche';
        $nb++;
        $ok[$nb] = 'Palettisation : nombre de carton par palette';
        $nb++;
        $ok[$nb] = 'Palettisation : dimensions de la palette bois';
        $nb++;
        $ok[$nb] = 'Palettisation : hauteur de la palette';
        $nb++;
        $ok[$nb] = 'Palettisation : poids net de la palette';
        $nb++;
        $ok[$nb] = 'Palettisation : poids brut de la palette';
        $nb++;
        $ok[$nb] = 'Palettisation : zone de picking';
        $nb++;
        $ok[$nb] = 'Palettisation : dimensions de la barquette';
        $nb++;
        $ok[$nb] = 'Palettisation : poids net du carton';
        $nb++;
        $ok[$nb] = 'Palettisation : nombre de couche par palette';
        $nb++;
    }

    return ($ok);
}

;

/* * ******************************************************** */
/* Fonction decoupe_chaine.                                */
/* Permet de decouper une chaine de caracteres en enlevant */
/* les espaces et les caracteres speciaux ainsi que les    */
/* mots comportant moins ou le meme nombre de lettres que  */
/* le parametre 'long'.                                    */
/* * ******************************************************** */

function decoupe_chaine($chaine, $nbcar) {
// On decoupe la chaine
    $mot = preg_split("[ -/+\\*\'\"]", $chaine);
// On mesure la longueur du tableau
    $long = count($mot);
// Pour chaque mot, on le mesure,
// si <=3 alors, on decale le
// tableau vers la gauche = efface
    $i = 0;
    while ($i < $long) {
// On mesure la longueur de la chaine
        $longcase = strlen($mot[$i]);
        if ($longcase <= $nbcar) {
// On efface le mot, on decale le tableau vers la gauche
            $j = $i;
            while ($j <= $long) {
                if ($j == $long) {  // C la derniere case du tableau
                    $mot[$j] = null;
                } else {
                    $mot[$j] = $mot[$j + 1];
                }
                $j++;
            }
            $long--;
        } else {
            $i++;
        }
    }

// Affichage du tableau de mots a chercher
//echo ("/**************************************/<br>\n");
//echo ("Longueur du tableau: $long, contenu: <br>\n");
//echo ("mot=$mot<br>\n");
//$i=0;
//  while ($i<$long)
//  {
//    echo ("mot[$i]=$mot[$i]<br>\n");
//    $i++;
//  }
//echo ("/**************************************/\n");

    return ($mot);
}

/* * ******************************************************* */
/* Fonction d'affichage d'une liste déroulante a 2 champs */
/* * ******************************************************* */

function liste_deroulante_2($table, $champ1, $champ2, $nomliste, $selection) {
    echo ("<select name=\"$nomliste\">\n");
    $req = "select $champ1, $champ2 from $table order by $champ2";
    $result = DatabaseOperation::query($req);
    if ($result != false) {
        while ($row = mysql_fetch_row($result)) {
            if ($selection == $row[0])
                echo ("<option value=\"$row[0]\" selected>$row[1]</option>");
            else
                echo ("<option value=\"$row[0]\">$row[1]</option>");
        }
    }
    echo ("</select>\n");
}

;

/* * ******************************************************* */
/* Fonction d'affichage d'une liste déroulante a 2 champs */
/* Avec en premier champ une phrase issue du paramètrage. */
/* * ******************************************************* */

function liste_deroulante_2phrase($table, $champ1, $champ2, $nomliste, $selection, $phrase) {
    echo ("<select name=\"$nomliste\">\n");
    echo ("<option value=\"\">$phrase</option>");
    $req = "select $champ1, $champ2 from $table order by $champ2";
    $result = DatabaseOperation::query($req);
    if ($result != false) {
        while ($row = mysql_fetch_row($result)) {
            if ($selection == $row[0])
                echo ("<option value=\"$row[0]\" selected>$row[1]</option>");
            else
                echo ("<option value=\"$row[0]\">$row[1]</option>");
        }
    }
    echo ("</select>\n");
}

;

/* * ******************************************************* */
/* Fonction makeSelectListChecked                         */
/* Permet de créer une liste déroulante d'un champ de type */
/* enum                                        .          */
/* Pour utilisation:                                      */
/* echo ("<select name=\"nomL\">".makeSelectList($nombase,$table,$field)."</select>"); */
/* * ******************************************************* */

function makeSelectList($nombase, $table, $field) {
    $s = "";

    $req = ("SHOW COLUMNS FROM $table");
    $rid = DatabaseOperation::query($req);
    $nr = mysql_num_rows($rid);

    while (list($name, $type) = mysql_fetch_row($rid)) {
        if ($name == $field) {
            if (preg_match('/^enum\(.*\)$/', $type))
                $type = substr($type, 6, -2);
            else
            if (preg_match('/^set\(.*\)$/', $type))
                $type = substr($type, 5, -2);
            else
                return("<option>ERROR");
            $opts = explode("','", $type);
            while (list($k, $v) = each($opts))
                $s.="<option>$v";
        }
    }
    return($s);
}

;

/* * ******************************************************* */
/* Fonction makeSelectListChecked                         */
/* Permet de créer une liste déroulante d'un champ de type */
/* enum en selectionnant un élément particulier.          */
/* * ******************************************************* */

function makeSelectListChecked($nombase, $table, $field, $val) {
    $s = "";
    $req = ("SHOW COLUMNS FROM $table");
    $rid = DatabaseOperation::query($req);
    $nr = mysql_num_rows($rid);

    while (list($name, $type) = mysql_fetch_row($rid)) {
        if ($name == $field) {
            if (preg_match('/^enum\(.*\)$/', $type))
                $type = substr($type, 6, -2);
            else
            if (preg_match('/^set\(.*\)$/', $type))
                $type = substr($type, 5, -2);
            else
                return("<option>ERROR");
            $opts = explode("','", $type);
            while (list($k, $v) = each($opts)) {
                if ($val == $v)
                    $s.="<option selected>$v";
                else
                    $s.="<option>$v";
            }
        }
    }
    return($s);
}

;



/* * ******************************************************* */
/* Fonction decoupe_numft                                 */
/* Permet de decouper un numéro de fiche technique        */
/* pour pouvoir l'analyser. Retourne un tableau.          */
/* * ******************************************************* */

function decoupe_numft($numft) {
    $numchrono = substr($numft, 2, 4);
    $initiale = substr($numft, 6, 1);
    $version = substr($numft, -2);
    return array($numchrono, $initiale, $version);
}

;

/* * ******************************************************* */
/* Fonction affiche_date_heure                              */
/* Format une date SQL en JJ/MM/AAAA                      */
/* * ******************************************************* */

function affiche_date_heure($val) {
    $tempo = substr($val, 0, 10);
    $tempodate = substr($tempo, -2) . "/" . substr($tempo, 5, 2) . "/" . substr($tempo, 0, 4);
    $tempoheure = substr($val, -8);
    return array($tempodate, $tempoheure);
}

;

/* * ******************************************************* */
/* Fonction affiche_date                                  */
/* Format une date SQL en JJ/MM/AAAA                      */
/* * ******************************************************* */

function affiche_date($val) {
    $toto = substr($val, 0, 10);
    $tata = substr($toto, -2) . "/" . substr($toto, 5, 2) . "/" . substr($toto, 0, 4);
    return ($tata);
}

;

/* * ******************************************************* */
/* Pour chaque table constituant une fiche on recupere    */
/* les informations pour les recopier dans les tables     */
/* prevues.                                               */
/* Aussi, modification dans les tables actives du numero  */
/* de fiche pour allouer le nouveau numero de version.    */
/* * ******************************************************* */

function traitement_version($numft) {
    /* LES INFOS GENERALES */
    $req = "select * from infog where numft='$numft'";
    $result = DatabaseOperation::query($req);

    $numgam = mysql_result($result, 0, numgam);
    $numseg = mysql_result($result, 0, numseg);
    $siteorig = mysql_result($result, 0, siteorig);
    $nomprod = mysql_result($result, 0, nomprod);
    $infologic = mysql_result($result, 0, infologic);
    $infodesc = mysql_result($result, 0, infodesc);
    $poids = mysql_result($result, 0, poids);
    $upoids = mysql_result($result, 0, upoids);
    $gencod = mysql_result($result, 0, gencod);
    $condition = mysql_result($result, 0, condition);
    $vieclt = mysql_result($result, 0, vieclt);
    $vietech = mysql_result($result, 0, vietech);
    $agrcee = mysql_result($result, 0, agrcee);
    $transfr = mysql_result($result, 0, transfr);
    $siteass = mysql_result($result, 0, siteass);
    $siteexp = mysql_result($result, 0, siteexp);
    $inumft = mysql_result($result, 0, inumft);
    $isiteorig = mysql_result($result, 0, isiteorig);
    $inumgam = mysql_result($result, 0, inumgam);
    $inomprod = mysql_result($result, 0, inomprod);
    $iinfologic = mysql_result($result, 0, iinfologic);
    $iinfodesc = mysql_result($result, 0, iinfodesc);
    $ipoids = mysql_result($result, 0, ipoids);
    $igencod = mysql_result($result, 0, igencod);
    $icondition = mysql_result($result, 0, icondition);
    $ivieclt = mysql_result($result, 0, ivieclt);
    $ivietech = mysql_result($result, 0, ivietech);
    $iagrcee = mysql_result($result, 0, iagrcee);
    $itransfr = mysql_result($result, 0, itransfr);
    $isiteass = mysql_result($result, 0, isiteass);
    $isiteexp = mysql_result($result, 0, isiteexp);
    $date_crea = mysql_result($result, 0, date_crea);
    $date_modif = mysql_result($result, 0, date_modif);
    $date_val = mysql_result($result, 0, date_val);
    $importance = mysql_result($result, 0, importance);

    $req = "insert into infogv (numft, numgam, numseg, siteorig, nomprod, infologic, infodesc,
  poids, upoids, gencod, condition, vieclt, vietech, agrcee, transfr, siteass, siteexp,
  inumft, isiteorig, inumgam, inomprod, iinfologic, iinfodesc, ipoids, igencod,
  icondition, ivieclt, ivietech, iagrcee, itransfr, isiteass, isiteexp, date_crea,
  date_modif, date_val, importance)
  values ('$numft', '$numgam', '$numseg', '$siteorig', '$nomprod', '$infologic', '$infodesc',
  '$poids', '$upoids', '$gencod', '$condition', '$vieclt', '$vietech', '$agrcee', '$transfr',
  '$siteass', '$siteexp', '$inumft', '$isiteorig', '$inumgam', '$inomprod', '$iinfologic',
  '$iinfodesc', '$ipoids', '$igencod', '$icondition', '$ivieclt', '$ivietech', '$iagrcee',
  '$itransfr', '$isiteass', '$isiteexp', '$date_crea', '$date_modif', '$date_val', '$importance')";
    $result = DatabaseOperation::query($req);

    /* LES COMPOSANTS */
    $req = "select * from compos where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numcompos = mysql_result($result, $i, numcompos);
            $nomcompos = mysql_result($result, $i, nomcompos);
            $siteprod = mysql_result($result, $i, siteprod);
            $ingredient = mysql_result($result, $i, ingredient);
            $poids = mysql_result($result, $i, poids);
            $unite = mysql_result($result, $i, unite);
            $poidsmeo = mysql_result($result, $i, poidsmeo);
            $nbportion = mysql_result($result, $i, nbportion);
            $inomcompos = mysql_result($result, $i, inomcompos);
            $isiteprod = mysql_result($result, $i, isiteprod);
            $iingredient = mysql_result($result, $i, iingredient);
            $ipoids = mysql_result($result, $i, ipoids);
            $ipoidsmeo = mysql_result($result, $i, ipoidsmeo);
            $inbportion = mysql_result($result, $i, inbportion);

            $req2 = "insert into composv (numft, numcompos, nomcompos, siteprod, ingredient, poids,
      unite, inomcompos, isiteprod, iingredient, ipoids, poidsmeo, nbportion, ipoidsmeo, inbportion)
      values ('$numft', '$numcompos', '$nomcompos', '$siteprod', '$ingredient', '$poids',
      '$unite', '$inomcompos', '$isiteprod', '$iingredient', '$ipoids', '$poidsmeo', '$nbportion',
      '$ipoidsmeo', '$inbportion')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }

    /* LES MODES DE CONSERVATIONS */
    $req = "select * from conserv where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numconserv = mysql_result($result, $i, numconserv);
            $tempera = mysql_result($result, $i, tempera);
            $typecons = mysql_result($result, $i, typecons);
            $conseil = mysql_result($result, $i, conseil);
            $itempera = mysql_result($result, $i, itempera);
            $itypecons = mysql_result($result, $i, itypecons);
            $iconseil = mysql_result($result, $i, iconseil);


            $req2 = "insert into conservv (numft, numconserv, tempera, typecons, conseil, itempera, itypecons,
      iconseil) values ('$numft', '$numconserv', '$tempera', '$typecons', '$conseil', '$itempera',
      '$itypecons', '$iconseil')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }

    /* DIVERS */
    $req = "select * from divers where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $remarque = mysql_result($result, 0, remarque);
        $numdossier = mysql_result($result, 0, numdossier);
        $present = mysql_result($result, 0, present);
        $ouvert = mysql_result($result, 0, ouvert);
        $ipresent = mysql_result($result, 0, ipresent);
        $iouvert = mysql_result($result, 0, iouvert);
        $iremarque = mysql_result($result, 0, iremarque);
        $inumdossier = mysql_result($result, 0, inumdossier);

        $req = "insert into diversv (numft, remarque, numdossier, present, ouvert, ipresent, iouvert, iremarque, inumdossier)
    values ('$numft', '$remarque', '$numdossier', '$present', '$ouvert', '$ipresent', '$iouvert', '$iremarque', '$inumdossier')";
        $result = DatabaseOperation::query($req);
    }

    /* LES PALETTISATIONS */
    $req = "select * from palet where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numpalet = mysql_result($result, $i, numpalet);
            $dimext = mysql_result($result, $i, dimext);
            $udimext = mysql_result($result, $i, udimext);
            $nbpiece = mysql_result($result, $i, nbpiece);
            $poidbrut = mysql_result($result, $i, poidbrut);
            $upoidbrut = mysql_result($result, $i, upoidbrut);
            $nbcouche = mysql_result($result, $i, nbcouche);
            $nbtotal = mysql_result($result, $i, nbtotal);
            $dimpal = mysql_result($result, $i, dimpal);
            $udimpal = mysql_result($result, $i, udimpal);
            $hautpal = mysql_result($result, $i, hautpal);
            $uhautpal = mysql_result($result, $i, uhautpal);
            $poidbrutpal = mysql_result($result, $i, poidbrutpal);
            $upoidpal = mysql_result($result, $i, upoidpal);
            $picking = mysql_result($result, $i, picking);
            $dimbarq = mysql_result($result, $i, dimbarq);
            $poidnet = mysql_result($result, $i, poidnet);
            $upoidnet = mysql_result($result, $i, upoidnet);
            $nbcouchepal = mysql_result($result, $i, nbcouchepal);
            $poidnetpal = mysql_result($result, $i, poidnetpal);
            $upoidnetpal = mysql_result($result, $i, upoidnetpal);

            $idimbarq = mysql_result($result, $i, idimbarq);
            $ipoidnet = mysql_result($result, $i, ipoidnet);
            $inbcouchepal = mysql_result($result, $i, inbcouchepal);
            $ipoidnetpal = mysql_result($result, $i, ipoidnetpal);
            $idimext = mysql_result($result, $i, idimext);
            $inbpiece = mysql_result($result, $i, inbpiece);
            $ipoidbrut = mysql_result($result, $i, ipoidbrut);
            $inbcouche = mysql_result($result, $i, inbcouche);
            $inbtotal = mysql_result($result, $i, inbtotal);
            $idimpal = mysql_result($result, $i, idimpal);
            $ihautpal = mysql_result($result, $i, ihautpal);
            $ipoidbrutpal = mysql_result($result, $i, ipoidbrutpal);
            $ipicking = mysql_result($result, $i, ipicking);

            $req2 = "insert into paletv (numft, numpalet, dimext, udimext,
      nbpiece, poidbrut, nbcouche, nbtotal, dimpal, udimpal, hautpal,
      uhautpal, poidbrutpal, upoidpal, picking, idimext, inbpiece,
      ipoidbrut, inbcouche, inbtotal, idimpal, ihautpal, ipoidbrutpal,
      ipicking, dimbarq, poidnet, upoidnet, nbcouchepal, poidnetpal,
      upoidnetpal, idimbarq, ipoidnet, inbcouchepal, ipoidnetpal)
      values ('$numft', '$numpalet', '$dimext', '$udimext',
      '$nbpiece', '$poidbrut', '$nbcouche', '$nbtotal', '$dimpal',
      '$udimpal', '$hautpal', '$uhautpal', '$poidbrutpal', '$upoidpal',
      '$picking', '$idimext', '$inbpiece', '$ipoidbrut', '$inbcouche',
      '$inbtotal', '$idimpal', '$ihautpal', '$ipoidbrutpal', '$ipicking',
      '$dimbarq', '$poidnet', '$upoidnet', '$nbcouchepal', '$poidnetpal',
      '$upoidnetpal', '$idimbarq', '$ipoidnet', '$inbcouchepal', '$ipoidnetpal')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }

    /* Avant de faire l'update, on attribut un nouveau numero de fiche (version+1) */
    $version = substr($numft, -2);
    //if($version=='09'){
    //echo"on passe de 09 à 10";
    //$version=10;
    //}else{
    //echo "incrementation normale";
    $version = (int) $version + 1;
    if ($version < 10) {
        $version = "0" . $version;
    }
    //}
    //$tabnumft=decoupe_numft($numft);
    //$version=$tabnumft[2]++;
    $newnumft = substr($numft, 0, 7) . $version;
    //echo"$newnumft";
    /* On affecte ce nouveau numero de version a tous les elements de cette fiche */
    /* LES INFOS GENERALES */
    $req = "update infog set numft='$newnumft', date_modif=now(), date_val=0, importance='non' where numft='$numft'";
    $result = DatabaseOperation::query($req);
//echo ("req=$req<br>");
    /* LES COMPOSANTS */
    $req = "update compos set numft='$newnumft'where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* LES MODES DE CONSERVATIONS */
    $req = "update conserv set numft='$newnumft'where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* DIVERS */
    $req = "update divers set numft='$newnumft'where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* LES PALETTISATIONS */
    $req = "update palet set numft='$newnumft'where numft='$numft'";
    $result = DatabaseOperation::query($req);

    return ($newnumft);
}

;


/* * ******************************************************* */
/* On recupere les informations des 5 premieres tables en */
/* parametres pour les palacer dans les 5 suivantes       */
/* * ******************************************************* */

function traitement_archivage($numft, $infog, $compos, $conserv, $divers, $palet, $infog1, $compos1, $conserv1, $divers1, $palet1) {
    /* LES INFOS GENERALES */
    $req = "select * from $infog where numft='$numft'";
    $result = DatabaseOperation::query($req);

    $numgam = mysql_result($result, 0, numgam);
    $numseg = mysql_result($result, 0, numseg);
    $siteorig = mysql_result($result, 0, siteorig);
    $nomprod = mysql_result($result, 0, nomprod);
    $infologic = mysql_result($result, 0, infologic);
    $infodesc = mysql_result($result, 0, infodesc);
    $poids = mysql_result($result, 0, poids);
    $upoids = mysql_result($result, 0, upoids);
    $gencod = mysql_result($result, 0, gencod);
    $condition = mysql_result($result, 0, condition);
    $vieclt = mysql_result($result, 0, vieclt);
    $vietech = mysql_result($result, 0, vietech);
    $agrcee = mysql_result($result, 0, agrcee);
    $transfr = mysql_result($result, 0, transfr);
    $siteass = mysql_result($result, 0, siteass);
    $siteexp = mysql_result($result, 0, siteexp);

    $nomprod = addslashes($nomprod);
    $infodesc = addslashes($infodesc);
    $condition = addslashes($condition);
    $vieclt = addslashes($vieclt);
    $vietech = addslashes($vietech);
    $agrcee = addslashes($agrcee);

    $inumft = mysql_result($result, 0, inumft);
    $isiteorig = mysql_result($result, 0, isiteorig);
    $inumgam = mysql_result($result, 0, inumgam);
    $inomprod = mysql_result($result, 0, inomprod);
    $iinfologic = mysql_result($result, 0, iinfologic);
    $iinfodesc = mysql_result($result, 0, iinfodesc);
    $ipoids = mysql_result($result, 0, ipoids);
    $igencod = mysql_result($result, 0, igencod);
    $icondition = mysql_result($result, 0, icondition);
    $ivieclt = mysql_result($result, 0, ivieclt);
    $ivietech = mysql_result($result, 0, ivietech);
    $iagrcee = mysql_result($result, 0, iagrcee);
    $itransfr = mysql_result($result, 0, itransfr);
    $isiteass = mysql_result($result, 0, isiteass);
    $isiteexp = mysql_result($result, 0, isiteexp);
    $date_crea = mysql_result($result, 0, date_crea);
    $date_modif = mysql_result($result, 0, date_modif);
    $date_val = mysql_result($result, 0, date_val);
    $importance = mysql_result($result, 0, importance);

    $req = "insert into $infog1 (numft, numgam, numseg, siteorig, nomprod, infologic, infodesc,
  poids, upoids,  gencod, condition, vieclt, vietech, agrcee, transfr, siteass, siteexp,
  inumft, isiteorig, inumgam, inomprod, iinfologic, iinfodesc, ipoids, igencod,
  icondition, ivieclt, ivietech, iagrcee, itransfr, isiteass, isiteexp, date_crea,
  date_modif, date_val, importance)
  values ('$numft', '$numgam', '$numseg', '$siteorig', '$nomprod', '$infologic', '$infodesc',
  '$poids', '$upoids', '$gencod', '$condition', '$vieclt', '$vietech', '$agrcee', '$transfr',
  '$siteass', '$siteexp', '$inumft', '$isiteorig', '$inumgam', '$inomprod', '$iinfologic',
  '$iinfodesc', '$ipoids', '$igencod', '$icondition', '$ivieclt', '$ivietech', '$iagrcee',
  '$itransfr', '$isiteass', '$isiteexp', '$date_crea', '$date_modif', '$date_val', '$importance')";
    //echo"$req";
    $result = DatabaseOperation::query($req);
    if ($infog1 == 'infoga') {
        $req = "update infoga set date_archive=now() where numft='$numft'";
        $result = DatabaseOperation::query($req);
    }

    /* LES COMPOSANTS */
    $req = "select * from $compos where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numcompos = mysql_result($result, $i, numcompos);
            $nomcompos = mysql_result($result, $i, nomcompos);
            $siteprod = mysql_result($result, $i, siteprod);
            $ingredient = mysql_result($result, $i, ingredient);
            $poids = mysql_result($result, $i, poids);
            $unite = mysql_result($result, $i, unite);
            $poidsmeo = mysql_result($result, $i, poidsmeo);
            $nbportion = mysql_result($result, $i, nbportion);
            $inomcompos = mysql_result($result, $i, inomcompos);
            $isiteprod = mysql_result($result, $i, isiteprod);
            $iingredient = mysql_result($result, $i, iingredient);
            $ipoids = mysql_result($result, $i, ipoids);
            $ipoidsmeo = mysql_result($result, $i, ipoidsmeo);
            $inbportion = mysql_result($result, $i, inbportion);

            $nomcompos = addslashes($nomcompos);
            $ingredient = addslashes($ingredient);

            $req2 = "insert into $compos1 (numft, numcompos, nomcompos, siteprod, ingredient, poids,
      unite, inomcompos, isiteprod, iingredient, ipoids, poidsmeo, nbportion, ipoidsmeo, inbportion)
      values ('$numft', '$numcompos',
      '$nomcompos', '$siteprod', '$ingredient', '$poids', '$unite', '$inomcompos', '$isiteprod',
      '$iingredient', '$ipoids', '$poidsmeo', '$nbportion', '$ipoidsmeo', '$inbportion')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }

    /* LES MODES DE CONSERVATIONS */
    $req = "select * from $conserv where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numconserv = mysql_result($result, $i, numconserv);
            $tempera = mysql_result($result, $i, tempera);
            $typecons = mysql_result($result, $i, typecons);
            $conseil = mysql_result($result, $i, conseil);
            $itempera = mysql_result($result, $i, itempera);
            $itypecons = mysql_result($result, $i, itypecons);
            $iconseil = mysql_result($result, $i, iconseil);

            $tempera = addslashes($tempera);
            $typecons = addslashes($typecons);
            $conseil = addslashes($conseil);

            $req2 = "insert into $conserv1 (numft, numconserv, tempera, typecons, conseil, itempera, itypecons,
      iconseil) values ('$numft', '$numconserv', '$tempera', '$typecons', '$conseil', '$itempera',
      '$itypecons', '$iconseil')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }

    /* DIVERS */
    $req = "select * from $divers where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $remarque = mysql_result($result, 0, remarque);
        $numdossier = mysql_result($result, 0, numdossier);
        $present = mysql_result($result, 0, present);
        $ouvert = mysql_result($result, 0, ouvert);
        $ipresent = mysql_result($result, 0, ipresent);
        $iouvert = mysql_result($result, 0, iouvert);
        $iremarque = mysql_result($result, 0, iremarque);
        $inumdossier = mysql_result($result, 0, inumdossier);

        $present = addslashes($present);
        $remarque = addslashes($remarque);
        $numdossier = addslashes($numdossier);
        $ouvert = addslashes($ouvert);

        $req = "insert into $divers1 (numft, remarque, numdossier, present, ouvert, ipresent, iouvert, iremarque, inumdossier)
    values ('$numft', '$remarque', '$numdossier', '$present', '$ouvert', '$ipresent', '$iouvert', '$iremarque', '$inumdossier')";
        $result = DatabaseOperation::query($req);
    }

    /* LES PALETTISATIONS */
    $req = "select * from $palet where numft='$numft'";
    $result = DatabaseOperation::query($req);
    $num = mysql_num_rows($result);
    if ($num != 0) {
        $i = 0;
        while ($i < $num) {
            $numpalet = mysql_result($result, $i, numpalet);
            $dimext = mysql_result($result, $i, dimext);
            $udimext = mysql_result($result, $i, udimext);
            $nbpiece = mysql_result($result, $i, nbpiece);
            $poidbrut = mysql_result($result, $i, poidbrut);
            $upoidbrut = mysql_result($result, $i, upoidbrut);
            $nbcouche = mysql_result($result, $i, nbcouche);
            $nbtotal = mysql_result($result, $i, nbtotal);
            $dimpal = mysql_result($result, $i, dimpal);
            $udimpal = mysql_result($result, $i, udimpal);
            $hautpal = mysql_result($result, $i, hautpal);
            $uhautpal = mysql_result($result, $i, uhautpal);
            $poidbrutpal = mysql_result($result, $i, poidbrutpal);
            $upoidpal = mysql_result($result, $i, upoidpal);
            $picking = mysql_result($result, $i, picking);
            $dimbarq = mysql_result($result, $i, dimbarq);
            $poidnet = mysql_result($result, $i, poidnet);
            $upoidnet = mysql_result($result, $i, upoidnet);
            $nbcouchepal = mysql_result($result, $i, nbcouchepal);
            $poidnetpal = mysql_result($result, $i, poidnetpal);
            $upoidnetpal = mysql_result($result, $i, upoidnetpal);

            $dimext = addslashes($dimext);
            $dimpal = addslashes($dimpal);
            $picking = addslashes($picking);
            $dimbarq = addslashes($dimbarq);


            $idimbarq = mysql_result($result, $i, idimbarq);
            $ipoidnet = mysql_result($result, $i, ipoidnet);
            $inbcouchepal = mysql_result($result, $i, inbcouchepal);
            $ipoidnetpal = mysql_result($result, $i, ipoidnetpal);
            $idimext = mysql_result($result, $i, idimext);
            $inbpiece = mysql_result($result, $i, inbpiece);
            $ipoidbrut = mysql_result($result, $i, ipoidbrut);
            $inbcouche = mysql_result($result, $i, inbcouche);
            $inbtotal = mysql_result($result, $i, inbtotal);
            $idimpal = mysql_result($result, $i, idimpal);
            $ihautpal = mysql_result($result, $i, ihautpal);
            $ipoidbrutpal = mysql_result($result, $i, ipoidbrutpal);
            $ipicking = mysql_result($result, $i, ipicking);

            $req2 = "insert into $palet1 (numft, numpalet, dimext, udimext,
      nbpiece, poidbrut, nbcouche, nbtotal, dimpal, udimpal, hautpal,
      uhautpal, poidbrutpal, upoidpal, picking, idimext, inbpiece,
      ipoidbrut, inbcouche, inbtotal, idimpal, ihautpal, ipoidbrutpal,
      ipicking, dimbarq, poidnet, upoidnet, nbcouchepal, poidnetpal,
      upoidnetpal, idimbarq, ipoidnet, inbcouchepal, ipoidnetpal)
      values ('$numft', '$numpalet', '$dimext', '$udimext',
      '$nbpiece', '$poidbrut', '$nbcouche', '$nbtotal', '$dimpal',
      '$udimpal', '$hautpal', '$uhautpal', '$poidbrutpal', '$upoidpal',
      '$picking', '$idimext', '$inbpiece', '$ipoidbrut', '$inbcouche',
      '$inbtotal', '$idimpal', '$ihautpal', '$ipoidbrutpal', '$ipicking',
      '$dimbarq', '$poidnet', '$upoidnet', '$nbcouchepal', '$poidnetpal',
      '$upoidnetpal', '$idimbarq', '$ipoidnet', '$inbcouchepal', '$ipoidnetpal')";
            $result2 = DatabaseOperation::query($req2);
            $i++;
        }
    }
    /* Effacement des enregistrements dans les tables actives */
    /* LES INFOS GENERALES */
    $req = "delete from $infog where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* LES COMPOSANTS */
    $req = "delete from $compos where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* LES MODES DE CONSERVATIONS */
    $req = "delete from $conserv where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* DIVERS */
    $req = "delete from $divers where numft='$numft'";
    $result = DatabaseOperation::query($req);

    /* LES PALETTISATIONS */
    $req = "delete from $palet where numft='$numft'";
    $result = DatabaseOperation::query($req);
}

;

/* * ******************************************************* */
/* permet de rentrer dans la table logft                  */
/* * ******************************************************* */

function logft($nomtable, $numft, $user, $action, $commentaire) {
    $req = "insert into logft (numft, id_user, date_modif, nomtable, action, commentaire)
  values ('$numft', '$user', now(), '$nomtable', '$action', '$commentaire')";
    $result = DatabaseOperation::query($req);
//echo"$req";
}

;

function viguleft($strinft) {
    $strinft = eregi_replace(",", ".", $strinft);
    return ($strinft);
}

/*
  Affiche le menu de navigation des FTA
 */

function afficher_navigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback) {

    //Action: "consultation" ou "modification"
    //Barre de navigation de la Fiche Tehnique Article
    //Variables
    $html_table = "table "              //Permet d'harmoniser les tableaux
            . "border=1 "
            . "width=100% "
            . "class=contenu "
    ;

    $id_fta_chapitre_encours;
    $comeback;    //1=l'url précédente à à enregistrer comme url de retour

    $t_processus_encours = array();
    $t_processus_visible = array();

    //Récupère la page en cours
    //$page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
    $page_default = "modification_fiche";

    //Récupération des informations préalables
    $_SESSION["id_fta"] = $id_fta;
    $objectFta = new ObjectFta($id_fta);

    mysql_table_load("fta");
    mysql_table_load("fta_etat");
    mysql_table_load("access_arti2");
//echo     $_SESSION["code_article_ldc"];
    //Nom de l'assistante de projet responsable:
    $req = "SELECT prenom, nom FROM salaries WHERE id_user='" . $_SESSION["createur_fta"] . "' ";
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        $createur = mysql_result($result, 0, "prenom") . " " . mysql_result($result, 0, "nom");
    }


    //Construction du Menu
    if ($_SESSION["id_article_agrologic"]) {
        $identifiant = $_SESSION["id_article_agrologic"];
    } else {
        $identifiant = $_SESSION["id_dossier_fta"] . "v" . $_SESSION["id_version_dossier_fta"];
    }
    if ($_SESSION["LIBELLE"]) {
        $nom = $_SESSION["LIBELLE"];
    } else {
        $nom = $_SESSION["designation_commerciale_fta"];
    }
    $menu_navigation = "
                     <$html_table>
                     <tr><td class=titre_principal> <div align=\"left\">
                           $identifiant (LDC: <b><font size=\"2\" color=\"#0000FF\">" . $_SESSION["code_article_ldc"] . "</font></b>) - $nom &nbsp;&nbsp;&nbsp;&nbsp;<i>(gérée par $createur)</i>
                           </div>
                     </td></tr>
                     <tr class=titre><td>
                     ";

    //Si une action est donnée, alors construction du menu des chapitres
    if ($synthese_action) {
        //Etat d'avancement de la FTA et Recherche des processus validés (et donc en lecture-seule)
        $liste_processus_visible = "";      //Liste des processus en lecture-seule (séparés par une virgule)
        //$req = "SELECT * FROM fta_processus ";
        $req = "SELECT DISTINCT fta_processus.* FROM fta_processus, fta_processus_cycle "
                . "WHERE fta_processus_cycle.id_init_fta_processus=fta_processus.id_fta_processus "
                //. "AND id_etat_fta_processus_cycle='".$objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat")."' "
                . "AND id_etat_fta_processus_cycle='I' "
                . "AND id_fta_categorie = '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_fta_categorie") . "' "
        ;
        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            //Balayage de tous les processus
            while ($rows = mysql_fetch_array($result)) {
                $id_fta;    //Déjà déclaré
                $id_fta_processus = $rows["id_fta_processus"];
                $taux_validation_processus = fta_processus_validation($id_fta, $id_fta_processus);


                //echo $rows["nom_fta_processus"].": ".$taux_validation_processus."<br>";
                //Liste des processus visible(lecture-seule)
                if ($taux_validation_processus == 1) {
                    $t_processus_visible[] = $rows["id_fta_processus"];
                }
            }//Fin du balayage
            //print_r($t_processus_visible);
        } else {
            //La table des processus est vide
            $titre = "Erreur de configuration du module FTA";
            $message = "Cette FTA n'a pas de cycle \"Initialisation\" défini pour la catégorie " . $objectFta->getFieldValue(ObjectFta::TABLE_WORKFLOW_NAME, "nom_fta_categorie") . " <i>(Voir la table fta_processus_cycle)</i> ";
            afficher_message($titre, $message, $redirection);
        }//Fin de suivi de projet
        //Recherche des processus en cours
        //Balayage des cycles des processus (en exclant les processus déjà validés)
        $req = "SELECT DISTINCT id_next_fta_processus "
                . "FROM fta_processus_cycle, fta_processus, intranet_actions, intranet_droits_acces, intranet_modules "
                . "WHERE 1 AND ( 1 "
        ;
        $separator = "AND";

        //Suppression des processus déjà validé
        if ($t_processus_visible) {
            foreach ($t_processus_visible as $value) {

                $req .= $separator . " id_next_fta_processus<>" . $value . " ";
                $separator = "AND";
            }
        }

        //Vérification des droits d'accès de l'utilisateur en cours
        $req .=") "
                . "AND fta_processus_cycle.id_next_fta_processus=fta_processus.id_fta_processus "       //Jointure
                . "AND fta_processus.id_intranet_actions=intranet_actions.id_intranet_actions "         //Jointure
                . "AND intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions " //Jointure
                . "AND intranet_droits_acces.id_intranet_modules=intranet_modules.id_intranet_modules " //Jointure
                . "AND id_user=" . $_SESSION["id_user"] . " " //Utilisateur actuellement connecté
                . "AND nom_intranet_modules='fta' "
                . "AND niveau_intranet_droits_acces=1 "  //L'utilisateur est propriétaire
                . "AND id_etat_fta_processus_cycle='" . $objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat") . "' "
                . "AND id_fta_categorie = '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_fta_categorie") . "' "
        ;


        //Finalisation de la requête
        $req .="";
//echo "<br>".$req;

        $result = DatabaseOperation::query($req);
        while ($rows = mysql_fetch_array($result)) {
            //Pour chaque processus, on vérifie que tous ces précédents sont validés
            $req = "SELECT * FROM fta_processus_cycle "
                    . "WHERE id_next_fta_processus=" . $rows["id_next_fta_processus"] . " AND ( 1 "
            ;
            $separator = "AND";
            //Ajout de la restriction des processus validé
            if ($t_processus_visible) {
                foreach ($t_processus_visible as $value) {

                    $req .= $separator . " id_init_fta_processus<>" . $value . " ";
                    $separator = "AND";
                }
            }

            //Recherche dans le cycle correspondant à l'état en cours de la fiche
            $req_etat = "SELECT `fta_etat`.`abreviation_fta_etat` "
                    . "FROM `fta_etat`, `fta` "
                    . "WHERE ( `fta_etat`.`id_fta_etat` = `fta`.`id_fta_etat` )"
                    . "AND ( ( `fta`.`id_fta` = '" . $id_fta . "' ) )"
            ;
            $abreviation_fta_etat = mysql_result(DatabaseOperation::query($req_etat), 0, "abreviation_fta_etat");
            $req .= "AND id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' ";

            //Filtrage par catégorie
            //$req .= "AND id_fta_categorie='".$_SESSION["id_fta_categorie"]."' ";
            //Finalisation de la requête
            $req .=")";
            //echo "<br>".$req;
            //Si la requête est vide, c'est que tous les processus précédents sont validés
            //Il est donc un Processus en cours
            $result_temp = DatabaseOperation::query($req);

            if (!mysql_num_rows($result_temp)) {
                //echo " Y";
                //Ce processus en cours, est-il du type repartie ou centralisé ?
                $req = "SELECT multisite_fta_processus FROM fta_processus "
                        . "WHERE id_fta_processus=" . $rows["id_next_fta_processus"]
                ;
                $result_temp = DatabaseOperation::query($req);
                $multisite_fta_processus = mysql_result($result_temp, 0, "multisite_fta_processus");

                //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
                if ($multisite_fta_processus) {

                    //Existe-il une configuration de gestion forcée pour ce processus et ce site d'assemblage ?
                    $req = "SELECT id_site_processus_fta_processus_multisite FROM fta_processus_multisite, access_arti2 "
                            . "WHERE id_site_assemblage_fta_processus_multisite=Site_de_production "
                            . "AND id_processus_fta_processus_multisite='" . $rows["id_next_fta_processus"] . "' "
                            . "AND id_fta=" . $id_fta . " "
                    ;
                    $result_temp = DatabaseOperation::query($req);
                    if (mysql_num_rows($result_temp)) {
                        $id_geo = mysql_result($result_temp, 0, "id_site_processus_fta_processus_multisite");
                    } else {
                        //Sinon, Vérification de l'égalité entre le site d'assemblage de la FTA et le site de Localisation de l'utilisateur
                        $req = "SELECT id_geo FROM access_arti2, geo "
                                . "WHERE id_fta=" . $id_fta . " "
                                . "AND Site_de_production=id_site "
                        ;
                        $result_temp = DatabaseOperation::query($req);
                        if (mysql_num_rows($result_temp)) {
                            $id_geo = mysql_result($result_temp, 0, "id_geo");
                        }
                    }
                    if ($id_geo == $_SESSION["lieu_geo"]) {
                        //L'égalité est respecté, donc ce processus est bien en cours
                        $t_processus_encours[] = $rows["id_next_fta_processus"];
                    } else {
//                   echo "TEST";
                    }
                } else {
                    //Enregistrement du processus en tant que processus en cours
                    $t_processus_encours[] = $rows["id_next_fta_processus"];
                }
            }
        }//Fin du balayage des processus non-validés
        //print_r($t_processus_encours);
        //Recherche des processus Publics
        //Création de la liste des processus dans la barre de navigation
        $t_processus_encours;
        $t_processus_visible;

        /*     switch ($synthese_action)//Suivant l'action effectuée sur la navigation:
          {
          case "modification":
          $t_liste_processus = array_merge($t_processus_encours,$t_processus_visible);
          break;

          case "consultation":
          $t_liste_processus = $t_processus_visible;
          break;
          } */
        $t_liste_processus = array_merge($t_processus_encours, $t_processus_visible);

        //$t_liste_processus = $t_processus_encours;
        //Ajout des processus n'ayant pas de précédents et donc obligatoirement présent dans le menu de navigation
        $req = "SELECT fta_processus.* FROM fta_processus "
                . "LEFT JOIN fta_processus_cycle "
                . "ON fta_processus.id_fta_processus=fta_processus_cycle.id_next_fta_processus "
                . "WHERE fta_processus_cycle.id_next_fta_processus IS NULL;"
        ;
        $result = DatabaseOperation::query($req);
        while ($rows = mysql_fetch_array($result)) {
            $t_liste_processus[] = $rows["id_fta_processus"];
        }

        //Récupération des Chapitres accessible dans le menu de naviguation
        if ($t_liste_processus) {
            $req = "SELECT * FROM fta_chapitre LEFT JOIN fta_processus "
                    . "ON fta_processus.id_fta_processus=fta_chapitre.id_fta_processus "
                    . "WHERE  ( "
                    . "fta_chapitre.id_fta_processus=0 "                              //Chapitre public
            ;
            $separator = "OR";

            foreach ($t_liste_processus as $value) {
                $req .= $separator . " fta_processus.id_fta_processus=" . $value . " ";
                $separator = "OR";
            }
            $req .=" ) ORDER BY fta_chapitre.id_fta_chapitre";
            $result = DatabaseOperation::query($req);

            //Balyage des chapitres trouvés
            while ($rows = mysql_fetch_array($result)) {
                $id_fta_chapitre = $rows['id_fta_chapitre'];
                $nom_fta_chapitre = $rows['nom_fta_chapitre'];
                $nom_usuel_fta_chapitre = $rows['nom_usuel_fta_chapitre'];

                //Dans le cas où il n'y a pas de chapitre sélectionné, sélection du premier
                if (!$id_fta_chapitre_encours) {
                    $id_fta_chapitre_encours = $id_fta_chapitre;
                }

                if ($id_fta_chapitre_encours == $id_fta_chapitre) {
                    $b = "<font size=3 color=#5494EE><b>";
                    $image1 = "[>";
                    $image2 = "<]";
                    $num = 1;
                    //$image1="[<img src=../lib/images/etoile_clignotante.gif width=15 height=15 border=0 />]";
                    //$image2=$image1;
                } else {

                    $image1 = "[>";
                    $image2 = "<]";

                    //Ce chapitre est-il public?
                    if ($rows['id_fta_processus'] == 0) {
                        $b = "<font color=\"#8977A9\">";
                    } else {
                        //Le chapitre est-il validé ?
                        $req1 = "SELECT id_fta_suivi_projet "
                                . "FROM fta_suivi_projet "
                                . "WHERE id_fta=$id_fta "
                                . "AND id_fta_chapitre=$id_fta_chapitre "
                                . "AND signature_validation_suivi_projet<>0 "
                        ;
                        $result1 = DatabaseOperation::query($req1);
                        $num = mysql_num_rows($result1);
                        switch ($num) {
                            case 0:  //Chapiter pas encore validé
                                $b = "<font color=\"#FF0000\">";
                                break;

                            case 1:  //Chapitre validé
                                $b = "<font color=\"#00B300\">";
                                break;

                            default: //Anomalie
                                $titre = "Erreur Grave !";
                                $message = "La fonction afficher_navigation() vient de trouver des doublons de validation des chapitres dans la table fta_suivi_projet";
                                afficher_message($titre, $message, $redirection);
                                break;
                        }
                    }//Fin du test public
                }//Fin de la colorisation
                //$menu_navigation.="<a href=$page_default.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre><img src=images/bouton_menu-$nom_fta_chapitre.png border=$border></a> ";
                //echo $num." ".$_SESSION["synthese_action"]."<br>";
                if ($num == 0 and $_SESSION["synthese_action"] == "attente") {
                    
                } else {
                    $menu_navigation .= "<a href=$page_default.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre&synthese_action=$synthese_action>$b"
                            . $image1 . $nom_usuel_fta_chapitre . $image2
                            . "</a>"
                            . "</b></font> "
                    ;
                }
                //$menu_navigation.="<input type=submit value=`".$nom_usuel_fta_chapitre."` border=$border> ";
            }
        }//Fin de la création des chapitres
    }//Fin du controle de $synthese_action
    //Lien de retour rapide
    /* $menu_navigation.= "</td></tr><tr><td>
      <a href=index.php?id_fta_etat=".$_SESSION["id_fta_etat"]."&nom_fta_etat=".$_SESSION["abreviation_fta_etat"]."&synthese_action=$synthese_action>Retour vers la synthèse</a>
      "; */
    if ($comeback == 1) {
        $_SESSION["comeback_url"] = $_SERVER["HTTP_REFERER"];
        $_GLOBALS["comeback_url"] = $_SESSION["comeback_url"];
    }
    $menu_navigation.= "</td></tr><tr><td>
    <a href=" . $_SESSION["comeback_url"] . "><img src=../lib/images/bouton_retour.png alt=\"\" title=\"Retour à la synthèse\" width=\"18\" height=\"15\" border=\"0\" /> Retour vers la synthèse</a> |
    ";
    //echo "<pre>".print_r($_SERVER["QUERY_STRING"])."</pre>";
    //Corps du menu
    $menu_navigation.="
                    <a href=historique.php?id_fta=$id_fta><img src=./images/graphique.png alt=\"\" title=\"" . UserInterfaceLabel::FR_AVANCEMENT_FTA . "\" width=\"18\" height=\"15\" border=\"0\" />" . UserInterfaceLabel::FR_AVANCEMENT_FTA . "</a>
                       </td></tr>
                       </table>
                       ";
    return $menu_navigation;
}

?>