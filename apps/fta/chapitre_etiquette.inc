<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par
  - - - - - - - - - - - - - - - - - - - - - - - */


//Gestion des étiquettes
$bloc .= "<tr class=titre_principal><td>Gestion des étiquettes</td></tr>
         <tr><td><$html_table>
         ";


   //Activation de l'étiquette dans la base de données Codesoft
   //0=Aucune Impression
   //1=Colis
   //2=Composition
   //3=Les deux

//echo $activation_codesoft_arti2;
   $champ="activation_codesoft_arti2";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("access_arti2", $champ)."</td><td $color_modif>";
   switch(${$champ})
   {

      case 0:
          $checked2="";
          $checked3="";
      break;
      case 1:
          $checked2="checked";
          $checked3="";
      break;
      case 2:
          $checked2="";
          $checked3="checked";
      break;
      case 3:
          $checked2="checked";
          $checked3="checked";
      break;

   }
   if($proprietaire)
   {
       $disabled="";
   }else
   {
       $disabled="disabled";
   }
   $bloc .= "<input type=checkbox name=temp_colis_".$champ." value=1 $checked2 $disabled /> Colis $image_modif<hr>";
   $bloc .= "<input type=checkbox name=temp_composition_".$champ." value=2 $checked3 $disabled /> Composition $image_modif";
   $bloc .="</td></tr>";

$bloc .= "</td></tr></table>";


//Etiquettes Colis
$bloc .= "<tr class=titre_principal><td>Etiquettes Colis</td></tr>
         <tr><td><$html_table>
         ";
   //Forcer la DIN
   $champ="verrouillage_libelle_etiquette_fta";
   $table="fta";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
     //La case est-elle cochée ?
     if($$champ)
     {
        $checked_oui="checked";
        $checked_non="";
     }
     else
     {
        $checked_oui="";
        $checked_non="checked";
     }
   $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
   if($proprietaire)
    {
        $disabled="";
    }else
    {
        $disabled="disabled";
    }
    $bloc .= "<input type=\"radio\" name=\"$champ\" value=\"1\" $checked_oui $disabled />Oui <hr>";
    $bloc .= "<input type=\"radio\" name=\"$champ\" value=\"0\" $checked_non $disabled />Non";
    $bloc .="$image_modif</td></tr>";

   //Désignation Etiquette
   $taille_max = "60";
   if($verrouillage_libelle_etiquette_fta)
   {
      $LIBELLE_CLIENT=$LIBELLE;
      //echo "test: $LIBELLE";
      $disabled="1";
   }
   else
   {
     $disabled="";
     if(!$LIBELLE_CLIENT)
     {
        $LIBELLE_CLIENT="Vous devez spécifier le libellé Article de l'étiquette.";
     }
   }
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
   if($proprietaire and !$disabled)
    {
       $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` maxlength=$taille_max size=$taille_max /> ";
    }else
    {
        $bloc .="${$champ}";
        $bloc .="<input type=hidden name=LIBELLE_CLIENT value=\"$LIBELLE_CLIENT\">";
    }
    $bloc .="$image_modif</td></tr>";

   //Modèle d'etiquette par défaut
   $champ="id_etiquette_codesoft_arti2";
   $table="access_arti2";
        //Versionning
        $color_modif="";
        $image_modif="";
        if(${"diff_".$table}[$champ])
        {
           $image_modif=$html_image_modif;
           $color_modif=$html_color_modif;
        }
   $liste_etiquette = mysql_field_desc("codesoft_etiquettes", "designation_codesoft_etiquettes")
                     . "</td><td $color_modif>"
                     ;

   if(!$id_etiquette_codesoft_arti2)
   {
       $id_defaut = -1;
   }
   else
   {
       $id_defaut = $id_etiquette_codesoft_arti2;
   }
   if($proprietaire)
   {
       $requete = "SELECT k_etiquette, designation_codesoft_etiquettes "
                . "FROM codesoft_etiquettes "
                . "WHERE (k_site='".$Site_de_production."' "
                . " OR k_site=0 ) "
                . " AND ( k_type_etiquette_codesoft_etiquettes<>2 ) "
                . "ORDER BY designation_codesoft_etiquettes "
                ;

       $nom_defaut ="id_etiquette_codesoft_arti2";
       $liste_etiquette .= afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut);

   }
   else
   {
      $requete = "SELECT k_etiquette, designation_codesoft_etiquettes "
                . "FROM codesoft_etiquettes "
                . "WHERE k_etiquette='".$id_defaut."' "
                ;
      $result=DatabaseOperation::query($requete);
      $liste_etiquette.=mysql_result($result, 0, "designation_codesoft_etiquettes");
   }
   $bloc.="<tr class=contenu><td $color_modif>".$liste_etiquette.$image_modif."</td></tr>";


$bloc .= "</td></tr></table>";

//Etiquettes Composition
$bloc .= "<tr class=titre_principal><td>Etiquettes Composition</td></tr>
         <tr><td><$html_table>
         ";


   //Composition Etiquette (1er paragraphe)
   $champ="Composition";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("access_arti2", $champ)."</td><td $color_modif>";
   if($proprietaire)
   {
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

   //Composition Etiquette (2nd paragraphe)
   $champ="composition1";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("access_arti2", $champ)."</td><td $color_modif>";
//   $bloc .= "<tr class=contenu><td>".mysql_field_desc("access_arti2", $champ)."</td><td>";
   if($proprietaire)
   {
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="</td></tr>";

   //Composition Etiquette (Multilangue)
   $champ="libelle_multilangue";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("access_arti2", $champ)."</td><td $color_modif>";
   if($proprietaire)
   {
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

?>