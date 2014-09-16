<?php
/* - - - - - - - - - - - - - - - - - - - - - - -
 Fichier Include
 Créé le mercredi 3 août 2005 16:58:06
 avec HAPedit 3.1.11.111
 par
  - - - - - - - - - - - - - - - - - - - - - - - */

//Liste des corrections apportées
$bloc_correction=" <$html_table><tr class=titre_principal><td>Récapitulatif des corrections</td></tr>
                  ";


//Liste de tous les commentaires des chapitres
$bloc_commentaire=" <$html_table><tr class=titre_principal><td>Récapitulatif des commentaires</td></tr>
                    <tr class=contenu><td><br>
                    <$html_table>
                  ";

 $req = "SELECT fta_suivi_projet.*, salaries.* "
     . "FROM `fta_suivi_projet`, `salaries` "
     . "WHERE ( `fta_suivi_projet`.`signature_validation_suivi_projet` = `salaries`.`id_user` ) "
     . "AND `fta_suivi_projet`.`id_fta` = $id_fta "
     . "ORDER BY date_validation_suivi_projet "
     ;
$result=DatabaseOperation::query($req);
while($rows=mysql_fetch_array($result))
{
      if ($rows["commentaire_suivi_projet"])
      {
        $bloc_commentaire.= "<tr class=titre_principal><td width=\"30%\">".$rows["prenom"]." ".$rows["nom"]." a écrit:</td></tr>"
                          . "<tr class=contenu><td></td><td>".html_view_txt($rows["commentaire_suivi_projet"])."</td></tr>"
                          ;
      }
      if($rows["correction_fta_suivi_projet"])
      {
        $bloc_correction.= "<tr class=contenu><td>".html_view_txt($rows["correction_fta_suivi_projet"])."</td></tr>"
                          ;
      }
}

$bloc.=$bloc_correction."</table>";
$bloc.=$bloc_commentaire."</table></td></tr></table>";

//Historique des mises à jour de la FTA
$bloc_historique=" <$html_table><tr class=titre_principal><td>Historique des actions effectuées sur le Fiche Technique Article</td></tr>
                    <tr class=contenu><td><br><br>
                    <$html_table>
                  ";
$bloc.=$bloc_historique."<tr class=contenu><td>".html_view_txt($commentaire_maj_fta)."</td></tr></table></td></tr></table>";



?>