<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
//print_page_begin($disable_full_page, $menu_file);
//print_page_begin($disable_full_page, $menu_file);
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/functions.php");
//include ("../$module/functions.php");              //Inclusion des fonctions propres au module


/*
  if (isset($menu))
  include ("./$menu");
  else
  include ("./menu_principal.inc");

  /*************
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
//$page_action=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4')."_post.php";
$page_action = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4') . ".php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=all "
;
$output = 'pdf';
$disabled = "disabled";



/*
  Récupération des données MySQL
 */
$id_fta = Lib::getParameterFromRequest("id_fta"); //Variable passé en URL
//$id_fta=1;



//Conditionnement
/*
$arrayCommentaireEmballage = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                "SELECT " . FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaChapitreModel::TABLENAME . " "
                . " WHERE ( " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                . " = " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME . " ) "
                . " AND ( ( " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA . " = '" . $id_fta . "' "
                . " AND (" . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . " = 'emballage' "
                . " OR " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . " = 'emballage_colis' "
                . " ) )"
);
if ($arrayCommentaireEmballage){
    
    $commentaire_emballage = mysql_result($result, 0, "commentaire_suivi_projet");
}

//Conservation
if ($id_annexe_environnement_conservation) {
    mysql_table_load("annexe_environnement_conservation");
    $conservation = $nom_annexe_environnement_conservation . ": " . $temperature_annexe_environnement_conservation;
}

//Agrément CE
$id_site = $Site_de_production;
$req = "SELECT id_geo FROM access_arti2, geo "
        . "WHERE id_fta=" . $id_fta . " "
        . "AND Site_de_production=id_site "
;
$result_temp = DatabaseOperation::query($req);
$id_geo = mysql_result($result_temp, 0, "id_geo");
mysql_table_load("geo");
$site_agrement_ce;


//Produit Transformé en France
$champ = "origine_transformation_fta";
switch (${$champ}) {
    case 2:
        $description_origine_transformation_fta = "Oui";
        break;
    default:
        $description_origine_transformation_fta = "Non";
}
*/

/* * ***********
  Début Code PDF
 * *********** */

//Configuration du Pied de page
class temp_xfpdf extends xfpdf {

    function Footer() {
        //Positionnement à 1cm du bas
        $marge_pied_page = -15;
        $this->SetY($marge_pied_page);
        //Police Arial italique 6
        $this->SetFont('Arial', 'I', 6);

        //Commentaire de bas de page statique
        //$commentaire = "AGIS-SA Siège social: BP 931 - 802, rue Sainte Geneviève - ZI de Courtine 84 091 AVIGNON CEDEX 09"
        //           . "\nTel: 04.90.80.99.99 - Fax: 04.90.80.99.80 - Fax Gestion des Ventes: 04.74.05.32.68"
        //         ;
        //Commentaire de bas de page dynamique
        $_SESSION["id_geo"] = 5;
        mysql_table_load("geo");
        $commentaire = $_SESSION["adresse_geo"] . "\nTel: " . $_SESSION["telephone_geo"] . " - Fax : " . $_SESSION["fax_geo"] . " - Fax Gestion des Ventes : " . $_SESSION["fax_commercial_geo"]
                . "\nInformations susceptibles d'être modifiées, seule l'étiquette fait foi";

        //Numéro de page centré
        //$this->MultiCell(200,3,$commentaire.'Page '.$this->PageNo(). ' sur {nb}',0,'C');
        $this->MultiCell(200, 3, $commentaire, 0, 'L');

        $this->SetY($marge_pied_page);
        $this->SetX(180);
        $this->MultiCell(0, 3, "\nPage " . $this->PageNo() . " sur {nb}", 0, 'C');
    }

}

//Constructeur
$pdf = new temp_xfpdf();
$pdf->AliasNbPages(); //Remplace {nb} par le nombre total de page
//Déclaration des variables de formatages
$police_standard = "Arial";
$t1_police = $police_standard;
$t1_style = "B";
$t1_size = 12;
$t1_bgcolor = "150,250,230";

$t2_police = $police_standard;
$t2_style = "B";
$t2_size = 11;
$t2_interligne = 7;
$t2_bgcolor = "150,250,230";

$t3_police = $police_standard;
$t3_style = "";
$t3_size = 9;
$t3_interligne = 5;
$t3_largeur = 40;
$t3_format = array($t3_police, $t3_style, $t3_size, $t3_interligne, $t3_largeur);
$t3_bgcolor = "150,250,230";

$t4_size = 6;

$contenu_police = $police_standard;
$contenu_style = "B";
$contenu_size = 10;
$contenu_interligne = 5;
$contenu_largeur = 60;
$contenu_format = array($contenu_police, $contenu_style, $contenu_size, $contenu_interligne, $contenu_largeur);

$chapitre = 0;
$section = 0;
$marge_gauche = 10;
$marge_droite = 10;
$pdf->SetRightMargin($marge_droite);
$pdf->SetLeftMargin($marge_gauche);

//Informations Générales
$chapitre++;
$section = 0;
include ("fta_pdf.php");
//include ("saisie_commun_pdf.php");
//Informations Spécifique
$chapitre++;
$section = 0;
/* include ("saisie_specifique.php");
  include ("saisie_specifique_pdf.php");
 */

//Informations Zone de Pêche
/*
  switch($origine_produit_matiere_premiere==1 and $id_matiere_premiere_filiere==3)
  {
  case 1: //Animaux sauvages
  $chapitre++;
  $section=0;
  include ("saisie_zone_peche_pdf.php");
  break;
  }
 */
//Informations Contaminants
$chapitre++;
$section = 0;
//include ("saisie_association_contaminant.php");
//Informations Ingrédients
$chapitre++;
$section = 0;
//include ("visualiser_ingredient.inc.php");
//Informations Alergène
$chapitre++;
$section = 0;
//include ("saisie_composant_allergene.php");


/*
  //Informations Ethique Clients
  $pdf->AddPage();
  $pdf->Bookmark('Ethique Clients');
  ob_start();
  //       include ("saisie_ethique_client.php");
  $htmlbuffer=ob_get_contents();
  ob_end_clean();
  $pdf->WriteHTML($htmlbuffer);

  //Informations Historique
  $pdf->AddPage();
  $pdf->Bookmark('Historique');
  ob_start();
  //       include ("visualiser_historique.inc.php");
  $htmlbuffer=ob_get_contents();
  ob_end_clean();
  $pdf->WriteHTML($htmlbuffer);



  /***********
  Fin Code PDF
 * ********* */

$pdf->SetProtection(array("print"));

switch ($sendto) {
    case 0://Le fichier n'est pas à envoyer donc on l'affiche à l'écran
        $pdf->Output(); //Read the FPDF.org manual to know the other options
        break;

    case 1://Le fichier pdf doit être envoyé par mail
        //Définition des Variables
        //Nom du fichier pièce jointe
        $tmp_filename = "Agis-FTMP"
                . $id_dossier_matiere_premiere
                . "v"
                . $version_matiere_premiere
                . ".pdf"
        ;
        $tmp_pdf = $pdf->Output($tmp_file, "S");
        $text = stripslashes($text);

        //Création du mail
        $mail = new htmlMimeMail();
        $mail->addAttachment($tmp_pdf, $tmp_filename, 'application/pdf');
        $mail->setFrom($mail_user);
        $mail->setSubject("Agis: Fiche Technique Article");
        $mail->setText($text);
        $result = $mail->send(array($adresse_to), 'smtp');
//       echo $adresse_to;
        if (!$result) {
            print_r($mail->errors);
        } else {
            $titre = "Envoi Réussi !";
            $message = "Votre mail à bien été envoyé à:<br>$adresse_to";
            $redirection = "";
            afficher_message($titre, $message, $redirection);
            //echo 'Mail sent!';
        }//echo $GLOBALS['smtp_ip'];
        break;
}

/* * *********************
  Inclusion de fin de page
 * ********************* */
//include ("../lib/fin_page.inc");
?>

