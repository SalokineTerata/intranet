<?php

header('Location: cadre.php');

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ('../lib/session.php');         //Récupération des variables de sessions
        include ('../lib/functions.php');       //On inclus seulement les fonctions sans construire de page
        include ('functions.php');              //Fonctions du module
        echo '
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ';

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ('../lib/session.php');         //Récupération des variables de sessions
//        include ('../lib/debut_page.php');      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ('./$menu');
//        }
//        else
//        {
//           include ('./menu_principal.inc');    //Sinon, menu par défaut
//        }
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'border=1 '
        . 'width=100% '
        . 'class=contenu '
;

/*
  Récupération des données MySQL
 */
//   Exemple: mysql_table_load('nom_de_ma_table');


/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case 'pdf':
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = 'Arial';
        $t1_police = $police_standard;
        $t1_style = 'B';
        $t1_size = '12';

        $t2_police = $police_standard;
        $t2_style = 'B';
        $t2_size = '11';

        $t3_police = $police_standard;
        $t3_style = 'BIU';
        $t3_size = '10';

        $contenu_police = $police_standard;
        $contenu_style = '';
        $contenu_size = '8';

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array('print', 'copy'));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo '
             <form method=' . $method . ' action=' . $page_action . '>
             <input type=hidden name=action value=$action>

             <' . $html_table . '>
             <tr class=titre_principal><td>

                 Module Modèle à partir duquel vous pouvez créer de nouveaux modules<br>
                 Il constitue la \'\'SPECIFICATION\'\' à respecter.<br>

             </td></tr>
             <tr><td>

                 &nbsp&nbsp&nbsp&nbsp
                 Voici le Module permettant de créer d\'autres modules.<br>
                 <br>
                 Comment installer un nouveau module ?<br>
                 - Copier /template<br>
                 - Déclarer le module dans la table MYSQL `intranet_modules`<br>
                 - Configurer les droits d\'accès<br>
                 - Effectuer la migration de intranet.dev.agis.fr vers intranet.agis.fr<br>
                 <br>
                 Pensez à optimiser, centraliser et commenter votre code au maximum !<br>
                 Boris - 2003.08.12<br>
                 <br>
                 <br>
                 <a href=\'readme.txt\'>Télécharger le ficher readme.txt</a>

             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value=\'Enregistrer\'>
                 </center>

             </td></tr>
             </table>

             </form>

<table width=780 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td width=150 valign=top bgcolor=#FFCC66>
';
        if ($id_type == 1) {
            include('menunews.php');
        }
        if ($id_type == 2) {
            include('menunews.php');
        }
        if ($id_type == 3) {
            include('menunews.php');
        }

        echo '
      &nbsp; </td>
    <td valign=top>
      <p class=loginFFCC66>&nbsp;</p>
      <p class=loginFFCC66>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td width=33% height=80>
';
        if ($id_type == 4) {
            echo '<div align=center>
      <a href=gestion_salaries1.php?repere=1>
      <img src=../images-index/grosadmin.gif width=197 height=54 border=0>
      </a>
      </div>
      ';
        }

        echo '</td>
     <td width=34%>
';
        if ($id_type == 4) {
            echo '<div align=center><a href=gestion_public1.php?repere=2>
      <img src=../images-index/grosadmin2.gif width=197 height=54 border=0>
      </a></div>
      ';
        }
        echo '</td>
     <td width=33%>
     ';

        if ($id_type == 4) {
            echo '<div align=center><a href=../news/crea_articlece.php?repere=3>
      <img src=../images-index/grosadmin2.gif width=197 height=54 border=0>
      </a></div>
      ';
        }

        echo '
           </td>
        </tr>
      </table>
<form method=post action=administration_post.php>
<table>
<tr>
    <td>

    </td>
<tr>
</table>
<!input type=submit value=Valider>
</form>
      <p align=center>&nbsp;</p>
    </td>
  </tr>
</table>
</body>
</html>
';




        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ('../lib/fin_page.inc');

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>