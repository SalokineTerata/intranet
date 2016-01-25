<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */
//
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
$action = lib::getParameterFromRequest('action');
$poids_annexe_emballage = lib::getParameterFromRequest('poids_annexe_emballage');
$actif_annexe_emballage = lib::getParameterFromRequest('actif_annexe_emballage');
$epaisseur_annexe_emballage = lib::getParameterFromRequest('epaisseur_annexe_emballage');
$hauteur_annexe_emballage = lib::getParameterFromRequest('hauteur_annexe_emballage');
$id_annexe_emballage = lib::getParameterFromRequest('id_annexe_emballage');
$largeur_annexe_emballage = lib::getParameterFromRequest('largeur_annexe_emballage');
$liste_fta = lib::getParameterFromRequest('liste_fta');
$longueur_annexe_emballage = lib::getParameterFromRequest('longueur_annexe_emballage');
$nom_annexe_emballage_groupe = lib::getParameterFromRequest('nom_annexe_emballage_groupe');
$nom_fte_fournisseur = lib::getParameterFromRequest('nom_fte_fournisseur');
$nombre_couche_annexe_emballage = lib::getParameterFromRequest('nombre_couche_annexe_emballage');
$quantite_par_couche_annexe_emballage = lib::getParameterFromRequest('quantite_par_couche_annexe_emballage');
$reference_fournisseur_annexe_emballage = lib::getParameterFromRequest('reference_fournisseur_annexe_emballage');
$selection_groupe = lib::getParameterFromRequest('selection_groupe');
$selection_fournisseur = lib::getParameterFromRequest('selection_fournisseur');

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

    case "supprimer":

        $id_annexe_emballage;      //URL
        $selection_groupe;         //URL
        $selection_fournisseur;    //URL
        //Suppression de la FTE
        if (${$module . "_modification"} >= 1) {
            mysql_table_operation("annexe_emballage", "delete");
        }
        //Redirection
        header("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");

        break;

    case "insert":
    case "rewrite":

        //echo "id_fte_fournisseur: ".$id_fte_fournisseur;
        mysql_table_load("fte_fournisseur");

        if (!$actif_annexe_emballage) {
            $actif_annexe_emballage = 0;
        }
        $id_annexe_emballage;      //URL
        $selection_groupe;         //URL
        $selection_fournisseur;    //URL
        $date_maj_annexe_emballage = date("d-m-Y");

        //Ajout ou réécriture de la FTE
        if (Acl::getValueAccesRights($module . "_modification") >= 1) {
            $annexeEmballageModel = new AnnexeEmballageModel($id_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE)->setFieldValue($poids_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ACTIF_ANNEXE_EMBALLAGE)->setFieldValue($actif_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_EPAISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($epaisseur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE)->setFieldValue($hauteur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE)->setFieldValue($largeur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE)->setFieldValue($longueur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($nombre_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($quantite_par_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($reference_fournisseur_annexe_emballage);
            $annexeEmballageModel->saveToDatabase();
        }

        //Mise à jour des FTA associées
        //Récupération de la liste des FTA à mettre à jour -- Pas utile pour le moment tant qu'on met à jour toutes les FTA
        //echo $liste_fta;
        //print_r($tab_fta);
        //$id_fta=$val;
        //Mise à joutr du conditionnement de la FTA
        //$id_annexe_emballage_groupe=$id_annexe_emballage_groupe;
        //$id_annexe_emballage_groupe_type
        //$hauteur_emballage_fta_conditionnement
        //La palettisation n'est pas mise à jour car elle peut être personnalisée suivant les FTA
        //$quantite_par_couche_fta_conditionnement=$quantite_par_couche_annexe_emballage;
        //$nombre_couche_fta_conditionnement=$nombre_couche_annexe_emballage;

        $poids_fta_conditionnement = $poids_annexe_emballage;
        $longueur_fta_conditionnement = $longueur_annexe_emballage;
        $largeur_fta_conditionnement = $largeur_annexe_emballage;
        $hauteur_fta_conditionnement = $hauteur_annexe_emballage;

        //MAJ des FTA:
        $req = "UPDATE fta_conditionnement, fta, fta_etat "
                . "SET poids_fta_conditionnement='$poids_fta_conditionnement' "            //Nouvelles valeurs
                . ", longueur_fta_conditionnement='$longueur_fta_conditionnement' "      //Nouvelles valeurs
                . ", largeur_fta_conditionnement='$largeur_fta_conditionnement' "        //Nouvelles valeurs
                . ", hauteur_fta_conditionnement='$hauteur_fta_conditionnement' "        //Nouvelles valeurs
                . "WHERE fta_conditionnement.id_fta=fta.id_fta "                           //Liaison
                . "AND fta.id_fta_etat=fta_etat.id_fta_etat "                              //Liaison
                //. "AND abreviation_fta_etat='V' "                                          //Seules les FTA validées sont mises à jours
                . "AND fta_conditionnement.id_annexe_emballage='$id_annexe_emballage' "    //Seul cet emballage est mis à jour
        ;
        $result = DatabaseOperation::query($req);
        //echo mysql_affected_rows();
        //echo $largeur_annexe_emballage."\n";
        //Information par mails aux Assistantes de projets
        //Récupération du service des chef de projets affectés par les modifications des FTA Validées(créateurs des FTA)
        $tab_fta = explode(";", $liste_fta);
        /**
          $req = "SELECT DISTINCT salaries_mail.id_service, salaries_mail.id_user, salaries_mail.nom, salaries_mail.prenom, salaries_mail.mail, CODE_ARTICLE, LIBELLE   "
          . "FROM salaries AS salaries_createur, salaries AS salaries_mail, fta, fta_etat "
          . ", intranet_droits_acces, intranet_actions, fta_processus, access_arti2 "
          . "WHERE salaries_createur.id_user=createur_fta "                  //Créateur de la FTA
          . "AND salaries_createur.id_service=salaries_mail.id_service "     //Liste des salaries du même service
          . "AND `salaries_mail`.`id_user` = `intranet_droits_acces`.`id_user` "                              //Liaison - Droits d'accès des utilisateurs
          . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "   //Liaison - Actions associées aux droits d'accès
          . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "           //Liaison - Processus liés aux actions
          . "AND fta_processus.id_fta_processus = 1 "            //Processus Définition du Projet
          . "AND fta.id_fta=access_arti2.id_fta "                //Liaison - table access_arti2
          . "AND ( "
          ;
          /* */
        $req = "SELECT DISTINCT salaries_mail.id_service, salaries_mail.id_user, "
                . "salaries_mail.nom, salaries_mail.prenom, salaries_mail.mail, CODE_ARTICLE, LIBELLE "
                . "FROM salaries AS salaries_createur, salaries AS salaries_mail, fta, fta_etat, "
                . "intranet_droits_acces AS acces_definition, intranet_droits_acces AS acces_diffusion, "
                . "intranet_actions AS action_definition, intranet_actions AS action_diffusion, fta_action_role "
                . "WHERE salaries_createur.id_user=createur_fta "

                //Recherche de l'accès au chapitre "Définition"
                . "AND `salaries_mail`.`id_user` = `acces_definition`.`id_user` "
                . "AND `acces_definition`.`id_intranet_actions` = `action_definition`.`id_intranet_actions` "
                . "AND `action_definition`.`id_intranet_actions` = `fta_action_role`.`id_intranet_actions` "
                . "AND fta_action_role.id_fta_role = 1 "

                //Recherche de l'accès au droit de "Diffusion"
                . "AND `salaries_mail`.`id_user` = `acces_diffusion`.`id_user` "
                . "AND `acces_diffusion`.`id_intranet_actions` = `action_diffusion`.`id_intranet_actions` "
                . "AND `action_diffusion`.`id_intranet_actions` = 3 "

                //Recherche des FTA concernées
                . "AND ( 0"
        ;

//        $operator = "";
//        $text_article = "";
//        while (list($key, $idFta) = each($tab_fta)) {
//            if ($idFta) {
//                $req .="$operator fta.id_fta='" . $idFta . "' ";
//                $operator = "OR";
//            }
//        }
//        $req .=" ) ";
//        //echo $req;
//
//        $result = DatabaseOperation::query($req);
//        $sujetmail = "FTA/Mise à jour de l'emballage: " . $nom_fte_fournisseur . " - " . $reference_fournisseur_annexe_emballage;
//        $text = "Bonjour,\n"
//                . "La Fiche Technique Emballage (FTE) \"" . $nom_fte_fournisseur . " - " . $reference_fournisseur_annexe_emballage . "\" vient d'être actualisée.\n"
//                . "\n"
//                . "Les Fiches Techniques Articles validées suivantes sont maintenant à jour:\n"
//        ;
//        $destinataire = "InformatiqueSupport.AVIGNON@agis-sa.fr,";
//        $expediteur = "InformatiqueSupport.AVIGNON@agis-sa.fr";
//        $operateur = "";
//        $text_article = "";
//        if ($result) {
//            while ($rows_mail = mysql_fetch_array($result)) {
//                $text_article[] = $rows_mail["CODE_ARTICLE"] . " - " . $rows_mail["LIBELLE"] . "\n";
//                $destinataire.=$operateur . $rows_mail["mail"];
//                $operateur = ",";
//            }
//
//            //Reconstitution de la liste des articles affectées
//            if ($text_article) {
//                $text_article = array_unique($text_article);
//
//                $text_article = implode("", $text_article);
//            }
//
//            //Finalisation du mail
//            $text.=$text_article;
//            $text.= "\n"
//                    . "Bonne journée.\n"
//                    . "Intranet Agis\n"
//            ;
//
//            //print_r($destinataire);
//            //$sujetmail="test4";
//            //$text="test4";
//            //$destinataire="InformatiqueSupport.AVIGNON@agis-sa.fr,boris.sanegre@agis-sa.fr";
//            envoismail($sujetmail, $text, $destinataire, $expediteur);
//        }


        //Redirection
        header("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");


        break;



    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

