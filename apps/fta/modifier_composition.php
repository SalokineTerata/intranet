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
switch($output)
{

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


/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
   $page_action=$page_default."_post.php";
   $page_pdf=$page_default."_pdf.php";
   //$action="valider";  //L'action sera de sélectionner un groupe d'emballage
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;
   //Bouton Valider
   if($proprietaire)
   {
       $action="valider";
       $bouton_valider= "
            <input type=\"checkbox\" name=\"valider_saisie\" value=1 />Valider et revenir sur la FTA<br>
            <input type=submit value='Enregistrer les modifications'>
            ";
   }else{
       $action="consulter";
       $bouton_valider= "
            <input type=submit value='Revenir sur la FTA'>
            ";
   }


/*
    Récupération des données MySQL
*/
mysql_table_load("fta");
mysql_table_load("access_arti2");

//Mode Création/Modification d'une nomenclature
/*
if ($id_fta_composition)
{
   $creation = 0;
   mysql_table_load("fta_composition");

   //Existe-il une nomenclature associée ?
   if($id_fta_nomenclature)
   {
       //Dans ce cas, chargement des informations
       mysql_table_load("fta_nomenclature");
       mysql_table_load("annexe_agrologic_article_codification");
   }
   mysql_table_load("geo");
   }
   else
   {
   $creation = 1;
}
*/

//echo $id_fta."<br>";

/*******************************************************************************
   Gestion du composant
********************************************************************************/

//Mode Création/Modification d'un composant
if ($id_fta_composant)
{
   $creation = 0;
   mysql_table_load("fta_composant");

   //Existe-il une nomenclature associée ?
   //if($id_fta_nomenclature)
   {
       //Dans ce cas, chargement des informations
       //mysql_table_load("fta_nomenclature");
       mysql_table_load("annexe_agrologic_article_codification");
   }
   mysql_table_load("geo");
   }
   else
   {
   $creation = 1;
   //Ce composant sera géré dans la composition
   //$is_composition_fta_composant = 1;

   //La création d'un composant dans la composition n'inclus pas ce composant dans la nomenclature
   //$is_nomenclature_fta_nomenclature = 0;
}


//Chargement des données de la FTA
//mysql_table_load("fta");
//echo $id_fta."<br>";
$bloc=""; //Bloc de saisie


        //Désignation
        $champ="nom_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Code Produit Agrologic
        $champ="code_produit_agrologic_fta_nomenclature";
        $table="fta_composant";
        $bloc .="<tr><td>".mysql_field_desc($table, $champ)."</td><td>";
        $bloc .= $prefixe_annexe_agrologic_article_codification.$$champ;
        $bloc.="</td></tr>";

        //Liste des ingrédients
        $champ="ingredient_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Liste des ingrédients (extension supplémentaire)
        $champ="ingredient_fta_composition1";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Site de Fabrication
        $nom_liste="id_geo";
        $champ="geo";
        if(!$$nom_liste) //Par défaut, prende le site d'assemblage de la FTA
        {
           $req = "SELECT id_geo FROM geo WHERE id_site = $Site_de_production";
           $result_id_geo = DatabaseOperation::query($req);
           $id_geo = mysql_result($result_id_geo, 0, "id_geo");
           mysql_table_load("geo");
        }

        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $nom_liste)."</td><td>";
        $id_defaut=$id_geo;
        $req = "SELECT id_geo, geo "
               . "FROM geo "
               . "WHERE assemblage = 1 "
               . "ORDER BY geo "
               ;
        $id_defaut=$$nom_liste;
        if($proprietaire)
        {
          $bloc .= afficher_requete_en_liste_deroulante($req, $id_defaut, $nom_liste);
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";
//echo $id_fta."<br>";

        //Durée de Vie
        $champ="duree_vie_technique_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Poids
        $champ="poids_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Quantité
        $champ="quantite_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

        //Ordre dans le quel présenter les composants
        $champ="ordre_fta_composition";
        $bloc .= "<tr><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if($proprietaire)
        {
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        }else{
          $bloc .=html_view_txt(${$champ});
        }
        $bloc.="</td></tr>";

/*******************************************************************************
   Gestion de l'étiquette associée à ce composant
********************************************************************************/

$bloc .= "</td></tr>
             </table>
             <$html_table>
             <tr class=titre_principal><td>

                 Etiquette
             </td></tr>
             </table>
             <$html_table>
             <tr><td>
        ";


        //Mode de fonctionnement de l'Etiquette Composition
        $champ="mode_etiquette_fta_composition";
        $table="fta_composant";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc($table, $champ)."</td><td $color_modif>";
        $checked6="";
        $checked7="";
        $checked8="";
        if($proprietaire)
        {
          $data_disabled_0="";

          // Le champ $id_fta_nomenclature est obsolète
          //if($id_fta_nomenclature)  //Sans code Agrologic, on ne peut pas étiqueter
          //echo $is_nomenclature_fta_composant." ".$code_produit_agrologic_fta_nomenclature." " .$activation_codesoft_arti2;
          //if($is_nomenclature_fta_composant and $code_produit_agrologic_fta_nomenclature and ($activation_codesoft_arti2==2
          if($is_nomenclature_fta_composant and ($activation_codesoft_arti2==2 or $activation_codesoft_arti2==3)
          )
          {
             $data_disabled_1="";
             $data_disabled_4="";
             $data_disabled_2="disabled";
          }else
          {
             $data_disabled_1="disabled";
             $data_disabled_4="disabled";
             $data_disabled_2="disabled";
          }
          $data_disabled_3="";
        }
        else
        {
             $data_disabled_0="disabled";
             $data_disabled_1="disabled";
             $data_disabled_4="disabled";
             $data_disabled_2="disabled";
             $data_disabled_3="disabled";
        }
        switch(${$champ})
        {

           case 0: //Pas d'étiquette composition
               $checked_0="checked";
               //$etiquette_fta_composition=$etiquette_supplementaire_fta_composition="";

           break;
           case 1: //Contenu de l'etiquette identique à la liste des ingrédients
               $checked_1="checked";
               //$etiquette_fta_composition=$ingredient_fta_composition;
               //$etiquette_supplementaire_fta_composition=$ingredient_fta_composition1;

           break;
           /* OBSOLETE
           case 2: //Etiquette regroupant quelques composants
               $checked_2="checked";

           break;
           **/

           /* ONBSOLETE
           case 3: //L'étiquette est regroupée sur un autre composant
               $checked_3="checked";

           break;
           **/

           case 4: //Etiquette personnalisée
               $checked_4="checked";

           break;

           default:
           //case 14:
               $checked_0="checked";
           break;
        }
        $bloc .= "<input type=radio name=".$champ." value=0 $checked_0 $data_disabled_0> Pas d'étiquette pour ce composant $image_modif<br>";
        $bloc .= "<input type=radio name=".$champ." value=1 $checked_1 $data_disabled_1> Etiquette identique à ce composant $image_modif<br>";
        //$bloc .= "<input type=radio name=".$champ." value=2 $checked_2 $data_disabled_2> Etiquette regroupant quelques composants $image_modif<br>";
        //$bloc .= "<input type=radio name=".$champ." value=3 $checked_3 $data_disabled_3> L'étiquette est regroupée sur un autre composant $image_modif<br>";
        $bloc .= "<input type=radio name=".$champ." value=4 $checked_4 $data_disabled_4> Etiquette personnalisée $image_modif<br>";
        $bloc .="</td></tr>";

        //$etiquette_poids_fta_composition=$poids_fta_composition*$quantite_fta_composition;

        /***********************************************************************
        Contenu de l'étiquette
        ***********************************************************************/

        //Données par défaut
        $default_etiquette_libelle_fta_composition=$nom_fta_composition;
        $default_etiquette_fta_composition=$ingredient_fta_composition;
        $default_etiquette_supplementaire_fta_composition=$ingredient_fta_composition1;
        $default_etiquette_poids_fta_composition=$poids_fta_composition/1000;  //Conversion de g -> Kg
        $default_etiquette_quantite_fta_composition=$quantite_fta_composition;
        $default_etiquette_duree_vie_fta_composition=$duree_vie_technique_fta_composition;

        //Initialisation des données
//echo "MODE: $mode_etiquette_fta_composition<br><br>";

        switch($mode_etiquette_fta_composition)
        {
        case 0:

             //Les données étiquettes sont purgées
             $etiquette_libelle_fta_composition="";
             $etiquette_fta_composition="";
             $etiquette_supplementaire_fta_composition="";
             $etiquette_poids_fta_composition=0;
             $etiquette_quantite_fta_composition=0;
             $etiquette_duree_vie_fta_composition=0;

        break;

        case 1: //Etiquette identique à ce composant
             //Les données sont forcées avec les valeurs par défaut
             $champ="etiquette_libelle_fta_composition";
                $$champ=${"default_".$champ};
             $champ="etiquette_fta_composition";
                $$champ=${"default_".$champ};
             $champ="etiquette_supplementaire_fta_composition";
                $$champ=${"default_".$champ};
             $champ="etiquette_poids_fta_composition";
                $$champ=${"default_".$champ};
             $champ="etiquette_quantite_fta_composition";
                $$champ=${"default_".$champ};
             $champ="etiquette_duree_vie_fta_composition";
                $$champ=${"default_".$champ};

        break;
        case 4:

//echo "FIRST etiquette_fta_composition: $etiquette_fta_composition <br><br>";
//echo "FIRST etiquette_poids_fta_composition: $etiquette_poids_fta_composition <br><br>";

             //Les données sont initialisées si absente.
             $champ="etiquette_libelle_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
             $champ="etiquette_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
             $champ="etiquette_supplementaire_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
             $champ="etiquette_poids_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
             $champ="etiquette_quantite_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
             $champ="etiquette_duree_vie_fta_composition";
                if ($$champ == "") $$champ=${"default_".$champ};
        break;
        }

        /***********************************************************************
        Interface utilisateur pour configurer de l'étiquette
        ***********************************************************************/

          //Pour modifier le contenu de l'étiquette  l'utilisateur doit être propriétaires et l'étquette doit être personnalisable
          if($proprietaire and $mode_etiquette_fta_composition==4)
          {
              $edit_allow = true;
          }
          else
          {
              $edit_allow = false;
          }

          //Libellé produit de l'étiquette
          $champ="etiquette_libelle_fta_composition";
          $table="fta_composant";
            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";

            if($edit_allow)
            {
              $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }
            $bloc.="$image_modif</td></tr>";

          //Composition Etiquette
          $champ="etiquette_fta_composition";
          $table="fta_composant";
            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";
            if($edit_allow)
            {
              $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
              //$bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }
            $bloc.="$image_modif</td></tr>";



           //Composition Etiquette (extension supplémentaire)
           $champ="etiquette_supplementaire_fta_composition";
           $table="fta_composant";

            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";
            if($edit_allow)
            {
              $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }

            $bloc.="$image_modif</td></tr>";

          //Durée de vie etiquetée
          $champ="etiquette_duree_vie_fta_composition";
          $table="fta_composant";

            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";
            if($edit_allow)
            {
              $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }

          //Poids net etiqueté
          $champ="etiquette_poids_fta_composition";
          $table="fta_composant";

            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";
            if($edit_allow)
            {
              $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }

          //Quantité etiquetée
          $champ="etiquette_quantite_fta_composition";
          $table="fta_composant";

            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
            $bloc .= "<tr><td $color_modif>".mysql_field_desc("fta_composant", $champ)."</td><td $color_modif>";
            if($edit_allow)
            {
              $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
            }else{
              $bloc .=html_view_txt(${$champ});
              $bloc .= "<input type=hidden name=".$champ." value=`".${$champ}."`/>";
            }
            
          //Liste des composants regroupés sur cette étiquette
          $req = "SELECT * "
               . "FROM fta_composant "
               . "WHERE etiquette_id_fta_composition=$id_fta_composant "
               . "ORDER BY nom_fta_composition"
               ;
          $result = DatabaseOperation::query($req);
          if(mysql_num_rows($result))
          {
              $liste_composant_associee="";
              while($rows=mysql_fetch_array($result))
              {
                 $liste_composant_associee.=$rows["nom_fta_composition"]."<br>";
                 $etiquette_poids_fta_composition=$etiquette_poids_fta_composition + ($rows["poids_fta_composition"]*$rows["quantite_fta_composition"]);

              }
              $bloc .="<tr><td>Liste des composants inclus sur cette étiquette</td>"
                    . "<td>$liste_composant_associee</td></tr>";
          }
          else
          {
             //$bloc .= "<input type=hidden name=etiquette_supplementaire_fta_composition value=`$etiquette_supplementaire_fta_composition`>";
             //$bloc .= "<input type=hidden name=etiquette_fta_composition value=`$etiquette_fta_composition`>";
          }
//echo $id_fta."<br>";

   //Configuration de l'étiquette
   if($mode_etiquette_fta_composition==1 or $mode_etiquette_fta_composition==2 or $mode_etiquette_fta_composition==4)
   {


        //Taile de la police du nom du composant
        $champ="taille_police_nom_fta_composition";
        $table="fta_composant";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc($table, $champ)."</td><td $color_modif>";
        $checked6="";
        $checked7="";
        $checked8="";

        switch(${$champ})
        {

           case 13:
               $checked6="checked";
           break;
           case 15:
               $checked8="checked";
           break;

           default:
           //case 14:
               $checked7="checked";
           break;


        }
        $bloc .= "<input type=radio name=".$champ." value=13 $checked6 $data_disabled> 13 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=14 $checked7 $data_disabled> 14 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=15 $checked8 $data_disabled> 15 $image_modif";
        $bloc .="</td></tr>";


        //Taile de la police de la liste d'ingrédient:
	$champ="taille_police_ingredient_fta_composition";
        $table="fta_composant";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc($table, $champ)."</td><td $color_modif>";

	//Remise à zéro des bouton radio
	$checked4=$checked5=$checked6=$checked7=$checked8="";

	//Activation uniquement de celui correspondant à la taille de la police choisie
	if ($taille_police_ingredient_fta_composition){
		${"checked".$taille_police_ingredient_fta_composition}="checked";
	}else{
		$checked6="checked";
	}
	
        $bloc .= "<input type=radio name=".$champ." value=4 $checked4 $data_disabled> 4 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=5 $checked5 $data_disabled> 5 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=6 $checked6 $data_disabled> 6 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=7 $checked7 $data_disabled> 7 $image_modif";
        $bloc .= "<input type=radio name=".$champ." value=8 $checked8 $data_disabled> 8 $image_modif";
        $bloc .="</td></tr>";


   //Alignement
   $champ="k_style_paragraphe_ingredient_fta_composition";
   $table="fta_composant";
        //Versionning
        $color_modif="";
        $image_modif="";
        if(${"diff_".$table}[$champ])
        {
           $image_modif=$html_image_modif;
           $color_modif=$html_color_modif;
        }
   $bloc.="<tr class=contenu><td $color_modif>";
   $bloc.= mysql_field_desc($table, $champ)
                     . "</td><td $color_modif>"
                     ;
   if($proprietaire)
   {
       $requete = "SELECT k_codesoft_style_paragraphe, libelle_codesoft_style_paragraphe "
           . "FROM codesoft_style_paragraphe "
           . "ORDER BY libelle_codesoft_style_paragraphe "
           ;
       $nom_defaut=$champ;
       $id_defaut=$$champ;
       $liste_style .= afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut);
       $bloc.= $liste_style;
   }else{
       $k_codesoft_style_paragraphe=$$champ;
       mysql_table_load("codesoft_style_paragraphe");
       $bloc .=html_view_txt($libelle_codesoft_style_paragraphe);
   }
   $bloc .=$image_modif."</td></tr>";
//echo $id_fta."<br>";
   //Modèle d'etiquette par défaut
   $champ="k_etiquette_fta_composition";
   $table="fta_composant";
        //Versionning
        $color_modif="";
        $image_modif="";
        if(${"diff_".$table}[$champ])
        {
           $image_modif=$html_image_modif;
           $color_modif=$html_color_modif;
        }
   $liste_etiquette = mysql_field_desc($table, $champ)
                     . "</td><td $color_modif>"
                     ;
   $bloc.="<tr class=contenu><td $color_modif>".$liste_etiquette;
   if($proprietaire)
   {
       $requete = "SELECT k_etiquette, designation_codesoft_etiquettes "
                . "FROM codesoft_etiquettes "
                . "WHERE (k_site='".$Site_de_production."' "
                . "OR k_site=0) "
                . "AND (k_type_etiquette_codesoft_etiquettes=2 "
                . "OR k_type_etiquette_codesoft_etiquettes=0) "
                . "ORDER BY designation_codesoft_etiquettes "
                ;
       $nom_defaut=$champ;
       $id_defaut=$$champ;
       $bloc.= afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut).$image_modif;
   }else{
       $k_etiquette=$$champ;
       mysql_table_load("codesoft_etiquettes");
       $bloc .=html_view_txt($designation_codesoft_etiquettes);
   }
   $bloc.="</td></tr>";


    /************************
    BUG IDENTIFIE ICI
    Il est arrivé que l'id_fta de la table conditionnement soit différentes !!
    Annulation de cette fonctionnalité
    *************************/
   //Conditionnement à étiqueter
/**
       $champ="etiquette_id_fta_conditionnement";
       $table="fta_composant";
            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
       $liste_etiquette = mysql_field_desc($table, $champ)
                         . "</td><td $color_modif>"
                         ;
       $bloc.="<tr class=contenu><td $color_modif>".$liste_etiquette;
       //if($proprietaire)
       {
           $requete = "SELECT id_fta_conditionnement, CONCAT(nom_annexe_emballage_groupe, ' ', reference_fournisseur_annexe_emballage) "
                    . "FROM fta_conditionnement, annexe_emballage, annexe_emballage_groupe "
                    . "WHERE (id_fta='".$id_fta."' "
                    . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                    . "AND fta_conditionnement.id_annexe_emballage=annexe_emballage.id_annexe_emballage "
                    . "AND (id_annexe_emballage_groupe_type=1 or id_annexe_emballage_groupe_type=2) "
                    . ") ORDER BY CONCAT(nom_annexe_emballage_groupe, ' ', reference_fournisseur_annexe_emballage) "
                    ;
           $result=DatabaseOperation::query($requete);
           if(mysql_num_rows($result)==1)
           {
                $id_fta_conditionnement=mysql_result($result, 0, "id_fta_conditionnement");
                mysql_table_load("fta_conditionnement");
                mysql_table_load("annexe_emballage_groupe");
                mysql_table_load("annexe_emballage");
                $bloc .=html_view_txt($nom_annexe_emballage_groupe." ".$reference_fournisseur_annexe_emballage);
           }
           else
           {
                $nom_defaut=$champ;
                $id_defaut=$$champ;
                $bloc.= afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut).$image_modif;
           }
       }
/**/

//echo $id_fta."<br>";
    //Poids Net Etiquette
    /************************
    BUG IDENTIFIE ICI
    Il est arrivé que l'id_fta de la table conditionnement soit différentes !!
    Annulation de cette fonctionnalité
    *************************/

/**
    $bug_current_fta=$id_fta;
    $id_fta_conditionnement = $etiquette_id_fta_conditionnement;
    mysql_table_load("fta_conditionnement");
    if($id_fta<>$bug_current_fta)
    {
        echo "BUG FTA !!! -> Correction Automatique";

        $titre="Bug FTA";
        $message = "Merci d'appler immédiatement le service Informatique";
        //afficher_message($titre, $message, $redirection);
        $id_fta=$bug_current_fta;
    }
//echo $id_fta."<br>";
    mysql_table_load("annexe_emballage_groupe");
    mysql_table_load("annexe_emballage");

//echo $id_annexe_emballage_groupe_type;

    switch($id_annexe_emballage_groupe_type)
    {
        case 1://Emballages par UVC (à convertir en emballage par Colis)
             $quantite_par_colis = $quantite_par_couche_fta_conditionnement * $NB_UNIT_ELEM;
        break;

        case 2://Emballage par Colis
             $quantite_par_colis = $quantite_par_couche_fta_conditionnement;
        break;
        default:
            $quantite_par_colis=1;
        break;
    }

    //Récupération des poids des composants au niveau colis
//echo $quantite_par_colis;
    $etiquette_poids_fta_composition=$etiquette_poids_fta_composition/$quantite_par_colis/1000;
    $bloc .="<tr class=contenu><td>Poids Net Etiquette (en Kg)</td><td>"
          . $etiquette_poids_fta_composition
          . "</td></tr>";
/**/
}
//echo $mode_etiquette_fta_composition;

if($mode_etiquette_fta_composition==3)
{

   //Composant regroupant l'étiquette
       $champ="etiquette_id_fta_composition";
       $table="fta_composant";
            //Versionning
            $color_modif="";
            $image_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
       $liste_etiquette = mysql_field_desc($table, $champ)
                         . "</td><td $color_modif>"
                         ;
       $bloc.="<tr class=contenu><td $color_modif>".$liste_etiquette;
    /*    if($proprietaire)
       { */
           $requete = "SELECT id_fta_composant, nom_fta_composition "
                    . "FROM fta_composant "
                    . "WHERE fta_composant.id_fta=$id_fta "
                    . "AND id_fta_composant<>$id_fta_composant "
                    //. "AND id_fta_nomenclature<>0 "
                    . "AND is_nomenclature_fta_composant=1 "
                    . "ORDER BY nom_fta_composition "
                    ;

           $nom_defaut=$champ;
           $id_defaut=$$champ;
           $bloc.= afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut).$image_modif;


}
   /* }else{
       $k_etiquette=$$champ;
       mysql_table_load("codesoft_etiquettes");
       $bloc .=html_view_txt($designation_codesoft_etiquettes);
   } */
   $bloc.="</td></tr>";




/*
     Sélection du mode d'affichage
*/
switch ($output)
{

/*************
Début Code PDF
*************/
case "pdf":
         //Constructeur
         $pdf=new XFPDF();

         //Déclaration des variables de formatages
         $police_standard="Arial";
         $t1_police=$police_standard;
         $t1_style="B";
         $t1_size="12";

         $t2_police=$police_standard;
         $t2_style="B";
         $t2_size="11";

         $t3_police=$police_standard;
         $t3_style="BIU";
         $t3_size="10";

         $contenu_police=$police_standard;
         $contenu_style="";
         $contenu_size="8";

         $chapitre=0;
         $section=0;
         include($page_pdf);
         //$pdf->SetProtection(array("print", "copy"));
         $pdf->Output(); //Read the FPDF.org manual to know the other options

break;
/***********
Fin Code PDF
***********/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/




/**************
Début Code HTML
**************/
default:
//echo $id_fta;
        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>
             <input type=hidden name=id_fta value=$id_fta>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
             <input type=hidden name=id_access_recette_recette value=$id_access_recette_recette>
             <input type=hidden name=id_fta_composition value=$id_fta_composition>
             <input type=hidden name=id_fta_composant value=$id_fta_composant>
             <input type=hidden name=etiquette_poids_fta_composition value=$etiquette_poids_fta_composition>
             <input type=hidden name=creation value=$creation>
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />
             <input type=hidden name=proprietaire value=$proprietaire />

             <$html_table>
             <tr class=titre_principal><td>

                 Modification d'un Composant

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 $lien_mode_selection

             </td></tr>

                 $bloc

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 <center>
                 $bouton_valider
                 </center>

             </td></tr>
             </table>

             </form>
             ";



/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");

/************
Fin Code HTML
************/

}//Fin du switch de sélection du mode d'affichage

?>
