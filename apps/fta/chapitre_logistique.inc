<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */

        //Etat de conservation
        $id_annexe_environnement_conservation_groupe=$K_etat;
        mysql_table_load("annexe_environnement_conservation_groupe");
        $champ="nom_annexe_environnement_conservation_groupe";
        $table="annexe_environnement_conservation_groupe";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }

        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        //if($proprietaire)
        //{
        //   $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        //}else
        //{
           $bloc .="${$champ}";
        //}
        $bloc.="$image_modif</td></tr>";


/*         $id_annexe_environnement_conservation_groupe=$K_etat;
        mysql_table_load("annexe_environnement_conservation_groupe");
        $value=$nom_annexe_environnement_conservation_groupe;
        $bloc .="$value";
        $bloc.="</td></tr>";
 */
/*
        $id_fta;
        $id_element="51"; //Environnement de conservation
        $extension[0]=1;
        $exist=recherche_element_classification_fta($id_fta, $id_element, $extension);
        if($version_modif)
        {
            $exist_last=recherche_element_classification_fta($last_id_fta, $id_element, $extension);
            //Versionning
            $image_modif="";
            $color_modif="";
            if($exist[2]<>$exist_last[2])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
        }
        $bloc .= "<tr class=contenu><td width=\"20%\" $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if($exist[0])
        {
           $value = $exist[2];
        }
        else
        {
           $value = "<i>Classification Incomplète</i>";
        }
        $bloc .="$value";
        $bloc.="$image_modif</td></tr>";
*/

//echo $id_access_arti2;
//echo "Site_de_production:".$Site_de_production."<br>";

        //Site d'assemblage
        $nom_liste="Site_de_production";
        $champ=$nom_liste;
        $table="access_arti2";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }

        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$nom_liste}:</td><td $color_modif>";
        if($proprietaire)
        {
           $req_liste_site_assemblage = "SELECT id_site, geo "
                  . "FROM geo "
                  . "WHERE assemblage = 1 "
		  . "AND site_actif = 1 "
		  . "AND `tag_application_geo` LIKE '%fta%' "
                  . "ORDER BY geo "
                  ;
	   $id_defaut=$$nom_liste;
           $bloc .= afficher_requete_en_liste_deroulante($req_liste_site_assemblage, $id_defaut, $nom_liste);

        }else
        {
           //ATTENTION !!!!! Gestion spécifique de la clef
           $req = "SELECT id_geo FROM geo WHERE id_site='".$$nom_liste."' ";
           $result=DatabaseOperation::query($req);
           $id_geo=mysql_result($result, 0, "id_geo");
           mysql_table_load("geo");
           $bloc .=$geo;
        }
        $bloc.="$image_modif</td></tr>";


        //Site d'expédition
        $nom_liste="site_expedition_fta";
        $champ=$nom_liste;
        $table="fta";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }

        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$nom_liste}:</td><td $color_modif>";
        if($proprietaire)
        {
           $req_liste_site_assemblage = "SELECT id_geo, geo "
                  . "FROM geo "
                  . "WHERE assemblage = 1 "
                  . "AND site_actif = 1 "
                  . "AND `tag_application_geo` LIKE '%fta%' "
                  . "ORDER BY geo "
                  ;
           $id_defaut=$$nom_liste;
           $bloc .= afficher_requete_en_liste_deroulante($req_liste_site_assemblage, $id_defaut, $nom_liste);

        }else
        {
           //ATTENTION !!!!! Gestion spécifique de la clef
/* echo           $req = "SELECT id_geo FROM geo WHERE id_site='".$$nom_liste."' ";
           $result=DatabaseOperation::query($req);
           $id_geo=mysql_result($result, 0, "id_geo");
 */
           $id_geo=$$nom_liste;
           mysql_table_load("geo");
           $bloc .=$geo;
        }
        $bloc.="$image_modif</td></tr>";

        // rajout SM ************************ 2007-10-03
        //CNUD PREPARER PAR
        $id_geo = $site_expedition_fta;
        mysql_table_load("geo");
        $champ="geo_cnud_preparer_par";
        $table="geo";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }

        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        //if($proprietaire)
        //{
        //   $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        //}else
        //{
           $bloc .="${$champ}";
        //}
        $bloc.="$image_modif</td></tr>";
        //fin  rajout SM ************************ 2007-10-03

        //Code Douane
        $champ="code_douane_fta";
        $table="fta";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }

        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if($proprietaire)
        {
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Libellé du Code Douane
        $champ="code_douane_libelle_fta";
        $table="fta";

            //Versionning
            $image_modif="";
            $color_modif="";
            if(${"diff_".$table}[$champ])
            {
               $image_modif=$html_image_modif;
               $color_modif=$html_color_modif;
            }
        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if($proprietaire)
        {
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";







?>
