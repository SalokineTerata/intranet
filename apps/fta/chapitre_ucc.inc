<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */


        //Gencod EAN Article
        $champ="EAN_UVC";
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
           $id_element="1"; //Recherche si le propriétaire est Agis
           $extension[0]=0; //Passage en mode recherche d'un contenu
           $search = recherche_element_classification_fta($id_fta, $id_element, $extension);
           $search[0];

           //Si il y a déjà une valeur, ou que le propriétaire n'est pas Agis
           if((${$champ}) or ($search[0]==0))
           {
               $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
           }
           else
           {
               $id_societe=1;
               mysql_table_load("societe");
               $bloc .= "<input type=text name=".$champ." value=`".$cnuf_societe."` size=20/>";
           }
           
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Gencod EAN Colis
        $champ="EAN_COLIS";
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
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Gencod EAN Palette
        $champ="EAN_PALETTE";
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
           $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";


?>