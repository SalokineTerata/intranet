<?php

/**
 * Moteur de recherche
 * 
 * @author Franckwastaken
 */
class MoteurDeRecherche {

    /**
     * MOTEUR DE RECHERCHE
     * Cette fonction retourne l'affiche de l'interface du moteur de recherche
     * @param type $module
     * @param type $id_recherche
     * @param type $etat_table
     * @param type $id_recherche_etat
     * @param type $abreviation_recherche_etat
     * @param type $nom_recherche_recherche_etat
     * @param string $paramImageBordure
     * @param string $paramImageRecherche
     * @param type $champ_retour
     * @param int $paramNbLimiteDeResultat
     * @param type $url_page_depart
     * @param type $QUERY_STRING
     * @param type $PHP_SELF
     * @param type $nbligne
     * @param type $nbcol
     * @param type $champ_recherche
     * @param type $operateur_recherche
     * @param type $texte_recherche
     * @param type $champ_courant
     * @param type $operateur_courant
     * @param type $texte_courant
     * @param type $nb_col_courant
     * @param type $ajout_col
     * @param type $paramRequete
     * @param type $tab_resultat
     * @param type $module_table
     * @return type
     */
    public static function afficherMoteurDeRecherche($module
    , $id_recherche, $etat_table, $id_recherche_etat
    , $abreviation_recherche_etat, $nom_recherche_recherche_etat, $paramImageBordure
    , $paramImageRecherche, $champ_retour, $paramNbLimiteDeResultat
    , $url_page_depart, $QUERY_STRING, $PHP_SELF
    , $nbligne, $nbcol, $champ_recherche
    , $operateur_recherche, $texte_recherche, $champ_courant
    , $operateur_courant, $texte_courant, $nb_col_courant
    , $ajout_col, $paramRequete, $tab_resultat, $module_table
    , $nb_ligne_courant
    ) {
        /*
          Définition des Variables
         */

        if ($url_page_depart == '') {
            if ($QUERY_STRING) {
                $url_page_depart = '(' . $PHP_SELF . '?' . $QUERY_STRING . ')';
            } else {
                $url_page_depart = '(' . $PHP_SELF . ')';
            }
        }

        $return = "";
        $_REQUEST['table_champ_retour'] = $module_table;  // table du champ retour
        $_REQUEST['table_tous_champs_rech'] = $module_table . "_moteur_de_recherche";
        $tab_resultat;


//Construction du code HTML
        $return.= "
     <center>
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . "> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=" . $paramImageBordure . ">
     <br>
     </center>
     <center>
     <table width=100% border=1 valign=top cellspacing=0>
     <tr>
     <td class=titre_principal><img src=" . $paramImageRecherche . " WIDTH=70 HEIGHT=50 align=left> <br> Recherche <br><br></td>
     </tr>
     <tr>
     <td colspan=3> ";


        $return.=MoteurDeRecherche::recuperationDesDonneesDeRecherche(
                        $module, $url_page_depart, $module_table
                        , $champ_retour, $paramNbLimiteDeResultat, $nbligne
                        , $nbcol, $champ_recherche, $operateur_recherche
                        , $texte_recherche, $champ_courant, $operateur_courant
                        , $texte_courant, $nb_col_courant, $nb_ligne_courant
                        , $ajout_col
        );

        $return.= "</td>
      </tr>
      </table>
      ";

        if ($tab_resultat) {
            $tab_resultat = explode(';;', $tab_resultat);
        }
        $return.= "
     <table width=100% border=1 valign=top cellspacing=0>
     <tr>
     <td class=titre_principal> <br> Résultats <br><br></td>
     </tr>
     ";


        $choix = -1;    // pour que l'on affiche les entetes du tableau une seule fois
        $tableau_fiche = '';


        if ($paramRequete) {

//On vérifie si le résultat n'est pas nul
            $result_requete_resultat = DatabaseOperation::convertSqlStatementWithoutKeyToArray($paramRequete);
            if (!$result_requete_resultat) {
                $titre = 'Moteur de Recherche';
                $message = 'Vos critères de recherche ne donnent aucun résultat.';
                afficher_message($titre, $message, $redirection);
            }

//Regroupement par Etat du résultat
            $req = "SELECT * FROM $etat_table ";

//Spécificité propre au module FTMP
//Restriction par droit d'accès
//  $acces= $module."_modification";
//  echo $SESSION[$acces];
            if (!$_SESSION[$module . "_modification"] and $_SESSION["module"] == "fiches_mp_achats") {
                $req.= "WHERE " . $abreviation_recherche_etat . "='V' OR " . $abreviation_recherche_etat . "='E' ";
            }
            /**
             * Augmente le temps d'execution temporairement
             */
            ini_set('max_execution_time', 300);

            $result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

            foreach ($result as $rows) {
//Construction de la reqûete de resultat propre à cet Etat
                $req1 = "$paramRequete AND " . $id_recherche_etat . "=" . $rows[$id_recherche_etat];
                $result1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req1);

//Si il y a des résltat on commence la construction du tableau
                if ($result1) {

//Affichage de l'en-tête de regroupement

                    $return.= "<tr><td class=titre>" . $rows["nom_" . $etat_table] . "</td></tr>";

//Affichage des fiches
                    foreach ($result1 as $rows1) {

//echo $choix;
                        $return.= "<tr><td>"
                                . visualiser_fiches($rows1[$id_recherche], $choix, 0, "")
                                . "</td></tr>"
                        ;
                    }
                }
                $return.= "<br>";
            }// Fin de l'affichage des résultats;
        }


//Dans le cas où un résultat de recherche est proposé, affichage du tableau
//if ($tab_resultat){

        $return.= "</td></tr>
     </table>
     <br>
     <img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure>
     <img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure>
     <img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure>
     <img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure><img src=$paramImageBordure>
     ";

        return $return;

        /*         * *****************************************************************************
          FIN MOTEUR DE RECHERCHE
         * ***************************************************************************** */
    }

    private static function recuperationDesDonneesDeRecherche(
    $module, $url_page_depart, $module_table
    , $champ_retour, $nb_limite_resultat, $nbligne
    , $nbcol, $champ_recherche, $operateur_recherche
    , $texte_recherche, $champ_courant, $operateur_courant
    , $texte_courant, $nb_col_courant, $nb_ligne_courant
    , $ajout_col) {

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
        if ($champ_courant != '') {
            $champ_recherche[$nb_ligne_courant][$nb_col_courant] = $champ_courant;
        }
        if ($operateur_courant != '') {
            $operateur_recherche[$nb_ligne_courant][$nb_col_courant] = $operateur_courant;
        }


// Transformation des tableaux en une chaine de caratères
//Les lignes étant séparées par || et les colonnes par ;;
// on les stoke dans des tableaux auxiliaires

        if ($nbligne == 1) {    // Si une seule ligne
            if ($champ_recherche[0][0] != '') {
                $champ_recherche_aux = implode(';;', $champ_recherche[0]);
            }
            if ($operateur_recherche[0][0] != '') {
                $operateur_recherche_aux = implode(';;', $operateur_recherche[0]);
            }
            if ($texte_recherche[0][0] != '') {
                $texte_recherche_aux = implode(';;', $texte_recherche[0]);
            }
        } else {
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
//                $liste_champ = "<select name=$name_champ_recherche onChange=lien_selection('$name_form','$name_champ_recherche')>";
// creation de la liste déroulante
                $liste_champ = "<select name=$name_champ_recherche onChange=lien_selection('$name_form','$name_champ_recherche','$name_operateur_recherche')>";

// nom de la table ou sont repertorié les champs possibles de recherches
                $t = $module_table;
                $t.='_moteur_de_recherche';

// pour les champs avec priorité haute
                $desc = " SELECT * FROM " . $t
                        . " WHERE priorite_moteur_de_recherche = 1"
                        . " ORDER BY nom_champ_usuel_moteur_de_recherche ";
                $resultat = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($desc)
                        or die('Erreur SQL !' . $desc . '<br>' . PDO::errorInfo());

                if (!strstr($url_page_depart, '?')) {
                    $lien = $url . "?url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche='$champ_recherche_aux'&operateur_recherche='$operateur_recherche_aux'&texte_recherche='$texte_recherche_aux'&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                } else {
                    $lien = $url . "&url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche='$champ_recherche_aux'&operateur_recherche='$operateur_recherche_aux'&texte_recherche='$texte_recherche_aux'&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                }
// remplissage de la première liste déroulante
                $liste_champ.="<option value" . $lien;
                $liste_champ.="=>Selectionnez </option>";
                foreach ($resultat as $enr) {
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
                $resultat = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($desc) or die('Erreur SQL !' . $desc . '<br>' . PDO::errorInfo());

                foreach ($resultat as $enr) {
                    if ($champ_recherche[$cpt_ligne][$cpt_col] != '') {   // Si la categorie est déja selectionnée
                        if ($enr[0] == $champ_recherche[$cpt_ligne][$cpt_col])
                            $selected = 'selected';
                        else
                            $selected = '';
                    }
                    if (!strstr($url_page_depart, '?')) {
                        $lien = $url . "?url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                    } else {
                        $lien = $url . "&url_page_depart=$url_page_depart&nb_limite_resultat=$nb_limite_resultat&champ_recherche=$champ_recherche_aux&operateur_recherche=$operateur_recherche_aux&texte_recherche=$texte_recherche_aux&nbligne=$nbligne&nbcol=$nbcol&nb_col_courant=$cpt_col&nb_ligne_courant=$cpt_ligne&champ_courant=";
                    }
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

                    $desc5 = " SELECT " . $aux . "," . $aux2
                            . " FROM " . $t
                            . " WHERE " . $aux3 . " = " . $aux4 . "";

                    $result1 = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($desc5) or die('Erreur SQL !' . $desc5 . '<br>' . PDO::errorInfo());
                    foreach ($result1 as $rows1) {
                        $aux5 = $rows1;
                    }

                    $nom_table = $aux5[0];
                    $nom_champ = $aux5[1];

                    // Chercher le type de $nom_champ dans $nom_table

                    $rech_type = " SELECT $nom_champ
FROM $nom_table";
                    $rech_type_res = DatabaseOperation::queryPDO($rech_type) or die('Erreur SQL !' . $rech_type . '<br>' . PDO::errorInfo());

                    // type du champ sur lequel on fait la recherche
                    $type = $rech_type_res->getColumnMeta(0);

                    /**
                     * le type de champs diffère entre PDO et Mysql modifier la table intranet_moteur_de_recherche_type_de_champ
                     */
                    // recherche de l'identifiant du type :
                    $rech_id_type = " SELECT id_intranet_moteur_de_recherche_type_de_champ
FROM intranet_moteur_de_recherche_type_de_champ
WHERE type_intranet_moteur_de_recherche_type_de_champ = '" . $type["native_type"] . "'";
                    $rech_id_type_res = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($rech_id_type) or die('Erreur SQL !' . $rech_id_type . '<br>' . PDO::errorInfo());
                    foreach ($rech_id_type_res as $rowsrech_id_type_res) {
                        $tmp = $rowsrech_id_type_res;
                    }


                    // identifiant du type du champ sur lequel on fait la recheche
                    $id_type = $tmp[0];

                    // en fonction du type du champ recherche des operateurs de recherche
                    // possibles
                    $sql = " SELECT op_intranet_moteur_de_recherche_association_type_operateur
FROM intranet_moteur_de_recherche_association_type_operateur
WHERE type_intranet_moteur_de_recherche_association_type_operateur = '$id_type'";
                    $resultat2 = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($sql) or die('Erreur SQL !' . $sql . '<br>' . PDO::errorInfo());

                    foreach ($resultat2 as $enr2) {
                        $sql2 = " SELECT intranet_moteur_de_recherche_operateur_sur_champ.*
FROM intranet_moteur_de_recherche_operateur_sur_champ
WHERE id_intranet_moteur_de_recherche_operateur_sur_champ = '$enr2[0]'";
                        $resultat3 = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($sql2) or die('Erreur SQL !' . $sql2 . '<br>' . PDO::errorInfo());
                        foreach ($resultat3 as $enr3) {
                            if ($operateur_recherche[$cpt_ligne][$cpt_col] != '') {
                                if ($enr3[0] == $operateur_recherche[$cpt_ligne][$cpt_col]) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                            }
                        }
                        // remplissage de la deuxieme liste deroulante
                        if (!strstr($url_page_depart, '?')) {
                            $lien = $url . "?url_page_depart=" . $url_page_depart . "&nb_limite_resultat=" . $nb_limite_resultat . "&champ_recherche=" . $champ_recherche_aux . "&operateur_recherche=" . $operateur_recherche_aux . "&texte_recherche=" . $texte_recherche_aux . "&nbligne=" . $nbligne . "&nbcol=" . $nbcol . "&nb_col_courant=" . $cpt_col . "&nb_ligne_courant=" . $cpt_ligne . "&operateur_courant=";
                        } else {
                            $lien = $url . "&url_page_depart=" . $url_page_depart . "&nb_limite_resultat=" . $nb_limite_resultat . "&champ_recherche=" . $champ_recherche_aux . "&operateur_recherche=" . $operateur_recherche_aux . "&texte_recherche=" . $texte_recherche_aux . "&nbligne=" . $nbligne . "&nbcol =" . $nbcol . "&nb_col_courant=" . $cpt_col . "&nb_ligne_courant=" . $cpt_ligne . "&operateur_courant=";
                        }
                        $liste_operateur.="<option value = '" . $lien . $enr3[0] . "' " . $selected;
                        $liste_operateur.=" >$enr3[1]</option>";
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
                            $result_temp = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req_temp);
                            $saisie_utilisateur = "<select size = 1 name = $name_val value = $temp>";
                            $verrou = 0;
                            $oui_non = 1;
                            foreach ($result_temp as $rows) {

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
                                        $saisie_utilisateur.="<option value = `$rows[0]` $select> $rows[0] </option>";
                                    }
                                } else {
                                    $verrou = 1;
                                }
                            }
                            $saisie_utilisateur.="</select>";
                            if ($verrou) {
                                $saisie_utilisateur.="<img src = images/exclamation.png title = 'Certaines données ne peuvent pas être affichées car trop grandes' width = 20 height = 20 border = 0 />";
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

                                $saisie_utilisateur = "<select size = 1 name = $name_val value = $temp>"
                                        . "<option value = 1 $checked_oui>Oui</option>"
                                        . "<option value = 0 $checked_non>Non</option>"
                                        . "</select>"
                                ;
                            }

                            break;

                        case $id_type == "5":  // si le type du champ choisi dans la premiere liste deroulante
                            // est une date on affiche 3 cases pour la saisie
                            $name_val_j = $name_val . '_jour';
                            $saisie_utilisateur = "<INPUT type = 'text' size = 2 maxlength = 2 name = '$name_val_j'value = $j>";
                            $saisie_utilisateur.="/";
                            $name_val_m = $name_val . '_mois';
                            $saisie_utilisateur.="<INPUT type = 'text' size = 2 maxlength = 2 name = '$name_val_m'value = $mois>";
                            $saisie_utilisateur.="/";
                            $name_val_a = $name_val . '_annee';
                            $saisie_utilisateur.="<INPUT type = 'text' size = 4 maxlength = 4 name = '$name_val_a'value = $a>";

                            break;

                        default:   // sinon on affiche un champ de texte
                            $saisie_utilisateur = "<INPUT type = 'text' size = 10 name = '$name_val' value = '$temp'>";
                    }
                }
                $liste_operateur.="</select>";

                $tableau_affichage[$cpt_ligne][$cpt_col].= $liste_operateur;
                $tableau_affichage[$cpt_ligne][$cpt_col].= $saisie_utilisateur;
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<br>";

                $action = 'ajout';
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = url_page_depart value = $url_page_depart>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = module value = $module>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = module_table value = $module_table>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = champ_retour value = $champ_retour>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = action value = $action>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = champ_recherche value = $champ_recherche_aux>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = operateur_recherche value = $operateur_recherche_aux>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = texte_recherche value = $texte_recherche_aux>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = nb_ligne_courant value = $cpt_ligne>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = nb_col_courant value = $cpt_col>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = texte_courant value = $texte_courant>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = nbligne value = $nbligne>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = nbcol value = $nbcol>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = name_val value = $name_val>";
                $tableau_affichage[$cpt_ligne][$cpt_col].="<input type = hidden name = nb_limite_resultat value = $nb_limite_resultat>";

                // creation des boutons de choix une fois la saisie de la recherche terminée
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = radio value = et name = boutton_operateur>Et<br>";
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = radio value = ou name = boutton_operateur >Ou<br>";
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = radio value = Ou_avec name = boutton_operateur >Ou (avec recopie)<br>";
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = radio value = 'Suppr'name = boutton_operateur >Supprimer<br>";
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = radio value = fin name = boutton_operateur checked>Fin de saisie<br>";
                $tableau_affichage[$cpt_ligne][$cpt_col].= "<input type = submit value = Ok name = ok>";
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

                    $return.="<img src = ../lib/moteur_de_recherche_image.php?op = $op>";
                    $return.='</td>';
                }
            }
            $return.='</tr>';
            if ($i < $nbligne - 1) {
                $op = 'OU';
                $return.='<td>';
                $return.="<img src = ../lib/moteur_de_recherche_image.php?op = $op><br><br>";
                $return.='</td>';
            }
        }
        $return.='</table>';


        return $return;
    }

    /**
     * Algo de recherche de jointures pour 1 champ
     * Dictionnaire des variables :
     * $table_rech = nom de la table du champ que l'utilisateur a selectionner.
     * $nbligne_jointure = variable qui contiendra le nombre de jointure contenue dans le fichier
     * @param type $champ_sel
     * @param type $url_page_depart
     * @param type $module
     * @param type $table_champ_retour
     * @param type $table_tous_champs_rech
     * @return string
     */
    public static function rechercheDeJointure($champ_sel, $url_page_depart, $module, $table_champ_retour, $table_tous_champs_rech) {
        // Dictionnaire des variables


        $result = array();
        // Fichier qui contient les differentes liaisons entre les tables
        //d'un meme module



        $file = '../' . $module . '/sql.map';


        // Recherche du nom de la table du champ que l'utilisateur a selectionné
        $nom_table = "table_moteur_de_recherche";
        $nom = "nom_champ_moteur_de_recherche";
        $table_req = " SELECT $nom_table FROM $table_tous_champs_rech
                        WHERE $nom='$champ_sel'";
        $array_enr = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($table_req);
        // nom de la table
        foreach ($array_enr as $table_enr) {
            $table_rech = $table_enr[0];
        }


        /*         * *****************************************************************************
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

        /*         * *****************************************************************************
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
        $chemin_req = " SELECT $nom_chemin FROM $table_tous_champs_rech
                         WHERE $nom='$champ_sel'";
        $chemin_resultat = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($chemin_req);
        foreach ($chemin_resultat as $chemin_enr) {
            // chemin force
            $chemin = $chemin_enr[0];
        }



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

}
