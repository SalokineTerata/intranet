<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par 
  - - - - - - - - - - - - - - - - - - - - - - - */


  //Largeur de la colonne
  $largeur_colonne="40%";


        //Calcul des éléments de palettisation (tout est issu de cette fonction)
        $palettisation=calcul_palettisation_fta($id_fta);
        //$palettisation_2_3_3 = calcul_palettisation_fta_2_3_3($id_fta);         //Ancienne Données


        //Contrôle de l'origine du Calcul du poids Net Colis
        //echo $palettisation["uvc_net"]*$palettisation["pcb"]." <> ".$palettisation["colis_net"]*1000;
        $bgcolor="";
        $html_warning ="";
        if ($palettisation["uvc_net"] * $palettisation["pcb"] <> $palettisation["colis_net"]*1000)
        {
           //echo "TEST";
           $html_warning ="ATTENTION, valeur calculée à partir du chapitre composition <img src=../lib/images/exclamation.png width=15 height=15 border=0/>";
           $bgcolor = "bgcolor=\"#C8FF9E\"";
        }


        /* 
        echo $poids_emballage["uvc_emballage"]."<br>";
        echo $poids_emballage["colis_emballage"]."<br>";
        echo $poids_emballage["palette_emballage"]."<br>";
        */
         //$temp_poids_net_uvc=$Poids_ELEM * 1000;
         //$temp_poids_brut_uvc=$temp_poids_net_uvc + $poids_emballage["uvc_emballage"];



        //Nombre d'UVC par Carton
 /*        $champ="NB_UNIT_ELEM";
        $nb_uvc= "<tr class=contenu><td>${'NOM_NB_UNIT_ELEM'}:</td><td>";
        $nb_uvc .=$palettisation["pcb"];
        $nb_uvc.="</td></tr>";
 */
         //Récapitulatifs des informations du colis
         //$poids_total_emballage_carton =  $poids_emballage["colis_emballage"]/1000;
/* 
         $poids_total_emballage_carton =  $poids_emballage["colis_emballage"];
         $poids_net_carton = $Poids_ELEM *  $NB_UNIT_ELEM;
         $poids_brut_carton = ($poids_total_emballage_carton/1000) + $poids_net_carton ;
 */

         //Hauteur Colis
/*          $req = "SELECT hauteur_fta_conditionnement, nombre_couche_fta_conditionnement, quantite_par_couche_fta_conditionnement "
              . "FROM fta_conditionnement, annexe_emballage_groupe "
              . "WHERE id_annexe_emballage_groupe_type=3 "
              . "AND id_fta=$id_fta "
              . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
              ;
         $result=DatabaseOperation::query($req);
         if(mysql_num_rows($result))
         {
           $hauteur_colis=mysql_result($result, 0, "hauteur_fta_conditionnement");
           $nombre_couche_colis_palette=mysql_result($result, 0, "nombre_couche_fta_conditionnement");
           $quantite_couche_colis_palette=mysql_result($result, 0, "quantite_par_couche_fta_conditionnement");
         }
           
         //Hauteur palette
         $req = "SELECT * "
              . "FROM fta_conditionnement, annexe_emballage_groupe "
              . "WHERE id_annexe_emballage_groupe_type=4 "
              . "AND id_fta=$id_fta "
              . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
              ;
         $result=DatabaseOperation::query($req);
         if(mysql_num_rows($result))
         {
           $hauteur_total_palette=mysql_result($result, 0, "old_hauteur_palette");
           if($hauteur_total_palette)
           {
              if($hauteur_total_palette > 1000)
              {
                  $hauteur_total_palette=$hauteur_total_palette/1000;
              }
              if($hauteur_total_palette > 100)
              {
                  $hauteur_total_palette=$hauteur_total_palette/100;
              }
           }
           else
           {
               $hauteur_palette=mysql_result($result, 0, "hauteur_fta_conditionnement");
               $hauteur_total_palette = ($hauteur_palette + $hauteur_colis * $nombre_couche_colis_palette)/1000;
           }
           $poids_palette=mysql_result($result, 0, "poids_fta_conditionnement");
         }

         //Récapitulatifs des informations de la palette
         $nombre_colis_par_palette = $nombre_couche_colis_palette * $quantite_couche_colis_palette;
         $poids_total_emballage_palette = $poids_total_emballage_carton * $nombre_colis_par_palette + $poids_palette;
         $poids_net_palette = $poids_net_carton * $nombre_colis_par_palette;
         $poids_brut_palette = $poids_net_palette + ($poids_total_emballage_palette/1000);
 */

$bloc .="<$html_table>"
      . "<tr class=titre_principal><td>Informations Générales de l'UVC</td></tr></table><$html_table>"
      . "<tr class=contenu><td width=$largeur_colonne>Poids Emballage UVC (en g):</td><td>"
      . $palettisation["uvc_emballage"]
      . "</td></tr>"
      . "<tr class=contenu><td>Poids Net UVC (en g):</td><td>"
      . $palettisation["uvc_net"]
      . "</td></tr>"
      . "<tr class=contenu><td>Poids Brut UVC (en g):</td><td>"
      . $palettisation["uvc_brut"]
      . "</td></tr>"
      . "<tr class=contenu><td>Dimension de l'UVC (en mm):</td><td>"
      . $dimension_uvc=$palettisation["dimension_uvc"]." <i>(Hauteur x Longueur x Largeur)</i>"
      . "</td></tr>"
      . "<tr><td><br></td></tr></table><$html_table><tr class=titre_principal><td>Informations Générales du Colis</td></tr></table><$html_table>"
      . "<tr class=contenu><td>${'NOM_NB_UNIT_ELEM'}:</td><td>"
      . $palettisation["pcb"]
      . "</td></tr>"
      . "<tr class=contenu><td width=$largeur_colonne>Poids des Emballages (en g):</td><td>"
      . round($palettisation["colis_emballage"], 2)
      . "</td></tr>"
      . "<tr class=contenu><td>Poids Net (en Kg):</td><td $bgcolor>"
      . round($palettisation["colis_net"], 2) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $html_warning
      . "</td></tr>"
      . "<tr class=contenu><td>Poids Brut (en Kg):</td><td $bgcolor>"
      . round($palettisation["colis_brut"], 2) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $html_warning
      . "</td></tr>"
      . "<tr class=contenu><td>Hauteur (en mm):</td><td>"
      . $palettisation["hauteur_colis"]
      . "</td></tr><tr><td><br></td></tr>"
      . "<tr><td><br></td></tr></table><$html_table><tr class=titre_principal><td>Informations Générales d'une Palette</td></tr></table><$html_table>"
      . $palette
      . "<tr class=contenu><td width=$largeur_colonne>Poids Net (en Kg):</td><td $bgcolor>"
      . round($palettisation["palette_net"], 2) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $html_warning
      . "</td></tr>"
      . "<tr class=contenu><td>Poids Brut (en Kg):</td><td $bgcolor>"
      . round($palettisation["palette_brut"], 2) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $html_warning
      . "</td></tr>"
      . "<tr class=contenu><td>Hauteur (en m):</td><td>"
      . round($palettisation["hauteur_palette"], 2)
      . "</td></tr>"
      . "<tr class=contenu><td>Nombre de couche par palette:</td><td>"
      . $palettisation["couche_palette"]
      . "</td></tr>"
      . "<tr class=contenu><td>Nombre de colis par couche:</td><td>"
      . $palettisation["colis_couche"]
      . "</td></tr>"
      . "<tr class=contenu><td>Nombre total de Carton par palette:</td><td>"
      . $palettisation["total_colis"]
      . "</td></tr>"
      . "</td></tr>"
      ;
?>