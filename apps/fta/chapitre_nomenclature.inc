<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */

     //Tableau des nomenclatures des recettes

   //Ajouter un nouveau Conditionement
   if($proprietaire)
   {
     /* $bloc.= "
             <tr class=titre_principal><td>
             <a href=ajout_recette.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
             Ajouter une nouvelle recette
             </a>
             </td></tr>
             "; */
     $bloc.= "
             <br>
             <tr class=titre_principal><td align=\"left\">
             <a href=modifier_nomenclature.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
             <img src=\"../lib/images/plus.png\" width=\"20\" height=\"20\" border=\"0\" />
             Ajouter un nouvel intermédiaire de production
             </a>
             </td></tr><tr></tr>
             ";
   }

   //Tableau récapitulatif des nomenclatures de production
   $recap_nomenclature = "
                  <$html_table>
                  <tr class=titre_principal>
                      ";
   /* $recap_nomenclature .="
                      <td>
                      ".mysql_field_desc("fta_nomenclature", "recette_racine")."
                      </td>
                      "; */

   $recap_nomenclature .="
                      <td>
                      ".mysql_field_desc("annexe_agrologic_article_codification", "nom_annexe_agrologic_article_codification")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "nom_fta_nomenclature")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "poids_fta_nomenclature")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "id_annexe_unite")."
                      </td>
                      <td>
                      ".mysql_field_desc("fta_composant", "site_production_fta_nomenclature")."
                      </td>
                      <td>
                      ".mysql_field_desc("access_recettes_recette", "environnement_conservation_recette")."
                      </td>
                      <td>
                      Carton Vrac
                      </td>

                  ";

   if($proprietaire)
   {
      $recap_nomenclature.="<td>Actions</td>";
   }
   $recap_nomenclature.="</tr>";

        /* $req = "SELECT id_fta_nomenclature, prefixe_annexe_agrologic_article_codification, nom_fta_nomenclature "
             . "FROM fta_nomenclature, annexe_agrologic_article_codification "
             . "WHERE fta_nomenclature.id_fta=$id_fta "
             . "AND fta_nomenclature.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
             . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
             ;
 */
        $req = "SELECT id_fta_composant, prefixe_annexe_agrologic_article_codification, nom_fta_nomenclature "
             . "FROM fta_composant, annexe_agrologic_article_codification "
             . "WHERE fta_composant.id_fta=$id_fta "
             . "AND is_nomenclature_fta_composant=1 "
             . "AND fta_composant.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
             . "ORDER BY prefixe_annexe_agrologic_article_codification ASC, nom_fta_nomenclature"
             ;
   $result=DatabaseOperation::query($req);
   if(mysql_num_rows($result))
   {
         while($rows=mysql_fetch_array($result))
         {
             //$id_fta_nomenclature=$rows["id_fta_nomenclature"];
             $id_fta_composant=$rows["id_fta_composant"];
             //$last_id_fta_nomenclature=$rows["last_id_fta_nomenclature"];
             $last_id_fta_composant=$rows["last_id_fta_composant"];
             //$table="fta_nomenclature";
             $table="fta_composant";
             mysql_table_load($table);
             mysql_table_load("annexe_agrologic_article_codification");
             mysql_table_load("annexe_environnement_conservation_groupe");

             //Récupération du différenciel de version
             $table_name_1=$table;
             //$id_1 = $id_fta_nomenclature;
             $id_1 = $id_fta_composant;
             $table_name_2=$table;
             //$id_2 = $last_id_fta_nomenclature;
             $id_2 = $last_id_fta_composant;
             //$debug=1;
             ${"diff_".$table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);
             $image_modif="";
             //Fin de Récupération du différenciel de version

/*              if ($id_access_recette_recette)
             {
                mysql_table_load("access_recettes_recette");
                $nomenclature_orpheline = 0;
                $id_annexe_environnement_conservation_groupe=$etat_access_recettes_recette;
                }
                else
                {
                $nomenclature_orpheline = 1;
                if ($quantite_piece_par_carton)
                {//Une quantité à été saisie: c'est donc du surgelé
                   $id_annexe_environnement_conservation_groupe=2;
                   }
                   else
                   {
                   $id_annexe_environnement_conservation_groupe=1;
                }
             }
 */

             //Recette Autonome ?
             /********* Ne sera pas implémenté (BS 2008-07-28)
             $recette_racine=recette_racine($id_access_recette_recette);
             if ($nomenclature_orpheline)
             {
                $autonome="Intermédiaire de Production";
                }
                else
                {
                if ($recette_racine)
                {
                   $autonome="Principale";
                   }
                   else
                   {
                   $autonome="Sous-recette";
                }
             }
             */
             $recap_nomenclature .= "<tr class=contenu bgcolor=$bgcolor>";
//             $recap_nomenclature .= "<td>$autonome</td>";

             //Codification
             if($id_annexe_agrologic_article_codification)
             {
               $champ="id_annexe_agrologic_article_codification";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
               $champ="nom_annexe_agrologic_article_codification";
               $recap_nomenclature .= "<td $color_modif>${$champ}</td>";
             }else{
               $recap_nomenclature .= "<td></td>";
             }
             //Désignation
             $champ="nom_fta_nomenclature";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $recap_nomenclature .= "<td $color_modif>${$champ} $suffixe_agrologic_fta_nomenclature</td>";

             //Poids
             $champ="poids_fta_nomenclature";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $recap_nomenclature .= "<td width=\"20\" $color_modif>${$champ}</td>";

             //Unité du Poids
             $champ="id_annexe_unite";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $recap_nomenclature .= "<td width=\"20\" $color_modif>${$champ}</td>";

             //Site de Production
             $champ="site_production_fta_nomenclature";
               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $id_geo=$$champ;
             mysql_table_load("geo");
             $champ="geo";
             $recap_nomenclature .= "<td width=\"20\" $color_modif>${$champ}</td>";

             //Environnement de conservation
             $champ="etat_fta_nomenclature";
               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $id_annexe_environnement_conservation_groupe=$$champ;
             mysql_table_load("annexe_environnement_conservation_groupe");
             $champ="nom_annexe_environnement_conservation_groupe";
             $recap_nomenclature .= "<td width=\"20\" $color_modif>${$champ}</td>";

             //Quantité par Carton (spécifique pour les sugelés)
             $champ="etat_fta_nomenclature";

               //Versionning
               $color_modif="";
               if( ${"diff_".$table}["quantite_piece_par_carton"]
                or ${"diff_".$table}["poids_total_carton_vrac_fta_nomenclature"]
                 )
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $recap_nomenclature .= "<td $color_modif>";
             if($quantite_piece_par_carton)
             {
               $champ="quantite_piece_par_carton";
               $recap_nomenclature .= "Nombre de pièce: $quantite_piece_par_carton<br>"
                                   .  "Poids total: $poids_total_carton_vrac_fta_nomenclature kg</td>"
                                   ;
             }
             $recap_nomenclature .= "</td>";

             //Action
             $color_modif="";
             if($image_modif)
             {
                 $color_modif=$html_color_modif;
             }
             $recap_nomenclature .= "<td $color_modif>";
             if($proprietaire)
             {
                 //Suppression d'une recette (seulement pour les recettes racines)
                 //if($recette_racine)
                 {
                   $recap_nomenclature .="
                                  <a href=".$page_action."?id_fta=$id_fta&id_fta_composant=$id_fta_composant&action=suppression_nomenclature&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                  <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                                  Suppr.$image_modif</a>
                                  ";
                 }

                 //Modification de la recette (pour toutes les recettes et sous-recettes
                 //if (!$nomenclature_orpheline)
                 {
                     $recap_nomenclature .="
                                      <a href=modifier_nomenclature.php?id_fta=$id_fta&id_fta_composant=$id_fta_composant&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                      <img src=../lib/images/next.png width=15 height=15 border=0/>
                                      Modif.</a>
                                      </td>
                                      ";
                 }
             }
             $recap_nomenclature .= "$image_modif</td>";
         }//Fin du while
   }//Fin du if
   $recap_nomenclature.="</tr></table>";
   $bloc.= $recap_nomenclature."<$html_table>";



   //Synoptic
   $champ="synoptique_experimental_fta";
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

   //Conseil de Réchauffage Echantillon
   $champ="conseil_rechauffage_experimentale_fta";
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

   //Date prévisionnelle du Transfert Industrielle
   $champ="date_transfert_industriel";
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

      //$bloc .= selection_date_pour_mysql($champ, ${$champ});
      $bloc .= calendrier($champ, ${$champ});
   }else
   {
      $bloc .="${$champ}";
      $bloc .="<input type=hidden name=$champ value=${$champ}>";
   }
   $bloc.="$image_modif</td></tr>";


?>