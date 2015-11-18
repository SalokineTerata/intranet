<?php

//Include des fonctions thématiques
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
function afficher_message($titre, $message, $redirection) {
    /*
      Dictionnaire des variables:
     * **************************
     */
    require_once('../inc/javascript.php');

    if (!$redirection) {
        $redirection = "'Javascript:;' onClick='history.go(-1);return(false);'";
    }
    $bouton_valider = "
                       <a href='$redirection'>
                       <img src=../lib/images/bouton_valider_jaune.gif border=0>
                       </a>
                       ";
    echo
    "
         <TABLE>
         <TR>
             <td id=tableProps width=70 valign=top align=center>
                 <IMG id=pagerrorImg SRC=../lib/images/icone_information.png width=20 height=38>

             </td><TD id=tablePropsWidth width=400>
                      <h1 id=errortype style='font:14pt/16pt verdana; color:#4e4e4e'>
                      <id id='Comment1'><!--Problem--></id><id id='errorText'>$titre</id></h1>
                      <id id='Comment2'><!--Probable causes:<--></id><id id='errordesc'><font style='font:9pt/12pt verdana; color:black'>
                      $message
                      </id>
                      <br><br>
                      <hr size=1 color='blue'>
                      <br>
                      <ID  id=term1>
                      $bouton_valider
                      </ID>
                      <P>
                      </ul>
                      <BR>
             </TD>
         </TR>
         <!/TABLE>        
     ";
    exit;
    //include ("../lib/fin_page.inc");
}

/*
 * *******************************************************************************
  MOTEUR DE RECHERCHE
  Cette fonction retourne l'affiche de l'interface du moteur de recherche
 * *******************************************************************************
 */

function afficher_moteur_recherche($module
, $id_recherche, $etat_table, $id_recherche_etat
, $abreviation_recherche_etat, $nom_recherche_recherche_etat, $image_bordure
, $image_recherche, $champ_retour, $nb_limite_resultat
, $url_page_depart, $QUERY_STRING, $PHP_SELF
, $nbligne, $nbcol, $champ_recherche
, $operateur_recherche, $texte_recherche, $champ_courant
, $operateur_courant, $texte_courant, $nb_col_courant
, $ajout_col, $requete_resultat, $tab_resultat, $module_table
) {
    /*
      Définition des Variables
     */
    //$module="fta";
    //$etat_table="fta_etat";
    //$id_recherche="id_fta";
    //$id_recherche_etat="id_fta_etat";
    //$abreviation_recherche_etat="abreviation_fta_etat";
    //$nom_recherche_recherche_etat="nom_fta_etat";
    //$champ_retour = 'fta.id_fta';

    $nb_limite_resultat = 1000;
    if ($url_page_depart == '') {
        if ($QUERY_STRING)
            $url_page_depart = '(' . $PHP_SELF . '?' . $QUERY_STRING . ')';
        else
            $url_page_depart = '(' . $PHP_SELF . ')';
    }

    $return = "";
    $requete_resultat = stripcslashes($requete_resultat);
    $_SESSION['table_champ_retour'] = $module_table;  // table du champ retour
    $_SESSION['table_tous_champs_rech'] = $module_table . "_moteur_de_recherche";
    $tab_resultat;


//Construction du code HTML
    $return.= "
     <center>
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
     <img src=$image_bordure>
     <br>
     </center>
     <center>
     <table width=100% border=1 valign=top cellspacing=0>
     <tr>
     <td class=titre_principal><img src=" . $image_recherche . " WIDTH=70 HEIGHT=50 align=left> <br> Recherche <br><br></td>
     </tr>
     <tr>
     <td colspan=3> ";


    $return.=recuperation_donnees_recherche(
            $module, $url_page_depart, $module_table
            , $champ_retour, $nb_limite_resultat, $nbligne
            , $nbcol, $champ_recherche, $operateur_recherche
            , $texte_recherche, $champ_courant, $operateur_courant
            , $texte_courant, $nb_col_courant, $nb_ligne_courant
            , $ajout_col
    );

    $return.= "</td>
      </tr>
      </table>
      ";

    if ($tab_resultat)
        $tab_resultat = explode(';;', $tab_resultat);

    $return.= "
     <table width=100% border=1 valign=top cellspacing=0>
     <tr>
     <td class=titre_principal> <br> Résultats <br><br></td>
     </tr>
     ";


    $choix = -1;    // pour que l'on affiche les entetes du tableau une seule fois
    $tableau_fiche = '';


    if ($requete_resultat) {

        //On vérifie si le résultat n'est pas nul
        $result_requete_resultat = DatabaseOperation::convertSqlStatementWithoutKeyToArray($requete_resultat);
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

        $result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

        foreach ($result as $rows) {
            //Construction de la reqûete de resultat propre à cet Etat
            $req1 = "$requete_resultat AND " . $id_recherche_etat . "=" . $rows[$id_recherche_etat];
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
     <img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure>
     <img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure>
     <img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure>
     <img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure><img src=$image_bordure>
     ";

    return $return;

    /*     * *****************************************************************************
      FIN MOTEUR DE RECHERCHE
     * ***************************************************************************** */
}

/*
 * *******************************************************************************
  Cette fonction affiche du texte au format HTML, mais formaté correctement.
  Elle a utilisée lors de l'affichage de texte stocké puis récupéré par les
  fonctions: mysql_table_operation() et mysql_table_load()
 * *******************************************************************************
 */

function html_view_txt($string) {
    /*
      Dictionnaire des variables:
     * **************************
     */



//Corps de la fonction
//$return = nl2br(str_replace(" ", "&nbsp;&nbsp;", $string));
    $return = nl2br($string);

//Double espace car simple espace provoque un alongement de l'écriture
    $return = str_replace("  ", "&nbsp;&nbsp;", $return);

    return $return;
}

//Fin de la fonction html_view_txt()

/* Affichage du chemin d'accès de la classification d'un article
 * ************************************************************ */

function affichage_classification_article($id_fta, $extension = null) {

    /*     * ****MAJ Boris Sanègre - 2007-01-09
      Fonction affichage_classification_article($id_fta,$extension) = 8 secondes
      Réécriture du code:
      - Suppression de toute utilisation de variable Globales
      - Simplification SQL
     */


    /*
      Dictionnaire des variables:
     */

    $id_fta;                 //Identifiant de la Fiche Technique Article
    $extension;              //Tableau de variables permettant de passer de futures nouvelles options à la fonction
    $i = 0;                    //Compteur représentant chaque chemin de classification
    //$j=0;                    //Identifiant du chemin de l'arboresence (id_classification_arborescence_article)
    $return[$i];             //Tableau contenant les chemins de classification de l'Article
    $return[$i][0];          //contient l'identifiant du chemin (voir $j)
    $return[$i][1];          //contient la représentation graphique HTML du chemin
    $return[$i][2];          //contient la liste des clefs des éléments de la classifications
    $entete == "<table>";
    $queue = "</table>";
    /*
      Corps de la fonction
     */



    //Recherche des classifications
    $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT * FROM classification_fta WHERE id_fta=" . $id_fta
    );
    if ($array) {//Il existe des classification
        foreach ($array as $rows) {//Parcours des classifications
            //Préparation de la boucle pour récupérer le chemin
            $return[$i][0] = $rows["id_classification_fta"];
            $id_classification_arborescence_article = $rows["id_classification_arborescence_article"];
            $return[$i][1].=affichage_classification_chemin($id_classification_arborescence_article, $extension);

            //On passe au chemin suivant. On incrémente au fur à mesure
            $i++;
        }//Fin de parcours des classifications
    }//Fin de "Il existe des classifications"
    else {//Il n'existe pas de classification
    }

    //La fonction retourne le tableau de résultat $return
    if ($return) {
        $return[$i][1] = $entete . $return[$i][1] . $queue;
    }
    return $return;
}

function affichage_classification_chemin($id_classification_arborescence_article, $extension) {
    /*     * ****MAJ Boris Sanègre - 2007-01-09
      Fonction affichage_classification_article($id_fta,$extension) = 8 secondes
      Réécriture du code:
      - Suppression de toute utilisation de variable Globales
      - Simplification SQL
     */

    /*
      Dictionnaire des variables:
     */
    //Préparation du chargment de l'enregistrement
    $id_classification_arborescence_article;
    //$_SESSION["ascendant_classification_arborescence_article_categorie_contenu"]=$id_classification_arborescence_article;
    $ascendant_classification_arborescence_article_categorie_contenu = $id_classification_arborescence_article;
    $tmp_i = 0;                                                                       //Pour ne pas avoir le séparateur à droite du chemin
    $HTML_separateur = "</td><td align=\"left\">";                                    //Représentation graphique du séparateur entre les différents répertoire d'un chemin
    $HTML_entete = "<tr class=contenu><td align=\"right\" width=\"50%\">";            //Début d'une ligne HTML
    $HTML_queue = "</td></tr>";                                                       //Fin d'une ligne HTML
    $extension["lien"];             //URL (page et variables) du Lien hypertexte qui sera utiliser pour chaque élément du chemin. l'ID sera aussi ajouter à ce lien

    /*
      Corps de la fonction
     */


    //Tant qu'un ascendant existe, on continu à remonter le chemin
    while ($ascendant_classification_arborescence_article_categorie_contenu and $ascendant_classification_arborescence_article_categorie_contenu <> 1) {

        //Pas de séparateur pour commencer
        if ($tmp_i) {
            $return = $separateur . $return;
        }

        //Activation du séparateur
        $tmp_i = 1;

        //Chargement des données
        $id_classification_arborescence_article = $ascendant_classification_arborescence_article_categorie_contenu;
        $ascendant_classification_arborescence_article_categorie_contenu = 0;

        $req = "SELECT nom_classification_arborescence_article_categorie_contenu "
                . ", nom_classification_arborescence_article_categorie "
                . ", ascendant_classification_arborescence_article_categorie_contenu "
                . "FROM classification_arborescence_article "
                . ", classification_arborescence_article_categorie_contenu "
                . ", classification_arborescence_article_categorie "
                . "WHERE ( `classification_arborescence_article_categorie_contenu`.`id_classification_arborescence_article_categorie_contenu` = `classification_arborescence_article`.`id_classification_arborescence_article_categorie_contenu` "
                . "AND `classification_arborescence_article_categorie`.`id_classification_arborescence_article_categorie` = `classification_arborescence_article_categorie_contenu`.`id_classification_arborescence_article_categorie` )"
                . "AND id_classification_arborescence_article=$id_classification_arborescence_article "
        ;
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($array) {
            foreach ($array as $rows) {
                $nom_classification_arborescence_article_categorie_contenu = $rows["nom_classification_arborescence_article_categorie_contenu"];
                $nom_classification_arborescence_article_categorie = $rows["nom_classification_arborescence_article_categorie"];
                $ascendant_classification_arborescence_article_categorie_contenu = $rows["ascendant_classification_arborescence_article_categorie_contenu"];
            }
        }

        //Création du lien hypertexte
        if ($extension["lien"]) {
            $lien1 = "<a href=" . $extension["lien"] . "&id_classification_arborescence_article=" . $id_classification_arborescence_article . " />";
            $lien2 = "</a>";
        }

        //Création de la représentation HTML du chemin
        if ($nom_classification_arborescence_article_categorie_contenu <> "/") {   //On ignire la racine "/"
            $return = $HTML_entete
                    . $lien1
                    . "<b>"
                    . $nom_classification_arborescence_article_categorie
                    . ":</b>"
                    . $HTML_separateur
                    . $nom_classification_arborescence_article_categorie_contenu
                    . $lien2
                    . $HTML_queue
                    . $return
            ;
        }
    }//Fin de la construction du chemin
    //Restitution de la clef
    $id_classification_arborescence_article = $id_classification_arborescence_article;
    return $return;
}

function calendrier($nom_date, $date_defaut) {
    /*
      Dictionnaire des variables:
     * **************************
     */
//    $i = 0;                                        //Compteur generique
//    $annee_actuelle = date("Y");                   //Annee en cours
//    $annee_max = ($annee_actuelle + 2);          //Annee maximale de la liste deroulante
//    $annee_min = ($annee_actuelle - 10);          //Devinez !?
////$date_defaut                                 La date doit-etre au format MySQL
//    $selected = 0;                               //Permet de savoir si un eleement
//    //de la liste a deje etait selectionne
//    //0=Non et 1=Oui
////Corps de la fonction
//    //Formatage de la date par defaut
//    if ($date_defaut)
//        $jour_date_defaut = substr($date_defaut, -2);
//    $mois_date_defaut = substr($date_defaut, 5, 2);
//    $annee_date_defaut = substr($date_defaut, 0, 4);
//
//    //Creation de la liste de selection du jour
//    $i = 1;
//    $liste_jour_date = "<select name="
//            . "jour_date"
//            . "_"
//            . $nom_date
//            . ">"
//            . "<option value=''>Jour</option>"
//    ;
//    while ($i <= 31) {
//        $liste_jour_date .= "<option value=$i";
//        if ($i == $jour_date_defaut and $jour_date_defaut) {
//            $liste_jour_date .= " selected";
//        }
//        $liste_jour_date .= ">$i</option>";
//        $i = $i + 1;
//    }
//    $liste_jour_date .= "</select>";
//
//
//    //Creation de la liste de selection du mois
//    $i = 1;
//    $liste_mois_date = "<select name="
//            . "mois_date"
//            . "_"
//            . $nom_date
//            . ">"
//            . "<option value=''>Mois</option>"
//    ;
//    while ($i <= 12) {
//        $liste_mois_date .= "<option value=$i";
//        if ($i == $mois_date_defaut and $mois_date_defaut) {
//            $liste_mois_date .= " selected";
//        }
//        $liste_mois_date .= ">$i</option>";
//        $i = $i + 1;
//    }
//    $liste_mois_date .= "</select>";
//
//    //Creation de la liste de selection de l'annee
//    $i = $annee_max;
//    $liste_annee_date = "<select name="
//            . "annee_date"
//            . "_"
//            . $nom_date
//            . ">"
//    ;
//    while ($i >= ($annee_min)) {
//        $liste_annee_date .= "<option value=$i";
//        //echo $i."=".$annee_date_defaut."<br>";
//        if ($i == $annee_date_defaut and $annee_date_defaut) {
//            $liste_annee_date .= " selected";
//            $selected = 1;
//        } else {
//            if ($i == $annee_actuelle and !$selected) {
//                $liste_annee_date .=" selected";
//            }
//        }
//
//        $liste_annee_date .= ">$i</option>";
//        $i = ($i - 1);
//    }
//    $liste_annee_date .= "</select>";
    //Fonction de calendrier
//    $calendrier .="<input name=$nom_date value='$date_defaut' />"
//            . " <a href=javascript:openCalendar('lang=fr-iso-8859-1&amp;server=1','form_action','$nom_date','date') />"
//            //. " <a href=javascript:MM_openBrWindow('theURL','winName','features') />"
//            . "<img src=../lib/images/bouton_calendar.png width=16 height=16 border=0 />"
//            . "</a>"
//    ;
//    $calendrier .= "
//        <input type=\"text\" value=\"$date_defaut\" readonly name=\"$nom_date\">
//        <input type=\"button\" value=\"Cal\" onclick=\"displayCalendar(document.forms['form_action'].$nom_date,'yyyy/mm/dd',this)\">
//    ";
//    $calendrier .= "
//        <input type=\"text\" value=\"$date_defaut\" readonly name=\"$nom_date\" onclick=\"displayCalendar(document.forms['form_action'].$nom_date,'yyyy-mm-dd',this)\">
//    ";
//    $calendrier .= "
//        <input type=\"text\" value=\"$date_defaut\" name=\"$nom_date\" onclick=\"displayCalendar(document.forms['form_action'].$nom_date,'yyyy-mm-dd',this)\">
//    ";
//    $calendrier .= "
//        <input type=\"text\" value=\"$date_defaut\" readonly name=\"$nom_date\">
//        <input type=\"image\"src=../lib/images/bouton_calendar.png width=16 height=16 border=0 value=\"Cal\" onclick=\"displayCalendar(document.forms['form_action'].$nom_date,'yyyy-mm-dd',this)\">
//    ";
    //$bloc .="<input type=\"button\" value=\"Cal\" onclick=\"displayCalendar(document.forms[0].theDate,'yyyy/mm/dd',this)\">";
    //openCalendar(params, form, field, type);
    //Envoi des listes deroulantes
    //$retour_fonction=$liste_jour_date.$liste_mois_date.$liste_annee_date.$calendrier;
    //$retour_fonction = $calendrier;
    $retour_fonction = "La fonction PHP \"calendrier\" n'est plus disponible. Utiliser l'objet HtmlInputCalendar";
    return $retour_fonction;
}

function popup($paramPopupName
, $paramPopupContent
, $ParamLink
, $paramSpecialPage = null
, $paramJavascriptOption = "scrollbars=yes,width=810,height=550,resizable=yes"
) {
    return Html::popup($paramPopupName, $paramPopupContent, $ParamLink, $paramSpecialPage, $paramJavascriptOption);
//    $return = false;
//    $default_message = "";
//    $_SESSION["popup_content"] = $popup_content;
//    $_SESSION[$popup_name] = $_SESSION["popup_content"];
//
//    $href_popup = "../lib/popup.php";
//    $href_javascript_begin = "javascript:; onClick=MM_openBrWindow('";
//    $href_javascript_end = "','pop','$javascript_option')";
//    //$title = "Debug";
//    //$link_name = "MySQL";
//    $html = "<a title=\"$title\" "
//            . "href="
//            . $href_javascript_begin
//            . $href_popup
//            . "?popup_name=" . $popup_name
//            //. "&disable_full_page=1"
//            . "&edit_allow=false"
//            . "&title=$title"
//            . "&special_page=$special_page"
//            . $href_javascript_end
//            . "  CLASS=link1 />"
//            . $link
//            . "</a>"
//    ;
//    $return = $html;
//    return $return;
}

function print_page_begin($disable_full_page = FALSE, $menu_file = NULL, $conf = null) {

    if ($conf == null) {
        $conf = $_SESSION["globalConfig"];
    }
    $module = Lib::getModule();
    $title = Lib::setTitle();
    $css_intranet_module = $_SESSION["intranet_modules"][$module]["css_intranet_module"];
    $printable = "";

    if (!$_SESSION[$module . "_impression"]) {
        $printable = "class=display_none";
    }


    header('Content-type: text/html; charset=utf-8');
    echo "<!DOCTYPE html><html>";
    echo "<head>";
    echo "<title>" . $title . "</title>";

    //Configuration du CSS
    echo "<link rel=stylesheet href=../lib/css/"
    . $_SESSION["intranet_modules"][$module]["css_intranet_module"]
    . " type=text/css>"
    ;
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"../plugins/dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112\" media=\"screen\"></link>";
    echo "</head>";


    echo "<body $printable leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 onload=chargement();>";

    echo "<div class=display_none id=chargement style=width:100%;height:75px;color:red;font-weight:bold;font-size:14px;background:white;>
           <img src= ..\lib\images\ajax_loader.gif> Chargement ...
          </div>";


    if (!$disable_full_page) {
        echo "<div class=display_none id=site width=100%; >";
        echo "<table border=0 cellspacing=0 cellpadding=0 height=534>";
        echo "<tr>";
        echo "<td valign=top  align=center><div id=menu class=display_none>";
        include("../inc/connexion.php");
        include("../inc/navigue.php");
        if ($menu_file != NULL) {                       //Si existant, utilisation du menu demandé
            include ("./$module/$menu_file");
        }               //en variable
        else {
            include ("../$module/menu_principal.inc");
        }  //Sinon, menu par défaut
    }
}

/**
 * Affichage d'un objet HTML de type "input type=text"
 * @param text $champ Nom du champs dans la base de données
 * @param text $table Nom de la table contenant ce champ
 * @param text $value Valeur de la données
 * @param boolean $editable Le champ est-il éditable ?
 * @param integer $size Taille de la zone de saisie
 * @param integer $maxlength Longeur maximale de la valeur pouvant être saisie dans la zone
 * @return html Retourne le rendu HTML de cet objet
 */
function html_text($champ, $table, $value, $editable = false, $warning_update = false, $size = 110, $maxlength = null) {
    $bloc = "";
    if ($maxlength == null
    )
        $maxlength = $size;
    ${'NOM_' . $champ} = $_SESSION["mysql_column_info"][$table][$champ]["label"];
    ${$champ} = $value;
    $html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
    $html_color_modif = "bgcolor=#B0FFFE";

    //$champ="designation_commerciale_fta";
    //$table="fta";
    //Versionning
    $image_modif = "";
    $color_modif = "";
    if ($warning_update) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }

    $bloc .= "<tr class=contenu><td $color_modif>${'NOM_' . $champ}:</td><td $color_modif>";
    if ($proprietaire) {
        $bloc .= "<input type=text name=" . $champ . " value=`" . ${$champ} . "` size=$size maxlength=$maxlength />";
    } else {
        $bloc .="${$champ}";
    }
    $bloc.="$image_modif</td></tr>";

    return $bloc;
}

/**
 * Créer un objet HTML de type calendrier
 * @param <type> $champ
 * @param <type> $table
 * @param <type> $value
 * @param <type> $editable
 */
function html_calendar($champ, $table, $value, $editable = false, $warning_update = false) {
    //Date d'échéance de la FTA
    //$champ="date_echeance_fta";
    //$table="fta";
    $bloc = "";

    ${'NOM_' . $champ} = DatabaseOperation::getColumnInfoLabel($table, $champ);
    $html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
    $html_color_modif = "bgcolor=#B0FFFE";

    //Versionning
    $image_modif = "";
    $color_modif = "";
    if ($warning_update) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }

    $bloc .= "<tr class=contenu><td  width=\"40%\" $color_modif>${'NOM_' . $champ}:</td><td $color_modif>";
    if ($editable) {

        $bloc .= calendrier($champ, $value);
        $bloc .= "<i>&nbsp;Effacer cette échéance pour supprimer toutes les autres échéances de processus</i>";
    } else {
        $bloc .="$value";
    }
    $bloc.="$image_modif</td></tr>";

    return $bloc;
}

?>