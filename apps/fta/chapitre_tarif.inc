<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par
  - - - - - - - - - - - - - - - - - - - - - - - */


         //Ajouter un nouveau tarif
         if($proprietaire)
         {
           $bloc.= "
                   <tr class=contenu><td>
                   <a href=ajout_tarif.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                   Ajouter un nouveau tarif
                   </a>
                   </td></tr>
                   ";
         }
         //Tableau récapitulatif des tarifs

         $recap_tarif = "
                        <$html_table>
                        <tr class=titre_principal><td>
                            ".mysql_field_desc("fta_tarif", "id_classification_arborescence_article_categorie_contenu")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_tarif", "prix_fta_tarif")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_tarif", "conditions_commerciales_fta_tarif")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_tarif", "ristournable_fta_tarif")."
                            </td>
                            <td>
                            Période
                            </td>
                        ";
         if($proprietaire)
         {
            $recap_tarif.="<td>Supprimer</td>";
         }
         $recap_tarif.="</tr>";

         $req = "SELECT id_fta_tarif FROM fta_tarif "
              . "WHERE id_fta=$id_fta "
              . "ORDER BY id_classification_arborescence_article_categorie_contenu, prix_fta_tarif "
              ;
         $result=DatabaseOperation::query($req);
         while($rows=mysql_fetch_array($result))
         {
             $id_fta_tarif=$rows["id_fta_tarif"];
             $last_id_fta_tarif=$rows["last_id_fta_tarif"];
             $table="fta_tarif";
             mysql_table_load($table);
             mysql_table_load("classification_arborescence_article_categorie_contenu");

             //Récupération du différenciel de version
             $table_name_1=$table;
             $id_1 = $id_fta_tarif;
             $table_name_2=$table;
             $id_2 = $last_id_fta_tarif;
             //$debug=1;
         ${"diff_".$table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);
         //echo "$table_name_1, $table_name_1, $id_1, $table_name_2, $id_2, $debug)"    ;

             $image_modif="";

             //Désignation de l'enseigne
             $champ="id_classification_arborescence_article_categorie_contenu";
             $table="fta_tarif";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $champ="nom_classification_arborescence_article_categorie_contenu";
             $recap_tarif .= "<tr class=contenu><td $color_modif>${$champ}</td>";

             //Tarif
             $champ="prix_fta_tarif";
             $table="fta_tarif";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             $recap_tarif .= "<td $color_modif>${$champ}</td>";

             //Conditions Commerciales
             $champ="conditions_commerciales_fta_tarif";
             $table="fta_tarif";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             if(${$champ})
             {
                 $value ="Oui";
             }
             else
             {
                 $value ="Non";
             }
             $recap_tarif .= "<td $color_modif>$value</td>";

             //Ristourne
             $champ="ristournable_fta_tarif";
             $table="fta_tarif";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }
             if(${$champ})
             {
                 $value ="Oui";
             }
             else
             {
                 $value ="Non";
             }
             $recap_tarif .= "<td $color_modif>$value</td>";

             //Période
             $champ1="date_debut_fta_tarif";
             $champ1="date_fin_fta_tarif";
             $table="fta_tarif";

               //Versionning
               $color_modif="";
               if(${"diff_".$table}[$champ1] or ${"diff_".$table}[$champ2])
               {
                  $image_modif=$html_image_modif;
                  $color_modif=$html_color_modif;
               }

             $recap_tarif .= "<td $color_modif>";
             if($date_debut_fta_tarif == "0000-00-00")
             {
                 $date_debut_fta_tarif = "<i>Immédiatement </i>";
             }

             if($date_fin_fta_tarif == "0000-00-00")
             {
                 $date_fin_fta_tarif = "<i>Jusqu'à la fin de l'année</i>";
             }
             $recap_tarif .= "du $date_debut_fta_tarif ";
             $recap_tarif .= "au $date_fin_fta_tarif";
             $recap_tarif .= "</td>";

             //Supprimer
             $color_modif="";
             if($image_modif)
             {
                 $color_modif=$html_color_modif;
             }
             $recap_tarif .= "<td $color_modif>";
             if($proprietaire)
             {
                 $recap_tarif .= "<td $color_modif>
                            <a href=modification_fiche_post.php?id_fta=$id_fta&id_fta_tarif=$id_fta_tarif&action=suppression_tarif&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                            <img src=../lib/images/supprimer.png width=15 height=15 border=0/></a>
                            ";
             }
             $recap_tarif .= "$image_modif</td>";
         }
         $recap_tarif.="</tr></table>";
         $bloc.= $recap_tarif;

         $bloc.="<$html_table>";


         //Période de commercialisation
         $champ="periode_commercialisation_fta";
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

         //Unité de Facturation
         $champ="Unité_Facturation";
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
         switch(${$champ})
         {
            case 2:
                $checked2="checked";
                $checked3="";
            break;
            case 3:
                $checked2="";
                $checked3="checked";
            break;
         }
         $bloc .= "<input type=radio name=".$champ." value=2 $checked2 $data_disabled> Pièce $image_modif<hr>";
         $bloc .= "<input type=radio name=".$champ." value=3 $checked3 $data_disabled> Kilo $image_modif";
         $bloc.="</td></tr>";

         //Gencod EAN Article
         $champ="EAN_UVC";
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
         if($proprietaire)
         {
            $id_element="1"; //Recherche si le propriétaire est Agis
            $extension[0]=0; //Passage en mode recherche d'un contenu
            $search = recherche_element_classification_fta($id_fta, $id_element, $extension);
            $search[0];

            //Si il y a déjà une valeur, ou que le propriétaire n'est pas Agis
            if((${$champ}) or ($search[0]==0))
            {
                $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` maxlength=13 size=20/>";
            }
            else
            {
                $id_societe=1;
                mysql_table_load("societe");
                $bloc .= "<input type=text name=".$champ." value=`".$cnuf_societe."` maxlength=13 size=20/>";
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
            $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` maxlength=14 size=20/>";
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



         //Code Article Interne Client
         $champ="code_article_client";
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
         if($proprietaire)
         {
            $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
         }else
         {
            $bloc .="${$champ}";
         }
         $bloc.="$image_modif</td></tr>";

         //PVC de l'article chez le client
         $champ="pvc_article";
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
         if($proprietaire)
         {
            $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
         }else
         {
            $bloc .="${$champ}";
         }
         $bloc.="$image_modif</td></tr>";

         //Prix / KG de l'article chez le client
         $champ="pvc_article_kg";
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
         if($proprietaire)
         {
            $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
         }else
         {
            $bloc .="${$champ}";
         }
         $bloc.="$image_modif</td></tr>";

         //Champ DLC déjà renseigné au chapitre identité mais permet un controle (et une correction si besoin) par le chef de projet lors de la
         // saisie du tairf
         $champ="Durée_de_vie";
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
         if($proprietaire)
         {
            $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=20/>";
         }else
         {
            $bloc .="${$champ}";
         }
         $bloc.="$image_modif</td></tr>";

         //Nombre de Portions
         $champ="nombre_portion_fta";
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

         //Synoptic
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
         $bloc.="$image_modif</td></tr>";

         //Présentation
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
         $bloc.="$image_modif</td></tr>";

?>