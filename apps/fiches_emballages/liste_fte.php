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
//        flush();
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */
$globalConfig = new GlobalConfig();

if ($globalConfig->getAuthenticatedUser()) {
    $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
}
if ($idUser) {
    /*
      Initialisation des variables
     */
    $page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
    $page_action = $page_default . "_post.php";
    $page_pdf = $page_default . "_pdf.php";
    $action = 'valider';                       //Action proposée à la page _post.php
    $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
    $html_table = "table "              //Permet d'harmoniser les tableaux
            . "border=1 "
            . "width=100% "
            . "class=contenu "
    ;
    $selection_groupe = Lib::getParameterFromRequest('selection_groupe');
    $selection_fournisseur = Lib::getParameterFromRequest('selection_fournisseur');
    /*
      Récupération des données MySQL
     */

    /*
      Création des Fonctions JavaScript
     */
//location.href =\"liste_fte_post.php?action=supprimer&id_annexe_emballage=\" + id_annexe_emballage + \"$id_annexe_emballage&selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur\"
//if(confirm('Etes vous certain de vouloir supprimer cette Fiche Technique Emballage ?'))
    $javascript = "
<SCRIPT LANGUAGE=JavaScript>
        function confirmation_suppression_fte(url)
        {
        if(confirm('Etes vous certain de vouloir supprimer cette Fiche Technique Emballage ?'))
        {
            location.href = url;
        }
         else{}
        }
</SCRIPT>
";



//Initialisation
    if (!$selection_groupe) {
        $selection_groupe = "0";
    }
    if (!$selection_fournisseur) {
        $selection_fournisseur = "0";
    }


//Filtre de recherche
    $recherche = "<form name=recherche_groupe method=post action=liste_fte.php>"
            . "<table class=titre border=0 width=100%>"
            . "<tr>"
    ;

//Par Groupe de modèle d'emballage
    $recherche.="<td> Groupe: "
            . "<select name=selection_groupe onChange=lien_selection_goupe()>"
            . "<option value=0 >Tous</option>"
    ;
    $req = "SELECT id_annexe_emballage_groupe,nom_annexe_emballage_groupe FROM annexe_emballage_groupe ORDER BY nom_annexe_emballage_groupe";
    $result_groupe = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    foreach ($result_groupe as $rows_groupe) {
        if ($rows_groupe["id_annexe_emballage_groupe"] == $selection_groupe) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        $recherche .="<option value=" . $rows_groupe["id_annexe_emballage_groupe"]
                . "$selected>" . $rows_groupe["nom_annexe_emballage_groupe"]
                . "</option>";
    }
    $recherche .="</select></td>";

//Par Fournisseur
    $recherche .="<td> Fournisseur: "
            . "<select name=selection_fournisseur onChange=lien_selection_fournisseur()>"
            . "<option value=0 >Tous</option>"
    ;
    $req = "SELECT id_fte_fournisseur,nom_fte_fournisseur FROM fte_fournisseur ORDER BY nom_fte_fournisseur";
    $result_groupe = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    foreach ($result_groupe as $rows_groupe) {
        if ($rows_groupe["id_fte_fournisseur"] == $selection_fournisseur) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        $recherche .="<option value=" . $rows_groupe["id_fte_fournisseur"]
                . "$selected>" . $rows_groupe["nom_fte_fournisseur"]
                . "</option>";
    }
    $recherche .="</select></td>";

    $recherche.="</tr></table></form>";

//echo $selection_groupe;
//Liste des FTE
    /* $req = "SELECT `annexe_emballage`.*, `fte_fournisseur`.*, `annexe_emballage_groupe`.*, `annexe_emballage_groupe_type`.* "
      . "FROM `annexe_emballage_groupe_type`, `annexe_emballage_groupe`, `annexe_emballage`, `fte_fournisseur` "
      . "WHERE ( `annexe_emballage_groupe_type`.`id_annexe_emballage_groupe_type` = `annexe_emballage_groupe`.`id_annexe_emballage_groupe_type` "
      . "AND `annexe_emballage_groupe`.`id_annexe_emballage_groupe` = `annexe_emballage`.`id_annexe_emballage_groupe` "
      . "AND `annexe_emballage`.`id_fte_fournisseur` = `fte_fournisseur`.`id_fte_fournisseur` ) "
      ;
     */
    $req = "SELECT `annexe_emballage`.*, `fte_fournisseur`.*, `annexe_emballage_groupe`.* "
            . "FROM `annexe_emballage_groupe`, `annexe_emballage`, `fte_fournisseur` "
            . "WHERE ( `annexe_emballage_groupe`.`id_annexe_emballage_groupe` = `annexe_emballage`.`id_annexe_emballage_groupe` "
            . "AND `annexe_emballage`.`id_fte_fournisseur` = `fte_fournisseur`.`id_fte_fournisseur` ) "
    ;

    if ($selection_groupe <> "0") {
        $req.= "AND ( ( `annexe_emballage_groupe`.`id_annexe_emballage_groupe` = $selection_groupe ) ) ";
    }

    if ($selection_fournisseur <> "0") {
        $req.= "AND ( ( `annexe_emballage`.`id_fte_fournisseur` = $selection_fournisseur ) ) ";
    }
    $req .="ORDER BY fte_fournisseur.nom_fte_fournisseur, reference_fournisseur_annexe_emballage ";
//echo $req;
    $result_fte = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
    if ($result_fte) {
        //Spécialisation suivant le type
        $id_annexe_emballage_groupe = $selection_groupe;
        $annexeEmballageGroupeModel = new AnnexeEmballageGroupeModel($id_annexe_emballage_groupe);
        $id_annexe_emballage_groupe_type = $annexeEmballageGroupeModel->getDataField(AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION)->getFieldValue();

        //Construction des entête du tableau
        $bloc = "<$html_table><tr class=titre><td></td>"
                . "<td>" . DatabaseDescription::getFieldDocLabel("fte_fournisseur", "nom_fte_fournisseur") . "</td>"
                . "<td>" . DatabaseDescription::getFieldDocLabel("annexe_emballage", "reference_fournisseur_annexe_emballage") . "</td>"
                . "<td>L x l x h (en mm)</td>"
                . "<td>" . DatabaseDescription::getFieldDocLabel("annexe_emballage", "poids_annexe_emballage") . "</td>"
        ;
        if ($id_annexe_emballage_groupe_type == 3 or $selection_groupe == "0") {
            $bloc .="<td>Palettisation</td>";
        }
        $bloc .="<td></td></tr>";

        //Construction du la liste des FTE
        foreach ($result_fte as $rows_fte) {
            if ($rows_fte["actif_annexe_emballage"] == 0) {
                $bgcolor = "bgcolor=#FF707E";
            } else {
                $bgcolor = "";
            }
            $bloc .="<tr class=\"contenu\" $bgcolor >";

            //Action possible sur la FTE
//         if(${$module."_modification"} == 1)
            {
                $bloc.="<td>";
                //Modifier
                $bloc.= "<a href=fte_modifier.php?id_annexe_emballage=" . $rows_fte["id_annexe_emballage"]
                        . "&selection_groupe=$selection_groupe"
                        . "&selection_fournisseur=$selection_fournisseur"
                        . "> "
                        . "<img src=../lib/images/next.png alt=Modifier  width=24 height=24 border=0 />"
                        . "</a>";
                $bloc.="</td>";
            }
            /*         else
              {
              $bloc .="<td></td>";
              }
             */
            $bloc.= "<td>" . $rows_fte["nom_fte_fournisseur"] . "</td>"
                    . "<td>" . $rows_fte["reference_fournisseur_annexe_emballage"] . "</td>"
                    . "<td>" . $rows_fte["longueur_annexe_emballage"] . " x " . $rows_fte["largeur_annexe_emballage"] . " x " . $rows_fte["hauteur_annexe_emballage"] . "</td>"
                    . "<td>" . $rows_fte["poids_annexe_emballage"] . "</td>"
            ;
            if ($rows_fte[AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION] == 3) {
                $bloc .="<td>" . $rows_fte["quantite_par_couche_annexe_emballage"] . " x " . $rows_fte["nombre_couche_annexe_emballage"] . "</td>";
            } else {
                $bloc .="<td></td>";
            }

            //Action possible sur la FTE
            if (Acl::getValueAccesRights($module . "_modification") == 1) {
                $bloc.="<td>";

                //Supprimer
                //Seules les FTE n'ayant plus de FTA associées peuvent être supprimées
                //Recherche des FTA utilisant cette FTE
                $req = "SELECT id_fta "
                        . "FROM `fta_conditionnement`,  `annexe_emballage` "
                        . "WHERE `fta_conditionnement`.`id_annexe_emballage` = `annexe_emballage`.`id_annexe_emballage` "
                        //. "AND `fta`.`id_fta` = `fta_conditionnement`.`id_fta` "
                        //. "AND `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` "
                        //. "AND `fta`.`id_fta` = `access_arti2`.`id_fta` "
                        //. "AND fta.id_fta_etat=fta_etat.id_fta_etat "
                        . "AND `fta_conditionnement`.`id_annexe_emballage` = '" . $rows_fte["id_annexe_emballage"] . "' "
                //. "AND abreviation_fta_etat='V' "
                ;
                $result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

                //Si il n'y a PAS de FTA associée, permettre la suppression
                if (!$result) {
                    //Il n'est possible de supprimer que des FTE qui ne sont pas utilisées par des FTA
                    $url = "liste_fte_post.php?action=supprimer&id_annexe_emballage=" . $rows_fte["id_annexe_emballage"]
                            . "&selection_groupe=" . $selection_groupe
                            . "&selection_fournisseur=" . $selection_fournisseur
                    ;
                    $bloc.= "<a "
                            . "href=# "
                            . "onClick=confirmation_suppression_fte(\"" . $url . "\"); "
                            . "/>"
                            . "<img src=\"../lib/images/supprimer.png\" alt=\"Supprimer\" width=\"24\" height=\"24\" border=\"0\" />"
                            . "</a>";
                }
                $bloc.="</td>";
            }
            $bloc .="</tr>";
        }
    }
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

        echo "
             $javascript
             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Liste des Fiches Techniques Emballages<br>

             </td></tr>
             <tr><td>
                 " . $recherche . "
             </td></tr>
             <tr><td>
                 " . $bloc . "
             </td></tr>
             <tr><td>
                 <center>
                 <!input type=submit value='Enregistrer'>
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