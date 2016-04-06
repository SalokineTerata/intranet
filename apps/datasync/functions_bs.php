<?
/***********
AUTORISATION
***********/
/*
Autorisation de consulter le module:
En effet cette page est chargée par toutes les pages de ce module
*/
    $$module_consultation = $module_consultation
                          . "_consultation"
                          ;
    if (!$module_consultation)
    {
        header ("Location: index.php");
    }



/***************************
VARIABLES GLOBALES DU MODULE
***************************/




/***************************
FONCTIONS GLOBALES DU MODULE
***************************/

/*Exemple de déclaration de fonctions
************************************/
//function fonction1($variable1,$variable2, $variable3, $variable4)
{
/*
Dictionnaire des variables:
*/

/*
Corps de la fonction
*/

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