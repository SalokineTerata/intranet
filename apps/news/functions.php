<?php

/* * *********
  AUTORISATION
 * ********* */
/*
  Autorisation de consulter le module:
  En effet cette page est chargée par toutes les pages de ce module
 */

//    $_SESSION[$module_consultation] = $module_consultation
//                          . "_consultation"
//                          ;
//    if (!$module_consultation)
//    {
////        header ("Location: index.php");
//    }

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

$_SESSION["module"] = trim(substr(strrchr(`pwd`, '/'), 1));

/* * *************************
  VARIABLES GLOBALES DU MODULE
 * ************************* */




/* * *************************
  FONCTIONS GLOBALES DU MODULE
 * ************************* */

/* Exemple de déclaration de fonctions
 * ********************************** */

//function fonction1($variable1,$variable2, $variable3, $variable4) {
/*
  Dictionnaire des variables:
 */

/*
  Corps de la fonction
 */


/* * ****************
  DEBUT DES FONCTIONS
 * **************** */

/* ------------------------------------------
  MAJORITE DES FONCTIONS DE LA PARTIE NEWS
  ------------------------------------------- */

/* ----------------------------------
  affichage des articles en home page
  pour tous les services excepté CE
  ----------------------------------- */

/* -- fonction avec mode unique -- */

function homepage1($id_user, $service, $homepage) {

//Variable de la fonction: date limite pour affichage des messages de niveau 1
    $date_limite = date("Y-m-d", mktime(0, 0, 0, date("m") - 4, date("d"), date("Y")));

    if ($id_user) {//Si l'utilisateur est connecté
        $test = "SELECT * FROM  modes, articles left join lu on articles.num_article = lu.id_art and lu.id_user='$id_user' WHERE lu.id_art is null and (modes.id_user = $id_user)";
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
        $test .= " and (articles.id_art_serv = modes.id_service)";
        $test .= " and (articles.nivo_conf <= modes.serv_conf)";
        $test .= " and (articles.homepage = '$homepage') ";
        /* ---- defini la page service sur laquelle on se trouve ---- */
        $test .= " and (articles.id_art_serv = '$service')";
        $test .= " and (articles.publica != 0)";
        $test .= " and (articles.diffusion = '')";
        /* --- on rajoute la fonction du non lu pour ordonner si on le souhaite --- */
        $test .= "order by articles.nivo_conf desc, date_modif DESC limit 0,1";
    } else {

        //Si l'utilisateur est déconnecté

        $test = "SELECT * FROM  articles  WHERE ";
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
//$test .= " and (articles.id_art_serv = modes.id_service)";
        $test .= " (articles.nivo_conf = '1')";
        $test .= " and (articles.homepage = '$homepage') ";
        /* ---- defini la page service sur laquelle on se trouve ---- */
        $test .= " and (articles.id_art_serv = '$service') ";
        $test .= " and (articles.publica != 0) ";
        $test .= " and (articles.diffusion = '') ";
        $result2 .= "and (articles.date_modif > '$date_limite 00:00:00' ) ";
        /* --- on rajoute la fonction du non lu pour ordonner si on le souhaite --- */
        $test .= "order by articles.nivo_conf desc, date_modif DESC limit 0,1";
    }

//echo"$test";
    $requete = DatabaseOperation::query("$test");
    $remplis = mysql_num_rows($requete);
    $rowser = mysql_fetch_array($requete);

    /* on rajoute le if qui dis que si pas de resultat on fait requete pour afficher une infos de nivo 1 */
    if ($remplis == 0) {
        $defaut = DatabaseOperation::query("$test");

        if ($id_user) { //Si l'utilisateur est connecté
            $req = "select * from modes, salaries, articles "
                    . "where (modes.id_user = $id_user) "
                    . "and (salaries.id_user = $id_user) "
                    . "and (articles.nivo_conf <= modes.serv_conf)"
                    . "and (articles.homepage = $homepage) "
                    . "and (articles.id_art_serv = '$service') "
                    . "and (articles.publica != '') "
                    . "and (articles.id_art_serv = modes.id_service) "
                    . "order by date_modif DESC limit 0,1"
            ;
        } else {
            $req = "select * from articles "
                    . "where(articles.nivo_conf = '1')"
                    . "and (articles.homepage = $homepage) "
                    . "and (articles.id_art_serv = '$service') "
                    . "and (articles.publica != '') "
                    . "and (articles.date_modif > '$date_limite 00:00:00' ) "
                    . "order by date_modif DESC limit 0,1"
            ;
        }
        $requete6 = DatabaseOperation::query($req);
        $rowser = mysql_fetch_array($requete6);
    }


    $txt_1 = array("$rowser[titre_art]", "$rowser[txt_1]", "$rowser[txt_2]", "$rowser[num_article]", "$rowser[taille]", "$rowser[mail]", "$rowser[img_1_nom]", "$rowser[img_1_alt]");
    return $txt_1;
}

/* ------------------------------------------
  le tableau des news...
  ------------------------------------------- */
/* -----listing des annonces----- */

function listing($id_user, $service, $page) {

    /* -- $n varible qui defini le nombre de ligne qui s'affichent dans le listing -- */

    if ($id_user) {//Si l'utilisateur est connécté
        $affichage = DatabaseOperation::query("select * from perso where id_user=$id_user");
        $na = mysql_fetch_array($affichage);
    }

    if (!$na[nbligne]) {
        $nb = 20;
    } else {
        $nb = $na[nbligne];
    }

    /* --- choix de l'order en fonction du choix utilisateur et definition si po encore inscrit --- */
    if (!$na[date]) {
        $order = "desc";
    } else if ($na[date] == 1) {
        $order = "";
    } else if ($na[date] == 2) {
        $order = "desc";
    }

    if ($id_user) { //Si l'utilisateur est connecté
        /* systeme d'exclusion ou non des infos deja lu */
        if (!$na[lu]) {
            $result2 = "SELECT * FROM modes, articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user)  WHERE lu.id_art is null and (modes.id_user = $id_user)";
        } else if ($na[lu] == 1) {
            $result2 = "SELECT * FROM articles, modes WHERE (modes.id_user = $id_user) ";
        } else if ($na[lu] == 2) {
            $result2 = "SELECT * FROM modes, articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user)  WHERE lu.id_art is null and (modes.id_user = $id_user)";
        }
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
        $result2 .= "and (articles.id_art_serv = modes.id_service)";
        $result2 .= "and (articles.nivo_conf <= modes.serv_conf)";
        /* ---- defini la page service sur laquelle on se trouve ---- */
        $result2 .= "and (articles.id_art_serv = '$service')";
//$result2 .= "and (articles.homepage = '4') ";
        $result2 .= "and (articles.publica != '')";
        $result2 .= "and (articles.diffusion = '')";
        /* rajouter dans l'order l'ordre souhaité par l'utilisateur */
        $result2 .= "order by date_modif $order ";
    } else {

        /* systeme d'exclusion ou non des infos deja lu */
        /*
          if(!$na[lu]){$result2 ="SELECT * FROM modes, articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user)  WHERE lu.id_art is null and (modes.id_user = $id_user)";}
          else if($na[lu]==1){$result2 ="SELECT * FROM articles, modes WHERE (modes.id_user = $id_user) ";}
          else if($na[lu]==2){$result2 ="SELECT * FROM modes, articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user)  WHERE lu.id_art is null and (modes.id_user = $id_user)";}
          $result2 .= "and (articles.id_art_serv = modes.id_service)";
          $result2 .= "and (articles.nivo_conf <= modes.serv_conf)";
          $result2 .= "and (articles.id_art_serv = '$service')";
          //$result2 .= "and (articles.homepage = '4') ";
          $result2 .= "and (articles.publica != '')";
          $result2 .= "and (articles.diffusion = '')";
          $result2 .= "order by date_modif $order ";
         */

        $date_limite = date("Y-m-d", mktime(0, 0, 0, date("m") - 4, date("d"), date("Y")));

        $result2 = "SELECT * FROM  articles  WHERE ";
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
//$test .= " and (articles.id_art_serv = modes.id_service)";
        $result2 .= " (articles.nivo_conf = '1')";
//    $test .= " and (articles.homepage = '$homepage') ";
        /* ---- defini la page service sur laquelle on se trouve ---- */
        $result2 .= " and (articles.id_art_serv = '$service') ";
        $result2 .= " and (articles.publica != '') ";
        $result2 .= " and (articles.diffusion = '') ";
        $result2 .= "and (articles.date_modif > '$date_limite 00:00:00' ) ";
        /* --- on rajoute la fonction du non lu pour ordonner si on le souhaite --- */
        $result2 .= "order by articles.nivo_conf desc, date_modif DESC limit 0,1";
    }

    if (empty($page)) {
        $page = 1;
    }

    $requete = DatabaseOperation::query("$result2");
    $total = mysql_num_rows($requete);
    $debut = ($page - 1) * $nb;
    $result2 .= "LIMIT $debut,$nb";

    if ($requete = @DatabaseOperation::query("$result2")) {
        while ($rows = mysql_fetch_array($requete)) {

            echo "<tr bgcolor=\"#FFFFCC\">";
            /* ------------
              formatage date
              ------------- */
            $date = $rows[date_crea];
            $jour = substr($date, 8, 2);
            $mois = substr($date, 5, 2);
            $annee = substr($date, 0, 4);
            $date = $jour . "/" . $mois . "/" . $annee;

            $titreart = stripslashes($rows[titre_art]);
            $auteurart = stripslashes($rows[auteur]);
            $sujetart = stripslashes($rows[sujet]);

            echo"<td class=\"txttabl\" width=\"22%\">$date</td>";
            echo"<td class=\"txttabl\" width=\"24%\">$titreart</td>";
            echo"<td class=\"txttabl\" width=\"24%\">";
            $ab = DatabaseOperation::query("select * from salaries where id_user='$auteurart'");
            $ligne = mysql_fetch_array($ab);
            echo "$ligne[nom] $ligne[prenom]</td>";
            echo"<td class=\"txttabl\" width=\"24%\">$sujetart<br>";
            taille($rows[taille], $rows[num_article]);
            echo "détail de l'article</a></td>";
            echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><img src=\"../zimages/";
            $nomimg = imagelu($rows[num_article], $id_user);
            echo"$nomimg";
            echo"\" width=\"20\" height=\"24\"></td>";
        }
    }
    echo"</tr>";
    echo"</table>";
    echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\">";
    echo"<tr>";
    echo "<td width=80% align=center>";
    $nbpages = ceil($total / $nb);
    for ($i = 1; $i <= $nbpages; $i++) {
        echo "<a href=\"$PHP_SELF?page=$i&service=$service\"><font size=1 color=#000000><b>";

        if ($page == $i) {
            echo"<font color=#FF6600><b>  page$i </b></font></a>\n";
        } else {
            echo"<font color=#000000><b>  page$i </b></font></a>\n";
        }

        if ($i < $nbpages) {
            echo " - ";
        }
    }
    echo"</td>";
}

/* ----------------------------------------------------
  les favoris en entete de la page groupe.php
  ----------------------------------------------------- */

function favoris($id_user) {
    if ($id_user) {
        $requete3 = DatabaseOperation::query("SELECT * FROM perso WHERE (id_user = $id_user)");
        $rows = mysql_fetch_array($requete3);
        echo "<tr align=\"center\" valign=\"middle\">";
        echo "<td><a href=\"$rows[web1]\" class=\"logFFCC66\" target=\"_blank\">$rows[label1]</a></td>";
        echo "<td><a href=\"$rows[web2]\" class=\"logFFCC66\" target=\"_blank\">$rows[label2]</a></td>";
        echo "<td><a href=\"$rows[web3]\" class=\"logFFCC66\" target=\"_blank\">$rows[label3]</a></td>";
        echo "</tr>";
        echo "<tr align=\"center\" valign=\"middle\">";
        echo "<td><a href=\"$rows[web4]\" class=\"logFFCC66\" target=\"_blank\">$rows[label4]</a></td>";
        echo "<td><a href=\"$rows[web5]\" class=\"logFFCC66\" target=\"_blank\">$rows[label5]</a></td>";
        echo "<td><a href=\"$rows[web6]\" class=\"logFFCC66\" target=\"_blank\">$rows[label6]</a></td>";
        echo "</tr>";
    }
}

//Fin de la fonction


/* ----------------------------------------
  les liens sur popup ou sur grande page
  ------------------------------------------ */

function taille($taille, $num_article) {
    if ($num_article != "") {
        if ($taille == 1) {
            echo "<a href=\"#\" class=\"lelien\" onClick=\"MM_openBrWindow('../popup/news_courte.php?num=$num_article','','scrollbars=yes,width=700,height=590')\">";
        } else {
            echo"<a href=\"#\" class=\"lelien\" target=\"_blank\" onClick=\"MM_goToURL('parent','../popup/news_long.php?num=$num_article');return document.MM_returnValue\">";
        }
    } else {
        echo "<a href=\"#\" class=\"lelien\">";
    }
}

/* ----------------------------------------
  les liens sur popup ou sur grande page
  ------------------------------------------ */

function taille2($taille, $num_article, $titou, $nva) {
    if ($taille == 1) {
        echo "<a href=\"#\" class=\"lelien\" onClick=\"MM_openBrWindow('../popup/news_courte.php?num=$num_article','','scrollbars=yes,width=700,height=590')\">";
    } else {
        echo"<a href=\"#\" class=\"lelien\" target=\"_blank\" onClick=\"MM_goToURL('parent','../popup/news_long.php?num=$num_article&titou=$titou&nva=$nva');return document.MM_returnValue\">";
    }
}

/* ---------------------------------------------------------
  les liens sur popup ou sur grande page pour archives
  ---------------------------------------------------------- */

function taille3($taille, $num_article, $titou, $nva) {
    if ($taille == 1) {
        echo "<a href=\"#\" class=\"lelien\" onClick=\"MM_openBrWindow('../popup/news_court_arch.php?num=$num_article','','scrollbars=yes,width=700,height=590')\">";
    } else {
        echo"<a href=\"#\" class=\"lelien\" target=\"_blank\" onClick=\"MM_goToURL('parent','../popup/news_long_arch.php?num=$num_article&titou=$titou&nva=$nva');return document.MM_returnValue\">";
    }
}

function taille4($taille, $num_article, $table, $pub) {
    if ($taille == 1) {
        echo"<a href=\"#\" onClick=\"MM_goToURL('parent','../news/news_courte.php?num_article=$num_article&table=$table&pub=$pub');return document.MM_returnValue\">";
    } else {
        echo"<a href=\"#\" onClick=\"MM_goToURL('parent','../news/news_long.php?num_article=$num_article&table=$table&pub=$pub');return document.MM_returnValue\">";
    }
}

;
/* ---------------------------------------------
  la gestion des liens dans les news_courtes
  --------------------------------------------- */

function liens_court($num) {
    $liens1 = DatabaseOperation::query("select * from articles where num_article = $num");
    /* $liensrow = mysql_fetch_array ($liens1); */
    $lien_1_type = mysql_result($liens1, 0, lien_1_type);
    $lien_1_txt = mysql_result($liens1, 0, lien_1_txt);
    $lien_1_cont = mysql_result($liens1, 0, lien_1_cont);

    $lien_2_type = mysql_result($liens1, 0, lien_2_type);
    $lien_2_txt = mysql_result($liens1, 0, lien_2_txt);
    $lien_2_cont = mysql_result($liens1, 0, lien_2_cont);

    $lien_3_type = mysql_result($liens1, 0, lien_3_type);
    $lien_3_txt = mysql_result($liens1, 0, lien_3_txt);
    $lien_3_cont = mysql_result($liens1, 0, lien_3_cont);

    $lien_1_txt = stripslashes($lien_1_txt);
    $lien_2_txt = stripslashes($lien_2_txt);
    $lien_3_txt = stripslashes($lien_3_txt);

    /* alors les types sont les suivants :
      1 - rien ; 2 - auteur (sans lien reprise article) ; 3 - auteur (mail) ; 4 - site net ; 5 - autre article */


    if ($lien_1_type != "rien") {
        echo"<tr>";
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_1_type </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
        if ($lien_1_type == "auteur") {
            echo "$lien_1_txt";
        }
        if ($lien_1_type == "mail") {
            echo "<a href=\"mailto:$lien_1_cont\">$lien_1_txt</a>";
        }
        if ($lien_1_type == "site web") {
            echo "<a href=\"http://$lien_1_cont\" target=_blank>$lien_1_txt</a>";
        }
        echo"</td>";
        echo"</tr>";
    }


    if ($lien_2_type != "rien") {
        echo"<tr>";
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_2_type </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
        if ($lien_2_type == "auteur") {
            echo "$lien_2_txt";
        }
        if ($lien_2_type == "mail") {
            echo "<a href=\"mailto:$lien_2_cont\">$lien_2_txt</a>";
        }
        if ($lien_2_type == "site web") {
            echo "<a href=\"http://$lien_2_cont\" target=_blank>$lien_2_txt</a>";
        }
        echo"</td>";
        echo"</tr>";
    }

    if ($lien_3_type != "rien") {
        echo"<tr>";
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_3_type </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
        if ($lien_3_type == "auteur") {
            echo "$lien_3_txt";
        }
        if ($lien_3_type == "mail") {
            echo "<a href=\"mailto:$lien_3_cont\">$lien_3_txt</a>";
        }
        if ($lien_3_type == "site web") {
            echo "<a href=\"http://$lien_3_cont\" target=_blank>$lien_3_txt</a>";
        }
        echo"</td>";
        echo"</tr>";
    }
}

/* ---------------------------------------------
  la gestion des liens dans les news_longues
  verifie la destination .. mail, interne ...
  --------------------------------------------- */

function liens_long($num) {
    $liens1 = DatabaseOperation::query("select * from articles where num_article = $num");
    $liensrow = mysql_fetch_array($liens1);
    /* alors les types sont les suivants :
      1 - rien ; 2 - auteur (sans lien reprise article) ; 3 - auteur (mail) ; 4 - site net ; 5 - autre article */
    $lien_1_type = stripslashes($liensrow[lien_1_type]);
    $lien_1_txt = stripslashes($lienrows[lien_1_txt]);
    $lien_2_txt = stripslashes($lienrows[lien_2_txt]);
    $lien_3_txt = stripslashes($lienrows[lien_3_txt]);
    $lien_4_txt = stripslashes($lienrows[lien_4_txt]);
    $lien_5_txt = stripslashes($lienrows[lien_5_txt]);


    echo"<tr>";
    if ($liensrow[lien_1_type] != "rien") {
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_1_type </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
    }
    if ($liensrow[lien_1_type] == "auteur") {
        echo "$lien_1_txt";
    }
    if ($liensrow[lien_1_type] == "mail") {
        echo "<a href=\"mailto:$liensrow[lien_1_cont]\">$lien_1_txt</a>";
    }
    if ($liensrow[lien_1_type] == "site web") {
        echo "<a href=\"http://$liensrow[lien_1_cont]\" target=_blank>$lien_1_txt</a>";
    }
    echo"</td>";
    echo"</tr>";

    echo"<tr>";
    if ($liensrow[lien_2_type] != "rien") {
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_2_type] </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
    }
    if ($liensrow[lien_2_type] == "auteur") {
        echo "$liensrow[lien_2_txt]";
    }
    if ($liensrow[lien_2_type] == "mail") {
        echo "<a href=\"mailto:$liensrow[lien_2_cont]\">$lien_2_txt</a>";
    }
    if ($liensrow[lien_2_type] == "site web") {
        echo "<a href=\"http://$liensrow[lien_2_cont]\" target=_blank>$lien_2_txt</a>";
    }
    echo"</td>";
    echo"</tr>";

    echo"<tr>";
    if ($liensrow[lien_3_type] != "rien") {
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_3_type] </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
    }
    if ($liensrow[lien_3_type] == "auteur") {
        echo "$liensrow[lien_3_txt]";
    }
    if ($liensrow[lien_3_type] == "mail") {
        echo "<a href=\"mailto:$liensrow[lien_3_cont]\">$lien_3_txt</a>";
    }
    if ($liensrow[lien_3_type] == "site web") {
        echo "<a href=\"http://$liensrow[lien_3_cont]\" target=_blank>$lien_3_txt</a>";
    }
    echo"</td>";
    echo"</tr>";

    echo"<tr>";
    if ($liensrow[lien_4_type] != "rien") {
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_4_type] </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
    }
    if ($liensrow[lien_4_type] == "auteur") {
        echo "$liensrow[lien_4_txt]";
    }
    if ($liensrow[lien_4_type] == "mail") {
        echo "<a href=\"mailto:$liensrow[lien_4_cont]\">$lien_4_txt</a>";
    }
    if ($liensrow[lien_4_type] == "site web") {
        echo "<a href=\"http://$liensrow[lien_4_cont]\" target=_blank>$lien_4_txt</a>";
    }
    echo"</td>";
    echo"</tr>";

    echo"<tr>";
    if ($liensrow[lien_5_type] != "rien") {
        echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_5_type] </td>";
        echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
    }
    if ($liensrow[lien_5_type] == "auteur") {
        echo "$liensrow[lien_3_txt]";
    }
    if ($liensrow[lien_5_type] == "mail") {
        echo "<a href=\"mailto:$liensrow[lien_5_cont]\">$lien_5_txt</a>";
    }
    if ($liensrow[lien_5_type] == "site web") {
        echo "<a href=\"http://$liensrow[lien_5_cont]\" target=_blank>$lien_5_txt</a>";
    }
    echo"</td>";
    echo"</tr>";
}

/* ------------------------------------------------------------------------------------------
  fonction permettant l'affichage des services avec liens en fonction de la table services
  pour les menus de la page groupe.php
  ------------------------------------------------------------------------------------------- */

function services($service) {
    /* faire un truc disant si service appartient alors couleur untel sinon couleur differente */
    $groupe = substr($service, 0, 1);
    $requete = DatabaseOperation::query("select * from services where id_groupe = $groupe order by intitule_ser");

    while ($rows = mysql_fetch_array($requete)) {
        /* gestion couleur dois dependre du groupe et non du service vu que page unique */

        if ($groupe == 1) {
            $couleur2 = '#FF3300';
            $couleur1 = '#FF6633';
        }
        if ($groupe == 2) {
            $couleur1 = '#FF9933';
            $couleur2 = '#FF6600';
        }
        if ($groupe == 3) {
            $couleur2 = '#FF9900';
            $couleur1 = '#FFCC66';
        }
        if ($groupe == 4) {
            $couleur2 = '#CC9933';
            $couleur1 = '#D3B565';
        }

        if ($service == $rows[id_service]) {
            $couleur1 = $couleur2;
        }
        echo "<td width=\"15%\" onMouseOver=this.style.backgroundColor='$couleur2'
                                onMouseOut=this.style.backgroundColor='$couleur1'  align=\"center\" valign=\"middle\" bgcolor=\"$couleur1\"><a href=\"groupe.php?service=$rows[id_service]\" class=\"rollgeneral\">$rows[intitule_ser]</a></td>";
    }
}

/* ------------------------------------------------
  fonction d'affichage des commentaire d'articles
  ------------------------------------------------ */

function commentaire($num_article) {

    $requete3 = DatabaseOperation::query("SELECT comment.date, salaries.prenom, salaries.nom, comment.commentaire FROM comment,salaries WHERE ((comment.id_art = $num_article) and (comment.id_user = salaries.id_user)) order by id_comment desc");
    while ($rows = mysql_fetch_array($requete3)) {
        $date = "$rows[date]";
        $annee = substr($date, 0, 4);
        $mois = substr($date, 5, 2);
        $jour = substr($date, 8, 2);

        echo "<tr align=\"center\" valign=\"middle\">";
        echo "<td class=\"logFFCC66\" width=15%>$rows[prenom] $rows[nom]</td>";
        echo "<td class=\"logFFCC66\" width=20%>";
        $string = stripslashes($rows[commentaire]);
        censor_string($string);
        echo"</td>";
        echo "<td class=\"logFFCC66\" width=10%>$jour-$mois-$annee</td>";
        echo "</tr>";
    }
}

/* -------------------------------------------
  fonction d'affichage des commentaire d'archives
  ------------------------------------------- */

function commentaire2($num_article) {

    $requete3 = DatabaseOperation::query("SELECT archcomment.date, salaries.prenom, salaries.nom, archcomment.commentaire FROM archcomment,salaries WHERE ((archcomment.id_art = $num_article) and (archcomment.id_user = salaries.id_user)) order by id_comment desc");
    while ($rows = mysql_fetch_array($requete3)) {
        $date = "$rows[date]";
        $annee = substr($date, 0, 4);
        $mois = substr($date, 5, 2);
        $jour = substr($date, 8, 2);

        echo "<tr align=\"center\" valign=\"middle\">";
        echo "<td class=\"logFFCC66\" width=15%>$rows[prenom] $rows[nom]</td>";
        echo "<td class=\"logFFCC66\" width=20%>";
        $string = stripslashes($rows[commentaire]);
        censor_string($string);
        echo"</td>";
        echo "<td class=\"logFFCC66\" width=10%>$jour-$mois-$annee</td>";
        echo "</tr>";
    }
}

/* ------------------------------------------------------
  la gestion des zones libres dans les news longues
  ------------------------------------------------------- */

function zone($num_art, $num_zone) {
    $zone1 = DatabaseOperation::query("select * from articles where num_article = $num_art");
    $zonerow = mysql_fetch_array($zone1);

    $type = "zone_" . $num_zone . "_type";
    $lien = "zone_" . $num_zone . "_lien";
    $infos = "zone_" . $num_zone . "_info";
    $justif = "zone_" . $num_zone . "_justif";

    if ($zonerow[$type] == "rien") {
        echo"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" name=\"tablo004\">";
    } else {
        echo"<table width=\"100%\" border=\"1\" cellspacing=\"4\" cellpadding=\"0\" name=\"tablo004\">";
    }
    echo"<tr>";
    echo "<td align=";
    if ($zonerow[$justif] == "gauche") {
        echo"left";
    } else if ($zonerow[$justif] == "milieu") {
        echo"center";
    } else if ($zonerow[$justif] == "droite") {
        echo"right";
    }
    echo">";
    /* si dans la base */
    $tempo = stripslashes($zonerow[$infos]);

    if ($zonerow[$type] == "lien") {
        echo "<a href=\"http:\"//$zonerow[$lien]\">$tempo</a>";
    }
    if ($zonerow[$type] == "image") {
        echo "<img src=\"../imgarticle/$zonerow[$lien]\" border=0 alt=\"$tempo\">";
    }
    if ($zonerow[$type] == "texte") {
        echo "<font class=\"txt\">$tempo</font>";
    }

    echo "</td>";
    echo"</tr>";
    echo"</table>";
}

/* ----------------------------------------------------
  fonction d'affichage de la petite image symbolisant le lu/non lu
  ------------------------------------------------------ */

function imagelu($num, $id_user) {
    $condition = DatabaseOperation::query("select distinct * from lu, articles where ((articles.num_article='$num') and (lu.id_art='$num') and (lu.id_user='$id_user'))");
    $nb2 = mysql_numrows($condition);
    if (!$nb2) {
        return ("nonlu.gif");
    } else {
        return ("lu.gif");
    }
}

/* -----------------------------------------------------
  fonction de censure pour commentaires d'articles
  ------------------------------------------------------ */

function censor_string($string) {
    $sql = "SELECT word, replacement FROM words";
    $r = DatabaseOperation::query($sql);
    while ($w = mysql_fetch_array($r)) {
        $word = stripslashes($w[word]);
        $replacement = stripslashes($w[replacement]);
        $string = eregi_replace(" $word", " $replacement", $string);
        $string = eregi_replace("^$word", "$replacement", $string);
        $string = eregi_replace("<BR>$word", "<BR>$replacement", $string);
    }

    echo "$string";
}

/* -----------------------------------------------------------
  fonction pour affichage contenu liste diffusion
  au niveau de la page nouveautés
  ----------------------------------------------------------- */

function diffusion($id_user, $service) {

    $info = "";

    $requeted = "SELECT * FROM diffusion, articles left join lu on articles.num_article = lu.id_art  WHERE lu.id_art is null and (diffusion.id_user = $id_user)";
    $requeted .= "and (articles.diffusion = diffusion.nomliste)";
    $requeted .= "and (articles.publica != '')";
    $requeted1 = DatabaseOperation::query("$requeted");
    if ($requeted1)
        $info = mysql_num_rows($requeted1);
    if ($info != '') {
        echo"<table width=\"100%\" border=\"0\" cellspacing=\"0\">";
        echo"        <tr>";
        echo"          <td  width=\"100\" class=\"rollmarron\"><span class=\"rollmarron\">liste de diffusion </span></td>";
        echo"        </tr>";
        echo"      </table><span class=\"loginFFFFFF\">";


        echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\"><tr>";
        while ($rows = mysql_fetch_array($requeted1)) {
            /* -formatage date- */
            $date = $rows[date_crea];
            $jour = substr($date, 8, 2);
            $mois = substr($date, 5, 2);
            $annee = substr($date, 0, 4);
            $date = $jour . "/" . $mois . "/" . $annee;
            echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
            echo"<td class=\"titrtabl\" width=\"60\" bgcolor=\"#FFFFCC\">$date</td>";
            echo"<td class=\"titrtabl\" width=\"43%\" bgcolor=\"#FFFFCC\">$rows[titre_art]</td>";
            echo"<td class=\"titrtabl\" width=\"10%\" bgcolor=\"#FFFFCC\">";
            $ab = DatabaseOperation::query("select * from salaries where id_user='$rows[auteur]'");
            $ligne = mysql_fetch_array($ab);
            echo "$ligne[nom] $ligne[prenom]</td>";
            echo"<td class=\"titrtabl\" width=\"34%\" bgcolor=\"#FFFFCC\">$rows[sujet]<br>";
            $titou = $service;
            taille2($rows[taille], $rows[num_article], $titou);
            echo "lien sur l'article</a></td>";
        }
    }
    echo"</tr></table>";
}

/* ---------------------------------------------------------------
  la page rapide.php pour le coup d'oeil
  des tableaux service (detail un service)
  ---------------------------------------------------------------- */
/* -----listing des annonces----- */

function rapide1($id_user, $service, $titou) {

    if ($id_user) {//Si l'utilisateur est connecté, il voit les articles en rapport avec son niveau
        //Chargement des données utilisateurs
        $recordSalaries = new DatabaseRecord("salaries", $id_user);
        $date_creation_salaries = $recordSalaries->date_creation_salaries;

//echo $_SESSION["date_creation_salaries"];
        /* systeme d'exclusion ou non des infos deja lu */
//      $result2 ="SELECT * FROM modes, articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user) WHERE lu.id_art is null and (modes.id_user = $id_user)";
        $result2 = "SELECT * FROM articles left join lu on (articles.num_article = lu.id_art) and (lu.id_user = $id_user) WHERE lu.id_art is null ";
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
        //$result2 .= "and (articles.id_art_serv = '$service')";
//$result2 .= "and (articles.id_art_serv = modes.id_service)";
//$result2 .= "and (articles.nivo_conf <= modes.serv_conf)";
        $result2 .= "and (articles.publica != 0)";
        $result2 .= "and (articles.diffusion = '')"
//L'utilisateur ne voit pas les messages antérieur à sa création
                . "and (articles.date_modif>'" . $date_creation_salaries . "') "
        ;
        /* rajouter dans l'order l'ordre souhaité par l'utilisateur */
        $result2 .= "order by date_modif desc";
    } else {
////Si il est déconnecté, il ne voit seulement que les articles de niveau 1 des deux derniers mois {

        $date_limite = date("Y-m-d", mktime(0, 0, 0, date("m") - 4, date("d"), date("Y")));

        /* systeme d'exclusion ou non des infos deja lu */
        $result2 = "SELECT * FROM articles WHERE  ";
        /* retrouver le niveau du user dans la table mode et sortir les articles en fonction de ce nivo modes */
        //$result2 .= "(articles.id_art_serv = '$service')";
//$result2 .= "and (articles.id_art_serv = modes.id_service)";
        //$result2 .= "and (articles.nivo_conf = '1') ";
        $result2 .= " (articles.nivo_conf = '1') ";
        $result2 .= "and (articles.publica != 0) ";
        $result2 .= "and (articles.diffusion = '') ";
        $result2 .= "and (articles.date_modif > '$date_limite 00:00:00' )";
        /* rajouter dans l'order l'ordre souhaité par l'utilisateur */
        $result2 .= "order by date_modif desc";
    }
//echo $result2;
    $requete = DatabaseOperation::query("$result2");
    $total = mysql_num_rows($requete);

    echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\"><tr>";
    if ($requete = @DatabaseOperation::query("$result2")) {
        while ($rows = mysql_fetch_array($requete)) {

            echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
            /* affichage unique du service */
            $variable = Lib::isDefined("variable", 0);
            if ($variable != 1) {
                $variable = 1;
                $servik = DatabaseOperation::query("select * from services where id_service = '$rows[id_art_serv]'");
                $rok = mysql_fetch_array($servik);
                echo "$rok[intitule_ser]";
            }

            /* ------------
              formatage date
              ------------- */
            $date = $rows["date_crea"];
            $jour = substr($date, 8, 2);
            $mois = substr($date, 5, 2);
            $annee = substr($date, 0, 4);
            $date = $jour . "/" . $mois . "/" . $annee;

            $titre_art = stripslashes($rows["titre_art"]);
            $sujet = stripslashes($rows["sujet"]);

            echo"<td class=\"titrtabl\" width=\"60\" bgcolor=\"#FFFFCC\">$date</td>";
            echo"<td class=\"titrtabl\" width=\"43%\" bgcolor=\"#FFFFCC\">$titre_art</td>";
            echo"<td class=\"titrtabl\" width=\"10%\" bgcolor=\"#FFFFCC\">";
            $ab = DatabaseOperation::query("select * from salaries where id_user='" . $rows["auteur"] . "'");
            $ligne = mysql_fetch_array($ab);
            echo $ligne["nom"] . " " . $ligne["prenom"] . "</td>";
            echo"<td class=\"titrtabl\" width=\"30%\" bgcolor=\"#FFFFCC\">$sujet<br>";
            $nva = "nouveaute";
            taille2($rows["taille"], $rows["num_article"], "", $nva);
            echo "lien sur l'article</a></td>";
            echo"<td class=\"titrtabl\" width=\"5%\" bgcolor=\"#FFFFCC\">" . $rows["nivo_conf"] . "</td>";
            echo"<td align=\"center\" bgcolor=\"#FFFFCC\" width=\"2%\"><input type=\"checkbox\" name=\"" . $rows["num_article"] . "\" value=\"1\"></td>";
            echo "<input type=hidden name=\"ids[]\" value=\"" . $rows["num_article"] . "\">";
        }
    }
    echo"</tr></table>";
    return($total);
}

/* -----------------------------
  compteur articles à publier
  ------------------------------ */

function publication2($user) {
    /* $reqtilt = "select distinct * from articles, publicateur, modes "
      . "where publicateur.id_user = $user "
      . "and publicateur.id_service = articles.id_art_serv "
      . "and articles.date_modif=0 and modes.id_user=$user "
      . "and modes.id_service=articles.id_art_serv "
      . "and modes.serv_conf >= articles.nivo_conf"
      ; */

    $reqtilt = "select distinct * from articles, publicateur "
            . "where publicateur.id_user = $user "
            . "and publicateur.id_service = articles.id_art_serv "
            . "and articles.date_modif=0 "
    ;

//echo $reqtilt;
    $tilt = DatabaseOperation::query($reqtilt);
    if ($tilt != false) {

        $tilt2 = mysql_num_rows($tilt);
        if ($tilt2 != '') {
            echo "<a href=article_publier.php><img src=../images-index/publication.gif width=130 height=20 border=0></a><br>";
            if ($tilt2 == 1) {
                echo "Vous avez $tilt2 article à publier";
            } else {
                echo "Vous avez $tilt2 articles à publier";
            }
        }
    }
}

/* --------------------------------
  compteur articles à archiver
  ---------------------------------- */

function archive($user) {
    $tilt = DatabaseOperation::query("select distinct * from articles, publicateur, modes where publicateur.id_user = $user and publicateur.id_service = articles.id_art_serv and articles.archive = 'oui' and modes.id_user=$user and modes.id_service=articles.id_art_serv and modes.serv_conf >= articles.nivo_conf");
    $tilt2 = "";
    if ($tilt)
        $tilt2 = mysql_num_rows($tilt);
    if ($tilt2 != '') {
        if ($tilt2 == 1) {
            echo "Vous avez $tilt2 article à archiver";
        } else {
            echo "Vous avez $tilt2 articles à archiver";
        }
    }
}

/* ---------------------------------
  compteur articles actifs
  ---------------------------------- */

function actifs($user) {
    if ($user) {
        $tilt = DatabaseOperation::query("select * from articles where articles.auteur = $user and articles.publica != ''");
        $tilt2 = mysql_num_rows($tilt);
        if ($tilt2 != '') {
            if ($tilt2 == 1) {
                echo "&nbsp; Vous avez $tilt2 article publié";
            } else {
                echo " &nbsp; Vous avez $tilt2 articles publiés";
            }
        }
    }
}

//Fin de la fonction

/* --------------------------------------------------------------
  news defilante sur toutes les pages groupe.php, neutre.php
  ------------------------------------------------------------------ */

function defilante() {
    echo"<marquee msambientcpg=\"2504\" type=\"SCROLL\" direction=\"LEFT\" height=\"28\" width=\"600\" scrolldelay=\"30\" scrollamount=\"2\" class=\"txtentreprise\">";
    $champs = DatabaseOperation::query("select * from newsdefil where num=1");
    $colonne = mysql_fetch_array($champs);
    $news1 = stripslashes($colonne[news1]);
    $news2 = stripslashes($colonne[news2]);
    $news3 = stripslashes($colonne[news3]);
    $news4 = stripslashes($colonne[news4]);
    $news5 = stripslashes($colonne[news5]);

    echo"$news1";
    if ($news2 != "") {
        bip();
    }
    echo"$news2";
    if ($news3 != "") {
        bip();
    }
    echo"$news3";
    if ($news4 != "") {
        bip();
    }
    echo"$news4";
    if ($news5 != "") {
        bip();
    }
    echo"$news5";
    echo "</marquee>";
}

function bip() {
    $bip = 0;
    while ($bip <= 90) {
        echo"&nbsp;";
        $bip++;
    }
}

/* ------------------------------------
  listing article ce centre
  ------------------------------------- */

function centrece($service) {
    if ($service) {
        $ce1 = DatabaseOperation::query("select * from articlece where ((placeinfoce='Info centrale') and (numserce=$service)) order by datecrea desc limit 0,3");
        while ($rowsce1 = mysql_fetch_array($ce1)) {
            echo"<table width=\"500\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">";
            echo"         <tr>";
            echo"                      <td class=\"titr\" colspan=\"2\"></td>";
            echo"         </tr>";
            echo"        <tr>";
            echo"           <td bgcolor=\"#FFCC66\" width=\"20\">";
            if ($rowsce1[imgce] != "") {
                echo"<img src=\"../imgarticlece/$rowsce1[imgce]\">";
            }
            echo"</td>";
            echo"                <td width=80% class=\"txt\">$rowsce1[titrece]</td>";
            echo"              </tr>";
            echo"              <tr>";
            echo"                <td colspan=\"2\" class=\"txt\">$rowsce1[txtce]</td>";
            echo"              </tr>";
            echo"</table>";
        }
    }
}

//Fin de la fonction

/* ------------------------------------
  listing article ce colonne droite
  ------------------------------------- */

function droitece($service) {
    if ($service) {
        $ce2 = DatabaseOperation::query("select * from articlece where placeinfoce='Info colonne' and numserce=$service order by datecrea desc limit 0,6");
        while ($rowsce2 = mysql_fetch_array($ce2)) {
            echo"<table width=\"150\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">";
            echo"               <tr>";
            echo"                      <td class=\"titr\" colspan=\"2\"></td>";
            echo"               </tr>";
            echo"              <tr>";
            echo"                <td>";
            echo"                  <div align=\"center\" class=\"txt\">$rowsce2[titrece]</div>";
            echo"                </td>";
            echo"              </tr>";
            echo"              <tr>";
            echo"                <td class=\"txt\">$rowsce2[txtce]</td>";
            echo"              </tr>";
            echo"</table>";
        }
    }
}

//fin de la fonction

/* ------------------------------------------
  pages suivantes / precedente pour C.E.
  ------------------------------------------- */
/* -----listing des annonces----- */

function suitece($service, $page) {

    $nb = 9;
    $result2 = "SELECT * FROM articlece where numserce='$service'";
    $result2 .= "order by datecrea desc ";

    if (empty($page)) {
        $page = 1;
    }
    $requete = DatabaseOperation::query("$result2");
    $total = mysql_num_rows($requete);
    $debut = ($page - 1) * $nb;

    $result2 .= "LIMIT $debut,$nb";

    echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\">";
    if ($requete = @DatabaseOperation::query("$result2")) {
        while ($rows = mysql_fetch_array($requete)) {
            $titrece = stripslashes($rows[titrece]);
            $txtce = stripslashes($rows[txtce]);
            echo "<tr bgcolor=\"#FFFFCC\">";
            echo"<td class=\"txttabl\" width=\"24%\">$titrece</td>";
            echo"<td class=\"txttabl\" width=\"34%\">$txtce</td>";

            $date = $rows[datecrea];
            $jour = substr($date, 8, 2);
            $mois = substr($date, 5, 2);
            $annee = substr($date, 0, 4);
            $date = $jour . "/" . $mois . "/" . $annee;

            echo"<td class=\"txttabl\" width=\"14%\">$date</td>";
            echo"</tr>";
        }
    }
    echo"</table>";
    echo"<table width=\"100%\" border=\"0\" cellspacing=\"4\">";
    echo"<tr>";
    echo "<td width=80% align=center>";

    $nbpages = ceil($total / $nb);
    $nbpages = $nbpages - 1;
    for ($i = 1; $i <= $nbpages; $i++) {
        if ($i == 1) {
            echo "<a href=\"entreprise.php?service=$service\"><font size=1 color=#000000><b> accueil </b></font></a>";
        } else {
            echo "<a href=\"$PHP_SELF?page=$i&service=$service\"><font size=1 color=#000000><b> page$i </b></font></a>";
        }
        if ($i < $nbpages) {
            echo " - ";
        }
    }
    echo"</td></tr>";
    echo"</table>";
}

/* ------------------------------------------------------------------------------------------
  fonction permettant l'affichage des services avec liens pour la partie entreprise C.E.
  ------------------------------------------------------------------------------------------- */

function servicesce($service) {

    $requete8 = DatabaseOperation::query("select * from servicece order by descserce");
    while ($rows = mysql_fetch_array($requete8)) {
        /* gestion couleur dois dependre du groupe et non du service vu que page unique */
        $couleur2 = '#FF3300';
        $couleur1 = '#FF6633';
        if ($service == $rows[numserce]) {
            $couleur1 = $couleur2;
        }
        echo "<td width=\"15%\" onMouseOver=this.style.backgroundColor='$couleur2'
              onMouseOut=this.style.backgroundColor='$couleur1'  align=\"center\" valign=\"middle\" bgcolor=\"$couleur1\"><a href=\"entreprise.php?service=$rows[numserce]\" class=\"rollgeneral\">$rows[descserce]</a></td>";
    }
}

//Fin de la fonction

/* ------------------------------------------------------------------------
  fonction de verification presence http dans adresse web pour les favoris
  -------------------------------------------------------------------------- */

function webttp($adresse) {
    $recoupe = substr($adresse, 0, 7);

    if ($recoupe != "http://") {
        $transit .= 'http://';
        $transit .= $adresse;
        $adresse = $transit;
    }

    return($adresse);
}

/*
  Fonction mail
  Envoi de mail. En parametres:
  $corpsmail: Le texte du mail redige en HTML
  $adrFrom: adresse de l'expediteur
  $adrTo: adresse du destinataire
  $sujet: sujet du mail
 */

function envoi_mail($corpsmail, $adrFrom, $adrTo, $sujet) {
// Constition du corps du mail
//      $entetemail = "X-Mailer: $adrfrom\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=ISO-8859-1\r\nContent-Transfer-Encoding: 8bit\n";
//      $entetemail .= "From: $adrfrom \n";
//     $entetemail .= "Reply-To: $adrfrom\n";
//      $rep= @mail($adrTo, $sujet, $corpsmail, $entetemail);

    $rep = envoismail($sujet, $corpsmail, $adrTo, $adrFrom);
}

;

// Fonction makeSelectListChecked
// Permet de créer une liste déroulante d'un champ de type
// enum.
function makeSelectList($nombase, $table, $field) {
    $s = "";

//$rid=mysql_db_query($nombase,"SHOW COLUMNS FROM $table");
    $rid = DatabaseOperation::query("SHOW COLUMNS FROM $table");
    $nr = mysql_num_rows($rid);

    while (list($name, $type) = mysql_fetch_row($rid)) {
        if ($name == $field) {
            if (preg_match('/^enum\(.*\)$/', $type))
                $type = substr($type, 6, -2);
            else
            if (preg_match('/^set\(.*\)$/', $type))
                $type = substr($type, 5, -2);
            else
                return("<option>ERROR");
            $opts = explode("','", $type);
            while (list($k, $v) = each($opts))
                $s.="<option>$v";
        }
    }
    return($s);
}

;

// Fonction makeSelectListChecked
// Permet de créer une liste déroulante d'un champ de type
// enum en selectionnant un élément particulier.
function makeSelectListChecked($nombase, $table, $field, $val) {
    $s = "";
// Boris 2003.03.28: $rid=mysql_db_query($nombase,"SHOW COLUMNS FROM $table");
    $rid = DatabaseOperation::query("SHOW COLUMNS FROM $table");

    $nr = mysql_num_rows($rid);

    while (list($name, $type) = mysql_fetch_row($rid)) {
        if ($name == $field) {
            if (preg_match('/^enum\(.*\)$/', $type))
                $type = substr($type, 6, -2);
            else
            if (preg_match('/^set\(.*\)$/', $type))
                $type = substr($type, 5, -2);
            else
                return("<option>ERROR");
            $opts = explode("','", $type);
            while (list($k, $v) = each($opts)) {
                if ($val == $v)
                    $s.="<option selected>$v";
                else
                    $s.="<option>$v";
            }
        }
    }
    return($s);
}

;

// Fonction affiche_date
// Permet de formater une date SQL en format JJ/MM/AAAA
function affiche_date($val) {
    $toto = substr($val, 0, 10);
    $tata = substr($toto, -2) . "/" . substr($toto, 5, 2) . "/" . substr($toto, 0, 4);
    return ($tata);
}

;

// Fonction taille_image_7271
// Permet de redimensionner une image en 72x71.
function taille_image_7271($filesrc, $filedst) {
// Recuperation du type d'image

    $info = getimagesize("data/370_1.jpg");
    $new_w = 72; // Taille en X de l'image de destination ( width )
    $new_h = 71; // Taille en Y de l'image de destination ( height )
    $dst_img = imagecreatetruecolor($new_w, $new_h);


    /* définition de l'image source
      getimagesize() retourne un tableau de 4 éléments.
      L'index 0 contient la longueur.
      L'index 1 contient la largeur.
      L'index 2 contient le type de l'image :
      1 = GIF,
      2 = JPG,
      3 = PNG,
      5 = PSD,
      6 = BMP,
      7 = TIFF (Ordre des octets Intel),
      8 = TIFF (Ordre des octets Motorola),
      9 = JPC,
      10 = JP2,
      11 = JPX,
      12 = JB2,
      13 = SWC,
      14 = IFF.
      Ces valeurs correspondent aux constantes IMAGETYPE qui ont été ajoutée en PHP 4.3.
      L'index 3 contient la chaîne à placer dans les balises HTML : "height=xxx width=xxx".
     */

    switch ($info[2]) {
        case '2': $src_img = ImageCreateFromJPEG($filesrc);
            break;
        case '3': $src_img = ImageCreateFromPNG($filesrc);
            break;
    }

    ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, ImageSX($src_img), ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
    if ($taille[2] == 1) { //C'est un GIF
        ImageGIF($dst_img, $filedst);
    }
    if ($taille[2] == 2) { //C'est un JPEG
        ImageJPEG($dst_img, $filedst);
    }
    if ($taille[3] == 2) { //C'est un PNG
        ImagePNG($dst_img, $filedst);
    }
}

;

// Fonction taille_image_350y
// Permet de retailler une image en gardant son ratio
// avec une largeur de 350 si l'image a une largeur
// superieure.
function taille_image_350Y($filesrc, $filedst) {
    $taille = getimagesize($filesrc);
    $largeur = $taille[0];
    if ($largeur > 350) {
        $longueur = $taille[1];
        $rapport = $largeur / $longueur;

        $new_w = 350; // Taille en X de l'image de destination ( width )
        $new_h = floor(350 / $rapport); // Taille en Y de l'image de destination ( height )

        $dst_img = ImageCreate($new_w, $new_h);
// définition de l'image source
        if ($taille[2] == 1) { //C'est un GIF
            $src_img = ImageCreateFromGIF($filesrc);
        }
        if ($taille[2] == 2) { //C'est un JPEG
            $src_img = ImageCreateFromJPEG($filesrc);
        }
        if ($taille[3] == 2) { //C'est un PNG
            $src_img = ImageCreateFromPNG($filesrc);
        }

        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, ImageSX($src_img), ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
        if ($taille[2] == 1) { //C'est un GIF
            ImageGIF($dst_img, $filedst);
        }
        if ($taille[2] == 2) { //C'est un JPEG
            ImageJPEG($dst_img, $filedst);
        }
        if ($taille[3] == 2) { //C'est un PNG
            ImagePNG($dst_img, $filedst);
        }
    }
}

;

// Fonction taille_image_300y
// Permet de retailler une image en gardant son ratio
// avec une largeur de 300 si l'image a une largeur
// superieure.
function taille_image_300Y($filesrc, $filedst) {
    $taille = getimagesize($filesrc);
    $largeur = $taille[0];
    if ($largeur > 300) {
        $longueur = $taille[1];
        $rapport = $largeur / $longueur;

        $new_w = 300; // Taille en X de l'image de destination ( width )
        $new_h = floor(300 / $rapport); // Taille en Y de l'image de destination ( height )

        $dst_img = ImageCreate($new_w, $new_h);
// définition de l'image source
        if ($taille[2] == 1) { //C'est un GIF
            $src_img = ImageCreateFromGIF($filesrc);
        }
        if ($taille[2] == 2) { //C'est un JPEG
            $src_img = ImageCreateFromJPEG($filesrc);
        }
        if ($taille[3] == 2) { //C'est un PNG
            $src_img = ImageCreateFromPNG($filesrc);
        }

        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, ImageSX($src_img), ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
        if ($taille[2] == 1) { //C'est un GIF
            ImageGIF($dst_img, $filedst);
        }
        if ($taille[2] == 2) { //C'est un JPEG
            ImageJPEG($dst_img, $filedst);
        }
        if ($taille[3] == 2) { //C'est un PNG
            ImagePNG($dst_img, $filedst);
        }
    }
}

;



/* ----------------------------------------
  Ouverture d'un article en modification
  ------------------------------------------ */

function taillemod($taille, $num_article, $table) {
    if ($taille == 1) {
        echo"<a href=\"#\" onClick=\"MM_goToURL('parent','modcourt.php?num_article=$num_article&modifier=mod');return document.MM_returnValue\">";
    } else {
        echo"<a href=\"#\" onClick=\"MM_goToURL('parent','modetap1long.php?num_article=$num_article&modifier=mod');return document.MM_returnValue\">";
    }
}

;







/* Suppression d'un salarié de l'intranet */

function suppression_intranet_utilisateur($id_salaries) {
    $req7 = "delete from modes where id_user='$id_salaries'";
    $result7 = DatabaseOperation::query($req7);

    $req8 = "delete from lu where id_user='$id_salaries'";
    $result8 = DatabaseOperation::query($req8);

    $req9 = "delete from droitft where id_user='$id_salaries'";
    $result9 = DatabaseOperation::query($req9);

    $req10 = "delete from perso where id_user='$id_salaries'";
    $result10 = DatabaseOperation::query($req10);

    $req11 = "delete from log where id_user='$id_salaries'";
    $result11 = DatabaseOperation::query($req11);

//$req12="update salaries set actif='non', login='nologin', pass='nopass' where id_user='$sal_user'";
    $req12 = "delete from salaries where id_user='$id_salaries'";
    $result12 = DatabaseOperation::query($req12);

    $req13 = "delete from intranet_droits_acces where id_user='$id_salaries'";
    $result13 = DatabaseOperation::query($req13);

    $req14 = "delete from planning_presence_detail where id_salaries='$id_salaries'";
    $result14 = DatabaseOperation::query($req14);
}

/* Afficher une image dans une news
 * ********************************** */

function afficher_image($nom_image) {

    /*
      Dictionnaire des variables:
     */

    $GLOBALS[$nom_image]; //Nom du fichier à afficher


    /*
      Corps de la fonction
     */

    echo "
     <script type=text/javascript>
     function RefreshImage$nom_image() {
     document.images['$nom_image'].src = 'data/" . $GLOBALS[$nom_image] . "?variable='+Math.random()*9999;
     }
     setTimeout('RefreshImage$nom_image()',30);
     </script>
     <img src=data/" . $GLOBALS[$nom_image] . " id=$nom_image width=72 height=71>
     ";
}

/* Inserer une image d'une news
 * ********************************** */

function insert_image($num_article, $num_image) {

    /*
      Dictionnaire des variables:
     */
    $num_article;                                 //Identifiant de la news
    $num_image;                                   //Identifiant de l'image

    $nom_image_predefini = "img_" . $num_image . "_nomr";
    $nom_image_personalise = "img_" . $num_image . "_nom";
    $nom_image = "nomimg" . $num_image;
    $path_image = 'data';
    $img_temp = $num_article . "_" . $num_image . ".tmp"; //Nom temporaire du fichier image
    $img_png = $num_article . "_" . $num_image . ".png";  //Nom définitif du fichier image
    $GLOBALS[$nom_image_personalise];             //Nom de l'image personnalisée si sélectionnée en amont
    $GLOBALS[$nom_image_predefini];               //Nom de l'image prédéfini si sélectionnée en amont
    $GLOBALS[$nom_image];                         //Nom de l'image à prévisualiser

    /*
      Corps de la fonction
     */
//Si aucun image n'a été sélectionnés ou n'existe, on met l'image par défaut:
    if (!is_file("$path_image/$img_png") and !$GLOBALS[$nom_image_personalise] and !$GLOBALS[$nom_image_predefini]) {
        $GLOBALS[$nom_image_predefini] = "photo1.jpg";
    }

//Une image prédéfini a été sélectionnée
    if ($GLOBALS[$nom_image_predefini]) {
//Suppression de l'ancienne image
        $t = `rm $path_image/$img_png`;

//Copy de la nouvelle image (et écrasement)
        copy("images/$GLOBALS[$nom_image_predefini]", "$path_image/$img_temp");
    }
//Une nouvelle image a été sélectionnée ou la même image a été conservée {
//Un fichier personalisé a été sélectionné on la copie pour la convertir ensuite
    if ($GLOBALS[$nom_image_personalise]) {
//Suppression de l'ancienne image
        $t = `rm $path_image/$img_png`;

//Copy de la nouvelle
        copy("$GLOBALS[$nom_image_personalise]", "$path_image/$img_temp");
    }


//Conversion de l'image si un fichier temporaire est trouvé
    if (is_file("$path_image/$img_temp")) {
        imagefile2png("$path_image/$img_temp");
    }

//Nettoyage
//$ancien=$path_image."/".$num_article."_".$num_image.".tmp";
//$t=`rm $path_image/$ancien`;
    $GLOBALS[$nom_image] = $img_png;
    return $nom_image;
}

/*
  Include de développement
  Une optimisation serait d'utiliser CVS !!
 */
//if($module)
//{
//   $chemin_functions_personalise="../".$module;
//}else
//   $chemin_functions_personalise=".";
//include ("$chemin_functions_personalise/functions_sm.php");
//include ("$chemin_functions_personalise/functions_bs.php");
?>