<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */

        mysql_table_load("annexe_agrologic_article_codification");
                  
        //Unité d'affichage
        $champ="unite_affichage_fta";   //En rapport avec id_annexe_unite
        $table="fta";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        switch(${$champ})
        {
          case "kg":
              $checked2="checked";
              $checked3="";
              $poids_affichage=$Poids_ELEM;

          break;
          default:
              $checked2="";
              $checked3="checked";
              $poids_affichage=$Poids_ELEM*1000;

        }
        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>
                  <input type=radio name=unite_affichage_fta value=kg $checked2 $data_disabled> Kilogramme$image_modif<hr>
                  <input type=radio name=unite_affichage_fta value=g $checked3 $data_disabled> Gramme$image_modif
                  ";

        //Désignation Abrégée
        $taille_max = "20"; //En rapport avec le taille réelle de la données

        if(!$nom_abrege_fta)
        {
            $nom_abrege_fta = $designation_commerciale_fta;
            $nom_abrege_fta=strtoupper($nom_abrege_fta);
        }
        $champ="nom_abrege_fta";
        $table="fta";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("fta", $champ)."</td><td $color_modif>";

        if($proprietaire)
        {
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` maxlength=$taille_max size=$taille_max/> "
                  . "<a href=../.data/dictionnaire_abreviations.sxc target=_blank>"
                  . "<img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /></a>"
                  ;
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Désignation Interne Agis
        $taille_max = "60";
        if(!$unite_affichage_fta)$unite_affichage_fta="G";
        if(!$LIBELLE)
        {
          $LIBELLE = $nom_abrege_fta." ".$suffixe_agrologic_fta." ".$NB_UNIT_ELEM."X".$poids_affichage.strtoupper($unite_affichage_fta);
          $LIBELLE=strtoupper($LIBELLE);
        }
        $champ="LIBELLE";
        $table="access_arti2";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if($proprietaire)
        {
            $bloc .= "<input type=text name=$champ value=`".${$champ}."` maxlength=$taille_max size=$taille_max/> ";
        }else
        {
            $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Désignation Etiquette
        $taille_max = "60";
        $champ="LIBELLE_CLIENT";
        $table="access_arti2";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if(!$verrouillage_libelle_etiquette_fta)
        {
            $disabled="readonly";
        }
        else
        {
            $disabled="";
        }
        if($proprietaire)
        {
           $bloc .= "<input type=text name=LIBELLE_CLIENT value=`".$LIBELLE_CLIENT."` maxlength=$taille_max size=$taille_max $disabled /> ";
        }else
        {
        $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Identifiant LDC
        $champ="code_article_ldc";
        $table="access_arti2";
          //Versionning
          $color_modif="";
          $image_modif="";
          if(${"diff_".$table}[$champ])
          {
             $image_modif=$html_image_modif;
             $color_modif=$html_color_modif;
          }
        $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
        if($proprietaire)
        {
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."`/> ";
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

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


?>