<?php

/*
 * Copyright (C) 2015 tp4300008
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function afficher_navigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback) {

    //Action: "consultation" ou "modification"
    //Barre de navigation de la Fiche Tehnique Article
    //Variables
    $html_table = "table "              //Permet d'harmoniser les tableaux
            . "border=1 "
            . "width=100% "
            . "class=contenu "
    ;

    $id_fta_chapitre_encours;
    $comeback;    //1=l'url précédente à à enregistrer comme url de retour

    $t_processus_encours = array();
    $t_processus_visible = array();

    //Récupère la page en cours
    //$page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
    $page_default = "modification_fiche";

    //Récupération des informations préalables
    $_SESSION["id_fta"] = $id_fta;
    $objectFta = new ObjectFta($id_fta);

    mysql_table_load("fta");
    mysql_table_load("fta_etat");
    mysql_table_load("access_arti2");
//echo     $_SESSION["code_article_ldc"];
    //Nom de l'assistante de projet responsable:
    $req = "SELECT prenom, nom FROM salaries WHERE id_user='" . $_SESSION["createur_fta"] . "' ";
    $result = DatabaseOperation::query($req);
    if (mysql_num_rows($result)) {
        $createur = mysql_result($result, 0, "prenom") . " " . mysql_result($result, 0, "nom");
    }


    //Construction du Menu
    if ($_SESSION["id_article_agrologic"]) {
        $identifiant = $_SESSION["id_article_agrologic"];
    } else {
        $identifiant = $_SESSION["id_dossier_fta"] . "v" . $_SESSION["id_version_dossier_fta"];
    }
    if ($_SESSION["LIBELLE"]) {
        $nom = $_SESSION["LIBELLE"];
    } else {
        $nom = $_SESSION["designation_commerciale_fta"];
    }
    $menu_navigation = "
                     <$html_table>
                     <tr><td class=titre_principal> <div align=\"left\">
                           $identifiant (LDC: <b><font size=\"2\" color=\"#0000FF\">" . $_SESSION["code_article_ldc"] . "</font></b>) - $nom &nbsp;&nbsp;&nbsp;&nbsp;<i>(gérée par $createur)</i>
                           </div>
                     </td></tr>
                     <tr class=titre><td>
                     ";

    //Si une action est donnée, alors construction du menu des chapitres
    if ($synthese_action) {
        //Etat d'avancement de la FTA et Recherche des processus validés (et donc en lecture-seule)
        $liste_processus_visible = "";      //Liste des processus en lecture-seule (séparés par une virgule)
        //$req = "SELECT * FROM fta_processus ";
        $req = "SELECT DISTINCT fta_processus.* FROM fta_processus, fta_processus_cycle "
                . "WHERE fta_processus_cycle.id_init_fta_processus=fta_processus.id_fta_processus "
                //. "AND id_etat_fta_processus_cycle='".$objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat")."' "
                . "AND id_etat_fta_processus_cycle='I' "
                . "AND id_fta_categorie = '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_fta_categorie") . "' "
        ;
        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            //Balayage de tous les processus
            while ($rows = mysql_fetch_array($result)) {
                $id_fta;    //Déjà déclaré
                $id_fta_processus = $rows["id_fta_processus"];
                $taux_validation_processus = fta_processus_validation($id_fta, $id_fta_processus);


                //echo $rows["nom_fta_processus"].": ".$taux_validation_processus."<br>";
                //Liste des processus visible(lecture-seule)
                if ($taux_validation_processus == 1) {
                    $t_processus_visible[] = $rows["id_fta_processus"];
                }
            }//Fin du balayage
            //print_r($t_processus_visible);
        } else {
            //La table des processus est vide
            $titre = "Erreur de configuration du module FTA";
            $message = "Cette FTA n'a pas de cycle \"Initialisation\" défini pour la catégorie " . $objectFta->getFieldValue(ObjectFta::TABLE_CATEGORIE_NAME, "nom_fta_categorie") . " <i>(Voir la table fta_processus_cycle)</i> ";
            afficher_message($titre, $message, $redirection);
        }//Fin de suivi de projet
        //Recherche des processus en cours
        //Balayage des cycles des processus (en exclant les processus déjà validés)
        $req = "SELECT DISTINCT id_next_fta_processus "
                . "FROM fta_processus_cycle, fta_processus, intranet_actions, intranet_droits_acces, intranet_modules "
                . "WHERE 1 AND ( 1 "
        ;
        $separator = "AND";

        //Suppression des processus déjà validé
        if ($t_processus_visible) {
            foreach ($t_processus_visible as $value) {

                $req .= $separator . " id_next_fta_processus<>" . $value . " ";
                $separator = "AND";
            }
        }

        //Vérification des droits d'accès de l'utilisateur en cours
        $req .=") "
                . "AND fta_processus_cycle.id_next_fta_processus=fta_processus.id_fta_processus "       //Jointure
                . "AND fta_processus.id_intranet_actions=intranet_actions.id_intranet_actions "         //Jointure
                . "AND intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions " //Jointure
                . "AND intranet_droits_acces.id_intranet_modules=intranet_modules.id_intranet_modules " //Jointure
                . "AND id_user=" . $_SESSION["id_user"] . " " //Utilisateur actuellement connecté
                . "AND nom_intranet_modules='fta' "
                . "AND niveau_intranet_droits_acces=1 "  //L'utilisateur est propriétaire
                . "AND id_etat_fta_processus_cycle='" . $objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat") . "' "
                . "AND id_fta_categorie = '" . $objectFta->getFieldValue(ObjectFta::TABLE_FTA_NAME, "id_fta_categorie") . "' "
        ;


        //Finalisation de la requête
        $req .="";
//echo "<br>".$req;

        $result = DatabaseOperation::query($req);
        while ($rows = mysql_fetch_array($result)) {
            //Pour chaque processus, on vérifie que tous ces précédents sont validés
            $req = "SELECT * FROM fta_processus_cycle "
                    . "WHERE id_next_fta_processus=" . $rows["id_next_fta_processus"] . " AND ( 1 "
            ;
            $separator = "AND";
            //Ajout de la restriction des processus validé
            if ($t_processus_visible) {
                foreach ($t_processus_visible as $value) {

                    $req .= $separator . " id_init_fta_processus<>" . $value . " ";
                    $separator = "AND";
                }
            }

            //Recherche dans le cycle correspondant à l'état en cours de la fiche
            $req_etat = "SELECT `fta_etat`.`abreviation_fta_etat` "
                    . "FROM `fta_etat`, `fta` "
                    . "WHERE ( `fta_etat`.`id_fta_etat` = `fta`.`id_fta_etat` )"
                    . "AND ( ( `fta`.`id_fta` = '" . $id_fta . "' ) )"
            ;
            $abreviation_fta_etat = mysql_result(DatabaseOperation::query($req_etat), 0, "abreviation_fta_etat");
            $req .= "AND id_etat_fta_processus_cycle='" . $abreviation_fta_etat . "' ";

            //Filtrage par catégorie
            //$req .= "AND id_fta_categorie='".$_SESSION["id_fta_categorie"]."' ";
            //Finalisation de la requête
            $req .=")";
            //echo "<br>".$req;
            //Si la requête est vide, c'est que tous les processus précédents sont validés
            //Il est donc un Processus en cours
            $result_temp = DatabaseOperation::query($req);

            if (!mysql_num_rows($result_temp)) {
                //echo " Y";
                //Ce processus en cours, est-il du type repartie ou centralisé ?
                $req = "SELECT multisite_fta_processus FROM fta_processus "
                        . "WHERE id_fta_processus=" . $rows["id_next_fta_processus"]
                ;
                $result_temp = DatabaseOperation::query($req);
                $multisite_fta_processus = mysql_result($result_temp, 0, "multisite_fta_processus");

                //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
                if ($multisite_fta_processus) {

                    //Existe-il une configuration de gestion forcée pour ce processus et ce site d'assemblage ?
                    $req = "SELECT id_site_processus_fta_processus_multisite FROM fta_processus_multisite, access_arti2 "
                            . "WHERE id_site_assemblage_fta_processus_multisite=Site_de_production "
                            . "AND id_processus_fta_processus_multisite='" . $rows["id_next_fta_processus"] . "' "
                            . "AND id_fta=" . $id_fta . " "
                    ;
                    $result_temp = DatabaseOperation::query($req);
                    if (mysql_num_rows($result_temp)) {
                        $id_geo = mysql_result($result_temp, 0, "id_site_processus_fta_processus_multisite");
                    } else {
                        //Sinon, Vérification de l'égalité entre le site d'assemblage de la FTA et le site de Localisation de l'utilisateur
                        $req = "SELECT id_geo FROM access_arti2, geo "
                                . "WHERE id_fta=" . $id_fta . " "
                                . "AND Site_de_production=id_site "
                        ;
                        $result_temp = DatabaseOperation::query($req);
                        if (mysql_num_rows($result_temp)) {
                            $id_geo = mysql_result($result_temp, 0, "id_geo");
                        }
                    }
                    if ($id_geo == $_SESSION["lieu_geo"]) {
                        //L'égalité est respecté, donc ce processus est bien en cours
                        $t_processus_encours[] = $rows["id_next_fta_processus"];
                    } else {
//                   echo "TEST";
                    }
                } else {
                    //Enregistrement du processus en tant que processus en cours
                    $t_processus_encours[] = $rows["id_next_fta_processus"];
                }
            }
        }//Fin du balayage des processus non-validés
        //print_r($t_processus_encours);
        //Recherche des processus Publics
        //Création de la liste des processus dans la barre de navigation
        $t_processus_encours;
        $t_processus_visible;

        /*     switch ($synthese_action)//Suivant l'action effectuée sur la navigation:
          {
          case "modification":
          $t_liste_processus = array_merge($t_processus_encours,$t_processus_visible);
          break;

          case "consultation":
          $t_liste_processus = $t_processus_visible;
          break;
          } */
        $t_liste_processus = array_merge($t_processus_encours, $t_processus_visible);

        //$t_liste_processus = $t_processus_encours;
        //Ajout des processus n'ayant pas de précédents et donc obligatoirement présent dans le menu de navigation
        $req = "SELECT fta_processus.* FROM fta_processus "
                . "LEFT JOIN fta_processus_cycle "
                . "ON fta_processus.id_fta_processus=fta_processus_cycle.id_next_fta_processus "
                . "WHERE fta_processus_cycle.id_next_fta_processus IS NULL;"
        ;
        $result = DatabaseOperation::query($req);
        while ($rows = mysql_fetch_array($result)) {
            $t_liste_processus[] = $rows["id_fta_processus"];
        }

        //Récupération des Chapitres accessible dans le menu de naviguation
        if ($t_liste_processus) {
            $req = "SELECT * FROM fta_chapitre LEFT JOIN fta_processus "
                    . "ON fta_processus.id_fta_processus=fta_chapitre.id_fta_processus "
                    . "WHERE  ( "
                    . "fta_chapitre.id_fta_processus=0 "                              //Chapitre public
            ;
            $separator = "OR";

            foreach ($t_liste_processus as $value) {
                $req .= $separator . " fta_processus.id_fta_processus=" . $value . " ";
                $separator = "OR";
            }
            $req .=" ) ORDER BY fta_chapitre.id_fta_chapitre";
            $result = DatabaseOperation::query($req);

            //Balyage des chapitres trouvés
            while ($rows = mysql_fetch_array($result)) {
                $id_fta_chapitre = $rows['id_fta_chapitre'];
                $nom_fta_chapitre = $rows['nom_fta_chapitre'];
                $nom_usuel_fta_chapitre = $rows['nom_usuel_fta_chapitre'];

                //Dans le cas où il n'y a pas de chapitre sélectionné, sélection du premier
                if (!$id_fta_chapitre_encours) {
                    $id_fta_chapitre_encours = $id_fta_chapitre;
                }

                if ($id_fta_chapitre_encours == $id_fta_chapitre) {
                    $b = "<font size=3 color=#5494EE><b>";
                    $image1 = "[>";
                    $image2 = "<]";
                    $num = 1;
                    //$image1="[<img src=../lib/images/etoile_clignotante.gif width=15 height=15 border=0 />]";
                    //$image2=$image1;
                } else {

                    $image1 = "[>";
                    $image2 = "<]";

                    //Ce chapitre est-il public?
                    if ($rows['id_fta_processus'] == 0) {
                        $b = "<font color=\"#8977A9\">";
                    } else {
                        //Le chapitre est-il validé ?
                        $req1 = "SELECT id_fta_suivi_projet "
                                . "FROM fta_suivi_projet "
                                . "WHERE id_fta=$id_fta "
                                . "AND id_fta_chapitre=$id_fta_chapitre "
                                . "AND signature_validation_suivi_projet<>0 "
                        ;
                        $result1 = DatabaseOperation::query($req1);
                        $num = mysql_num_rows($result1);
                        switch ($num) {
                            case 0:  //Chapiter pas encore validé
                                $b = "<font color=\"#FF0000\">";
                                break;

                            case 1:  //Chapitre validé
                                $b = "<font color=\"#00B300\">";
                                break;

                            default: //Anomalie
                                $titre = "Erreur Grave !";
                                $message = "La fonction afficher_navigation() vient de trouver des doublons de validation des chapitres dans la table fta_suivi_projet";
                                afficher_message($titre, $message, $redirection);
                                break;
                        }
                    }//Fin du test public
                }//Fin de la colorisation
                //$menu_navigation.="<a href=$page_default.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre><img src=images/bouton_menu-$nom_fta_chapitre.png border=$border></a> ";
                //echo $num." ".$_SESSION["synthese_action"]."<br>";
                if ($num == 0 and $_SESSION["synthese_action"] == "attente") {
                    
                } else {
                    $menu_navigation .= "<a href=$page_default.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre&synthese_action=$synthese_action>$b"
                            . $image1 . $nom_usuel_fta_chapitre . $image2
                            . "</a>"
                            . "</b></font> "
                    ;
                }
                //$menu_navigation.="<input type=submit value=`".$nom_usuel_fta_chapitre."` border=$border> ";
            }
        }//Fin de la création des chapitres
    }//Fin du controle de $synthese_action
    //Lien de retour rapide
    /* $menu_navigation.= "</td></tr><tr><td>
      <a href=index.php?id_fta_etat=".$_SESSION["id_fta_etat"]."&nom_fta_etat=".$_SESSION["abreviation_fta_etat"]."&synthese_action=$synthese_action>Retour vers la synthèse</a>
      "; */
    if ($comeback == 1) {
        $_SESSION["comeback_url"] = $_SERVER["HTTP_REFERER"];
        $_GLOBALS["comeback_url"] = $_SESSION["comeback_url"];
    }
    $menu_navigation.= "</td></tr><tr><td>
    <a href=" . $_SESSION["comeback_url"] . "><img src=../lib/images/bouton_retour.png alt=\"\" title=\"Retour à la synthèse\" width=\"18\" height=\"15\" border=\"0\" /> Retour vers la synthèse</a> |
    ";
    //echo "<pre>".print_r($_SERVER["QUERY_STRING"])."</pre>";
    //Corps du menu
    $menu_navigation.="
                    <a href=historique.php?id_fta=$id_fta><img src=./images/graphique.png alt=\"\" title=\"Etat d'avancement\" width=\"18\" height=\"15\" border=\"0\" /> Etat d'avancement</a>
                       </td></tr>
                       </table>
                       ";
    return $menu_navigation;
}
