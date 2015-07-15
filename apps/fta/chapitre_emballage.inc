<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */

  //PCB
  /*
  $champ="NB_UNIT_ELEM";
  $table="access_arti2";

      //Versionning
      $image_modif="";
      $color_modif="";
      if(${"diff_".$table}[$champ])
      {
         $image_modif=$html_image_modif;
         $color_modif=$html_color_modif;
      }
      $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
      $bloc .="<b>${$champ}</b>";
      $bloc.="$image_modif</td></tr>";
  */

  //Selection de tous les type de groupe d'emballage
  $req = "SELECT * FROM annexe_emballage_groupe_type ORDER BY ordre_emballage_groupe_type";
  $result1=DatabaseOperation::query($req);
  while($rows1=mysql_fetch_array($result1))
  {


         //Sélection du bon groupe d'emballage
         $type_emballage_groupe=$rows1["id_annexe_emballage_groupe_type"]; //Emballe pour l'UVC
         $id_annexe_emballage_groupe_type=$type_emballage_groupe;
         $titre=$rows1["nom_annexe_emballage_groupe_type"];

         $bloc.="<tr><td><br></td></tr><$html_table><tr class=titre_principal><td align=left>$titre";

         //Ajouter un nouveau Conditionement
         if($proprietaire)
         {
           if($type_emballage_groupe==2)
           {
               $dimension_uvc_fta_conditionnement=1;
           }
           $bloc.= "
                   <a href=ajout_conditionnement.php?id_fta=$id_fta&type_emballage_groupe=$type_emballage_groupe&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action&dimension_uvc_fta_confitionnement=$dimension_uvc_fta_conditionnement>
                   (Ajouter)
                   </a>
                   ";
         }
         $bloc.= "</td></tr>";

         //Intitulé des quantité
         $intitule_quantite = "Quantité par ";
         switch ($id_annexe_emballage_groupe_type)
         {
             case 1: $intitule_quantite .= "UVC";
             break;
             case 2: $intitule_quantite .= "Colis";
             break;
             case 3: $intitule_quantite .= "Palette";
             break;
             case 4: $intitule_quantite = "Quantité";
             break;
         }
         //Tableau récapitulatif du conditionnement
         $recap_conditionnement = "
                        <$html_table>
                        <tr class=contenu>
                            <td>
                            ".mysql_field_desc("annexe_emballage_groupe", "nom_annexe_emballage_groupe")."
                            </td>
                            <td>
                            Hauteur x Longueur x Largeur (en mm)
                            </td>
                            <td>
                            ".mysql_field_desc("fta_conditionnement", "poids_fta_conditionnement")."
                            </td>
                            <td>
                            $intitule_quantite
                            </td>
                        ";
         if($proprietaire)
         {
            $recap_conditionnement.="<td></td>";
         }
         $recap_conditionnement.="</tr>";

         $req = "SELECT id_fta_conditionnement, fta_conditionnement.id_annexe_emballage_groupe "
              . "FROM fta_conditionnement, annexe_emballage_groupe "
              . "WHERE id_fta=$id_fta "
              . "AND ( "
                . "id_annexe_emballage_groupe_type=$type_emballage_groupe "
                //. "OR ( fta_conditionnement.id_annexe_emballage_groupe = annexe_emballage_groupe.id_annexe_emballage_groupe "
                //. "AND id_annexe_emballage_groupe_configuration =$type_emballage_groupe )"
              . " )"
              . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
              . "ORDER BY nom_annexe_emballage_groupe, poids_fta_conditionnement "
              ;

         $result=DatabaseOperation::query($req);
         if(mysql_num_rows($result))
         {
             while($rows=mysql_fetch_array($result))
             {
                 $id_fta_conditionnement=$rows["id_fta_conditionnement"];
                 $last_id_fta_conditionnement=$rows["last_id_fta_conditionnement"];
                 $table="fta_conditionnement";
                 mysql_table_load($table);
                 mysql_table_load("annexe_emballage");
                 mysql_table_load("annexe_emballage_groupe");

                 //Récupération du différenciel de version
                 $table_name_1=$table;
                 $id_1 = $id_fta_conditionnement;
                 $table_name_2=$table;
                 $id_2 = $last_id_fta_conditionnement;
                 //$debug=1;
                 ${"diff_".$table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);
                 $image_modif="";

                 /* 
                 if($dimension_uvc_fta_confitionnement)
                 {
                     $bgcolor="bgcolor=#AFFF5A";
                     }else{
                     $bgcolor="";
                 }
                 */

                 //Groupe d'emballage
                 $champ="id_annexe_emballage_groupe";
                 $table="fta_conditionnement";

                   //Versionning
                   $color_modif="";
                   if(${"diff_".$table}[$champ])
                   {
                      $image_modif=$html_image_modif;
                      $color_modif=$html_color_modif;
                   }
                 $champ="nom_annexe_emballage_groupe";
                 $recap_conditionnement .= "<tr class=contenu ><td $color_modif width=\"20%\">${$champ}<br>&nbsp;&nbsp;$reference_fournisseur_annexe_emballage</td>";

                 //Dimensions
                 $color_modif="";
                 $table="fta_conditionnement";

                   //Versionning
                   //$champ="hauteur_fta_conditionnement";
                   if(${"diff_".$table}["hauteur_fta_conditionnement"]
                   or ${"diff_".$table}["longueur_fta_conditionnement"]
                   or ${"diff_".$table}["largeur_fta_conditionnement"]
                   )
                   {
                      $image_modif=$html_image_modif;
                      $color_modif=$html_color_modif;
                   }

                 $champ="Hauteur x Longeur x Largeur (en mm)";
                 if($old_dim)
                 {
                     //echo $old_dim;
                     $recap_conditionnement .= "<td $color_modif width=\"20%\">$old_dim</td>";

                 }else
                 {
                     $recap_conditionnement .= "<td $color_modif width=\"20%\">$hauteur_fta_conditionnement x $longueur_fta_conditionnement x $largeur_fta_conditionnement</td>";
                 }
                 //Poids
                 $champ="poids_fta_conditionnement";
                 $table="fta_conditionnement";

                   //Versionning
                   $color_modif="";
                   if(${"diff_".$table}[$champ])
                   {
                      $image_modif=$html_image_modif;
                      $color_modif=$html_color_modif;
                   }
                 $recap_conditionnement .= "<td $color_modif width=\"20%\">${$champ}</td>";

                 //Quantité
                 /* if($type_emballage_groupe==2)//Cas du PCB
                 {
                    $p1="<H4><br>";
                    $p2="</H4>";
                 }else{
                    $p1="";
                    $p2="";
                 } */

                   //Versionning
                   $champ="quantite_par_couche_fta_conditionnement";
                   $table="fta_conditionnement";
                   $color_modif="";
                   if(${"diff_".$table}[$champ])
                   {
                      $image_modif=$html_image_modif;
                      $color_modif=$html_color_modif;
                   }

                 if($nombre_couche_fta_conditionnement == 1)
                 {

                     $recap_conditionnement .= "<td $color_modif width=\"20%\" align=\"center\">$p1 $quantite_par_couche_fta_conditionnement $p2</td>";
                     }else{
                     //Versionning
                     $champ="nombre_couche_fta_conditionnement";
                     $table="fta_conditionnement";
                     //$color_modif="";
                     if(${"diff_".$table}[$champ])
                     {
                        $image_modif=$html_image_modif;
                        $color_modif=$html_color_modif;
                     }
                     $recap_conditionnement .= "<td $color_modif width=\"20%\">$quantite_par_couche_fta_conditionnement colis x $nombre_couche_fta_conditionnement couches</td>";
                 }

                 //Action
                 $color_modif="";
                 if($image_modif)
                 {
                     $color_modif=$html_color_modif;
                 }
                 $recap_conditionnement .= "<td $color_modif width=\"1%\">";
                 if($proprietaire)
                 {
                   $recap_conditionnement .= "
                                <a href=modification_fiche_post.php?id_fta=$id_fta&id_fta_conditionnement=$id_fta_conditionnement&action=suppression_conditionnement&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                                </a><br>
                                <a href=ajout_conditionnement.php?id_fta=$id_fta&id_fta_conditionnement=$id_fta_conditionnement&action=etape3&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                <img src=../lib/images/next.png width=15 height=15 border=0/></a>
                                ";
                 }
                 $recap_conditionnement.="$image_modif</td>";

             }//Fin du While
         }//Fin du If

         $recap_conditionnement.="</tr>";
         $bloc.= $recap_conditionnement;

         $bloc.="";
   }

   $bloc.="</table><$html_table>";

   //Synoptic
   $champ="description_emballage";
   $table="fta";

     //Versionning
     $color_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("fta", $champ)."</td><td $color_modif>";
   if($proprietaire)
   {
     $bloc .= "<textarea name=".$champ." rows=8 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

?>
