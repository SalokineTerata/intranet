<?php

/*--------------------------------------------------------------------------
 fonction liée aux pages neutres qui ne necessitent pas
forcement une connexion pour etre dedans.
fonctions de navigation et sortie d'infos en mode non connecté. donc infos de niveau 1
-----------------------------------------------------------*/


/*------------------------------------------------------------
  si deja connecté alors on retourne dans partie securisée
-------------------------------------------------------------*/
function redirection_securite($login, $pass, $service){
$q1 = DatabaseOperation::query("SELECT * FROM salaries WHERE ((login = '$login') AND (pass = '$pass'))");
$nb1 = mysql_numrows($q1);
/* si le nomre de champ est null, alors.. on stop le prog  */
if (!$nb1){ header("Location: ../index.php?action=delog"); }
else{ header("Location: groupe.php?service=$service"); }
}

/*------------------------------------------
  les fonction pour la partie developpement
-------------------------------------------*/
/*-- fonction avec mode unique -- */
/*
function homepage1($service, $homepage){
$test ="SELECT * FROM  articles WHERE ";
/* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes
$test .= "(nivo_conf = 1)";
$test .= "and (homepage = $homepage) ";
/*---- defini la page service sur laquelle on se trouve ----*
$test .= "and (id_art_serv = '$service')";
$test .= "and (publica != '')";
/*--- on rajoute la fonction du non lu pour ordonner si on le souhaite --- *
$test .= "order by date_modif DESC limit 0,1";

$requete=DatabaseOperation::query($test);
$rows = mysql_fetch_array($requete);

$titreart=stripslashes($rows[titre_art]);
$txt_1=stripslashes($rows[txt_1]);
$txt_2=stripslashes($rows[txt_2]);

$txt_1 = array ("$titreart","$txt_1","$txt_2","$rows[num_article]","$rows[taille]","$rows[mail]","$rows[img_1_nom]");
return $txt_1;
}


/*------------------------------------------
          le tableau des news...
-------------------------------------------*/
/*-----listing des annonces-----*/
function listing($service, $page){

$nb = 3;
$result2 ="SELECT * FROM articles WHERE ";
$result2 .= "(nivo_conf = 1)";
$result2 .= "and (id_art_serv = '$service')";
//$result2 .= "and (homepage = '4') ";
$result2 .= "and (publica != '')";
$result2 .= "and (diffusion = '')";
$result2 .= "order by date_modif desc";

if(empty($page)){$page=1;}

$requete = DatabaseOperation::query("$result2");
$total = mysql_num_rows($requete);
$debut = ($page - 1) * $nb;
$result2 .= " LIMIT $debut,$nb";

if($requete = @DatabaseOperation::query("$result2")){


while ($rows = mysql_fetch_array($requete)){

echo "<tr bgcolor=\"#FFFFCC\">";

$titreart=stripslashes($rows[titre_art]);
$sujetart=stripslashes($rows[sujet]);

$date = $rows[date_crea];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;
echo"<td class=\"txttabl\" width=\"22%\">$date</td>";
echo"<td class=\"txttabl\" width=\"24%\">$titreart</td>";
echo"<td class=\"txttabl\" width=\"24%\">";
$ab = DatabaseOperation::query("select * from salaries where id_user='$rows[auteur]'");
$ligne = mysql_fetch_array($ab);
echo "$ligne[nom] $ligne[prenom]</td>";
echo"<td class=\"txttabl\" width=\"24%\">$sujetart<br>";
taille($rows[taille],$rows[num_article]);
echo "détail de l'article</a></td>";
}
}
echo"</tr>";
echo"</table>";
echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\">";
echo"<tr>";
echo "<td width=80% align=center>";
$nbpages = ceil($total / $nb);
for($i = 1;$i <= $nbpages;$i ++){
echo "<a href=\"$PHP_SELF?page=$i&service=$service\"><font size=1 color=#000000><b>";

    if ($page == $i){
  echo"<font color=#FF6600><b>  page$i </b></font></a>\n";
    }else{
  echo"<font color=#000000><b>  page$i </b></font></a>\n";
    }

if($i < $nbpages){
echo " - ";}
}
echo"</td>";
}


/*----------------------------------------
  les liens sur popup ou sur grande page
------------------------------------------*/
function taille($taille,$num_article){
if ($taille == 1){
echo "<a href=\"#\" class=\"lelien\" onClick=\"MM_openBrWindow('../popup/news_courte.php?num=$num_article','','scrollbars=yes,width=700,height=580')\">";
}else{ echo"<a href=\"#\" class=\"lelien\" target=\"_blank\" onClick=\"MM_goToURL('parent','../popup/news_long.php?num=$num_article');return document.MM_returnValue\">";}
}


/*------------------------------------------------------------------------------------------
  fonction permettant l'affichage des services avec liens en fonction de la table services
-------------------------------------------------------------------------------------------*/
function services($service){
/*faire un truc disant si service appartient alors couleur untel sinon couleur differente*/
$groupe = substr($service, 0, 1);
$requete = DatabaseOperation::query("select * from services where id_groupe = $groupe order by intitule_ser");
while ($rows = mysql_fetch_array($requete)){
/* gestion couleur dois dependre du groupe et non du service vu que page unique */

if ($groupe == 1) { $couleur2 = '#FF3300'; $couleur1 = '#FF6633'; }
if ($groupe == 2) { $couleur1 = '#FF9933'; $couleur2 = '#FF6600'; }
if ($groupe == 3) { $couleur2 = '#FF9900'; $couleur1 = '#FFCC66'; }
if ($groupe == 4) { $couleur2 = '#CC9933'; $couleur1 = '#D3B565'; }
if ($service == $rows[id_service]){$couleur1 = $couleur2;}
echo "<td width=\"15%\" onMouseOver=this.style.backgroundColor='$couleur2'
                                onMouseOut=this.style.backgroundColor='$couleur1'  align=\"center\" valign=\"middle\" bgcolor=\"$couleur1\"><a href=\"neutre.php?service=$rows[id_service]\" class=\"rollgeneral\">$rows[intitule_ser]</a></td>";
}
}


/* fonction d'affichage de la petite image symbolisant le lu/non lu */
function imagelu($num, $id_user){
$condition = DatabaseOperation::query("select lu.id_art from lu,articles where ((articles.num_article='$num') and (lu.id_art='$num') and (lu.id_user='$id_user') and (lu.date > articles.date_modif))");
$nb2 = mysql_numrows($condition);
if (!$nb2){
return ("nonlu.gif");
}else{
return ("lu.gif");
}
}



/*------------------------------
       news defilante
-------------------------------*/
function defilante(){
echo"<marquee msambientcpg=\"2504\" type=\"SCROLL\" direction=\"LEFT\" height=\"28\" width=\"600\" scrolldelay=\"30\" scrollamount=\"2\" class=\"txtentreprise\">";
$champs=DatabaseOperation::query("select * from newsdefil where num=1");
$colonne=mysql_fetch_array($champs);
$news1=stripslashes($colonne[news1]);
$news2=stripslashes($colonne[news2]);
$news3=stripslashes($colonne[news3]);
$news4=stripslashes($colonne[news4]);
$news5=stripslashes($colonne[news5]);

echo"$news1";if($news2 !=""){bip();}
echo"$news2";if($news3 !=""){bip();}
echo"$news3";if($news4 !=""){bip();}
echo"$news4";if($news5 !=""){bip();}
echo"$news5";
echo "</marquee>";
}

function bip(){
$bip=0;
while($bip<=90){
echo"&nbsp;";
$bip ++ ;
}
}
?>