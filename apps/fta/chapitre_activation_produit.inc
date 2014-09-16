<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par
  - - - - - - - - - - - - - - - - - - - - - - - */

        //Code Article Agrologic
        $champ="id_article_agrologic";
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
        if($proprietaire)
        {
           $bloc .="<input type=text name=".$champ." value=`".${$champ}."` size=20 maxlength=5/>"
                 //. "<a href=../.data/grille_codification_article.sxc target=_blank>"
                 //. "<a href=file://intranet.agis.fr/www/intranet/.data/grille_codification_article.sxc target=\"_blank\">"
                 . "<a href=file://intranet.agis.fr/www/intranet/.data/grille_codification_article.ods target=\"_blank\">"
                 . "<img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /></a>"
                 ;
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";

        //Suffixe Agrologic
        $champ="suffixe_agrologic_fta";
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
        if($proprietaire)
        {
           $bloc .="<input type=text name=".$champ." value=`".${$champ}."` size=20 maxlength=8/>"
                 . "<a href=../.data/grille_codification_article.sxc target=_blank>"
                 . "<img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /></a>"
                 ;
        }else
        {
           $bloc .="${$champ}";
        }
        $bloc.="$image_modif</td></tr>";


        //Ajouter un nouvel intermédiaire de production
        //Désactivé pour l'instant

/*         if($proprietaire)
        {
          $bloc.= "
                  <tr class=contenu><td>
                  <a href=modifier_nomenclature.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                  Ajouter un nouvel intermédiaire de production
                  </a>
                  </td></tr>
                  ";
        }
 */
        //Tableau récapitulatif des nomenclatures de production
        $recap_nomenclature = "
                       <$html_table>
                       <tr class=titre_principal>
                           <td>
                           ".mysql_field_desc("annexe_agrologic_article_codification", "nom_annexe_agrologic_article_codification")."
                           </td>
                           <td width=\"20\">
                           ".mysql_field_desc("fta_composant", "code_produit_agrologic_fta_nomenclature")."
                           </td>
                           <td>
                           ".mysql_field_desc("fta_composant", "nom_fta_nomenclature")." (Format DIN)
                           </td>
                           <td width=\"50\">
                           ".mysql_field_desc("fta_composant", "site_production_fta_nomenclature")."
                           </td>
                           <td width=50>
                           ".mysql_field_desc("fta_composant", "etat_fta_nomenclature")
                           ."</td>"
                           ;

        if($proprietaire)
        {
           $recap_nomenclature.="<td>Actions</td>";
        }
        $recap_nomenclature.="</tr>";

        /* $req = "SELECT id_fta_nomenclature, prefixe_annexe_agrologic_article_codification, nom_fta_nomenclature "
             . "FROM fta_nomenclature, annexe_agrologic_article_codification "
             . "WHERE fta_nomenclature.id_fta=$id_fta "
             . "AND fta_nomenclature.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
             . "ORDER BY prefixe_annexe_agrologic_article_codification DESC, nom_fta_nomenclature"
             ;
         */
        $req = "SELECT id_fta_composant, prefixe_annexe_agrologic_article_codification, nom_fta_nomenclature "
             . "FROM fta_composant, annexe_agrologic_article_codification "
             . "WHERE fta_composant.id_fta=$id_fta "
             . "AND is_nomenclature_fta_composant=1 "
             . "AND fta_composant.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
             . "ORDER BY prefixe_annexe_agrologic_article_codification DESC, nom_fta_nomenclature"
             ;
        $result=DatabaseOperation::query($req);
        if(mysql_num_rows($result))
        {
              $recap_mail="";

              while($rows=mysql_fetch_array($result))
              {
                  //$id_fta_nomenclature=$rows["id_fta_nomenclature"];
                  $id_fta_composant=$rows["id_fta_composant"];
                  //$last_id_fta_nomenclature=$rows["last_id_fta_nomenclature"];
                  $last_id_fta_composant=$rows["last_id_fta_composant"];
                  //$table="fta_nomenclature";
                  $table="fta_composant";
                  mysql_table_load($table);
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

/*                   if ($id_access_recette_recette)
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
                  mysql_table_load("annexe_agrologic_article_codification");
                  $recap_nomenclature .= "<tr class=contenu >";

                  //Codification
                  $champ="id_annexe_agrologic_article_codification";
                    //Versionning
                    $color_modif="";
                    if(${"diff_".$table}[$champ])
                    {
                       $image_modif=$html_image_modif;
                       $color_modif=$html_color_modif;
                    }

                  //$recap_nomenclature .= "<td bgcolor=$bgcolor>$nom_annexe_agrologic_article_codification</td>";
                  $recap_nomenclature .= "<td $color_modif>$nom_annexe_agrologic_article_codification</td>";


                  //Code
                  if($code_produit_agrologic_fta_nomenclature)
                  {
                    $champ="code_produit_agrologic_fta_nomenclature";
                      //Versionning
                      $color_modif="";
                      if(${"diff_".$table}[$champ])
                      {
                         $image_modif=$html_image_modif;
                         $color_modif=$html_color_modif;
                      }
                    $code_produit = $prefixe_annexe_agrologic_article_codification.${$champ};
                    $recap_nomenclature .= "<td $color_modif>".$prefixe_annexe_agrologic_article_codification.${$champ}."</td>";
                  }else{
                    $recap_nomenclature .= "<td bgColor=#FF0000>".$prefixe_annexe_agrologic_article_codification."nnnnn</td>";
                  }

                  //Désignation

                      //Versionning
                      $color_modif="";
                      if(${"diff_".$table}["nom_fta_nomenclature"]
                      or ${"diff_".$table}["suffixe_agrologic_fta_nomenclature"]
                      or ${"diff_".$table}["id_annexe_agrologic_article_codification"]
                      or ${"diff_".$table}["id_annexe_unite"]
                      or ${"diff_".$table}["site_production_fta_nomenclature"]
                      or ${"diff_".$table}["poids_fta_nomenclature"]
                      or ${"diff_".$table}["quantite_piece_par_carton"]
                      )
                      {
                         $image_modif=$html_image_modif;
                         $color_modif=$html_color_modif;
                      }


                  //$value=show_din_produit($id_fta_nomenclature);
                  $value=show_din_produit($id_fta_composant);

                  $recap_nomenclature .= "<td $color_modif>$value</td>";

                  //Site de Production
                  $champ = "site_production_fta_nomenclature";
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
                  $recap_nomenclature .= "<td $color_modif>${$champ}</td>";

                  //Environnement de conservation
                  $champ = "etat_fta_nomenclature";
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
                  $recap_nomenclature .= "<td $color_modif>${$champ}";
                  if($poids_total_carton_vrac_fta_nomenclature)
                  {
                      $recap_nomenclature .= " / $poids_total_carton_vrac_fta_nomenclature kg";
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
                      //Suppression de la nomenclature
                      //Désactivé pour l'instant

/*                       if ($nomenclature_orpheline)
                      {
                          $recap_nomenclature .="
                                  <a href=".$page_action."?id_fta=$id_fta&id_fta_nomenclature=$id_fta_nomenclature&action=suppression_nomenclature&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                  <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                                  Suppr.</a>
                                  ";
                      }
 */
                      //Modification de la nomenclature
                      //echo "test";
                      $recap_nomenclature .="
                                       <a href=modifier_produit.php?id_fta=$id_fta&id_fta_composant=$id_fta_composant&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                       <img src=../lib/images/next.png width=15 height=15 border=0/>
                                       Modif.</a>
                                        ";
                  }
                  $recap_nomenclature .= "$image_modif</td>";

                  //Récapitulatif du mail
                  $update_recap="";
                  if($image_modif)
                  {
                      $update_recap="(*)";
                  }
                  $recap_mail.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--> ".$code_produit." - ".$value." ".$update_recap."<br>";
                  
              }//Fin du while
        }//Fin du if
        $recap_nomenclature.="</tr></table><br>";
        $recap_mail_notice="Les produits suivis d'un astérisque (*) ont subit une mise à jour.<br>";
        $recap_mail_produit_fini="&nbsp;&nbsp;&nbsp;00".show_din($id_fta)."<br>";
        $bloc.= $recap_nomenclature
              . "<$html_table>"
              . "<tr class=titre_principal><td>Recap Mail:</td></tr>"
              . "<tr class=contenu><td>".$recap_mail_notice.$recap_mail_produit_fini.$recap_mail."</td></tr>"
              ;


?>