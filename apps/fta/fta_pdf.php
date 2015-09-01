<?php

/* * ***********
  Début Code PDF
 * *********** */
$ftaModel = new FtaModel($id_fta);

//Récupération des information de classification.
$tab = affichage_classification_article($id_fta, $extension);
if ($tab[0]) {
    //Rayon
    $id_element = "4"; //Recherche de l'Activité
    $extension[0] = 1; //Passage en mode recherche d'une catégorie
    $champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
    $rayon = $champ[2];

    //Activité
    $id_element = "3"; //Recherche de l'Activité
    $extension[0] = 1; //Passage en mode recherche d'une catégorie
    $champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
    $activite = $champ[2];
    if ($activite)
        $activite = " / " . $activite;

    //Marque
    $id_element = "2"; //Recherche de l'Activité
    $extension[0] = 1; //Passage en mode recherche d'une catégorie
    $champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
    $marque = $champ[2];
    if ($marque)
        $marque = " / " . $marque;

    $classification = "$rayon $activite $marque";
}
else {
    $classification = "$old_segdesc $old_gamdesc";
}
//Formatage de la date
$date_validation = recuperation_date_depuis_mysql($date_derniere_maj_fta);

//Récupération des Informations FTA
$palettisation = calcul_palettisation_fta($id_fta);
$idFtaEtat = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();
$date_derniere_maj_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA)->getFieldValue();
$ftaEtatModel = new FtaEtatModel($idFtaEtat);
$abreviation_fta_etat = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();
//Création de l'entête de la fiches techniques
$pdf->AddPage();
$pdf->Image("../lib/images/logo_agis.png", 10, 10, 20);
$pdf->SetFont($t2_police, $t2_style, $t3_size);
$pdf->SetLeftMargin(30);
$pdf->SetY(10);
$pdf->SetFillColor(150, 250, 230);

//Intitulés dynamiques
$intitule_fta = "";
$intitule_validation = "";
switch ($abreviation_fta_etat) {
    case "P":
        $intitule_fta = "PRESENTATION";
        $intitule_validation = "(Imprimé le " . date("d-m-Y") . ")";
        break;

    case "V":
        $intitule_fta = "TECHNIQUE";
        $intitule_validation = "(Validé le $date_validation)";
        break;
}
$pdf->Cell(0, $t4_size, "FICHE $intitule_fta ARTICLE - $classification  $intitule_validation", 1, 2, "C", 1);
$pdf->SetFont($police_standard, "B", "23");

$pdf->SetY($pdf->GetY() + 2);
$colonne1 = 60;
$colonne2 = 0;

//Désignation Commerciale
$champ = "designation_commerciale_fta";
$title = ${'NOM_' . $champ};
$data = strtoupper($$champ);
$title_format = $t3_format;
//$title_format[4]=10;//Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4] = 140;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
$pdf->SetY($pdf->GetY() + 2);

//Poids UVC
$marge_haute = $pdf->GetY();
$champ = "Poids_ELEM";
$title = "Poids UVC";
$data = $$champ * 1000;
$data.=" g";
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//Nombre d'Unité par UVC
$champ = "NB_UNIT_ELEM";
$title = ${'NOM_' . $champ};
$data = $$champ;
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//Nombre de Portions
$champ = "nombre_portion_fta";
$title = ${'NOM_' . $champ};
$data = $$champ;
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//EAN Article
//$pdf->SetX(250);
$pdf->SetLeftMargin(130);
$pdf->SetY($marge_haute);
$champ = "EAN_UVC";
$title = ${'NOM_' . $champ};
$data = $$champ;
$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//EAN Colis
$champ = "EAN_COLIS";
$title = ${'NOM_' . $champ};
$data = $$champ;
$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//EAN Palette
$champ = "EAN_PALETTE";
$title = ${'NOM_' . $champ};
$data = $$champ;
$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

$pdf->SetY($pdf->GetY() + 5);
$pdf->SetLeftMargin($marge_gauche);
$pdf->SetX($marge_gauche);

$pdf->SetFont($t2_police, $t2_style, $t3_size);
$pdf->Bookmark($chapitre . ' - Informations Générales');
$chapitre = $chapitre + 1;
$pdf->SetFillColor(150, 250, 230);
$pdf->Cell(0, $t4_size, 'INFORMATIONS GENERALES', 1, 1, 'C', 1);
$pdf->SetY($pdf->GetY() + 2);
$K_etat = $ftaModel->getDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION)->getFieldValue();
$id_annexe_environnement_conservation_groupe = $K_etat;
$annexeEnvironnementConservationGroupeModel = new AnnexeEnvironnementConservationGroupeModel($id_annexe_environnement_conservation_groupe);
$temperature_par_defaut_annexe_environnement_conservation_groupe = $annexeEnvironnementConservationGroupeModel->getDataField(AnnexeEnvironnementConservationGroupeModel::FIELDNAME_TEMPERATURE_PAR_DEFAUT_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE)->getFieldValue();
$NOM_K_etat = $annexeEnvironnementConservationGroupeModel->getDataField(AnnexeEnvironnementConservationGroupeModel::FIELDNAME_NOM_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE)->getFieldValue();
//Tableau de données
$data_table = array(
    //***********
    array($NOM_synoptique_valide_fta, $synoptique_valide_fta),
    //array("Conditionnement", $description_emballage),
    //array("Température de conservation", $conservation),
    array($NOM_K_etat, $temperature_par_defaut_annexe_environnement_conservation_groupe),
    array("Durée de vie garantie", ${"Durée_de_vie"} . " jours"),
    //array(${"NOM_Durée_de_vie_technique"}, ${"Durée_de_vie_technique"}),
    array($NOM_site_agrement_ce, $site_agrement_ce),
    array($NOM_origine_transformation_fta, $description_origine_transformation_fta)
);

foreach ($data_table as $information) {
    $title = $information[0];
    $data = $information[1];
    $title_format = $t3_format;
    $title_format[4] = 50;
    //$title_format[5]="R";
    $data_format = $contenu_format;
    $data_format[4] = 0;   //Personalisation de la largeur de la colonne

    fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
}

//conditionnement
$champ = "description_emballage";
$title = "Conditionnement";
$data = $$champ;
$title_format = $t3_format;
$title_format[4] = 45; //Personalisation de la largeur de la colonne
//$title_format[5]="R";
$data_format = $contenu_format;
$data_format[1] = "";
$data_format[4] = 0;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);


//conseil_rechauffage_valide_fta
$champ = "conseil_rechauffage_valide_fta";
$title = "Conseils de réchauffage";
$data = $$champ;
$title_format = $t3_format;
$title_format[4] = 45; //Personalisation de la largeur de la colonne
//$title_format[5]="R";
$data_format = $contenu_format;
$data_format[1] = "";
$data_format[4] = 0;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//Nouvelle rubrique
$pdf->SetY($pdf->GetY() + 5);
$pdf->Cell(0, 0, "", 1, 1);

//******************************************************************************
//Listes des composants
$pdf->SetFont($t2_police, $t2_style, $t3_size);
$pdf->Bookmark($chapitre . ' - Composition');
$chapitre = $chapitre + 1;
$pdf->SetFillColor(150, 250, 230);
$pdf->Cell(0, $t4_size, 'COMPOSITION DU COLIS', 1, 1, 'C', 1);
//$pdf->SetY($pdf->GetY()+2);
$pdf->SetY($pdf->GetY() + 2);

//Récupération des données
$poids_net_colis = calcul_poids_net_colis($id_fta);

//$req = "SELECT id_fta_composition FROM fta_composition WHERE id_fta='".$id_fta."' ORDER BY ordre_fta_composition, nom_fta_composition ";
$req = "SELECT id_fta_composant FROM fta_composant WHERE id_fta='" . $id_fta . "' AND is_composition_fta_composant=1 ORDER BY ordre_fta_composition, nom_fta_composition ";
$result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
foreach ($result as $rows) {
    $pdf->SetAutoPageBreak(0);

    //Chargement des données
    //$id_fta_composition=$rows["id_fta_composition"];
    $id_fta_composant = $rows["id_fta_composant"];
    $ftaComposantModel = new FtaComposantModel($id_fta_composant);

    //Préparation des données de sortie
    $nom_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->getFieldValue();
    $quantite_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION)->getFieldValue();
    $poids_fta_compositionTmp = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->getFieldValue();
    $taux_poids_composant = ($poids_fta_compositionTmp * $quantite_fta_composition) / $poids_net_colis;
    $temp_taux = round($taux_poids_composant / 10, 2);
    $poids_fta_composition = round($poids_fta_composition, 0);

    //Création de la première colonne
    //Désignation Commerciale
//      $champ="designation_commerciale_fta";
//      $title = "";
//      $data = $nom_fta_composition;
//      $title_format = $t3_format;
//      //$title_format[4]=10;//Personalisation de la largeur de la colonne
//      $data_format  = $contenu_format;
//      $data_format[2]=12;    //Personalisation de la taille
//      $data_format[4]=                       140;   //Personalisation de la largeur de la colonne
//      fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
//      $pdf->SetY($pdf->GetY()+2);

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont($t2_police, $t2_style, $t3_size);
    $txt = $nom_fta_composition . " (" . $poids_fta_composition . " g)";
    //$pdf->Cell(0,$contenu_size,$nom_fta_composition." (".$poids_fta_composition." g)");
    $pdf->MultiCell(0, 5, $txt, $border = 0, $align = 'C', $fill = 0);
    $marge_haute = $pdf->GetY();
//      $taille_nom_fta_composition=strlen($nom_fta_composition);
//      $data_table=array(
//                        //***********
//                        array("", $nom_fta_composition." (".$poids_fta_composition." g)" )
//                       );
//      foreach ($data_table as $information)
//      {
//         $title = $information[0];
//         $data = $information[1];
//         $title_format = $t3_format;
//         $title_format[4]=10;
//         $title_format[3]=5;   //Personalisation de l'interligne
//         $data_format  = $contenu_format;
//         $data_format[4]=200;   //Personalisation de la largeur de la colonne
//         $data_format[3]=$title_format[3];   //Personalisation de l'interligne
//         $data_format[5]="C";   //Alignement
//         //$data_format[2]="8";
//         fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
//      }
    $marge_basse1 = $pdf->GetY();

    //Création de la deuxième colonne
    $pdf->SetY($marge_haute);
    $marge_deuxieme_colonne = $marge_gauche;
    $pdf->SetX($marge_deuxieme_colonne);
    $pdf->SetLeftMargin($marge_deuxieme_colonne);

    //Liste des composants
    //$champ="ingredient_fta_composition";
    $title = "";
    if ($taille_nom_fta_composition > 25) {
        $data = "\n";
    } else {
        $data = "";
    }
    $data .= $ingredient_fta_composition;
    if ($ingredient_fta_composition1) {
        $data .= "\n" . $ingredient_fta_composition1;
    }
    $title_format = $t3_format;
    //$title_format[4]+=20;//Personalisation de la largeur de la colonne
    $data_format = $contenu_format;
    $data_format[1] = "";
    $data_format[4] = 0;   //Personalisation de la largeur de la colonne
    $data_format[2] = "";
    fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

    $marge_basse2 = $pdf->GetY();

    if ($marge_basse2 > $marge_basse1) {
        $new_marge = $marge_basse2;
    } else {
        $new_marge = $marge_basse1;
    }

    $pdf->SetY($new_marge);
    $pdf->SetLeftMargin($marge_gauche);
    $pdf->SetX($marge_gauche);
    $pdf->SetAutoPageBreak(1, 40);

    $pdf->Cell(0, 0, "", 1, 1);
    $pdf->SetY($pdf->GetY() + 2);
    //$pdf->SetAutoPageBreak(0);
}//Fin du parcours des composants

if ($abreviation_fta_etat <> "P") {
//Conditionnement (1ère Colonne)

    $pdf->SetAutoPageBreak(1, 50);
    $pdf->SetY($pdf->GetY() + 2);
    $pdf->Cell(0, 0, "", 1, 1);
    $marge_haute = $pdf->GetY();

    $pdf->SetAutoPageBreak(0);
    $pdf->SetFont($t2_police, $t2_style, $t3_size);
    $pdf->Bookmark($chapitre . ' - Conditionnement');
    $chapitre = $chapitre + 1;
    $pdf->SetFillColor(150, 250, 230);
    $pdf->Cell(100, $t4_size, 'CONDITIONNEMENT', 1, 1, 'C', 1);
    $pdf->SetY($pdf->GetY() + 2);

    //Conditionnement UVC
    //Affichage des données
    $data_table = array(
        //***********
        array("Dimension UVC", $palettisation["dimension_uvc"] . " mm"),
        array("Dimension Colis", $palettisation["dimension_colis"]),
        array("PCB", $palettisation["pcb"]),
        array("Poids net Colis", $palettisation["colis_net"] . " kg"),
        array("Poids brut Colis", $palettisation["colis_brut"] . " kg")
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
        $title_format = $t3_format;
        $title_format[4] = 10;
        //$title_format[5]="R";
        //$title_format[3]=10;   //Personalisation de l'interligne
        $data_format = $contenu_format;
        $data_format[4] = 80;   //Personalisation de la largeur de la colonne
        //$data_format[3]=10;   //Personalisation de l'interligne
        fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
    }
    $marge_basse1 = $pdf->GetY();

//Palettisation (2ème Colonne)
    $pdf->SetY($marge_haute);
    $marge_deuxieme_colonne = 100;
    $pdf->SetX($marge_deuxieme_colonne);
    $pdf->SetLeftMargin($marge_deuxieme_colonne);

    $pdf->SetFont($t2_police, $t2_style, $t3_size);
    $pdf->Bookmark($chapitre . ' - Palettisation');
    $chapitre = $chapitre + 1;
    $pdf->SetFillColor(150, 250, 230);
    $pdf->Cell(0, $t4_size, 'PALETTISATION', 1, 1, 'C', 1);
    $pdf->SetY($pdf->GetY() + 2);


    //Affichage des données
    $data_table = array(
        //***********
        array("Nombre de colis par couche", $palettisation["colis_couche"]),
        array("Nombre de couche par palette", $palettisation["couche_palette"]),
        array("Nombre total de colis par palette", $palettisation["total_colis"]),
        array("Dimension palette", $palettisation["dimension_palette"]),
        array("Hauteur palette", $palettisation["hauteur_palette"] . " m"),
        array("Poids Net palette", $palettisation["palette_net"] . " kg"),
        array("Poids Brut palette", $palettisation["palette_brut"] . " kg")
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
        $title_format = $t3_format;
        $title_format[4] = 10;
        //$title_format[5]="R";
        //$title_format[3]=10;   //Personalisation de l'interligne
        $data_format = $contenu_format;
        $data_format[4] = 80;   //Personalisation de la largeur de la colonne
        //$data_format[3]=10;   //Personalisation de l'interligne
        fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
    }
    $marge_basse2 = $pdf->GetY();

    $pdf->SetAutoPageBreak(1, 15);
    $pdf->SetLeftMargin($marge_gauche);
    $pdf->SetX($marge_gauche);
    $pdf->Cell(0, 0, "", 1, 1);
    //$pdf->SetAutoPageBreak(0);
    $pdf->SetY($pdf->GetY() + 2);
}

//Informations supplémentaires
if (!$presentation_fta and ! $apres_ouverture_fta and ! $remarque_fta and ! $origine_matiere_fta and ! $allergenes_matiere_fta) {
    
} else {
    $pdf->SetFont($t2_police, $t2_style, $t3_size);
    $pdf->Bookmark($chapitre . ' - Informations Supplémentaires');
    $chapitre = $chapitre + 1;
    $pdf->SetFillColor(150, 250, 230);
    $pdf->Cell(0, $t4_size, 'INFORMATIONS SUPPLEMENTAIRES', 1, 1, 'C', 1);
    $pdf->SetY($pdf->GetY() + 2);
    $data_table = array(
        //***********
        array($NOM_presentation_fta, $presentation_fta),
        array($NOM_apres_ouverture_fta, $apres_ouverture_fta),
        array($NOM_remarque_fta, $remarque_fta),
        array($NOM_origine_matiere_fta, $origine_matiere_fta),
        array($NOM_allergenes_matiere_fta, $allergenes_matiere_fta)
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
        $title_format = $t3_format;
        $title_format[4] = 50;
        //$title_format[3]=10;   //Personalisation de l'interligne
        $data_format = $contenu_format;
        $data_format[4] = 0;   //Personalisation de la largeur de la colonne
        //$data_format[3]=10;   //Personalisation de l'interligne
        fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
    }
}
$pdf->SetAutoPageBreak(1, 40);
/*
  <!------------------------------------------------------------------->



  /***********
  Fin Code PDF
 * ********* */
?>
