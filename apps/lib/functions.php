<?php

//header('Content-type: text/html; charset=iso-8859-1');
//Include des fonctions thématiques
//require_once ("../lib/functions.js");
//Fonctions diverses
//Autorisation de consulter le module:
//En effet cette page est chargee par toutes les page de ce module
/*
  if (nom_du_module==0)
  {
  header ("Location: none.php");
  }
 */

/*
  Initialisation des variables globales du modules:
  ----------------------------------------------- */

/* -----------------------------------------------------
  Determination du profil de l'utilisateur pour ce module
  ----------------------------------------------------- */

/*
  Dictionnaire des variables:
  ---------------------------
 */

/* ---------------------------------------------
  FONCTIONS GLOBALES DE TOUS LES MODULE INTRANET
  --------------------------------------------- */

/*
  Exemple de declaration de fonctions
 * **********************************
 */

/* function fonction1($variable1,$variable2, $variable3, $variable4)

  /*
  Dictionnaire des variables:
 * **************************
 */

/*
  {
  //Corps de la fonction

  }
 */

/*
 * ******************************************************************************
 *                            DEBUT DES FONCTIONS                              *
 * ******************************************************************************
 */


/*
  Afficher un message
 * ******************

  Cette fonction permet de rediriger vers une page affichant un message, puis
  de rediriger au nouveau vers une page quelconque.

  Laissez $redirection vide pour que le lien pointe vers la page precedente.

 */











//******************************************************************************
//                              MOTEUR DE RECHERCHE
//******************************************************************************

/*
  Pour créer un moteur de recherche dans un module il faut :

  - Créer une table nom_du_module_moteur_de_recherche qui va contenir
  tous les champs sur lequels il est possible de faire une recherche
  Elle contient :
 * id_matiere_premiere_moteur_de_recherche : identifiant
 * table_matiere_premiere_moteur_de_recherche : nom de la
  table auquel appartient le champ
 * nom_champ_matiere_premiere_moteur_de_recherche : nom
  du champ
 * nom_champ_usuel_matiere_premiere_moteur_de_recherche  :
  nom du champ tel qu'il va apparaitre dans la liste deroulante
 * priorite_matiere_premiere_moteur_de_recherche  :
  priorité d'affichage (1 = prioritaire, 0=non prioritaire)
 * chemin_force_matiere_premiere_moteur_de_recherche :
  Si pour arriver a ce champ, on ne doit utiliser qu'un seul chemin specifique
  a travers les jointures des tables, on donne l'identifiant auquel il correspond.
  EX : Dans la table matiere premiere je veux le lieu de derniere tranformation
  Remplissage de la table
 * table_matiere_premiere_moteur_de_recherche : annexe_pays
 * nom_champ_matiere_premiere_moteur_de_recherche : nom_annexe_pays
 * nom_champ_usuel_matiere_premiere_moteur_de_recherche  : lieu de derniere transformation
 * chemin_force_matiere_premiere_moteur_de_recherche : matiere_premiere.id_lieu_derniere_transformation_matiere_premiere

  - Créer un fichier sql.map qui contiendra toute les jointures entre les tables.
  Les noms des champs doivent etre précédés par le nom de la table a laquelle
  ils appartiennent et un point.
  Les liaisons doivent etre séparées par des sauts de lignes
  pas de AND a la fin
 */

/* * *******************************************************************************
  Cette fonction a pour but d'afficher les differents formulaires de recherche et
  de recuperer les donnees.
  1 recherche ( 1 champ, 1operateur, 1 valeur) = 1 formulaire
  Composition de chaque formulaire :
  - Première liste deroulante : selection du champs de la table
  - Deuxieme liste déroulante affiche en fonction de la première les opérateurs
  disponibles selon le type du champ choisi avant.
  - Une zone de texte pour que l'utilisateur puisse rentrer un mot (ou une date) a rechercher
  - 5 cases à cocher :
 * Et  (ajoute un formulaire vierge à droite du formulaire courant)
 * Ou   (ajoute un formulaire vierge en dessous du formulaire courant)
 * Ou avec recopie   (recopie la ligne courante en dessous de cette dernière)
 * Supprimer    (supprime le formulaire courant)
 * Fin de saisie       (appelle l'execution de la recherche)
  - Un bouton Ok (submit) qui valide le formulaire en appelant la page : action.php avec action = 'ajout'

  Les données sont stokées dans des tableaux à 2 dimensions.
  $champ_recherche[][] : stoke les identifiants des champs choisis
  $operateur_recherche[][] : stoke les identifiants des operateurs choisis
  $texte_recherche[][] : stoke les valeurs entrées par l'utilisateur

  Cette fonction renvoie par URL un tableau linearisé $tab_resultat qui contient tout les identifiants
  des champs résultats de la requete.
  Pour delinéariser le tableau :
  $tab_resultat= explode (';;',$tab_resultat);

  Les arguments de la fonction :
  $module = nom du module de la page
  $url_page_depart= url de la page de départ (la ou est inserer la fonction recuperation_donnees_recherche)
  $module_table= nom du module auquel appartienent les tables
  $champ_retour= nom du champ sur lequel on realise la requete (juste apres le SELECT)
  $nb_limite_resultat = nombre maximun de resultat que peut avoir une requete.

 * ******************************************************************************** */

function recuperation_donnees_recherche($module, $url_page_depart, $module_table, $champ_retour, $nb_limite_resultat, $nbligne, $nbcol, $champ_recherche, $operateur_recherche, $texte_recherche, $champ_courant, $operateur_courant, $texte_courant, $nb_col_courant, $nb_ligne_courant, $ajout_col
) {

    // Dictionnaire des variables
    $nbligne;                   // Nombre de lignes totales
    $nbcol;                     // nombre de colonnes de la ligne courante
    $champ_recherche;           //tableau des identifiants des champs choisis
    $operateur_recherche;       //tableau des identifiants des operateurs choisis
    $texte_recherche;           //table au des valeurs entrées par l'utilisateur
    $champ_courant;             // Valeur de l'identifiant du champ qui vient juste d'etre saisie par l'utilisateur
    $operateur_courant;         // Valeur de l'identifiant de l'operateur qui vient juste d'etre saisie par l'utilisateur
    $texte_courant;             // Valeur du texte qui vient juste d'etre saisie par l'utilisateur
    $nb_col_courant;            // numero de la colonne courante
    $nb_ligne_courant;          // numero de la ligne courante
    $ajout_col;                 //si $ajout_col = 1 : ajout d'une colonne dans la ligne courante
    $champ_retour;
    $module_table = $module;
    $champ_retour;              // Initialisation du nombre de lignes et de colones à 1 si il n'est pas déjà défini
    $tableau_affichage = Lib::isDefined("tableau_affichage");
    $name_operateur_recherche = Lib::isDefined("name_operateur_recherche");
    $return = Lib::isDefined("return");

// Initialisation du nombre de lignes et de colones à 1
    //si il n'est pas déjà défini
    if (!isset($nbligne) || $nbligne == '') {
        $nbligne = 1;
    }
    if (!isset($nbcol) || $nbcol == '') {
        $nbcol = 1;
    }
    $url = substr($url_page_depart, 1);
    $url = substr($url, 0, strlen($url) - 1);

    // Découpage des tableaux
    //Les lignes étant séparées par || et les colonnes par ;;

    $champ_recherche = explode('||', $champ_recherche);
    $operateur_recherche = explode('||', $operateur_recherche);
    $texte_recherche = explode('||', $texte_recherche);
    for ($i = 0; $i < $nbligne; $i++) {
        $champ_recherche[$i] = explode(';;', $champ_recherche[$i]);
        $operateur_recherche [$i] = explode(';;', $operateur_recherche[$i]);
        $texte_recherche [$i] = explode(';;', $texte_recherche[$i]);
    }

    // insertion de la valeur choisie par l'utilisateur dans une
    //des listes déroulantes
    if ($champ_courant != '')
        $champ_recherche[$nb_ligne_courant][$nb_col_courant] = $champ_courant;
    if ($operateur_courant != '')
        $operateur_recherche[$nb_ligne_courant][$nb_col_courant] = $operateur_courant;


    // Transformation des tableaux en une chaine de caratères
    //Les lignes étant séparées par || et les colonnes par ;;
    // on les stoke dans des tableaux auxiliaires

    if ($nbligne == 1) {    // Si une seule ligne
        if ($champ_recherche[0][0] != '')
            $champ_recherche_aux = implode(';;', $champ_recherche[0]);
        if ($operateur_recherche[0][0] != '')
            $operateur_recherche_aux = implode(';;', $operateur_recherche[0]);
        if ($texte_recherche[0][0] != '')
            $texte_recherche_aux = implode(';;', $texte_recherche[0]);
    }
    else {
        for ($i = 0; $i < $nbligne; $i++) {
            $champ_recherche_aux .= implode(';;', $champ_recherche[$i]);
            $champ_recherche_aux.='||';
            $operateur_recherche_aux .= implode(';;', $operateur_recherche[$i]);
            $operateur_recherche_aux.='||';
            $texte_recherche_aux .= implode(';;', $texte_recherche[$i]);
            $texte_recherche_aux.='||';
        }
    }

    // Initialisation des compteurs pour les lignes et pour les colonnes
    $cpt_col = 0; // compteur sur les colonnes
    $cpt_ligne = 0;    // compteur sur les lignes

    while ($cpt_ligne < $nbligne) { // parcours des lignes
        // Calcul du nombre de colones de la ligne courante
        $nbcol = count($champ_recherche[$cpt_ligne]);
        if ($cpt_ligne == $nb_ligne_courant) {
            $nbcol = count($champ_recherche[$cpt_ligne]) + $ajout_col;
        }
        if (!isset($nbcol) || $nbcol == '') {
            $nbcol = 1;
        }

        while ($cpt_col < $nbcol) { // parcours des colonnes
            $tableau_affichage[$cpt_ligne][$cpt_col] = "";
            // Nom du formulaire courant
            $name_form = 'recherche_' . $cpt_ligne . '_' . $cpt_col;

            // creation du formulaire
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<form name=$name_form  method=post action=../lib/action.php>";

            // nom de la premiere liste deroulante
            $name_champ_recherche = "selection_champ_recherche_" . $cpt_ligne . '_' . $cpt_col;
            $liste_champ = "<select name=$name_champ_recherche onChange=lien_selection('$name_form','$name_champ_recherche')>";

            // creation de la liste déroulante
            $liste_champ = "<select name=$name_champ_recherche onChange=lien_selection('$name_form','$name_champ_recherche','$name_operateur_recherche')>";

            // nom de la table ou sont repertorié les champs possibles de recherches
            $t = $module_table;
            $t.='_moteur_de_recherche';

            // pour les champs avec priorité haute
            $desc = " SELECT *
                               FROM $t
                               WHERE priorite_moteur_de_recherche = 1
                               order by nom_champ_usuel_moteur_de_recherche ";
            $resultat = DatabaseOperation::query($desc) or die('Erreur SQL !' . $desc . '<br>' . mysql_error());

            if (!strstr($url_page_depart, '?'))
                $lien = $url . "?url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
            else
                $lien=$url . "&url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";

            // remplissage de la première liste déroulante
            $liste_champ.="<option value" . $lien;
            $liste_champ.="=>Selectionnez </option>";
            while ($enr = mysql_fetch_array($resultat, MYSQL_NUM)) {
                if ($champ_recherche[$cpt_ligne][$cpt_col] != '') {   // Si la categorie est déja selectionnée
                    if ($enr[0] == $champ_recherche[$cpt_ligne][$cpt_col])
                        $selected = 'selected';
                    else
                        $selected = '';
                }

                $liste_champ.="<option value=" . $lien . $enr[0] . " " . $selected;
                $liste_champ.=">$enr[3]</option>";
            }
            $liste_champ.="<option value=" . $lien;
            $liste_champ.=">==================================</option>";

            // pour les autres champs
            $desc = " SELECT *
                               FROM $t
                               WHERE priorite_moteur_de_recherche = 0
                               order by nom_champ_usuel_moteur_de_recherche";
            $resultat = DatabaseOperation::query($desc) or die('Erreur SQL !' . $desc . '<br>' . mysql_error());

            while ($enr = mysql_fetch_array($resultat, MYSQL_NUM)) {
                if ($champ_recherche[$cpt_ligne][$cpt_col] != '') {   // Si la categorie est déja selectionnée
                    if ($enr[0] == $champ_recherche[$cpt_ligne][$cpt_col])
                        $selected = 'selected';
                    else
                        $selected = '';
                }
                if (!strstr($url_page_depart, '?'))
                    $lien = $url . "?url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                else
                    $lien=$url . "&url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                $liste_champ.="<option value=" . $lien . $enr[0] . " " . $selected;
                $liste_champ.=">$enr[3]</option>";
            }
            $liste_champ.="</select>";

            $tableau_affichage[$cpt_ligne][$cpt_col].= $liste_champ;

            // Création de la deuxieme liste deroulante en fonction de la première
            // Elle va contenir les operateurs de recherches
            // nom de la liste deroulante
            $name_operateur_recherche = "selection_operateur_recherche_" . $cpt_ligne . '_' . $cpt_col;

            // creation de la liste
            $liste_operateur = "<select name=$name_operateur_recherche onChange=lien_selection('$name_form','$name_operateur_recherche')>";

            $liste_operateur.="<option value=''>Selectionnez </option>";

            if ($champ_recherche[$cpt_ligne][$cpt_col] != '') {    // si une valeur a ete saisie dans la premiere liste
                // recuperation du nom de la table et du nom du champ
                // sur lequel on veut faire la recherche
                $t = $module_table;
                $t.='_moteur_de_recherche';

                $aux = 'table_';
                //$aux.=$t;
                $aux.='moteur_de_recherche';

                $aux2 = 'nom_champ_';
                //$aux2.=$t;
                $aux2.='moteur_de_recherche';

                $aux3 = 'id_';
                //$aux3.=$t;
                $aux3.='moteur_de_recherche';

                $aux4 = $champ_recherche[$cpt_ligne][$cpt_col];

                $desc5 = " SELECT $aux,$aux2
                                  FROM $t
                                  WHERE
                                  $aux3 = '$aux4'";

                $result1 = DatabaseOperation::query($desc5) or die('Erreur SQL !' . $desc5 . '<br>' . mysql_error());
                $aux5 = mysql_fetch_array($result1, MYSQL_NUM);

                $nom_table = $aux5[0];
                $nom_champ = $aux5[1];

                // Chercher le type de $nom_champ dans $nom_table

                $rech_type = " SELECT $nom_champ
                                      FROM $nom_table";
                $rech_type_res = DatabaseOperation::query($rech_type) or die('Erreur SQL !' . $rech_type . '<br>' . mysql_error());

                // type du champ sur lequel on fait la recherche
                $type = mysql_field_type($rech_type_res, 0);

                // recherche de l'identifiant du type :
                $rech_id_type = " SELECT  id_intranet_moteur_de_recherche_type_de_champ
                                    FROM intranet_moteur_de_recherche_type_de_champ
                                    WHERE type_intranet_moteur_de_recherche_type_de_champ = '$type'";
                $rech_id_type_res = DatabaseOperation::query($rech_id_type) or die('Erreur SQL !' . $rech_id_type . '<br>' . mysql_error());
                $tmp = mysql_fetch_array($rech_id_type_res, MYSQL_NUM);

                // identifiant du type du champ sur lequel on fait la recheche
                $id_type = $tmp[0];

                // en fonction du type du champ recherche des operateurs de recherche
                // possibles
                $sql = " SELECT op_intranet_moteur_de_recherche_association_type_operateur
                              FROM intranet_moteur_de_recherche_association_type_operateur
                              WHERE type_intranet_moteur_de_recherche_association_type_operateur ='$id_type'";
                $resultat2 = DatabaseOperation::query($sql) or die('Erreur SQL !' . $sql . '<br>' . mysql_error());

                while ($enr2 = mysql_fetch_array($resultat2, MYSQL_NUM)) {
                    $sql2 = " SELECT *
                                      FROM intranet_moteur_de_recherche_operateur_sur_champ
                                      WHERE  id_intranet_moteur_de_recherche_operateur_sur_champ='$enr2[0]'";
                    $resultat3 = DatabaseOperation::query($sql2) or die('Erreur SQL !' . $sql2 . '<br>' . mysql_error());
                    $enr3 = mysql_fetch_array($resultat3, MYSQL_NUM);
                    if ($operateur_recherche[$cpt_ligne][$cpt_col] != '') {
                        if ($enr3[0] == $operateur_recherche[$cpt_ligne][$cpt_col])
                            $selected = 'selected';
                        else
                            $selected = '';
                    }
                    // remplissage de la deuxieme liste deroulante
                    if (!strstr($url_page_depart, '?'))
                        $lien = $url . "?url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&operateur_courant=";
                    else
                        $lien=$url . "&url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&operateur_courant=";

                    $liste_operateur.="<option value=" . $lien . $enr3[0] . " " . $selected;
                    $liste_operateur.=">$enr3[1]</option>";
                }

                //création de l'espace de saisie
                // nom de l'espace de saisie
                $name_val = 'val_' . $cpt_ligne . '_' . $cpt_col;

                // si on a deja saisie une valeur :
                $temp = $texte_recherche[$cpt_ligne][$cpt_col];

                // on regarde si c'est une date
                if (strchr($temp, '-')) {
                    $a = substr($temp, 0, 4);
                    $mois = substr($temp, 5, -3);
                    $j = substr($temp, 8, 10);
                }

                switch (TRUE) {

                    case $operateur_recherche[$cpt_ligne][$cpt_col] == 9 : //Liste

                        $req_temp = "SELECT DISTINCT $nom_champ FROM $nom_table ORDER BY $nom_champ";
                        $result_temp = DatabaseOperation::query($req_temp);
                        $saisie_utilisateur = "<select size=1 name=$name_val value=$temp>";
                        $verrou = 0;
                        $oui_non = 1;
                        while ($rows = mysql_fetch_array($result_temp)) {

                            if ("$rows[0]" == "$temp") {
                                //echo "$temp";
                                $select = "selected";
                            } else {
                                $select = "";
                            }

                            if ($rows[0] != "1" and $rows[0] != "0")
                                $oui_non = 0;

                            //Vérification de la tailles des entées
                            if (strlen($rows[0]) < 50) {
                                if ($rows[0] != "") {
                                    $saisie_utilisateur.="<option value=`$rows[0]` $select> $rows[0] </option>";
                                }
                            } else {
                                $verrou = 1;
                            }
                        }
                        $saisie_utilisateur.="</select>";
                        if ($verrou) {
                            $saisie_utilisateur.="<img src=images/exclamation.png title='Certaines données ne peuvent pas être affichées car trop grandes' width=20 height=20 border=0 />";
                        }

                        //Bouton radio Oui/Non
                        if ($oui_non) {

                            switch ($temp) {
                                case 0:
                                    $checked_oui = "";
                                    $checked_non = "selected";
                                    break;
                                case 01:
                                    $checked_oui = "selected";
                                    $checked_non = "";
                                    break;
                            }

                            $saisie_utilisateur = "<select size=1 name=$name_val value=$temp>"
                                    . "<option value=1 $checked_oui>Oui</option>"
                                    . "<option value=0 $checked_non>Non</option>"
                                    . "</select>"
                            ;
                        }

                        break;

                    case $id_type == "5":  // si le type du champ choisi dans la premiere liste deroulante
                        // est une date on affiche 3 cases pour la saisie
                        $name_val_j = $name_val . '_jour';
                        $saisie_utilisateur = "<INPUT type='text' size=2 maxlength=2 name='$name_val_j'value=$j>";
                        $saisie_utilisateur.="/";
                        $name_val_m = $name_val . '_mois';
                        $saisie_utilisateur.="<INPUT type='text' size=2 maxlength=2 name='$name_val_m'value=$mois>";
                        $saisie_utilisateur.="/";
                        $name_val_a = $name_val . '_annee';
                        $saisie_utilisateur.="<INPUT type='text' size=4 maxlength=4  name='$name_val_a'value=$a>";

                        break;

                    default:   // sinon on affiche un champ de texte
                        $saisie_utilisateur = "<INPUT type='text' size=10 name='$name_val' value='$temp'>";
                }
            }
            $liste_operateur.="</select>";

            $tableau_affichage[$cpt_ligne][$cpt_col].= $liste_operateur;
            $tableau_affichage[$cpt_ligne][$cpt_col].= $saisie_utilisateur;
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<br>";

            $action = 'ajout';
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=url_page_depart value=$url_page_depart>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=module value=$module>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=module_table value=$module_table>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=champ_retour value=$champ_retour>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=action value=$action>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=champ_recherche value=$champ_recherche_aux>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=operateur_recherche value=$operateur_recherche_aux>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=texte_recherche value=$texte_recherche_aux>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=nb_ligne_courant value=$cpt_ligne>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=nb_col_courant value=$cpt_col>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=texte_courant value=$texte_courant>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=nbligne value=$nbligne>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=nbcol value=$nbcol>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=name_val value=$name_val>";
            $tableau_affichage[$cpt_ligne][$cpt_col].="<input type=hidden name=nb_limite_resultat value=$nb_limite_resultat>";

            // creation des boutons de choix une fois la saisie de la recherche terminée
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=radio value=et name=boutton_operateur>Et<br>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=radio value=ou name=boutton_operateur >Ou<br>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=radio value=Ou_avec name =boutton_operateur >Ou (avec recopie)<br>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=radio value='Suppr'name=boutton_operateur >Supprimer<br>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=radio value=fin name =boutton_operateur checked>Fin de saisie<br>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type=submit value=Ok name =ok>";
            $tableau_affichage[$cpt_ligne][$cpt_col].= "</form>";
            $cpt_col++;
        }
        $cpt_col = 0;
        $cpt_ligne++;
    }
    //$tableau_affichage[$cpt_ligne][$cpt_col].= '</form>';
    $tableau_affichage[$cpt_ligne][$cpt_col] = '</form>';

    /*
      Création de l'interface HTML
     */
    // affichage du formulaire
    $return.='<table class=contenu>';
    for ($i = 0; $i < $nbligne; $i++) {
        $return.='<tr>';
        for ($j = 0; $j < count($tableau_affichage[$i]); $j++) {
            $return.='<td>';
            $return.= $tableau_affichage[$i][$j];
            $return.= "</td>";
            if ($j < count($tableau_affichage[$i]) - 1) {
                $op = 'ET';
                $return.='<td>';

                $return.="<img src=../lib/moteur_de_recherche_image.php?op=$op>";
                $return.='</td>';
            }
        }
        $return.='</tr>';
        if ($i < $nbligne - 1) {
            $op = 'OU';
            $return.='<td>';
            $return.="<img src=../lib/moteur_de_recherche_image.php?op=$op><br><br>";
            $return.='</td>';
        }
    }
    $return.='</table>';


    return $return;
}

//Fin de la fonction


/* * *****************************************************************************
  Algo de recherche de jointures pour 1 champ

  Dictionnaire des variables :
  $table_rech = nom de la table du champ que l'utilisateur a selectionner.
  $nbligne_jointure = variable qui contiendra le nombre de jointure contenue dans le fichier
 * ***************************************************************************** */

function jointure($champ_sel, $url_page_depart, $module) {
    // Dictionnaire des variables
    $module_table = $GLOBALS['module_table'];     // Module de l'emplacement du moteur de recherche
    $champ_retour = $GLOBALS['champ_retour'];  // Nom du champ retour (resultat)  nomtable.nom_champ
    $table_champ_retour = $GLOBALS['table_champ_retour'];  // table du champ retour
    $table_tous_champs_rech = $GLOBALS['table_tous_champs_rech'];

    $result = array();
    // Fichier qui contient les differentes liaisons entre les tables
    //d'un meme module



    $file = '../' . $module . '/sql.map';


    // Recherche du nom de la table du champ que l'utilisateur a selectionné
    $nom_table = "table_moteur_de_recherche";
    $nom = "nom_champ_moteur_de_recherche";
    $table_req = " SELECT $nom_table FROM $table_tous_champs_rech
                        WHERE $nom='$champ_sel'";
    $table_resultat = DatabaseOperation::query($table_req);
    $table_enr = mysql_fetch_array($table_resultat, MYSQL_NUM);
    // nom de la table
    $table_rech = $table_enr[0];

    /*     * *****************************************************************************
      Transformation du fichier $file en 1 tableau pour les jointures

      $tab_jointure[][] = Tableau a 2 dimensions qui va contenir  :
     * dans sa premiere colonne
      - soit 0 (si la jointure n'a pas été utilisée)
      - soit 1 (si elle a deja ete utilisée)
     * dans sa deuxieme colonne : la jointure en elle meme.
     * ****************************************************************************** */
    unset($tab_jointure);       //on vide le tableau
    if (file_exists("$file")) {    // Test de l'existance du fichier
        // Ouverture du fichier en lecture
        $fp = fopen("$file", "r");
        $nbligne_jointure = 0;   // le nombre de jointure
        if ($fp) {                   // Si le fichier est ouvert
            $toute_ligne = fgets($fp, 4096);    // lecture d'une ligne
            while (!feof($fp)) {     // tant qu'on n'est pas a la fin du fichier
                if ($toute_ligne[0] != '#') {   // on saute les lignes en commentaires
                    $tab_jointure[][1] = $toute_ligne;  // on rempli le tableau
                    $nbligne_jointure++;
                }
                $toute_ligne = fgets($fp, 4096);    // lecture d'une ligne
            }
        } else {
            $titre = 'ERREUR';
            $message = 'Probleme d\'ouverture du fichier ';
            $message .=$file;
            afficher_message($titre, $message, $redirection);
            exit();
        }
    } else {
        $titre = 'ERREUR';
        $message = 'Le fichier ';
        $message .=$file;
        $message .= " n'existe pas ! ";
        afficher_message($titre, $message, $redirection);
        exit();
    }

    // initialisation du marquage à 0
    for ($j = 0; $j < $nbligne_jointure; $j++) {
        $tab_jointure[$j][0] = 0;
    }

    /*     * *****************************************************************************
      Jointures et chemin forcé
      Pour pouvoir determiner toutes les jointures entre la table qui contient la valeur
      que l'on recherche et la table qui contient le resultat que l'on attend
      On utilise un algorithme de parcours en profondeur
      Explication :
      point de depart = la table du champ que l'ulisateur vient de selectionner
      pour faire sa recherche.
      point d'arrivée = $table_champ_retour

      En partant du point de départ, il peut y avoir plusieurs chemins pour
      arriver au point d'arrivée.

      Les differentes étapes du chemin (les jointures) seront séparées
      par des AND,
      Les differents chemins seront séparés par des OR

      Le principe de parcours en profondeur :
      on explore un chemin jusqu'au bout, si la table de la
      dernière jointure (étape) est le point d'arrivée
      on l'enregistre dans le tableau $chemin

      Chemin forcé :
      Si un champ a un chemin forcé alors il faut trouver
      la jointure entre ce champ et son étape forcé
      ( IMPORTANT un champ ne peut avoir de lien forcé qu'avec une table qui a
      une jointure directe avec lui)
      Et ensuite trouver les jointures entre l'étape forcée et
      la table de retour.

      Dictionnaire des variables :

      $requete = va contenir le resultat de la fonction cad les jointures
      $pile = va contenir le nom des tables trouvées au fur et a mesure
      $chemin[][] = tableau à 2 dimensions qui va contenir sur chaque ligne
      un chemin valide

     * ****************************************************************************** */

// Recherche dans la table  $module_table_moteur_de_recherche si le champ à un chemin forcé

    $nom_chemin = 'chemin_force_moteur_de_recherche';
    $nom = 'nom_champ_moteur_de_recherche';
    $chemin_req = " SELECT $nom_chemin FROM $table_tous_champs_rech
                         WHERE $nom='$champ_sel'";
    $chemin_resultat = DatabaseOperation::query($chemin_req);
    $chemin_enr = mysql_fetch_array($chemin_resultat, MYSQL_NUM);

    // chemin force
    $chemin = $chemin_enr[0];

    $requete = '';
    $ligne = 0;
    $col = 0;

    if ($chemin != '') {// si elle a un chemin forcé
        // on recherche la jointure correspondante
        $j = 0;
        while ($j < $nbligne_jointure) {    // on parcours tout le tableau de jointure
            $aux = explode('=', $tab_jointure[$j][1]);
            if (trim($aux[0]) == trim($chemin)) {
                $tmp1 = explode('.', $aux[1]);
                if (trim($tmp1[0]) == trim($table_rech))
                    $jointure_force = $tab_jointure[$j][1];
            }
            else {
                if (strcmp(trim($aux[1]), trim($chemin)) == 0) {
                    $tmp1 = explode('.', $aux[0]);
                    if (trim($tmp1[0]) == trim($table_rech))
                        $jointure_force = $tab_jointure[$j][1];
                }
            }
            $j++;
        }

        if ($jointure_force == '') {  // si il n'y a pas de jointure correspondant au chemin forcé
            //ERREUR
            $titre = 'ERREUR';
            $message = 'Probleme de jointure : le champ ';
            $message .=$chemin;
            $message .= "n'est pas reliée à la table  ";
            $message .=$table_rech;
            afficher_message($titre, $message, $redirection);
        } else {
            // On change $table_rech
            // la table du champ de recherche devient le nom de la table
            // du champ de la jointure forcée
            $tmp = explode('.', $chemin);
            $table_rech = $tmp[0];
            $requete[$ligne][1] = $jointure_force;
            $requete[$ligne][0] = 0;
            $ligne++;
        }
    }
    if ($table_champ_retour != $table_rech) {
        // Besoin de jointure
        $l = 0;   // nombre de ligne du tableau chemin
        $p = 0;   // nombre de colonne du tableau chemin
        $pile = array();      // creation d'un tableau
        array_push($pile, $table_rech);   // on empile la table de départ
        while (count($pile) > 0) {     // tant que la pile n'est pas vide
            $j = 0;
            while ($j < $nbligne_jointure) {    // on parcours tout le tableau de jointure
                $aux = explode('=', $tab_jointure[$j][1]);
                $tmp1 = explode(".", $aux[0]);
                $tmp2 = explode(".", $aux[1]);
                // si on trouve la table $pile[$p] dans une jointure
                if (($pile[$p] == $tmp1[0] OR $pile[$p] == $tmp2[0]) AND $tab_jointure[$j][0] != 1) {
//echo "test";
                    $p++;
                    // on marque la jointure pour ne pas avoir de doublons
                    $tab_jointure[$j][0] = 1;
                    // dans le tableau des chemins on garde le numero de la ligne ou se trouve la jointure
                    $chemin[$l][$p] = $j;
                    // on recupere le nom de la table qui fait une jointure avec $pile[$p-1]
                    if ($pile[$p - 1] == $tmp1[0]) {
                        $a_empiler = $tmp2[0];
                    } else {
                        $a_empiler = $tmp1[0];
                    }
                    if ($a_empiler == $table_champ_retour) {// si on est a la fin d'un chemin VALIDE
                        $chemin[$l + 1] = $chemin[$l]; // on recopie le bon chemin dans la ligne d'apres
                        $z = array_pop($chemin[$l + 1]);  // mais on supprime le dernier element
                        $l++;
                        $p--;
                    } else {
                        array_push($pile, $a_empiler);  // on empile le nom de la table
                        $j = -1;   //on repart au debut de la liste des jointures
                    }
                }
                $j++;
            }
            if ($j == $nbligne_jointure) {// Fin d'un chemin mais non valide
                $z = array_pop($pile); // on depile le dernier element de la pile
                // on supprime la derniere etape du chemin
                //echo $chemin[$l][$p]."<br>";
                unset($chemin[$l][$p]);

                //Rajout du contrôle de l'existance -- 2007-01-15 Boris.
                /*
                  if($chemin[$l][$p])
                  {
                  // on supprime la derniere etape du chemin
                  unset($chemin[$l][$p]);
                  }
                 */
                $p--;
            }
        }

        if (count($pile) == 0) { // Si la pile est vide, on a parcouru tous les chemins
            if (count($chemin[0]) == 0) {   // si le tableau de chemin est vide = table isolée = ERREUR
                $titre = 'ERREUR';
                $message = 'Probleme de jointure : la table ';
                $message .=$table_rech;
                $message .= " n'est pas reliée à la table  ";
                $message .=$table_champ_retour;
                afficher_message($titre, $message, $redirection);
                exit();
            } else {
                // ecriture de la requete
                // la requete est saisie dans un tableau a 2 dimensions sur le meme
                // principe que le tableau des jointures (avec une premiere colonne a 0
                // pour le marquage et la 2eme colonnes contient les jointures pour un chemin
                // separée par des AND
                for ($i = 0; $i < $l; $i++) {
                    $requete[$ligne][0] = 0;
                    for ($j = 1; $j <= count($chemin[$i]); $j++) {
                        $q = $chemin[$i][$j];
                        $requete[$ligne][1].= $tab_jointure[$q][1];
//echo  $requete[$ligne][1]."<br>";
                        if ($j < count($chemin[$i]))
                            $requete[$ligne][1].=' AND ';
                        $aux = explode('=', $tab_jointure[$q][1]);
                        $table1 = explode('.', $aux[0]);
                        $table2 = explode('.', $aux[1]);
                    }
                    $ligne++;
                }
            }
        }
    }

    //Il n'y a pas de jointure
    if ($requete == "") {
        $result[0][0] = 0;
        $result[0][1] = "";
    } else {
        $result = $requete;
    }
    return $result;
}

/* -----------------------------
  recuperation valeur timeout
  pour deconnexion session
  ----------------------------- */

function timeout($id_user) {
//$requete = DatabaseOperation::query("select * from perso where id_user = $id_user");
//$rows = mysql_fetch_array($requete);
//$time = $rows[timeout] * 60;
//if (!$time){$time = 900;}
//return ($time);
    return 900;
}

/*
  Test de chargement des images GIF
 */

function LoadGif($imgname) {
    $im = @imagecreatefromgif($imgname); /* Tentative d'ouverture */
    if (!$im) { /* Test d'échec */
        $im = imagecreate(150, 30); /* Création d'une image vide */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Affichage d'un message d'erreur */
        imagestring($im, 1, 5, 5, "Erreur au chargement de l'image $imgname", $tc);
    }
    return $im;
}

/* -------------------------------------------------------
  verification bon droits utilisateur pour les pages admin
  --------------------------------------------------------- */

function securadmin($typepag, $id_type) {
    if ($typepag > $id_type) {
        header("Location: ../index.php?action=delog");
    }
    if (!$id_type) {
        header("Location: ../index.php?action=delog");
    }
}

function securce($id_user, $id_type) {
    if ($id_type != 4) {
        $coco = DatabaseOperation::query("select membre_ce from salaries where id_user = $id_user");
        $reponse = mysql_fetch_array($coco);
        if ($reponse[membre_ce] != "oui") {
            header("Location: ../index.php?action=delog");
        }
    }
}

/* ----------------------------------------------------------
  fonction permettant de voir le nombre d'article de nivo 1 pour un service particulier
  synthese qui s'affiche lors de la publication d'un article
  ------------------------------------------------------------- */

function etatnivo($servauteur) {
    $home1 = DatabaseOperation::query("select * from articles where id_art_serv='$servauteur' and homepage='1' and nivo_conf='1' and date_modif!='0'");
    $ng1 = mysql_num_rows($home1);

    $home2 = DatabaseOperation::query("select * from articles where id_art_serv='$servauteur' and homepage='2' and nivo_conf='1' and date_modif!='0'");
    $ng2 = mysql_num_rows($home2);
    $home3 = DatabaseOperation::query("select * from articles where id_art_serv='$servauteur' and homepage='3' and nivo_conf='1' and date_modif!='0'");
    $ng3 = mysql_num_rows($home3);
    $home4 = DatabaseOperation::query("select * from articles where id_art_serv='$servauteur' and homepage='4' and nivo_conf='1' and date_modif!='0'");
    $ng4 = mysql_num_rows($home4);

    $infohome = array("$ng1", "$ng2", "$ng3", "$ng4");
    return($infohome);
}

/* * *****************************************************************************
  Conversion des images dans l'intranet
 */

function imagefile2png($file) {
    /*
      Dictionnaire des variables:
     * **************************
     */
    $file;                                   //nom du fichier source
    $info = pathinfo($file);                   //Récupération des informations
    $filepath = $info["dirname"];              //Répértoire
    $filename = substr($info["basename"], 0, strrpos($info["basename"], '.'));             //Nom du fichier
    $fileextension = $info["extension"];       //Extension
    $return = "1";                             //Par défaut ça doit bien se passer
//Corps de la fonction

    $image_type = exif_imagetype("$file");

    switch ($image_type) {
        case 1: //GIF
            $t = `giftopnm $file | pnmtopng > $filepath/$filename.png`;
            break;

        case 2: //JPEG
            $t = `jpegtopnm $file | pnmtopng > $filepath/$filename.png`;
            break;

        case 3: //PNG
            $t = `pngtopnm $file | pnmtopng > $filepath/$filename.png`;
            break;

        case 15: //WBMP
            $t = `wbmptopbm $file | pbmtopgm | pgmtoppm | ppmtojepg | jpegtopnm | pnmtopng > $filepath/$filename.png`;
            break;

        case 16: //XBM
            $t = `xbmtopbm $file | pbmtopgm | pgmtoppm | ppmtojepg | jpegtopnm | pnmtopng > $filepath/$filename.png`;
            break;

        case 6: //BMP
            $t = `bmptopnm $file | pnmtopng > $filepath/$filename.png`;
            break;

        case 7: //TIFF II
        case 8: //TIFF MM
            $t = `tifftopnm $file | pnmtopng > $filepath/$filename.png`;
            break;


        case 4: //SWF
        case 5: //PSD
        case 7: //TIFF II
        case 8: //TIFF MM
        case 9: //JPC
        case 10: //JP2
        case 11: //JPX
        case 12: //JB2
        case 13: //SWC
        case 14: //IFF
            $return = "0";
            break;
    }
    $t = `rm $file`;

    //Attend 5 secondes
    //sleep(5);

    return $return;
}

/*
  Fin de Conversion des images dans l'intranet
 * ***************************************************************************** */

//**************************************************************************
// Fonction makeSelectListChecked_sm                                      //
//     modifiée par sm pour rajouter un paramètre ($select) qui permet    //
//     de pré-sélectionner une valeur par défaut dans cette liste         //
// Permet de créer une liste déroulante d'un champ de type enum           //
// en selectionnant un champ ($field) d'une table ($table)                //
//**************************************************************************
function makeSelectListChecked_sm($nombase, $table, $field, $val, $select) {
    $s = "";
    $req = ("SHOW COLUMNS FROM $table");
    $rid = DatabaseOperation::query($req);
    $nr = mysql_num_rows($rid);

    while (list($name, $type) = mysql_fetch_row($rid)) {
        //echo ("1er name = $name / type  $type <br>");
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
                if ($select == $v)
                    $s.="<option selected>$v";
                else
                    $s.="<option>$v";
            }
        }
    }
    return($s);
}

; // fin fonction makeSelectListChecked_sm


/*
  Fonction de création d'une liste déroulante basée sur une table
  Cette fonction ne gère pas les tables à clefs primaires multiples
 */

function afficher_table_en_liste_deroulante($nom_table, $champ, $id_defaut, $nom_liste) {

    $premiere_operateur = 0;

    //Recherche de la clef
    $propriete = DatabaseOperation::query("DESC $nom_table");
    while ($rows1 = mysql_fetch_array($propriete)) {
        //Creation de la variable potentiellement PRIMARY KEY
        $primary_key = $rows1[Field];

        //Est-ce que ce champ est une clef
        if ($rows1[Key] == "PRI") {
            $id_liste = $primary_key;
        }//Fin de Recherche de la clef sur ce champ
    }//Fin WHILE de recherche des clefs
    //Création de la liste déroulante
    if ($nom_liste == ""

        )$nom_liste = $id_liste;
    $html_liste = "<select name=$nom_liste>";


    //Création du contenu de la liste
    $req = "SELECT $id_liste, $champ FROM $nom_table "
            . "ORDER BY $champ"
    ;
    $result = DatabaseOperation::query($req);
    while ($rows = mysql_fetch_array($result)) {
        if ($rows[$id_liste] == $id_defaut) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        $html_liste .= "<option value=$rows[$id_liste] $selected>$rows[$champ]</option>";
    }
    $html_liste .= "</select>";

    return $html_liste;
}

/*
  Fonction de création d'une liste déroulante basée sur une requete SQL
  le premier champ retourné par la requête est désigné comme Clef de la liste
  le second alimente le contenu de la liste déroulante
 */

function afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut) {
//echo $id_defaut;
    //Recherche de la clef
    $result = DatabaseOperation::query($requete);
    $table = mysql_fetch_array($result);
    if (!$table) {//Si la liste est vide
        $html_liste = "<i>(vide)</i>";
    } else {
        $key = array_keys($table);
        if (!$nom_defaut) {
            $nom_defaut = $key[1];
        }

        //Création de la liste déroulante
        $html_liste = "<select name=$nom_defaut onChange=" . $nom_defaut . "_js()>";

        //Création du contenu de la liste
        $result = DatabaseOperation::query($requete);
        while ($rows = mysql_fetch_array($result)) {
            if ($rows[0] == $id_defaut) {
                $selected = " selected";
            } else {
                $selected = "";
            }

            $html_liste .= "<option value=$rows[0]$selected>$rows[1]</option>";
        }
        $html_liste .= "</select>";
    }//Fin de la construction de la liste

    return $html_liste;
}

//Fonction récursive
function recursif($resultat, $id_recherche, $champ_id_pere, $champ_id_fils, $champ_valeur, $tab_fils, $tab_arborescence, $tab_espace, $return, $nombre_ligne, $extension
) {
    //Afficher le niveau dans lequel on est:
    //echo $id_recherche;
    //echo $champ_id_pere;
    //echo $champ_id_fils;
    //echo $champ_valeur;
    /* echo $tab_fils;
      $tab_arborescence,
      $tab_espace,
      $return,
      $nombre_ligne,
      $extension  ; */
    $deploy = Lib::isDefined("deploy");
    $html_link_1 = Lib::isDefined("html_link_1");
    $html_link_2 = Lib::isDefined("html_link_2");


    $output = Lib::isDefined("output");

    //Décalage Graphique
    switch ($output) {
        case "pdf":
            $tab_tmp = "  ";
            $tab_return = "\n";
            break;

        case "html":
        default:
            $tab_tmp = "&nbsp";
            $tab_return = "<br>";
    }
    $tab_espace = $tab_tmp . $tab_tmp . $tab_tmp . $tab_tmp . $tab_tmp . $tab_arborescence . $tab_espace;

    //Compteur de la boucle
    $i = 0;
    $return[$i] = null;
    while ($i < ($nombre_ligne)) {
//$id_recherche;

        if (mysql_result($resultat, $i, $champ_id_pere) == $id_recherche) {
            //Enregistrement des informations
            //echo "test".$extension[3];
            //Structure
            $return[0] .= $tab_return . $tab_espace;

            //Liens
            if ($extension[1]) {
                $deploy = $extension[0]
                        //. $extension[1]
                        . mysql_result($resultat, $i, $champ_id_fils)
                        . $extension[2]
                ;
            }
            if ($extension[4]) {
                $html_link_1 = "<a href="
                        . $extension[4]
                        . mysql_result($resultat, $i, $champ_id_fils)
                        . " >"
                ;
                $html_link_2 = "</a>";
            }

            //Données
            if (isset($return[1]) and mysql_result($resultat, $i, $champ_id_fils)) {
                $return[1] .= ",";
            }
            $return[1] .= mysql_result($resultat, $i, $champ_id_fils);

            //Structure et Données
            $return[2] .= $tab_return . $tab_espace . $deploy . " " . $html_link_1 . stripslashes(mysql_result($resultat, $i, $champ_valeur)) . $html_link_2;


            $id_recherche_ancien = $id_recherche;
            $id_recherche = mysql_result($resultat, $i, $champ_id_fils);

            //Appel recursif de la fonction
            //echo "<br>".$id_recherche." ".$extension[3]." --- ". strstr($extension[3], ",".$id_recherche.",")."<br>";
            //echo strstr("123456", "2");
            //$test = strstr($extension[3], ",".$id_recherche.",");
            $liste_id = $extension[3];
            $dont_explore = $return[2];    //Permet de ne deployer tous les dossiers HTML tout en parcourant l'ensemble de l'arboresence.
            $return = recursif(
                            $resultat,
                            $id_recherche,
                            $champ_id_pere,
                            $champ_id_fils,
                            $champ_valeur,
                            $tab_fils,
                            $tab_arborescence,
                            $tab_espace,
                            $return,
                            $nombre_ligne,
                            $extension
            );

            if ($_SESSION["module"] <> "fiches_mp_achats") { //A optimiser !!
                if (!strstr($liste_id, "," . $id_recherche . ",")) {
                    $return[2] = $dont_explore;
                }
            }
            $id_recherche = $id_recherche_ancien;
        }

        $i = $i + 1;
    }

    $return;
    return $return;
}

//Fin de la déclaration de la fonction recursive


/* Construction d'une arboresence
  la fonction retourne le tableau de resultat suivant:
  $return[1] --> liste de éléments séparé par une virgule
  $return[2] --> Réprésentation de l'arborescence au format texte

 * ***************************** */

function arborescence_construction($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $sql_where, $extension) {
    /*
      Déclaration des variables:
     */
    /*     $table='matiere_premiere_composant';                       //nom de la table contenant l'association "Père" / "Fils"
      $champ_valeur='nom_matiere_premiere_composant';            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
      $champ_id_fils='id_matiere_premiere_composant';            //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
      $champ_id_pere='id_ascendant_matiere_premiere_composant';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
     */
    $table;                    //nom de la table contenant l'association "Père" / "Fils"
    //Peux aussi être une liste de table séparé par une virgule ex: "table1,table2"
    $champ_valeur;             //nom du champ contenant la valeur à afficher
    $champ_id_fils;            //nom du champ fils contenant l'id
    $champ_id_pere;            //nom du champ père contenant l'id

    $id_racine;                //Identifiant de l'enregistrement père racine (le premier)
    $id_recherche = $id_racine;  //Identifiant en cours de recherche
    $id_fils;                  //Identifiant du fils en cours de traitement
    $id_pere;                  //Identifiant du pre en cours de traitement
    $tab;                      //Nombre de tabulation permettant un affichage en cascade de l'arborescence
    $tab_init = '    ';          //Representation de la tabulation
    $sql_where;                //Permet de personnaliser la clause SQL "WHERE" comme pour insérer une jointure par exemple
    $return = '';                //Valeur retourne par la fonction
    //$return[1] --> liste de éléments séparé par une virgule
    //$return[2] --> Réprésentation de l'arborescence au format texte


    $extension = Lib::isDefined("extension");                //Tableau d'argument optionnelle de la fonction
//    $extension[0];             //Code HTML qui sera ajouter à la fin de la valeur dans la représentation graphique
//    $extension[1];             //0 ou 1. Permet de terminer le code HTML créé par $extension[0] avec l'id de l'objet en cours
//    $extension[2];             //Ordre tri: 0=Valeur, 1=Clefs Fils et 2=Clef Père
//    $extension[3];             //Liste des id à développer, si NULL, alors tout est développé
//    $extension[4];             //Lien lorqu'on clic sur un élément de l'arborescence (terminé par l'id)
    $tri;                      //Champ à trier

    /*
      Initialisation des variables
     */
    //$champ_valeur .= "_".$table;
    //$champ_id_fils.= "_".$table;
    //$champ_id_pere.= "_".$table;
    $id_pere = $id_racine;
    $tab_arborescence = '|';       //Signe Nouvelle Arborescence
    $tab_fils = '---> ';           //Signe Nouveau Fils
    $tab_espace = '----->';         //Espace de décalage
    if ($sql_where) {
        $sql_where = "WHERE " . $sql_where;
    }

    if (!$extension[2]) {
        $extension[2] = 1;  //Tri par défaut
    }

    //Configuration du tri de l'arborescence
    switch ($extension[2]) {

        case 0:$tri = $champ_valeur;
            break;
        case 1:$tri = $champ_id_fils;
            break;
        case 2:$tri = $champ_id_pere;
            break;
    }


    $requete_principale = "SELECT $champ_id_pere, $champ_id_fils, $champ_valeur FROM $table "
            . "$sql_where "
            . "ORDER BY $tri ASC "
    ;

    //echo $requete_principale;
    $resultat = DatabaseOperation::query($requete_principale);
    $nombre_ligne = mysql_num_rows($resultat);

    /*
      Corps de la fonction
     */



    //Lancement de la fonction
    //Appel recursif de la fonction
    $i = 1;    //Affiche le niveau dans lequel on est

    $return = recursif(
                    $resultat,
                    $id_recherche,
                    $champ_id_pere,
                    $champ_id_fils,
                    $champ_valeur,
                    $tab_fils,
                    $tab_arborescence,
                    $tab_espace,
                    $return,
                    $nombre_ligne,
                    $extension
    );

    //var_dump($return);
    return $return;
}
?>