<?php


include("../inc/php.php");

//$autologin = null;
//$enable_autologin = false;

$autologin = Lib::isDefined("autologin");
$enable_autologin = Lib::isDefined("autologin");

//if ($conf->exec_debug) {
//    echo "<h3>Mode Debugger</h3>";
//}

//Autologin
if (!$autologin and $enable_autologin == 1) {

    $autologin = $_GET["autologin"];
    $enable_autologin = $_GET["enable_autologin"];

    echo "
Pour accéder à l'intranet en mode <b>Authentification automatique</b>, veuillez configurer votre navigateur Internet Explorer de la manière suivante:<br>
<br>
1. Aller dans Outils > Options Internet > Sécurité:<br>
2. Sélectionner \"Sites de confiance\"<br>
3. Cliquez sur le bouton \"Sites\"<br>
4. Ajouter *.agis.fr<br>
5. Décochez \"Exiger un serveur sécurisé (https) pour tous les sites de cette zone\"<br>
6. Validez en cliquant sur le bouton \"Fermer\"<br>
7. Cliquez sur \"personnaliser le niveau\"<br>
8. Aller dans \"Contrôles ActiveX et plug-ins\"<br>
9. Activer \"Contrôles d'initialisation et de scripts ActiveX non marqué comme sécurisés pour l'écriture de script\"<br>
10. Fermer et réouvrir le navigateur.<br>
<br>
<br>
<br>
Sinon, accéder à l'<a href=index.php> intranet en vous authentifiant ici</a><br>
<br>
<br>
<br>

";
?>
<script type="text/javascript">
        <!--
        //Récupération de l'utilisateur
        var wshell = new ActiveXObject("wscript.shell");
        var currentlogin = wshell.ExpandEnvironmentStrings("%USERNAME%");
        window.location.replace("../index.php?autologin=" + currentlogin);
        //-->
    </script>
<?php

    $title = "Intranet Agis - Initialisation de la connexion";


    echo "<html>";
    echo "<head>";
    echo "<title>$title</title>";

    echo "<link rel=stylesheet href=../lib/css/$css_intranet_module type=text/css>";
    echo "</head>";
//} else {

    $req = "SELECT * FROM ".$globalConfig->mysql_table_authentification." WHERE (login = '$autologin')";
    //echo $req;
    $q1 = DatabaseOperation::query($req);
    //"$autologin TEST".mysql_num_rows($q1);
    if (mysql_num_rows($q1)) {
        $rows = mysql_fetch_array($q1);
        $prenom = $rows["prenom"];
        $id_user = $rows["id_user"];
        $id_catsopro = $rows["id_catsopro"];
        $id_service = $rows["id_service"];
        $id_type = $rows["id_type"];
        $nom_famille_ses = $rows["nom"];
        $mail_user = $rows["mail"];
        $lieu_geo = $rows["lieu_geo"];
        $portail_wiki_salaries = $rows["portail_wiki_salaries"];

        $_SESSION["pass"]=$pass;
        $_SESSION["nom_famille_ses"]=$nom_famille_ses;
        $_SESSION["login"]=$login;
        $_SESSION["prenom"]=$prenom;
        $_SESSION["id_user"]=$id_user;
        $_SESSION["id_catsopro"]=$id_catsopro;
        $_SESSION["id_service"]=$id_service;
        $_SESSION["id_type"]=$id_type;
        $_SESSION["num_log"]=$num_log;
        $_SESSION["position"]=$position;
        $_SESSION['bdd']=$bdd;
        $_SESSION['mail_user']=$mail_user;
        $_SESSION['lieu_geo']=$lieu_geo;
        $_SESSION['portail_wiki_salaries']=$portail_wiki_salaries;

        /* --------------------------------------------------------------
          Appel de la page qui définit les droits d'accès de l'utilisateur
          dans l'ensemble des pages des modules
          -------------------------------------------------------------- */
        include ("lib/droits_acces.php");

        /* -------------------------------------------------------------
          Variables définissant que l'utilisateur est sur l'Intranet Agis
          cette variable est utile lorsque l'utilisateur utilie des
          applications autres
          ------------------------------------------------------------- */
        //Permet à phpMyAdmin d'identifier l'Intranet
        $application_courante = 'intranet.agis.fr';
        //session_register('application_courante');
        $_SESSION["application_courante"]=$application_courante;

        /* --------------------------------------------
          Utilisé pour renvoyer un code d'erreur général
          --------------------------------------------/*
          session_register('erreur');
          $erreur=0;
         */
        /* creation de la ligne user dans la table log */
        $req = DatabaseOperation::query("insert into log (id_user, date) values('$id_user', NOW())");
        $ng = DatabaseOperation::query("select * from log");
        $num_log = mysql_num_rows($ng);

        /* --- redirection si ok sur groupe et service propre --- */
        //$q1 = DatabaseOperation::query("SELECT * FROM $mysql_table_authentification WHERE ((login = '$login') AND (pass = '$pass'))");
    }
}


//Redirection vers la page par défaut du site
//header("Location: ../news/rapide.php");
header("Location: ../fta/index.php");
?>

