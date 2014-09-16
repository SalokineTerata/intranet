<?php

/* * ***************************************************
  Construction des droits d'accès pour tous les modules:
 * ***************************Boris Sanègre 2003.03.25 */

echo "<br>";
echo "</center>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<br>";
echo "</td>";
echo "</tr>";

$req_modules = "SELECT * FROM intranet_modules ";
$req_modules.= "ORDER BY nom_usuel_intranet_modules ASC";
$result_modules = DatabaseOperation::query($req_modules);
$colonne = 6;

while ($rows_modules = mysql_fetch_array($result_modules)) {
    //Préparation des variables
    $nom_usuel_intranet_modules = $rows_modules[nom_usuel_intranet_modules];
    $id_intranet_modules = $rows_modules[id_intranet_modules];


    //Construction du tableau
    echo "<br>";
    echo "<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>";

    // Nom du module
    echo "<tr>";
    echo "<td bgcolor=\"#FF8000\">";
    echo "<center>";
    echo "<h3>" . $nom_usuel_intranet_modules . "";
    echo "</center>";
    echo "</td>";
    echo "</tr>";

    //Droits d'accès du module
    //Recherche des droits d'accès globaux
    $req_actions = "SELECT DISTINCT * "
            . "FROM intranet_modules, intranet_actions "
            . "WHERE intranet_modules.id_intranet_modules=$id_intranet_modules "
            . "AND (module_intranet_actions='0' OR module_intranet_actions=$id_intranet_modules)"
    ;

    $result_actions = DatabaseOperation::query($req_actions);

    //Tableau de définitions des droits d'accès
    echo "<tr align=center><td><table border=0><tr>";
    $current_colonne = 0;
    while ($rows_actions = mysql_fetch_array($result_actions)) {
        //Préparation des variables
        $id_intranet_actions = $rows_actions[id_intranet_actions];
        $nom_intranet_actions = $rows_actions[nom_intranet_actions];
        $description_intranet_actions = $rows_actions[description_intranet_actions];



        //Construction de la liste déroulante des niveaux d'accès
        //Recherche de niveaux spécifiques
        $req_niveau_specifique = "SELECT * FROM intranet_niveau_acces "
                . "WHERE id_intranet_modules=$id_intranet_modules "
                . "AND id_intranet_actions=$id_intranet_actions "
        ;
        $result_niveau_specifique = DatabaseOperation::query($req_niveau_specifique);

        $compte_niveau_specifique = mysql_num_rows($result_niveau_specifique);
        if ($compte_niveau_specifique) {
            //S'il existe des niveaux personnalisés, alors ceux-ci sont utilisés
            $result_niveau = $result_niveau_specifique;
        } else {
            $req_niveau_defaut = "SELECT * FROM intranet_niveau_acces ";
            $req_niveau_defaut.= "WHERE id_intranet_modules=0 ";
            $req_niveau_defaut.= "AND id_intranet_actions=0";
            $result_niveau_defaut = DatabaseOperation::query($req_niveau_defaut);
            $result_niveau = $result_niveau_defaut;
        }

        //Liste déroulante montrant les différents niveaux d'accès pour le droit d'accès
        $nb = mysql_num_rows($result_niveau);
        if ($nb > 1) { // Si il y a plus d'une possibilité, alors liste déroulante
            //Construction du tableau
//echo $current_colonne;
            if ($current_colonne == $colonne) {
                echo "</tr><tr>";
                $current_colonne = 0;
            }
            $current_colonne++;
            echo "<td class=loginFFFFFFdroit valign=top width=172>";
            echo "<center>";
            echo "$description_intranet_actions<br>";

            $list1 = "<select name=module" . $id_intranet_modules . "_action" . $id_intranet_actions . ">";
            while ($rows_niveau = mysql_fetch_array($result_niveau)) {
                //Création des variables necessaires à la liste
                $id_intranet_niveau_acces = $rows_niveau[id_intranet_niveau_acces];
                $nom_intranet_niveau_acces = $rows_niveau[nom_intranet_niveau_acces];

                /*
                  Si l'utilisateur n'existe pas (lors d'une création)
                  alors on prend les droits de
                  l'utilisateur système: "template"
                 */

                if (!$sal_user) {
                    $req_template = "SELECT id_user FROM salaries "
                            . "WHERE prenom='template'"
                    ;
                    $result_template = DatabaseOperation::query($req_template);
                    if ($result_template) {
                        $sal_user = mysql_result($result_template, 0, "id_user");
                    }
                }

                //Est-ce que l'utilisateur à ce niveau d'accès
                if
                (
                        isset($id_intranet_modules)
                        and isset($id_intranet_actions)
                        and isset($id_intranet_niveau_acces)
                        and isset($sal_user)
                ) {
                    $req_droits_acces = "SELECT * FROM intranet_droits_acces ";
                    $req_droits_acces.= "WHERE id_intranet_modules=$id_intranet_modules ";
                    $req_droits_acces.= "AND id_intranet_actions=$id_intranet_actions ";
                    $req_droits_acces.= "AND niveau_intranet_droits_acces=$id_intranet_niveau_acces ";
                    $req_droits_acces.= "AND id_user=$sal_user";
                    $result_droits_acces = DatabaseOperation::query($req_droits_acces);

                    //Si oui, alors il est pris par défaut
                    $nb_droits_acces = mysql_num_rows($result_droits_acces);
                    if ($nb_droits_acces) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                }
                //Création de la liste
                $list1.="<option value=$id_intranet_niveau_acces $selected>";
                $list1.="$nom_intranet_niveau_acces";
                $list1.="</option>";
            }
            $list1.="</select>";
            echo $list1;
            echo "<br>";
            echo "</center>";
            echo "</td>";
        }//Fin de la liste déroulante
    }
    echo "</td></tr></table></tr>";
    echo "</table>";
}
echo "<br>";
?>

