<?php
include ("../lib/session.php");
require ("../lib/functions.php");

if ($id_user == "") {
    /* verification des bon droit de l'utilisateur par rapport a l'article lu */
    $requete = DatabaseOperation::query("select * from articles where ((articles.num_article='$num') and (articles.nivo_conf = 1))");
    $nb1 = mysql_numrows($requete);
    $rows = mysql_fetch_array($requete);

    if (!$nb1) {
        header("Location: ../popup/erreur.htm");
    }
} else {

    /* verification des bon droit de l'utilisateurn par rapport a l'article lu */
    $requete = DatabaseOperation::query("select * from articles, modes where ((articles.num_article='$num') and (modes.id_user=$id_user) and (articles.nivo_conf <= modes.serv_conf))");
    $rows = mysql_fetch_array($requete);
    $nb1 = mysql_numrows($requete);

    if (!$nb1) {
        header("Location: ../popup/erreur.htm");
    } else {

        /* et aussi dans fichiers espion on incremente le nb fichier lus si fichier pas deja lu */
        $condition = DatabaseOperation::query("select lu.id_art from lu,articles where ((articles.num_article='$num') and (lu.id_art='$num') and (lu.id_user='$id_user') and (lu.date > articles.date_modif))");
        $nb2 = mysql_numrows($condition);
        if (!$nb2) {
            $log = DatabaseOperation::query("select * from log where ((num_log='$num_log')and(id_user='$id_user'))");
            $log1 = mysql_fetch_array($log);
            $log1[lect_art] ++;
//DatabaseOperation::query("update log set lect_art = $log1[lect_art] where ((num_log='$num_log') and (id_user='$id_user'))");
        }

        /* --- mise a jour de la table lu/non lu on fait une requete avant
          et si il y a un resultat on update sinon on insert ...      --- */
        $existe = DatabaseOperation::query("select * from lu where ((id_art='$num') and (id_user='$id_user'))");
        $nb1 = mysql_numrows($existe);
        DatabaseOperation::query("INSERT INTO lustat(id_art ,id_user, date) VALUES ('$num','$id_user', NOW())");
        if (!$nb1) {
            DatabaseOperation::query("INSERT INTO lu(id_art ,id_user, date) VALUES ('$num','$id_user', NOW())");
        } else {
            DatabaseOperation::query("update lu set date = now() where ((id_art='$num') and (id_user='$id_user'))");
        }
    }


    /* si action commentaire on ecris celui ci dans la table si il n'existe pas deja afin de ne pas reecrire en actualisant' */
    /*
      echo"action : $action<br>";
      echo"commentaire : $commentair<br>";
     */
    if ($action == "comment") {
        if ($commentair != "") {
            $commentair = addslashes($commentair);
            $commentair = substr($commentair, 0, 250);
            $reqcom = "INSERT INTO comment(id_art ,id_user, commentaire, date) VALUES ('$num','$id_user', '$commentair', NOW())";
//echo"$reqcom<br>";
            $resultcom = DatabaseOperation::query($reqcom);

            /* et aussi dans fichiers espion on incremente le nb comment ecris */
            $log = DatabaseOperation::query("select * from log where ((num_log='$num_log')and(id_user='$id_user'))");
            $log2 = mysql_fetch_array($log);
            $log2[redac_com] ++;
//DatabaseOperation::query("update log set redac_com = $log2[redac_com] where ((num_log='$num_log') and (id_user='$id_user'))");

            /* et aussi on envois le mail si c coche dans la table perso
              donc requete sur l'article pour voir l'auteur  et en fonction de sa table perso envois de mail ou po
             */
            $mailing = DatabaseOperation::query("select * from salaries, perso where ((salaries.id_user=$rows[auteur]) and (perso.id_user=$rows[auteur]))");
            $mailingreq = "select * from salaries, perso where ((salaries.id_user=$rows[auteur]) and (perso.id_user=$rows[auteur]))";
//echo"$mailingreq";
            $mailrow = mysql_fetch_array($mailing);
            if ($mailrow[mailing] == 1) {

                /* envois du mail d'information à l'utilisateur concerné */
                $corpsmail = "Un commentaire concernant l'article ";
                $titreart = stripslashes($rows[titre_art]);
                $corpsmail.=$titreart;
                $corpsmail.=" vient d'etre rédigé par $login $prenom";
                $adrfrom = "postmaster@agis-sa.fr";
                $adrTo = $mailrow[mail];
                $sujet = "commentaire d'article Agis";

                $entetemail = "X-Mailer: $adrfrom\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=ISO-8859-1\r\nContent-Transfer-Encoding: 8bit\n";
                $entetemail .= "From: $adrfrom \n";
                $entetemail .= "Reply-To: $adrfrom\n";
                $rep = mail($adrTo, $sujet, $corpsmail, $entetemail);
                if ($rep == false) {
                    echo ("mail pas envoyé");
                }
            }
        }
    }
}
?>
<html>
    <head>
        <title>News Agis</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script language="JavaScript">
        <!--
            function MM_swapImgRestore() { //v3.0
                var i, x, a = document.MM_sr;
                for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++)
                    x.src = x.oSrc;
            }

            function MM_preloadImages() { //v3.0
                var d = document;
                if (d.images) {
                    if (!d.MM_p)
                        d.MM_p = new Array();
                    var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
                    for (i = 0; i < a.length; i++)
                        if (a[i].indexOf("#") != 0) {
                            d.MM_p[j] = new Image;
                            d.MM_p[j++].src = a[i];
                        }
                }
            }

            function MM_findObj(n, d) { //v4.0
                var p, i, x;
                if (!d)
                    d = document;
                if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
                    d = parent.frames[n.substring(p + 1)].document;
                    n = n.substring(0, p);
                }
                if (!(x = d[n]) && d.all)
                    x = d.all[n];
                for (i = 0; !x && i < d.forms.length; i++)
                    x = d.forms[i][n];
                for (i = 0; !x && d.layers && i < d.layers.length; i++)
                    x = MM_findObj(n, d.layers[i].document);
                if (!x && document.getElementById)
                    x = document.getElementById(n);
                return x;
            }

            function MM_swapImage() { //v3.0
                var i, j = 0, x, a = MM_swapImage.arguments;
                document.MM_sr = new Array;
                for (i = 0; i < (a.length - 2); i += 3)
                    if ((x = MM_findObj(a[i])) != null) {
                        document.MM_sr[j++] = x;
                        if (!x.oSrc)
                            x.oSrc = x.src;
                        x.src = a[i + 2];
                    }
            }
        //-->
        </script>
        <script language="JavaScript">
        <!--
            function Popup(page, options) {
                window.close();
            }

            function StartTimer(delai) {
                // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
                setTimeout("Popup()", delai * 1000);
            }
        //-->
        </script>
        <link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
        <script language="JavaScript">
        <!--
            function MM_reloadPage(init) {  //reloads the window if Nav4 resized
                if (init == true)
                    with (navigator) {
                        if ((appName == "Netscape") && (parseInt(appVersion) == 4)) {
                            document.MM_pgW = innerWidth;
                            document.MM_pgH = innerHeight;
                            onresize = MM_reloadPage;
                        }
                    }
                else if (innerWidth != document.MM_pgW || innerHeight != document.MM_pgH)
                    location.reload();
            }
            MM_reloadPage(true);
        // -->
        </script>
        <link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
        <link rel="stylesheet" href="../news1.css" type="text/css">
    </head>

    <body <?php if ($id_user != "") {
    $time = timeout($id_user);
    echo "onLoad=\"StartTimer($time)\"";
} ?> bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
            <tr>
                <td align="center" valign="top">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                        <tr>
                            <td><img src="../zimages/tetnews.gif" width="600" height="40"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">
                                    <tr>
                                        <td class="loginFFFFFFdroit" width="4%">&nbsp;</td>
                                        <td class="loginFFFFFFdroit" width="11%">Auteur</td>
                                        <td class="loginFFFFFF" width="30%">

                                            <input type="text" name="auteur" size="22" class="loginFFFFFF" value='<?php
$ab = DatabaseOperation::query("select * from salaries where id_user='$rows[auteur]'");
$ligne = mysql_fetch_array($ab);
echo "$ligne[nom] $ligne[prenom]";
?>'>
                                        </td>
                                        <td class="loginFFFFFFdroit" width="15%">publi&eacute; par</td>
                                        <td class="loginFFFFFF" width="30%">

                                            <input type="text" name="publicateur" size="22" class="loginFFFFFF" value='<?php
                                            $cd = DatabaseOperation::query("select * from salaries where id_user='$rows[publica]'");
                                            $ligne2 = mysql_fetch_array($cd);
                                            echo "$ligne2[nom] $ligne2[prenom]";
?>'>
                                        </td>

                                        <td class="loginFFFFFF" width="5%" align="center"><?php echo $News_icoLU ?></td>
                                    </tr>
                                    <tr>
                                        <td class="loginFFFFFFdroit"><img src=../lib/images/espaceur.gif width="25" height="1"></td>
                                        <td class="loginFFFFFFdroit" width="11%">date d'origine</td>
                                        <td class="loginFFFFFF" width="30&ugrave;">

                                            <input type="text" name="datecrea" size="22" class="loginFFFFFF" value='<?php
                                            /* --- formatage date en francais --- */
                                            $date = "$rows[date_crea]";

                                            $annee = substr($date, 0, 4);
                                            $mois = substr($date, 5, 2);
                                            $jour = substr($date, 8, 2);

                                            echo "$jour-$mois-$annee";
                                            ?>'>
                                        </td>
                                        <td class="loginFFFFFFdroit">derni&egrave;re modification</td>
                                        <td class="loginFFFFFF" width="30%">

                                            <input type="text" name="date_lastmodif" size="22" class="loginFFFFFF" value='<?php
                                            $date2 = "$rows[date_modif]";

                                            $annee2 = substr($date2, 0, 4);
                                            $mois2 = substr($date2, 5, 2);
                                            $jour2 = substr($date2, 8, 2);

                                            echo "$jour2-$mois2-$annee2";
                                            ?>
                                                   '>
                                        </td>
                                        <td class="loginFFFFFF" width="5%">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="600" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
                        <tr>
                            <td class="loginFFCC66">

                                <table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">

                                    <tr>

                                        <td class="loginFFFFFFdroit" width="4%"><img src="../zimages/verou.gif" width="25" height="26"></td>
                                        <td class="loginFFFFFFdroit" width="11%" align="left">
                                            <div align="left"><?php echo "niveau $rows[nivo_conf]"; ?></div>
                                        </td>
                                        <td class="loginFFFFFF" width="80%">

                                            <input type="text" name="textfield323" size="65" class="loginFFFFFF" value="<?php $tititre = stripslashes($rows[titre_art]);
                                            echo"$tititre"; ?>">
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="1" cellspacing="4" cellpadding="0">
                                    <tr>
                                        <td class="txttabl" valign="top"><?php $txt1 = stripslashes($rows[txt_1]);
                                            echo"$txt1"; ?></td>
                                        <td class="loginFFFFFF" width="72" align="center" valign="middle"><img src="../imgarticle/<?php echo $rows[img_1_nom] ?>" width="72" height="71" alt="<?php echo $rows[img_1_alt] ?>"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="1" cellspacing="4" cellpadding="0">
                                    <tr>
                                        <td class="txttabl" valign="top"><?php $txt2 = stripslashes($rows[txt_2]);
                                            echo"$txt2"; ?></td>
                                        <td class="loginFFFFFF" width="72" align="center" valign="middle"><img src="../imgarticle/<?php echo $rows[img_2_nom] ?>" width="72" height="71" alt="<?php echo $rows[img_1_alt] ?>"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <script language="JavaScript">
                                <!--
                                    function MM_goToURL() { //v3.0
                                        var i, args = MM_goToURL.arguments;
                                        document.MM_returnValue = false;
                                        for (i = 0; i < (args.length - 1); i += 2)
                                            eval(args[i] + ".location='" + args[i + 1] + "'");
                                    }

                                    function MM_openBrWindow(theURL, winName, features) { //v2.0
                                        window.open(theURL, winName, features);
                                    }
                                //-->
                                </script>
                                <table width="100%" border="1" cellspacing="4" cellpadding="0">
<?php liens_court($num) ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="loginFFCC66">
                                <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                    <tr>
                                        <td bordercolor="#000000" class="loginFFCC66">les commentaires
                                            de news</td>
                                        <td class="loginFFFFFFdroit">
<?php if ($id_user != "") {
    echo"<a href=\"../popup/modif_comment.php?num=$num&taille=$rows[taille]\"><img src=\"../zimages/ajoucoment-j.gif\" width=\"130\" height=\"20\" border=0></a>";
} ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="1" cellspacing="4" cellpadding="0" >
                                    <tr>
                                        <td class="txttabl">liste des commentaires </td>
                                    </tr>
                                </table>
                                <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF">
                                    <tr>
                                        <td class="txttabl" width="20%">auteur</td>
                                        <td class="txttabl">commentaire</td>
                                        <td class="txttabl" width="20%">date</td>
                                    </tr>
<?php commentaire($num) ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="loginFFCC66droit"><!-- #BeginLibraryItem "/Library/fermer.lbi" --><a href="javascript:;" onClick="window.close()"></a><a href="javascript:;" onClick="window.close()"><img src="../zimages/fermer-j.gif" width="130" height="20" border="0"></a><!-- #EndLibraryItem --></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>