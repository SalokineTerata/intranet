<?php
//Barre de navigation du module

$module_consultation = Acl::getValueAccesRights("module_consultation");
$module_modification = Acl::getValueAccesRights("module_modification");


//Récupération des droits d'accès necessaire
$_SESSION[$module_consultation] = $module_consultation
                          . "_consultation"
                          ;
$_SESSION[$module_modification] = $module_consultation
                          . "_modification"
                          ;
/*
Menu accessible pour les utilisateurs ayant les droits
en consultation sur ce module
*/
//if ($module_consultation)
{
   if ($id_user!="")
{

//Création d'un article
echo "
     <table width=100% border=0 cellspacing=5 cellpadding=0 bgcolor=#FFCC66>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     <!a href=crea_article.php>
     <a href=creacourt.php>
     ";

/* gestion de l'affichage des boutons en fonction du type */
$titi=DatabaseOperation::query("select * from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);

if ($toto["ecriture"] == "oui")
{
echo "<img src=../lib/images/bouton_creation.gif border=0  alt='Rediger un article'>";
}
echo "
     </a></td>
     </tr><tr align=center valign=middle>
     <td class=logFFCC66><a href=gestion_article.php?repere=2>
     ";
/* gestion de l'affichage des boutons en fonction du type */
$titi=DatabaseOperation::query("select * from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);

if ($toto["ecriture"] == "oui"){
echo "<img src=../lib/images/bouton_modification.gif border=0  alt='Gerer vos articles'>";
}
echo "
     </a></td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     <a href=javascript:; onClick=MM_openBrWindow('../adminagis/modif_favoris.php','pop','scrollbars=yes,width=510,height=550')>
     <img src=../lib/images/bouton_parametres.gif border=0  alt='Vos paramètres personnels'></td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66><a href=rapide.php?service=$service>
     <img src=../lib/images/bouton_nouveautes.gif border=0 alt='Liste des articles non-lus'>
     </a></td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     <a href=../adminagis/cadre.php class=logFFCC66 target=_self>
     ";
/* gestion de l'affichage des boutons en fonction du type */
$titi=DatabaseOperation::query("select * from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);

if ($toto["id_type"] >= 2){
echo "
     <img src=../lib/images/bouton_administration.gif border=0  alt='Administration du site'>
     ";
}
echo "
     </a></td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     <a href=crea_articlece.php?repere=3 class=logFFCC66 target=_self>
     ";

/* gestion de l'affichage des boutons en fonction du type */
$titi=DatabaseOperation::query("select * from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);

if ($toto["membre_ce"] == "oui"){
echo "
     <img src=../lib/images/bouton_administration_ce.gif border=0  alt='Administration News CE'>
     ";
}
echo "
     </a></td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     ";

publication2($id_user);

echo "
     </td>
     </tr>
     <tr align=center valign=middle>
     <td class=logFFCC66>
     ";

archive($id_user);

echo "
     </td>
     </tr>
     </table>
     ";
}

}

/*
Menu accessible pour les utilisateurs ayant les droits
en modifications sur ce module
*/
if ($module_modification)
{
   //Exemple d'un menu
   echo "<br>";
   echo "<a href=./index.php target=_top>Menu Avancé</a>";
   echo "<br>";

   echo "...";
}


echo "</td>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100%>";
?>