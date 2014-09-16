<?php
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
switch($output)
{

  case 'visualiser':
       //Inclusions
       include ("../lib/session.php");         //Récupération des variables de sessions
       include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
       include ("functions.php");              //Fonctions du module
       echo "
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ";

  //break;
  case 'pdf':
  break;

  default:
        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
      require_once '../inc/main.php';
      print_page_begin($disable_full_page, $menu_file);

//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }

}//Fin de la sélection du mode d'affichage de la page


/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
   $page_action=$page_default."_post.php";
   $page_pdf=$page_default."_pdf.php";
   $action = 'valider';          //Action proposée à la page _post.php
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "        //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/
//  Exemple: mysql_table_load('nom_de_ma_table');

/* echo $NOM_date_echeance_fta;
echo $date_echeance_fta;
echo "<br>";
echo $NOM_nomprod;
echo $nomprod;
 */

//Sélection des FTA qui nous concerne pour la modification
$req = "SELECT id_fta FROM fta, access_arti2 "
         . "WHERE fta.id_access_arti2=access_arti2.id_access_arti2 "
         . "ORDER BY LIBELLE "
         ;

$result=DatabaseOperation::query($req);

//Création du tableau de présentation des fiches en cours de modification
$liste_fta="<$html_table>";
$liste_fta_entete=0; //Indication comme quoi il faudra créer l'entête du tableau
while ($rows=mysql_fetch_array($result))
{

  //Récupération des informations necessaires
  $id_fta=$rows['id_fta'];
  mysql_table_load('fta');
  $numft; //Varible récupérée
  mysql_table_load('access_arti2');

  //Construction de l'entête de tableau
  if(!$liste_fta_entete)
  {
      $liste_fta.="
             <tr class=titre_principal>
                 <td width=20></td>
                 <td>$NOM_id_fta</td>
                 <td>$NOM_LIBELLE</td>
             </tr>
             ";
      $liste_fta_entete=1; //Il ne sera plus necessaire de recréer l'entête
  }

  //Construction du contenu du tableau
  $liste_fta.="
             <tr>
                 <td>
                 <a href=modification_fiche.php?id_fta=$id_fta>
                 <img src=../lib/images/next.png width=20 height=20 border=0/>
                 </a>
                 </td>
                 <td>$id_fta</td>
                 <td>$LIBELLE</td>
             </tr>
             ";

}
$liste_fta.="</table>";

/*
     Sélection du mode d'affichage
*/

switch ($output)
{

/*************
Début Code PDF
*************/
case "pdf":
         //Constructeur
         $pdf=new XFPDF();

         //Déclaration des variables de formatages
         $police_standard="Arial";
         $t1_police=$police_standard;
         $t1_style="B";
         $t1_size="12";

         $t2_police=$police_standard;
         $t2_style="B";
         $t2_size="11";

         $t3_police=$police_standard;
         $t3_style="BIU";
         $t3_size="10";

         $contenu_police=$police_standard;
         $contenu_style="";
         $contenu_size="8";

         $chapitre=0;
         $section=0;
         include($page_pdf);
         //$pdf->SetProtection(array("print", "copy"));
         $pdf->Output(); //Read the FPDF.org manual to know the other options

break;


/***********
Fin Code PDF
***********/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/




/**************
Début Code HTML
**************/
default:


         echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>

             <$html_table>
             <tr class=titre_principal><td>

                 Liste des Fiches Techniques Articles

             </td></tr>
             <tr><td>

                 $liste_fta

             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value='Enregistrer'>
                 </center>

             </td></tr>
             </table>

             </form>
             ";
/*
        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>


             <$html_table>
             <tr class=titre_principal><td>

                 Liste des Fiches Techniques Articles

             </td></tr>
             <tr><td>
              <tr widht=100%>
              <td class=texteFFFFFF colspan=3> Il est possible de combiner un segment avec une gamme pour obtenir une sélection précise </td>
              </tr>
              <tr>
                <td class=texteFFE5B2 width=50%>
                  <center>
                    segment d'activit&eacute;
                  </center>
                </td>
                <td class=texteFFE5B2 width=50%>
                  <div align=left>
                  ".
                  liste_deroulante_2phrase('segment', 'numseg', 'segdesc', 'numseg', $numseg, '')
                  ."
                  </div>
                </td>
              </tr>
              <tr align=center valign=middle>
                <td class=texteFFE5B2>nom de la gamme</td>
                <td class=texteFFE5B2 align=left>
                  <div align=left></div>
                  ".
                  liste_deroulante_2phrase('gamme', 'numgam', 'gamdesc', 'numgam', $numgam, '')
                  ."
                  </td>
              </tr>
              <tr align=center valign=middle>
                <td class=texteFFE5B2 height=13>nom du produit</td>
                <td class=texteFFE5B2 height=13 align=left>
                  <div align=left>
                    <input type=text name=nomprod>
                  </div>
                </td>
              </tr>
              <tr align=center valign=middle>
                <td class=texteFFFFFF colspan=2>
                  <center>
                    <input type=image src=images/rechercher.gif width=138 height=28 border=0>
                    <input type=hidden  name=chercher value=chercher>
                  </center>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class=titresynthese>&nbsp;</td>
        </tr>
        ";
        // On affiche que si il y a des resultats de recherche. Rien sinon
        if ($afficheresultat=='oui')
        {
              echo ("<tr>\n");
              echo ("          <td class=\"titresynthese\"><img src=\"images/fleche.gif\" width=\"12\" height=\"19\">r&eacute;sultats de la recherche</td>\n");
              echo ("        </tr>\n");
              echo ("        <tr>\n");
              echo ("          <td><img src=\"images/espaceur.gif\" height=\"10\"></td>\n");
              echo ("        </tr>\n");
          $result=DatabaseOperation::query($req);
          $num=mysql_num_rows($result);

              if ($num!=0)
              {
                echo ("        <tr>\n");
                echo ("          <td>\n");
                echo ("            <center>\n");
                echo ("              <table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"texteFFE5B2\">\n");
                echo ("                <tr>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      site\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      segment\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      gamme\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      code <br>infologic\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      nom du<br>produit\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td>\n");
                echo ("                    <center>\n");
                echo ("                      date de<br>\n");
                echo ("                      validation\n");
                echo ("                    </center>\n");
                echo ("                  </td>\n");
                echo ("                  <td width=\"138\" height=\"28\">&nbsp;</td>\n");
                echo ("                </tr>\n");
      // Création du tableau de resultats
                $i=0;
                $color='texteFFE5B2';
                while ($i<$num)
                {
                  if ($color=='texteFFE5B2')
                    $color='texteFFFFFF';
                  else
                    $color='texteFFE5B2';

                  $numft=mysql_result($result, $i, numft);
                  $infologic=mysql_result($result, $i, infologic);
                  $siteorig=mysql_result($result, $i, siteorig);
                  $numgam=mysql_result($result, $i, numgam);
                  $numseg=mysql_result($result, $i, numseg);
                  $nomprod=mysql_result($result, $i, nomprod);
                  $date_val=mysql_result($result, $i, date_val);


                  $nomprod=stripslashes($nomprod);


                  $req2="select geo from geo where id_geo='$siteorig'";
                  $result2=DatabaseOperation::query($req2);
                  $geo=mysql_result($result2, 0, geo);
                  $req2="select gamdesc, segdesc from gamme, segment
                  where numgam='$numgam' and numseg='$numseg'";
                  $result2=DatabaseOperation::query($req2);
                  $gamdesc=mysql_result($result2, 0, gamdesc);
                  $segdesc=mysql_result($result2, 0, segdesc);

                  $date_val=affiche_date($date_val);

                  echo ("                <tr>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$geo&nbsp;</td>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$segdesc&nbsp;</td>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$gamdesc&nbsp;</td>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$infologic&nbsp;</td>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$nomprod&nbsp;</td>\n");
                  echo ("                  <td height=\"29\" class=\"$color\">$date_val&nbsp;</td>\n");
                  echo ("                  <td width=\"138\" height=\"28\" class=\"$color\">\n");
                  echo ("                    <a href=\"afffichevpdf.php?numft=$numft&codeo=consult\">\n");
                  echo ("                    <img src=\"images/ficheaff.gif\" width=\"138\" height=\"28\" border=\"0\">\n");
                  echo ("                   </td>\n");
                  echo ("                </tr>\n");
                  $i++;
                }
                echo ("              </table>\n");
                echo ("            </center>\n");
                echo ("          </td>\n");
                echo ("        </tr>\n");
                echo ("      </table>\n");
                echo ("    </td>\n");
                echo ("  </tr>\n");
              }
              else
              {
                echo ("        <tr>\n");
                echo ("          <td>\n");
                echo ("            <center>\n");
                echo ("<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"texteFFE5B2\">\n");
                echo ("<tr><td>Il n'y a aucun résultat.</td></tr></table>\n");
                echo ("    </td>\n");
                echo ("  </tr>\n");
              }
        }
      echo "
           </table>
           </form>
           ";
*/

/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");

/************
Fin Code HTML
************/

}//Fin du switch de sélection du mode d'affichage

?>