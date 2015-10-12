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
//        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */
$action = Lib::getParameterFromRequest('action');
$id_classification_arborescence_article = Lib::getParameterFromRequest('id_classification_arborescence_article');
$id_classification_arborescence_article_categorie = Lib::getParameterFromRequest('id_classification_arborescence_article_categorie');
$id_classification_arborescence_article_categorie_contenu = Lib::getParameterFromRequest('id_classification_arborescence_article_categorie_contenu');
$liste_id = Lib::getParameterFromRequest('liste_id');
/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
//$page_action=$page_default."_post.php";
$page_pdf = $page_default . "_pdf.php";
//$action = '';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "width=100% "
        . "class=contenu "
;

/*
  Récupération des données MySQL
 */
$add_id_classification_arborescence_article_categorie = $id_classification_arborescence_article_categorie; //From URL
//Chemin en cours
if ($id_classification_arborescence_article) {

    $extension["lien"] = $page_default . ".php?id_fta=$idFta";
    $chemin_en_cours = affichage_classification_chemin($id_classification_arborescence_article, $extension);


    $bloc_chemin_actuel = "<a href=" . $extension["lien"] . "/>Chemin en cours: </td></tr><tr><td><$html_table>"
            . $chemin_en_cours
            . "</table>"
    ;
    $search = "=$id_classification_arborescence_article";
} else {
    $bloc_chemin_actuel = "Aucun chemin";
    $search = "IS NULL";
}

//Vérification des étapes
if (!$action) {
    $action = -1;
}



switch ($action) {

    case -1:
        $titre = "Que souhaitez vous faire ?";
        $submit_label = "Suivant >>";
        $bloc = "
                 <input type=\"radio\" name=\"action\" value=\"1\" /> Ajouter un nouvel éléments
                 <br>
                 <input type=\"radio\" name=\"action\" value=\"modifier\" /> Modifier cet élément
                 ";
        break;

    case 1: //Etape n°1
        $titre = "Ajout d'un nouvel élément de Classification - Etape 1/2";
        $submit_label = "Ajouter";

        //Cet objet est-il l'ascendant d'un autre objet ?
        $req = "SELECT DISTINCT classification_arborescence_article_categorie.id_classification_arborescence_article_categorie "
                . "FROM classification_arborescence_article, classification_arborescence_article_categorie_contenu, classification_arborescence_article_categorie  "
                . "WHERE ascendant_classification_arborescence_article_categorie_contenu=$id_classification_arborescence_article "
                . "AND classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
                . "AND classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie=classification_arborescence_article_categorie.id_classification_arborescence_article_categorie "
        ;
        $result = DatabaseOperation::query($req);

        //Si il existe déjà un objet dépendant, au reste homogène au niveau de la catégorie
        switch (mysql_num_rows($result)) {
            case 0:
                //On peut choisir entre la catégorie de l'objet dans lequel on est, ou la catégorie suivante
                $classificationArborescenceArticleModel = new ClassificationArborescenceArticleModel($id_classification_arborescence_article);
                $id_classification_arborescence_article_categorie_contenu = $classificationArborescenceArticleModel->getDataField(ClassificationArborescenceArticleModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU)->getFieldValue();
                $classificationArborescenceArticleCategorieContenuModel = new ClassificationArborescenceArticleCategorieContenuModel($id_classification_arborescence_article_categorie_contenu);
                $id_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieContenuModel->getDataField(ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();
                $classificationArborescenceArticleCategorieModel = new ClassificationArborescenceArticleCategorieModel($id_classification_arborescence_article_categorie);
                $suivant_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieModel->getDataField(ClassificationArborescenceArticleCategorieModel::FIELDNAME_SUIVANT_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();
                $id_categorie_pere = $id_classification_arborescence_article_categorie;
                $nom_categorie_pere = $nom_classification_arborescence_article_categorie;
                $id_categorie_fils = $suivant_classification_arborescence_article_categorie;

                //Recherche de la catégorie suivante
                if ($id_categorie_fils) {
                    $id_classification_arborescence_article_categorie = $id_categorie_fils;
                    $classificationArborescenceArticleCategorieModel = new ClassificationArborescenceArticleCategorieModel($id_classification_arborescence_article_categorie);
                    $nom_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieModel->getDataField(ClassificationArborescenceArticleCategorieModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();
                } else {
                    //Il n'y a plus de catégorie suivante
                    $checked = "checked";
                }
                $nom_categorie_fils = $nom_classification_arborescence_article_categorie;


                //Catégorie du nouvel élément
                $champ = "id_classification_arborescence_article_categorie";
                $bloc .= "<tr><td>" . Lib::getParameterFromRequest('NOM_' . $champ) . ":</td><td>";
                $bloc .= "<input type=radio name=" . $champ . " value=$id_categorie_pere $checked>$nom_categorie_pere";
                if ($id_categorie_fils) {//Il y a une catégorie "suivante"
                    $bloc .= "<hr><input type=radio name=" . $champ . " value=$id_categorie_fils >$nom_categorie_fils";
                }

                break;
            case 1:
                //On récupère la catégorie déjà utiliée
                $id_classification_arborescence_article_categorie = mysql_result($result, 0, "id_classification_arborescence_article_categorie");
                $classificationArborescenceArticleCategorieModel = new ClassificationArborescenceArticleCategorieModel($id_classification_arborescence_article_categorie);
                $nom_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieModel->getDataField(ClassificationArborescenceArticleCategorieModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();
                $champ = "id_classification_arborescence_article_categorie";
                $bloc .= "<tr><td>Catégorie obligatoirement sélectionnée:</td><td>";
                $bloc .= "<input type=radio name=" . $champ . " value=$id_classification_arborescence_article_categorie checked>$nom_classification_arborescence_article_categorie";

                break;

            default:
                //Il ne peut pas y avoir d'autre résultat
                $titre = "Incohérence des données";
                $message = "Il ne peut pas y avoir de catégorie différentes dans un même élement de classification!";
                afficher_message($titre, $message, $redirection);
        }
        $action++;
        $page_action = $page_default . ".php"; //On force à revenir sur cette page pour passer à l'étape 2
        break;
    case 2: //Etape 2

        $titre = "Ajout d'un nouvel élément de Classification";
        $submit_label = "Ajouter";

        $id_classification_arborescence_article_categorie = $add_id_classification_arborescence_article_categorie;
        $classificationArborescenceArticleCategorieModel = new ClassificationArborescenceArticleCategorieModel($id_classification_arborescence_article_categorie);
        $nom_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieModel->getDataField(ClassificationArborescenceArticleCategorieModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();


        //Contenu
        $nom_liste = "id_classification_arborescence_article_categorie_contenu";
        $bloc .= "<tr><td>$nom_classification_arborescence_article_categorie:</td><td>";
        $req_liste_site_assemblage = "SELECT id_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu "
                . "FROM classification_arborescence_article_categorie_contenu "
                . "WHERE id_classification_arborescence_article_categorie=$id_classification_arborescence_article_categorie "
                . "ORDER BY nom_classification_arborescence_article_categorie_contenu "
        ;
        $id_defaut = $id_classification_arborescence_article_categorie_contenu;
        $bloc .= AccueilFta::afficherRequeteEnListeDeroulante($req_liste_site_assemblage, $id_defaut, $nom_liste,TRUE);
        $bloc .="</td></tr>";

        //Classification Controle de Gestion
        if (!$suivant_classification_arborescence_article_categorie) {
            $bloc .= "<$html_table>
                     <tr class=titre><td>Code de regroupement controle de gestion
                     </td></tr>
                     <tr><td>
                         <$html_table>
                             <tr><td>
                                 " . mysql_field_desc("classification_arborescence_article", "FAMILLE_ARTICLE") . "
                                 </td><td>
                                 <input type=\"text\" name=\"FAMILLE_ARTICLE\" size=\"20\" />
                                 <a href=l:\erp_data.mdb target=_blank>
                                 <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>
                             </td></tr>
                             <tr><td>
                                 " . mysql_field_desc("classification_arborescence_article", "FAMILLE_MKTG") . "
                                 </td><td>
                                 <input type=\"text\" name=\"FAMILLE_MKTG\" size=\"20\" />
                                 <a href=l:\erp_data.mdb target=_blank>
                                 <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>
                             </td></tr>
                          </table>
                     </td></tr>
                     ";
        }



        $action = "valider";
        $page_action = $page_default . "_post.php";
        break;

    case "modifier":

        $titre = "Modification de l'élément";
        $submit_label = "Modifier";

        //Classification Controle de Gestion

        $classificationArborescenceArticleModel = new ClassificationArborescenceArticleModel($id_classification_arborescence_article);
        $id_classification_arborescence_article_categorie_contenu = $classificationArborescenceArticleModel->getDataField(ClassificationArborescenceArticleModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU)->getFieldValue();
        $classificationArborescenceArticleCategorieContenuModel = new ClassificationArborescenceArticleCategorieContenuModel($id_classification_arborescence_article_categorie_contenu);
        $id_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieContenuModel->getDataField(ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();
        $classificationArborescenceArticleCategorieModel = new ClassificationArborescenceArticleCategorieModel($id_classification_arborescence_article_categorie);
        $suivant_classification_arborescence_article_categorie = $classificationArborescenceArticleCategorieModel->getDataField(ClassificationArborescenceArticleCategorieModel::FIELDNAME_SUIVANT_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue();

        if (!$suivant_classification_arborescence_article_categorie) {
            $bloc .= "<".$html_table.">
                        <tr class=titre><td>Code de regroupement controle de gestion
                        </td></tr>
                        <tr><td>
                            <".$html_table.">
                                <tr><td>
                                    " . mysql_field_desc("classification_arborescence_article", "FAMILLE_ARTICLE") . "
                                    </td><td>
                                    <input type=\"text\" name=\"FAMILLE_ARTICLE\" size=\"20\" value=\"$FAMILLE_ARTICLE\" />
                                    <a href=l:\erp_data.mdb target=_blank>
                                    <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>
                                </td></tr>
                                <tr><td>
                                    " . mysql_field_desc("classification_arborescence_article", "FAMILLE_MKTG") . "
                                    </td><td>
                                    <input type=\"text\" name=\"FAMILLE_MKTG\" size=\"20\" value=\"$FAMILLE_MKTG\" />
                                    <a href=l:\erp_data.mdb target=_blank>
                                    <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>
                                </td></tr>
                             </table>
                        </td></tr>
                        ";
            $action = "modifier";
            $page_action = $page_default . "_post.php";
        } else {
            $bloc .= " Il n'y a rien à modifier pour cet élément.";
            $submit_label = "Annuler";
            $page_action = "index.php?liste_id=$liste_id";
        }

        break;
}



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
//echo $liste_id;
        echo "
             <form name=recherche_groupe method=$method action=$page_action>
             <input type=hidden name=action value=$action>
             <input type=hidden name=id_classification_arborescence_article value=$id_classification_arborescence_article>
             <input type=hidden name=id_classification_arborescence_article_categorie_contenu value=$id_classification_arborescence_article_categorie_contenu>
             <input type=hidden name=liste_id value=$liste_id>

             <$html_table>
             <tr class=titre_principal><td>

                 $titre

             </td></tr>
             <tr><td>
                     $bloc_chemin_actuel
             </td></tr>
             <tr><td>


                     <$html_table>
                     $bloc
                     </table>
             </td></tr>
             <tr class=titre><td>

                 <center>
                 <input type=submit value='$submit_label'>
                 </center>

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