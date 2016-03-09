<?
/***********
AUTORISATION
***********/
/*
Autorisation de consulter le module:
En effet cette page est chargée par toutes les pages de ce module
*/
/*
    $module_consultation = $module. "_consultation";

    if ($$module_consultation=="0")
    {
        header ("Location: index.php");
    }
*/

/***************************
VARIABLES GLOBALES DU MODULE
***************************/
//include("../$module/config.php");

/***************************
FONCTIONS GLOBALES DU MODULE
***************************/

/*Exemple de déclaration de fonctions
************************************/
function do_recette_update_composition_from_ingredient($site_recette)
//$site_recette : correspond au site sur lequel la mise à jour est à faire
{

       //Configuration de retour de fonction
       $return["title"]="La composition est maintenant à jour.";

       //Mise à jour des compositions à partir des ingrédients - Seuls les ingrédients ayant une modification de tarifs sont touchés
       //Les Recettes validées sont aussi impactées
       $req = "UPDATE access_recettes_multi_composition, access_recettes_multi_ingredients, access_recettes_multi_recette "
            . "SET access_recettes_multi_composition.PRIX_UL=access_recettes_multi_ingredients.PRIX "
            . ", access_recettes_multi_composition.FOURNISSEUR=access_recettes_multi_ingredients.FOURNISSEUR "
            . ", access_recettes_multi_composition.UNITE=access_recettes_multi_ingredients.UNITE "
            . " WHERE access_recettes_multi_composition.CLE_COMPOSANT=access_recettes_multi_ingredients.CLE_INGREDIENT "
            . " AND access_recettes_multi_composition.CLE_RECETTE=access_recettes_multi_recette.CLE_RECETTE "
            . " AND access_recettes_multi_composition.num_site=access_recettes_multi_ingredients.num_site "
            . " AND access_recettes_multi_ingredients.num_site= $site_recette "
            . " AND access_recettes_multi_recette.num_site= $site_recette "
            . " AND access_recettes_multi_ingredients.prix_avant_maj=1 "
            //. " AND access_recettes_multi_recette.version_recette<>0 "
            ;
       mysql_query($req);
       $nombre_enregistrement_mis_a_jour = mysql_affected_rows();
       $return["content"] = "$nombre_enregistrement_mis_a_jour composition(s) affectée(s)";


        $req = "SELECT CLE_INGREDIENT FROM access_recettes_multi_ingredients WHERE prix_avant_maj=1 "
             . "AND num_site = $site_recette ";

        $result = mysql_query($req);

        while($rows=mysql_fetch_array($result))
        {
            $current_ingredient = $rows["CLE_INGREDIENT"];
            //echo $current_ingredient;

            //Mise à jour des coûts des Recettes liée à un ingrédient

            $str_req = "SELECT access_recettes_multi_composition.CLE_RECETTE, "
                    . "Sum((COMPOSITION_1.QTE_UL_NETTE/(1-COMPOSITION_1.COEFF_PERTE))*COMPOSITION_1.PRIX_UL) AS cout_nouveau "
                    . "FROM access_recettes_multi_composition INNER JOIN access_recettes_multi_composition AS COMPOSITION_1 "
                    . "ON (access_recettes_multi_composition.num_site = COMPOSITION_1.num_site) "
                    . "AND (access_recettes_multi_composition.CLE_RECETTE = COMPOSITION_1.CLE_RECETTE) "
                    . "WHERE (((access_recettes_multi_composition.CLE_COMPOSANT)=$current_ingredient) "
                    . "AND ((access_recettes_multi_composition.num_site)=$site_recette)) "
                    . "GROUP BY access_recettes_multi_composition.CLE_RECETTE "
                    ;

            $result_req = mysql_query($str_req);
            while($rows1=mysql_fetch_array($result_req))
            {
                if ($rows1["cout_nouveau"])
                {
                   //Exploitation d'une donnée
                   $str_cle_recette = $rows1["CLE_RECETTE"];
                   $str_cout_nouveau = $rows1["cout_nouveau"];

                   //Faut-il appliquer la marge de 5% ?
                   $str_req2 = "SELECT Unité, POIDS_TOTAL FROM access_recettes_multi_recette WHERE access_recettes_multi_recette.CLE_RECETTE = $str_cle_recette "
                             . "AND access_recettes_multi_recette.num_site = $site_recette";
                   $result2 = mysql_query($str_req2);
                   if (mysql_num_rows($result2))
                   {
                        $poids_recette= mysql_result($result2 , 0 , "POIDS_TOTAL");
                        $str_unite = mysql_result($result2, 0, "Unité");
                        //echo $str_unite."<br>";
                        if ($str_unite == "mono" or $str_unite == "multi" or $str_unite == "Pièce")
                        {
                           $str_cout_nouveau = $str_cout_nouveau * 1.05;
                        }
                        $str_cout_total_kg = $str_cout_nouveau / $poids_recette;
                   }

                   //Mise à jour de la recette
                   $str_req2 = "UPDATE access_recettes_multi_recette SET access_recettes_multi_recette.COUT_TOTAL = $str_cout_nouveau, "
                             . " access_recettes_multi_recette.cout_total_kg = $str_cout_total_kg "
                             . " WHERE access_recettes_multi_recette.CLE_RECETTE = $str_cle_recette "
                             . " AND access_recettes_multi_recette.num_site = $site_recette"
                             ;
                   $result2 = mysql_query($str_req2);
                }
            }

            //Suppression de la mise en attente de mise à jour de tarif
            $req1 = "UPDATE access_recettes_multi_ingredients SET access_recettes_multi_ingredients.prix_avant_maj = 0 "
                 . "WHERE access_recettes_multi_ingredients.CLE_INGREDIENT = $current_ingredient "
                 . "AND access_recettes_multi_ingredients.num_site = $site_recette "
                 ;
            $result1 = mysql_query($req1);
        }

        return $return;
}

/******************
DEBUT DES FONCTIONS
******************/





/*
Include de développement
Une optimisation serait d'utiliser CVS !!
*/
if($module)
{
   $chemin_functions_personalise="../".$module;
}else
   $chemin_functions_personalise=".";

//include ("$chemin_functions_personalise/functions_sm.php");
//include ("$chemin_functions_personalise/functions_bs.php");
?>