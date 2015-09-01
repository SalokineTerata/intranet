<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ("../lib/session.php");         //Récupération des variables de sessions
        include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
        include ("functions.php");              //Fonctions du module
        echo "
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ";

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);

//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = "derogation_duree_vie_produit.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'etape1';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;

/*
  Dérogationc Colis
 */

$type_derogation = "<select name=\"type_derogation\" size=\"1\">
                   <option value=1>Réduire</option>
                   <option value=2>Augmenter</option>
                   </select>
                  ";
//Listes déroulantes
//Selection de l'Article Validés et Actifs
$req_liste_agrologic = "SELECT id_access_arti2"
        . ", CONCAT_WS(' - ', CODE_ARTICLE, LIBELLE) "
        . "FROM access_arti2 "
        . "WHERE CODE_ARTICLE IS NOT NULL AND actif=-1 "
        . "ORDER BY CODE_ARTICLE "
;
$id_defaut = $id_access_arti2;
$liste_article = AccueilFta::afficherRequeteEnListeDeroulante($req_liste_agrologic, $id_defaut, "id_access_arti2");

$liste_id_agrologic = $liste_article . $liste_produit;


//Liste des dérogations
$bloc = "<$html_table>"
        . "<tr class=titre_principal><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "date_fta_derogation_duree_vie")
        . "</td><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "createur_fta_derogation_duree_vie")
        . "</td><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "id_agrologic_fta_derogation_duree_vie")
        . "</td><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "lot_fta_derogation_duree_vie")
        . "</td><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "duree_vie_production_fta_derogation_duree_vie")
        . "</td><td>"
        . DatabaseDescription::getFieldDocLabel("fta_derogation_duree_vie", "utilise_fta_derogation_duree_vie")
        . "</td></tr>"
        . "<tr class=contenu><td>"
        . date("Y-m-d")
        . "<input type=\"hidden\" name=\"date_fta_derogation_duree_vie\" value=\"" . date("Y-m-d") . "\" />"
        . "</td><td>"
        . $prenom . " " . $nom_famille_ses
        . "<input type=hidden name=createur_fta_derogation_duree_vie value=$id_user>"
        . "</td><td>"
        . $liste_id_agrologic
        //."<br>"
        //. mysql_field_desc("fta_derogation_duree_vie", "commentaire_fta_derogation_duree_vie")
        //."&nbsp;<input type=\"text\" name=\"commentaire_fta_derogation_duree_vie\" size=\"60\" /></td>"
        . "</td><td>"
        . $type_derogation
        //." <input type=\"text\" name=\"lot_fta_derogation_duree_vie\" size=\"10\" /></td>"
        . "</td><td>"
        . "<input type=submit value='Ajouter'>"
        //." <input type=\"text\" name=\"duree_vie_production_fta_derogation_duree_vie\" size=\"5\" /></td>"
        . "</td><td>"
        //."Non"
        //."<input type=\"hidden\" name=\"utilise_fta_derogation_duree_vie\" value=\"0\" />"
        //."<input type=\"hidden\" name=\"type_fta_derogation_duree_vie\" value=\"0\" />"
        . "</td><td>"
        . "</td></tr>"
;
$message = "?";
$url = "index.php";
$req = "SELECT * "
        . "FROM fta_derogation_duree_vie "
        //. "WHERE type_fta_derogation_duree_vie=0 "
        . "ORDER BY type_fta_derogation_duree_vie ASC, date_fta_derogation_duree_vie DESC "
;
$result = DatabaseOperation::queryPDO($req);
$bloc.= "<tr class=titre_principal><td colspan=7>"
        . "Dérogations Colis"
        . "</td></tr>"
;
$passage_produit = 0;
foreach ($result as $rows) {
    //Mise en forme du tableau
    //Ajout du Titre des dérogations Produits
    if ($passage_produit == 0 and $rows["type_fta_derogation_duree_vie"] == 1) {
        $bloc.= "<tr class=titre_principal><td colspan=7>"
                . "Dérogations Sachets"
                . "</td></tr>"
        ;
        $passage_produit = 1;
    }
    //type_fta_derogation_duree_vie
    //Préparation des données
    if ($rows["createur_fta_derogation_duree_vie"]) {
        //Nom du créateur de la dérogation
        $req = "SELECT prenom, nom FROM salaries WHERE id_user='" . $rows["createur_fta_derogation_duree_vie"] . "' ";
        $result_login = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($result_login) {
            foreach ($result_login as $rows_login){
                $nom_createur_fta_derogation_duree_vie = $rows_login[UserModel::FIELDNAME_PRENOM];
            $nom_createur_fta_derogation_duree_vie.= " " . $rows_login[UserModel::FIELDNAME_NOM];
            }
        }
    }

    if (!$rows["type_fta_derogation_duree_vie"]) {
        //Nom de l'article
        $id_access_arti2 = $rows["id_access_arti2"];
        mysql_table_load("access_arti2");
        //$req = "SELECT LIBELLE FROM access_arti2 WHERE id_access_arti2='".$rows["id_access_arti2"]."' ";
        //$result_article = DatabaseOperation::query($req);
        $din = $CODE_ARTICLE . " - " . $LIBELLE;
    } else {
        //Nom du produit
        //$id_fta_composition=$rows["id_fta_composition"];
        $id_fta_composant = $rows["id_fta_composant"];
        //mysql_table_load("fta_composition");
        //mysql_table_load("fta_nomenclature");
        mysql_table_load("fta_composant");
        mysql_table_load("annexe_agrologic_article_codification");
        $din = $prefixe_annexe_agrologic_article_codification . $code_produit_agrologic_fta_nomenclature . " - " . $nom_fta_nomenclature;
    }

    //Ce lot a-t-il déjà été utilisé ?
    if ($rows["utilise_fta_derogation_duree_vie"]) {
        $label_utilise_fta_derogation_duree_vie = "Oui";
        $bouton_action = "";
        $bgcolor = "bgcolor=#B9C2CB";
    } else {
        $label_utilise_fta_derogation_duree_vie = "Non";
        $bouton_action = "<a href=derogation_duree_vie_post.php?action=supprimer&id_fta_derogation_duree_vie=" . $rows["id_fta_derogation_duree_vie"]
                . " />"
                . "<img src=\"../lib/images/supprimer.png\" width=\"24\" height=\"24\" border=\"0\" alt=\"\" />"
                . "</a>"
        ;
        $bgcolor = "";
    }

    //Construction du tableau
    $bloc.= "<tr class=contenu ><td $bgcolor width=\"57\">"
            . $rows["date_fta_derogation_duree_vie"]
            . "</td><td $bgcolor>"
            . $nom_createur_fta_derogation_duree_vie
            . "</td><td $bgcolor>"
            . $din
            . "<br>"
            . "<i>&nbsp;&nbsp;" . $rows["commentaire_fta_derogation_duree_vie"] . "</i>"
            . "</td><td $bgcolor>"
            . "<font face=courrier><b>" . $rows["lot_fta_derogation_duree_vie"] . "</b></font>"
            . "</td><td $bgcolor>"
            . $rows["duree_vie_production_fta_derogation_duree_vie"]
            . "</td><td $bgcolor>"
            . $label_utilise_fta_derogation_duree_vie
            . "</td><td $bgcolor>"
            . $bouton_action
            . "</td></tr>"
    ;
}
$bloc.="</table>";

/*
  Dérogationc Composant
 */

/*      //Liste déroulante
  $req_liste_agrologic = "SELECT DISTINCT "
  . "CONCAT_WS('', prefixe_annexe_agrologic_article_codification, code_produit_agrologic_fta_nomenclature) AS CODE_PRODUIT"
  . ", CONCAT_WS(' - ', CONCAT_WS('', prefixe_annexe_agrologic_article_codification, code_produit_agrologic_fta_nomenclature), din_fta_nomenclature) "
  . "FROM fta_nomenclature, annexe_agrologic_article_codification "
  . "WHERE annexe_agrologic_article_codification.id_annexe_agrologic_article_codification=fta_nomenclature.id_annexe_agrologic_article_codification "
  . "ORDER BY CONCAT_WS('', prefixe_annexe_agrologic_article_codification, code_produit_agrologic_fta_nomenclature) "
  ;
  $liste_id_agrologic = afficher_requete_en_liste_deroulante($req_liste_agrologic, $id_defaut, "id_agrologic_fta_derogation_duree_vie");



  //Liste des dérogations
  $bloc2 = "<$html_table>"
  . "<tr class=titre_principal><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "date_fta_derogation_duree_vie")
  ."</td><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "createur_fta_derogation_duree_vie")
  ."</td><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "id_agrologic_fta_derogation_duree_vie")
  ."</td><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "lot_fta_derogation_duree_vie")
  ."</td><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "duree_vie_production_fta_derogation_duree_vie")
  ."</td><td>"
  . mysql_field_desc("fta_derogation_duree_vie", "utilise_fta_derogation_duree_vie")
  ."</td></tr>"
  . "<tr class=contenu><td>"
  . date("Y-m-d")
  ."<input type=\"hidden\" name=\"date_fta_derogation_duree_vie\" value=\"".date("Y-m-d")."\" />"
  ."</td><td>"
  . $prenom ." ". $nom_famille_ses
  ."<input type=hidden name=createur_fta_derogation_duree_vie value=$id_user>"
  ."</td><td>"
  . $liste_id_agrologic
  ."<br>"
  . mysql_field_desc("fta_derogation_duree_vie", "commentaire_fta_derogation_duree_vie")
  ."&nbsp;<input type=\"text\" name=\"commentaire_fta_derogation_duree_vie\" size=\"60\" /></td>"
  ."</td><td>"
  ." <input type=\"text\" name=\"lot_fta_derogation_duree_vie\" size=\"10\" /></td>"
  ."</td><td>"
  ." <input type=\"text\" name=\"duree_vie_production_fta_derogation_duree_vie\" size=\"5\" /></td>"
  ."</td><td>"
  ."Non"
  ."<input type=\"hidden\" name=\"utilise_fta_derogation_duree_vie\" value=\"0\" />"
  ."<input type=\"hidden\" name=\"type_fta_derogation_duree_vie\" value=\"1\" />"
  ."</td><td>"
  ."<input type=submit value='Ajouter'>"
  ."</td></tr>"
  ;
  $message="?";
  $url="index.php";
  $req = "SELECT * "
  . "FROM fta_derogation_duree_vie "
  . "WHERE type_fta_derogation_duree_vie=1 "
  . "ORDER BY date_fta_derogation_duree_vie DESC "
  ;
  $result=DatabaseOperation::query($req);

  while($rows=mysql_fetch_array($result))
  {
  //Préparation des données

  //Nom du créateur de la dérogation
  $req = "SELECT prenom, nom FROM salaries WHERE id_user='".$rows["createur_fta_derogation_duree_vie"]."' ";
  $result_login = DatabaseOperation::query($req);
  $nom_createur_fta_derogation_duree_vie =      mysql_result($result_login, 0, "prenom");
  $nom_createur_fta_derogation_duree_vie.= " ". mysql_result($result_login, 0, "nom");

  //Nom de la nomenclature (à optimiser en passant par une table produit centralisant les produits des nomenclatures)
  $req = "SELECT id_fta_nomenclature "
  . ", CONCAT_WS('', prefixe_annexe_agrologic_article_codification, code_produit_agrologic_fta_nomenclature) "
  . "FROM fta_nomenclature, annexe_agrologic_article_codification "
  . "WHERE CONCAT_WS('', prefixe_annexe_agrologic_article_codification, code_produit_agrologic_fta_nomenclature)=".$rows["id_agrologic_fta_derogation_duree_vie"]." "
  . "ORDER BY id_fta_nomenclature DESC "
  ;
  $result2 = DatabaseOperation::query($req);
  $id_fta_nomenclature = mysql_result($result2, 0, "id_fta_nomenclature");
  $LIBELLE = show_din_produit($id_fta_nomenclature);

  //Ce lot a-t-il déjà été utilisé ?
  if($rows["utilise_fta_derogation_duree_vie"])
  {
  $label_utilise_fta_derogation_duree_vie="Oui";
  $bouton_action = "";
  $bgcolor="bgcolor=#B9C2CB";
  }else
  {
  $label_utilise_fta_derogation_duree_vie="Non";
  $bouton_action = "<a href=derogation_duree_vie_post.php?action=supprimer&id_fta_derogation_duree_vie=".$rows["id_fta_derogation_duree_vie"]
  . " />"
  . "<img src=\"../lib/images/supprimer.png\" width=\"24\" height=\"24\" border=\"0\" alt=\"\" />"
  . "</a>"
  ;
  $bgcolor="";
  }

  //Construction du tableau
  $bloc2.= "<tr class=contenu ><td $bgcolor width=\"57\">"
  . $rows["date_fta_derogation_duree_vie"]
  ."</td><td $bgcolor>"
  . $nom_createur_fta_derogation_duree_vie
  ."</td><td $bgcolor>"
  . $rows["id_agrologic_fta_derogation_duree_vie"]." - ".$LIBELLE
  ."<br>"
  . "<i>&nbsp;&nbsp;".$rows["commentaire_fta_derogation_duree_vie"]."</i>"
  ."</td><td $bgcolor>"
  ."<font face=courrier><b>".$rows["lot_fta_derogation_duree_vie"]."</b></font>"
  ."</td><td $bgcolor>"
  . $rows["duree_vie_production_fta_derogation_duree_vie"]
  ."</td><td $bgcolor>"
  . $label_utilise_fta_derogation_duree_vie
  ."</td><td $bgcolor>"
  .$bouton_action
  ."</td></tr>"
  ;
  }
  $bloc2.="</table>";
 */
/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case "pdf":
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = "Arial";
        $t1_police = $police_standard;
        $t1_style = "B";
        $t1_size = "12";

        $t2_police = $police_standard;
        $t2_style = "B";
        $t2_size = "11";

        $t3_police = $police_standard;
        $t3_style = "BIU";
        $t3_size = "10";

        $contenu_police = $police_standard;
        $contenu_style = "";
        $contenu_size = "8";

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array("print", "copy"));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo "
             <form method=$method action=$page_action name=\"form_action\">
             <input type=hidden name=action value=$action>

             <$html_table>
             <tr><td>

                  $bloc

             </td></tr>
             </table>

             </form>
             ";



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ("../lib/fin_page.inc");

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>