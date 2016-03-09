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
function do_sendmail($k_dossier,$k_article)
{
       //$k_dossier : correspond au dossier en cours de saisie
       //$k_article : correspond à l'article sur le dossier

       /*EXEMPLE d'initalisation des variables*/
       //http://intranet.dev.agis.fr/webobject/do.php?do=sendmail&DEST=boris;stephane&MAIL_OBJECT="toto"
       /*echo "DEST: ".$DEST."<br>";
       $tab_dest=explode(",", $DEST);
       echo "MAIL_OBJECT:".$MAIL_OBJECT."<br>"."<br>";
       print_r($tab_dest);
       */

       //Lors du passage de la ligne de commande via access il y avait un troncage des informations donc construction des données du mail dans php

       //*** requete recherchant les informations sur l'article en cours
       $req_article = "SELECT * FROM access_arti2 where access_arti2.CODE_ARTICLE = '$k_article'";
       $result_article=mysql_query($req_article);
       $info_article=mysql_fetch_array($result_article);

       //*** 2008-07-11 requete donnant des informations complémentaires sur le dossier saisi
       $req_dossier = "SELECT access_service_consommateur_reclamations.Cléf, access_service_consommateur_reclamations.Produit, access_service_consommateur_reclamations.DLC, access_service_consommateur_reclamations.N__Lot, access_service_consommateur_reclamations.Objet, access_service_consommateur_typologies.Nom, access_service_consommateur_typologies.Typologie, access_materiel_service.nom_service "
                    . "FROM (access_service_consommateur_reclamations INNER JOIN access_service_consommateur_typologies ON access_service_consommateur_reclamations.Typologie = access_service_consommateur_typologies.Typologie) INNER JOIN access_materiel_service ON access_service_consommateur_reclamations.k_responsable_mesure_corrective = access_materiel_service.K_service "
                    . "WHERE (((access_service_consommateur_reclamations.Cléf)='$k_dossier'))";

       $result_dossier=mysql_query($req_dossier);
       $info_dossier=mysql_fetch_array($result_dossier);

    //*** requete donnant le nombre de dossier saisi par rapport à la date de saisie du dossier sur la référence en cours depuis un mois
    $date_debut = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-30, date("Y")));
    $date_fin = date("Y-m-d");
    $req = "SELECT Count( access_arti2.CODE_ARTICLE ) AS nb_de_dossier FROM access_arti2 INNER JOIN access_service_consommateur_reclamations ON access_arti2.CODE_ARTICLE = access_service_consommateur_reclamations.Produit "
            . "WHERE (((access_service_consommateur_reclamations.Date_Réception_Courrier >= '$date_debut') AND (access_service_consommateur_reclamations.Date_Réception_Courrier <= '$date_fin' "
            . ")) AND ((access_service_consommateur_reclamations.produit = '$k_article')))" ;
    $result= mysql_query($req);
    $nb_dossier=mysql_fetch_array($result);

    //  définition du corps du mail
    //-----------------------------
    If ((!$result) or ($result == 0))
    {
        $mail_pied = "Aucune réclamation depuis un mois sur ce code";
    }
    Else
    {
        $mail_pied = "Le nombre de réclamation depuis un mois est de ".$nb_dossier[0];
    }
    //echo $mail_text;
    $mail_text = "Bonjour, \n\n"
                   . "Enregistrement de la réclamation suivante, n° ".$k_dossier." : \n\n"
                   . "- article   : ".$k_article." - " .$info_article["LIBELLE"]." (code groupe ".$info_article["code_article_ldc"].")\n"
                   . "- n° de lot : ".$info_dossier["N__Lot"]."\n"
                   . "- dlc       : ".recuperation_date_depuis_mysql($info_dossier["DLC"])."\n"
                   . "- objet     : ".$info_dossier["Objet"]."\n"
                   . "- typologie : ".$info_dossier["Nom"]."\n"
                   . "- service concerné : ".$info_dossier["nom_service"]."\n\n"
                   .$mail_pied;


    //  définition de l'objet du mail
    //-------------------------------
    $mail_object = "Réclamation sur la référence ".$info_article["LIBELLE"];


    //  définition de la liste des destinataires
    //------------------------------------------
    $req= "SELECT access_service_consommateur_reclamations.Cléf, access_service_consommateur_liste_diffusion.k_salarie_access_service_consommateur_liste_diffusion, salaries.mail "
          . "FROM ((access_service_consommateur_reclamations INNER JOIN access_arti2 ON access_service_consommateur_reclamations.Produit = access_arti2.CODE_ARTICLE) "
          . "INNER JOIN access_service_consommateur_liste_diffusion ON access_arti2.FAMILLE_ARTICLE = access_service_consommateur_liste_diffusion.k_famille_article_access_service_consommateur_liste_diffusion) "
          . "INNER JOIN salaries ON access_service_consommateur_liste_diffusion.k_salarie_access_service_consommateur_liste_diffusion = salaries.id_user "
          . "WHERE (((access_service_consommateur_reclamations.Cléf) = '$k_dossier'))";

    $result= mysql_query($req);
    $destinataire="";
    while($rows=mysql_fetch_array($result))
    {
         //echo $rows["mail"];
         $destinataire[] = $rows["mail"];
    }
    //print_r($destinataire);

    // Envoi du mail
    //--------------
    $expediteur="service.CONSOMMATEUR@agis-sa.fr";
    $tab_dest="service.CONSOMMATEUR@agis-sa.fr";
    if ($destinataire != "")
    { // si la liste des destinataires n'est pas vide envoi du mail
           $destinataireCCC=implode(",", $destinataire);
           //envoismail($mail_object,$mail_text,$tab_dest,$expediteur);
           $result=envoismail_CC($mail_object,$mail_text,$tab_dest,$expediteur,$destinataireCc,$destinataireCCC);
           //echo $result;
    }
    else
    { // sinon mail au service chargé de la gestion des liste de diffusions
        $destinataireCCC="Brigitte.SELTZ@agis-sa.fr";
        $result=envoismail_CC("Pas de liste de diffusion","Merci de renseigner la lsite de diffusion pour la gamme ".$info_article["FAMILLE_ARTICLE"],$tab_dest,$expediteur,$destinataireCc,$destinataireCCC);
        $result = 0;
    }
    if ($result)
       return 1;
    else
        return 0;
              

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