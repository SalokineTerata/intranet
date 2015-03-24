<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par
  - - - - - - - - - - - - - - - - - - - - - - - */

     //Tableau de la composition de l'Article

   //Ajouter un nouveau composant
   if($proprietaire)
   {
     $bloc.= "
             <tr class=contenu><td>
             <a href=modifier_composition.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action&proprietaire=$proprietaire>
             Ajouter un nouveau composant
             </a>
             </td></tr>
             ";
   }

   //récupération des données
   $poids_net_colis=calcul_poids_net_colis($id_fta);

   //Tableau récapitulatif de la composition
   $recap_composition = "
                  <$html_table>
                  <tr class=titre_principal>
                      <td>
                      ".mysql_field_desc("fta_composant", "nom_fta_composition")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "ingredient_fta_composition")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "id_geo")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "poids_fta_composition")."
                      </td>
                      <td>
                      Répartition<br>(en %)
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "quantite_fta_composition")."
                      </td>
                  ";

   if($proprietaire)
   {
      $recap_composition.="<td>Actions</td>";
   }
   $recap_composition.="</tr>";

   $req = "SELECT * "
        . "FROM fta_composant "
        . "WHERE id_fta=$id_fta "
        . "AND is_composition_fta_composant=1 "
        . "ORDER BY ordre_fta_composition, nom_fta_composition "
        ;
   $result=DatabaseOperation::query($req);
   if(mysql_num_rows($result))
   {
         $controle_poids_total_composant=0;
         while($rows=mysql_fetch_array($result))
         {
             //$id_fta_composition=$rows["id_fta_composition"];
             $id_fta_composant=$rows["id_fta_composant"];
             //$last_id_fta_composition=$rows["last_id_fta_composition"];
             $last_id_fta_composant=$rows["last_id_fta_composant"];
             $table="fta_composant";
             mysql_table_load($table);
             //Récupération du différenciel de version
             $table_name_1=$table;
             //$id_1 = $id_fta_composition;
             $id_1 = $id_fta_composant;
             $table_name_2=$table;
             //$id_2 = $last_id_fta_composition;
             $id_2 = $last_id_fta_composant;
             //$debug=1;
             ${"diff_".$table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);
             $image_modif="";
             mysql_table_load("geo");

             //Désignation du composant
             $champ = "nom_fta_composition";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<tr  class=contenu ><td $color_modif>".$$champ."<br>&nbsp;&nbsp;&nbsp;&nbsp;";

                    //Code Produit Agrologic
                    //if($id_fta_nomenclature)
                    if($is_nomenclature_fta_composant)
                    {
                        //$force_id_fta=$id_fta;
                        //mysql_table_load("fta_nomenclature");
                        //$id_fta=$force_id_fta;
                        mysql_table_load("annexe_agrologic_article_codification");
                        $recap_composition .= "<i>".$prefixe_annexe_agrologic_article_codification.$code_produit_agrologic_fta_nomenclature."</i></td>";
                    }
             //Liste des Ingrédients
             $recap_composition .= "<td><$html_table><tr>";
             $champ = "ingredient_fta_composition";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<td align=left $color_modif    >".html_view_txt($$champ)."</td></tr>";

             $champ = "ingredient_fta_composition1";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<td align=left $color_modif    >".html_view_txt($$champ)."</td></tr>";


             $recap_composition .= "</table></td>";
             
             //Site de Fabrication
             $champ = "id_geo";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<td $color_modif>$geo</td>";

             //Poids
             $champ = "poids_fta_composition";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<td $color_modif>".$$champ."</td>";

             //Repartition du poids
             if ($poids_net_colis)
             {
                 //Versionning
                 $color_modif="";
                 if(${"diff_".$table}["poids_fta_composition"]
                 or ${"diff_".$table}["quantite_fta_composition"]
                 or calcul_poids_net_colis($id_fta)<>calcul_poids_net_colis($last_id_fta)
                 )
                 {
                    $image_modif=$html_image_modif;
                    $color_modif=$html_color_modif;
                 }
                 $taux_poids_composant = $poids_fta_composition * $quantite_fta_composition / ($poids_net_colis*1000) ;
             }
             $temp_taux=round($taux_poids_composant*100, "2");
             $controle_poids_total_composant+=$taux_poids_composant;
             $recap_composition .= "<td $color_modif>".$temp_taux."</td>";

             //Quantité
             $champ = "quantite_fta_composition";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }
             $recap_composition .= "<td $color_modif>".$$champ."</td>";



             //Action
             $color_modif="";
             if($image_modif)
             {
                 $color_modif=$html_color_modif;
             }
             $recap_composition .= "<td $color_modif>";

             //Modification d'un composant
             $recap_composition .="
                                  <a href=modifier_composition.php?id_fta=$id_fta&id_fta_composant=$id_fta_composant&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action&proprietaire=$proprietaire>
                                  <img src=../lib/images/next.png width=15 height=15 border=0/>
                                  Détail</a>
                                  ";
             if($proprietaire)
             {
                 //Suppression d'un composant
                 //if(!$id_fta_nomenclature)
                 if(!$is_nomenclature_fta_composant)
                 {
                     $recap_composition .="<br>
                                      <a href=".$page_action."?id_fta=$id_fta&id_fta_composant=$id_fta_composant&action=suppression_composant&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                      <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                                      Suppr.</a>
                                      ";
                 }

                 //Visualisation de l'étiquette
                 //echo $activation_codesoft_arti2;
                 if($is_nomenclature_fta_composant and ($activation_codesoft_arti2==2
                                             or $activation_codesoft_arti2==3
                                             )
                   )
                 {
                     if ($globalConfig->exec_environnement!="production"){

                        $extension="-dev";

                     }
                     else{

                        $extension="";

                     }
                     $extension_local=$extension;
/*                      $recap_composition .="<br>
                                          <a href=../access/base_codesoft/secure_start$extension_local.vbs />
                                          <img src=../lib/images/logo_codesoft.png width=15 height=15 border=0/>
                                          Etiquette</a>
                                          ";
 */
                     $recap_composition .="<br>
                                          <a href=../access/base_codesoft/secure_start.vbs />
                                          <img src=../lib/images/logo_codesoft.png width=15 height=15 border=0/>
                                          Etiquette</a>
                                          ";
                  }
             }
             $recap_composition .=$image_modif."</td>";

         }//Fin du while
   }//Fin du if
   $recap_composition.="</tr></table>";
   $bloc.= $recap_composition;

//Affichage du poids net du colis

   //Calcul des éléments de palettisation (tout est issu de cette fonction)
   $palettisation=calcul_palettisation_fta($id_fta);
   //echo $poids_net_colis."<br>";
   //echo $palettisation["uvc_net"]."x". $palettisation["pcb"];
   if(($poids_net_colis*1000)<>($palettisation["uvc_net"] * $palettisation["pcb"]))
   {
       $html_warning ="ATTENTION, poids net du colis différents de celui défini dans le chapitre \"Indentié\" <img src=../lib/images/exclamation.png width=15 height=15 border=0/><br><br>";
           $bgcolor="#FFAA55";
   }else
   {
       $bgcolor="#AFFF5A";
       $html_warning ="";
   }
   $bloc .= "<input type=\"hidden\" name=poids_net_colis value=\"".$poids_net_colis."\" />";
   $bloc .= "<input type=\"hidden\" name=\"Poids_ELEM\" value=\"".$Poids_ELEM."\" />";
   $bloc.= "<$html_table><tr class=contenu><td bgcolor=$bgcolor align=\"center\" valign=\"middle\">";
   $bloc.="<h4><br>Poids net du colis (en Kg): $poids_net_colis</h4><br>$html_warning";
   $bloc.="</td></tr></table>";
   $bloc.="</td></tr><tr><td><$html_table><tr><td>";

/* //   if($controle_poids_total_composant<>1)
   {
     $bloc.= "<$html_table><tr class=contenu><td bgcolor=\"#FF0008\">";
     switch($controle_poids_total_composant)
     {
         case $controle_poids_total_composant == 1:
                 $bloc.="Cohérence des Poids OK";
         break;
         case $controle_poids_total_composant > 1:
                 $bloc.="Le poids de l'UVC est inférieur à la somme des poids de ses composants";
         break;
         case $controle_poids_total_composant < 1:
                 $bloc.="Le poids de l'UVC est supérieur à la somme des poids de ses composants";
         break;
     }
     $bloc.="</td></tr></table>";
   }
   $bloc.="</td></tr><tr><td><$html_table><tr><td>";
 */
/*    //Synoptic
   $champ="synoptique_valide_fta";
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
     //Dans le cas où le champ est vide, on récupère la description R&D
     if(!$synoptique_valide_fta)
     {
         //Version 2.6.1 - demmande de ne plus pré-saisir les inforamtions
         //$synoptique_valide_fta=$synoptique_experimental_fta;
     }
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>"; */

   //Agrément CE
   $id_site=$Site_de_production;
   $champ="Site_de_production";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $req = "SELECT id_geo FROM access_arti2, geo "
        . "WHERE id_fta=".$id_fta." "
        . "AND Site_de_production=id_site "
        ;
   $result_temp=DatabaseOperation::query($req);
   $id_geo=mysql_result($result_temp, 0, "id_geo");
   mysql_table_load("geo");
   $champ="site_agrement_ce";
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("geo", $champ)."</td><td $color_modif>";
   $bloc .= "FR ".${$champ}." CE";
   $bloc.="$image_modif</td></tr>";


   //Produit Transformé en France
   $champ="origine_transformation_fta";
   $table="fta";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $bloc .= "<tr class=contenu><td $color_modif>${'NOM_'.$champ}:</td><td $color_modif>";
   switch(${$champ})
   {

      case 0:
          $checked2="";
          $checked3="checked";
      break;
      case 2:
      default:
          $checked2="checked";
          $checked3="";
      break;

   }
   $bloc .= "<input type=radio name=".$champ." value=2 $checked2 $data_disabled> Oui$image_modif<hr>";
   $bloc .= "<input type=radio name=".$champ." value=0 $checked3 $data_disabled> Non$image_modif";

   //Environnement de Conservation
   $champ="K_etat";
   $table="access_arti2";
     //Versionning
     $color_modif="";
     $image_modif="";
     if(${"diff_".$table}[$champ])
     {
        $image_modif=$html_image_modif;
        $color_modif=$html_color_modif;
     }
   $nom_liste=$champ;
   $bloc .= "<tr class=contenu><td $color_modif>".mysql_field_desc("access_arti2", $nom_liste)."</td><td $color_modif>";
   if($proprietaire)
   {
      $req_liste_site_assemblage = "SELECT id_annexe_environnement_conservation_groupe, CONCAT(nom_annexe_environnement_conservation_groupe, ': ', temperature_par_defaut_annexe_environnement_conservation_groupe)"
             . "FROM annexe_environnement_conservation_groupe "
             . "ORDER BY CONCAT(nom_annexe_environnement_conservation_groupe, temperature_par_defaut_annexe_environnement_conservation_groupe) "
             ;
      $id_defaut=$$nom_liste;
      $bloc .= afficher_requete_en_liste_deroulante($req_liste_site_assemblage, $id_defaut, $nom_liste);

   }else
   {
      $K_etat;
      $id_annexe_environnement_conservation_groupe=$K_etat;
      mysql_table_load("annexe_environnement_conservation_groupe");
      if(!$id_annexe_environnement_conservation_groupe and $old_conservation)
      {
          //$bloc .=$old_conservation;
      }else{
          $bloc .="$nom_annexe_environnement_conservation_groupe: $temperature_par_defaut_annexe_environnement_conservation_groupe";
      }
   }
   $bloc.="$image_modif</td></tr>";

   //Remarque
   $champ="remarque_fta";
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
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

   //Origine Matière Premières
   $champ="origine_matiere_fta";
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
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

   //Liste des Allergènes
   $champ="allergenes_matiere_fta";
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
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

/*    //Présentation
   $champ="presentation_fta";
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
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>"; */

   //Après ouverture
   $champ="apres_ouverture_fta";
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
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

   //Conseil de Réchauffage Validé
   $champ="conseil_rechauffage_valide_fta";
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
     if(!$conseil_rechauffage_valide_fta)
     {
         $conseil_rechauffage_valide_fta=$conseil_rechauffage_experimentale_fta;
     }
     $bloc .= "<textarea name=".$champ." rows=15 cols=75>${$champ}</textarea>";
   }else{
     $bloc .=html_view_txt(${$champ});
   }
   $bloc.="$image_modif</td></tr>";

   //durée de vie
   $champ="Durée_de_vie_technique";
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
     $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
   }else{
     $bloc .="${$champ}";
   }$bloc.="$image_modif</td></tr>";

   //durée de vie technique
   $champ="duree_vie_technique_fta";
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
     $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
   }else{
     $bloc .="${$champ}";
   }$bloc.="$image_modif</td></tr>";

   //Référence Externes
   $champ="reference_externe_fta";
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
     $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
   }else{
     $bloc .="${$champ}";
   }$bloc.="$image_modif</td></tr>";

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

/*    $bloc.="</table>
           <$html_table>
           <tr class=titre_principal><td class>
              Etiquette
           </td></tr>
           ";
 */


?>