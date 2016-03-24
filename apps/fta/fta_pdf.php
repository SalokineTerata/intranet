<?php

/* * ***********
  Début Code PDF
 * *********** */

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
//Récupération des Informations FTA
$ftaModel = new FtaModel($id_fta);
$siteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
$description_origine_transformation_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME)->getFieldValue();
$idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
switch ($description_origine_transformation_fta) {
    case "0":
        $description_origine_transformation_fta = "Non";

        break;
    case "1":
    case "2":
        $description_origine_transformation_fta = "Oui";

        break;
}

$NOM_origine_transformation_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME)->getFieldLabel();
$synoptique_valide_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESCRIPTION_DU_PRODUIT)->getFieldValue();
$NOM_synoptique_valide_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESCRIPTION_DU_PRODUIT)->getFieldLabel();
$geoModel = new GeoModel($siteDeProduction);
$site_agrement_ce = $geoModel->getDataField(GeoModel::FIELDNAME_SITE_AGREMENT_CE)->getFieldValue();
$NOM_site_agrement_ce = $geoModel->getDataField(GeoModel::FIELDNAME_SITE_AGREMENT_CE)->getFieldLabel();
//Récupération des information de classification.
//Rayon
$IdFtaClassification2 = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
if ($IdFtaClassification2) {
    $rayon = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($IdFtaClassification2, ClassificationFta2Model::FIELDNAME_ID_RAYON);


//Activité
    $activite = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($IdFtaClassification2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);
    if ($activite) {
        $activite = " / " . $activite;
    }

//Marque
    $marque = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($IdFtaClassification2, ClassificationFta2Model::FIELDNAME_ID_MARQUE);
    if ($marque) {
        $marque = " / " . $marque;
    }
}
$classification = "$rayon $activite $marque";

$date_derniere_maj_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA)->getFieldValue();

//Formatage de la date
$date_validation = changementDuFormatDeDate($date_derniere_maj_fta);

//Récupération des Informations FTA
$returnUVC = $ftaModel->buildArrayEmballageTypeUVC();
$returnParColis = $ftaModel->buildArrayEmballageTypeParColis();
$returnDuColis = $ftaModel->buildArrayEmballageTypeDuColis();
$returnPallettes = $ftaModel->buildArrayEmballageTypePalette();
$idFtaEtat = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();
$ftaEtatModel = new FtaEtatModel($idFtaEtat);
$globalConfig = new GlobalConfig();
$logo = $globalConfig->getConf()->getApplicationLogoPDF();
//Création de l'entête de la fiches techniques
$pdf->AddPage();
$pdf->Image("../lib/images/" . $logo, 10, 10, 20);
$pdf->SetFont($t2_police, $t2_style, $t3_size);
$pdf->SetLeftMargin(30);
$pdf->SetY(10);
$pdf->SetFillColor(150, 250, 230);

//Intitulés dynamiques
$intitule_fta = "";
$intitule_validation = "";
switch ($idFtaWorkflow) {
    case FtaWorkflowModel::ID_WORKFLOW_PRESENTATION:
        $intitule_fta = "PRESENTATION";
        $intitule_validation = "(Imprimé le " . date("d/m/Y") . ")";
        break;

    default :
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
$designation_commerciale_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
$designation_commerciale_fta_label = $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldLabel();
$title_format = $t3_format;
//$title_format[4]=10;//Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4] = 140;   //Personalisation de la largeur de la colonne
fpdf_write_data($designation_commerciale_fta_label, strtoupper($designation_commerciale_fta), $title_format, $data_format, $pdf);
$pdf->SetY($pdf->GetY() + 2);

//Poids UVC
$marge_haute = $pdf->GetY();
$Poids_ELEM = $ftaModel->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
$title = "Poids UVC";
$data = $Poids_ELEM * 1000;
$data.=" g";
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($title, $data, $title_format, $data_format, $pdf);

//Nombre d'Unité par UVC
$NB_UNIT_ELEM = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
$NB_UNIT_ELEM_label = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldLabel();
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($NB_UNIT_ELEM_label, $NB_UNIT_ELEM, $title_format, $data_format, $pdf);

//Nombre de Portions
$nombre_portion_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_PORTION_FTA)->getFieldValue();
$nombre_portion_fta_label = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_PORTION_FTA)->getFieldLabel();
$title_format = $t3_format;
//$title_format[5]="R";
$title_format[4] = 10; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($nombre_portion_fta_label, $nombre_portion_fta, $title_format, $data_format, $pdf);

//EAN Article
//$pdf->SetX(250);
$pdf->SetLeftMargin(130);
$pdf->SetY($marge_haute);
$champ = "EAN_UVC";
$EAN_UVC = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue();
$EAN_UVC_label = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldLabel();
$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($EAN_UVC_label, $EAN_UVC, $title_format, $data_format, $pdf);

//EAN Colis
$EAN_COLIS = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldValue();
$EAN_COLIS_label = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldLabel();

$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($EAN_COLIS_label, $EAN_COLIS, $title_format, $data_format, $pdf);

//EAN Palette
$EAN_PALETTE = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->getFieldValue();
$EAN_PALETTE_label = $ftaModel->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->getFieldLabel();
$title_format = $t3_format;
$title_format[5] = "L";
$title_format[4] = 20; //Personalisation de la largeur de la colonne
$data_format = $contenu_format;
$data_format[2] = 12;    //Personalisation de la taille
$data_format[4]+=10;   //Personalisation de la largeur de la colonne
fpdf_write_data($EAN_PALETTE_label, $EAN_PALETTE, $title_format, $data_format, $pdf);

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
$NOM_K_etat = $annexeEnvironnementConservationGroupeModel->getDataField(AnnexeEnvironnementConservationGroupeModel::FIELDNAME_NOM_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE)->getFieldLabel();
//Tableau de données
$data_table = array(
    //***********
//    array($NOM_synoptique_valide_fta, $synoptique_valide_fta),
    //array("Conditionnement", $description_emballage),
    //array("Température de conservation", $conservation),
    array($NOM_K_etat, $temperature_par_defaut_annexe_environnement_conservation_groupe),
    array("Durée de vie garantie", $ftaModel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue() . " jours"),
    //array(${"NOM_Durée_de_vie_technique"}, ${"Durée_de_vie_technique"}),
    array($NOM_site_agrement_ce, $site_agrement_ce),
    array($NOM_origine_transformation_fta, $description_origine_transformation_fta)
);

foreach ($data_table as $information) {
    $title = $information[0];
    $data = $information[1];
    if ($data == NULL) {
        $data = "Données manquantes";
    }
    $title_format = $t3_format;
    $title_format[4] = 50;
    //$title_format[5]="R";
    $data_format = $contenu_format;
    $data_format[4] = 0;   //Personalisation de la largeur de la colonne

    fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
}

//conditionnement
$description_emballage = $ftaModel->getDataField(FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE)->getFieldValue();
$description_emballage_label = $ftaModel->getDataField(FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE)->getFieldLabel();
$title_format = $t3_format;
$title_format[4] = 45; //Personalisation de la largeur de la colonne
//$title_format[5]="R";
$data_format = $contenu_format;
$data_format[1] = "";
$data_format[4] = 0;   //Personalisation de la largeur de la colonne
fpdf_write_data($description_emballage_label, $description_emballage, $title_format, $data_format, $pdf);


//conseil_rechauffage_valide_fta
$conseil_rechauffage_valide_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE)->getFieldValue();
$conseil_rechauffage_valide_fta_label = $ftaModel->getDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE)->getFieldLabel();
$data = $$champ;
$title_format = $t3_format;
$title_format[4] = 45; //Personalisation de la largeur de la colonne
//$title_format[5]="R";
$data_format = $contenu_format;
$data_format[1] = "";
$data_format[4] = 0;   //Personalisation de la largeur de la colonne
fpdf_write_data($conseil_rechauffage_valide_fta_label, $conseil_rechauffage_valide_fta, $title_format, $data_format, $pdf);

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
$returnCOLIS = $ftaModel->buildArrayEmballageTypeDuColis();
$poids_net_colis = $returnCOLIS["colis_net"];

//$req = "SELECT id_fta_composition FROM fta_composition WHERE id_fta='".$id_fta."' ORDER BY ordre_fta_composition, nom_fta_composition ";
$req = "SELECT " . FtaComposantModel::KEYNAME
        . " FROM " . FtaComposantModel::TABLENAME
        . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "='" . $id_fta . "'"
        . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=1 "
        . " ORDER BY " . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION . ", " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION . " ";
$result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
if ($result) {
    foreach ($result as $rows) {
        $pdf->SetAutoPageBreak(0);

        //Chargement des données
        //$id_fta_composition=$rows["id_fta_composition"];
        $id_fta_composant = $rows[FtaComposantModel::KEYNAME];
        $ftaComposantModel = new FtaComposantModel($id_fta_composant);

        //Préparation des données de sortie
        $nom_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->getFieldValue();
        $quantite_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC)->getFieldValue();
        $poids_fta_compositionTmp = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->getFieldValue();
        $taille_nom_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION)->getFieldValue();
        $ingredient_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->getFieldValue();
        $ingredient_fta_composition1 = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1)->getFieldValue();
        $val_nut_kcal = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL)->getFieldValue();
        $NOM_val_nut_kcal = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL)->getFieldLabel();
        $val_nut_kj = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ)->getFieldValue();
        $NOM_val_nut_kj = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ)->getFieldLabel();
        $val_nut_mat_grasse = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE)->getFieldValue();
        $NOM_val_nut_mat_grasse = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE)->getFieldLabel();
        $val_nut_acide_gras = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS)->getFieldValue();
        $NOM_val_nut_acide_gras = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS)->getFieldLabel();
        $val_nut_glucide = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE)->getFieldValue();
        $NOM_val_nut_glucide = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE)->getFieldLabel();
        $val_nut_sucre = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE)->getFieldValue();
        $NOM_val_nut_sucre = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE)->getFieldLabel();
        $val_nut_proteine = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE)->getFieldValue();
        $NOM_val_nut_proteine = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE)->getFieldLabel();
        $val_nut_sel = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SEL)->getFieldValue();
        $NOM_val_nut_sel = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SEL)->getFieldLabel();
        /**
         * Verification que l'on est outes les données nécéssaire
         */
        if ($poids_fta_compositionTmp and $quantite_fta_composition) {
//            $taux_poids_composant = ($poids_fta_compositionTmp * $quantite_fta_composition) / $poids_net_colis;
//            $temp_taux = round($taux_poids_composant / 10, 2);
            $poids_fta_composition = round($poids_fta_compositionTmp, 0);

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
            $txt = $nom_fta_composition . " (" . $poids_fta_composition . " g) x " . $quantite_fta_composition;
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

            $txt = "Valeurs nutritionnelles pour 100g";

            $pdf->MultiCell(0, 5, $txt, $border = 1, $align = 'C', $fill = 0);

            $data = "\n" . $val_nut_kcal
                    . "\n" . $val_nut_kj
                    . "\n" . $val_nut_mat_grasse
                    . "\n" . $val_nut_acide_gras
                    . "\n" . $val_nut_glucide
                    . "\n" . $val_nut_sucre
                    . "\n" . $val_nut_proteine
                    . "\n" . $val_nut_sel;

            $data_table = array(
                /**
                 * Affichage des valeurs nutritionnelles pour 100g
                 */
                array($NOM_val_nut_kcal, $val_nut_kcal),
                array($NOM_val_nut_kj, $val_nut_kj),
                array($NOM_val_nut_mat_grasse, $val_nut_mat_grasse),
                array($NOM_val_nut_acide_gras, $val_nut_acide_gras),
                array($NOM_val_nut_glucide, $val_nut_glucide),
                array($NOM_val_nut_sucre, $val_nut_sucre),
                array($NOM_val_nut_proteine, $val_nut_proteine),
                array($NOM_val_nut_sel, $val_nut_sel)
            );

            foreach ($data_table as $information) {
                $title = $information[0];
                $data = $information[1];

                $title_format = $t3_format;
                $title_format[4] = 50;
                $data_format = $contenu_format;
                $data_format[4] = 0;   //Personalisation de la largeur de la colonne
                fpdf_write_data($title, $data, $title_format, $data_format, $pdf);
            }


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
        }
        //$pdf->SetAutoPageBreak(0);
    }//Fin du parcours des composants
}
if ($idFtaWorkflow <> FtaWorkflowModel::ID_WORKFLOW_PRESENTATION) {
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
        array("Dimension UVC", $returnUVC["dimension_uvc"] . " mm"),
        array("Dimension Colis", $returnDuColis["dimension_uvc"] . " mm"),
        array("PCB", $returnUVC[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON]),
        array("Poids net Colis", round($returnDuColis["colis_net"], "3") . " kg"),
        array("Poids brut Colis", round($returnDuColis["colis_brut"], "3") . " kg")
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
        if ($data == NULL) {
            $data = "Données manquantes";
        }
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
        array("Nombre de colis par couche", $returnPallettes["colis_couche"]),
        array("Nombre de couche par palette", $returnPallettes["couche_palette"]),
        array("Nombre total de colis par palette", $returnPallettes["total_colis"]),
        array("Dimension palette", $returnPallettes["dimension_uvc"]),
        array("Hauteur palette", $returnPallettes["hauteur_palette"] . " m"),
        array("Poids Net palette", round($returnPallettes["palette_net"], "1") . " kg"),
        array("Poids Brut palette", round($returnPallettes["palette_brut"], "1") . " kg")
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
        if ($data == NULL) {
            $data = "Données manquantes";
        }
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
$apres_ouverture_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE)->getFieldValue();
$NOM_apres_ouverture_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE)->getFieldLabel();
$remarque_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_REMARQUE)->getFieldValue();
$NOM_remarque_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_REMARQUE)->getFieldLabel();
$origine_matiere_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE)->getFieldValue();
$NOM_origine_matiere_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE)->getFieldLabel();
$allergenes_matiere_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE)->getFieldValue();
$NOM_allergenes_matiere_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE)->getFieldLabel();
//Informations supplémentaires
if (!$apres_ouverture_fta and ! $remarque_fta and ! $origine_matiere_fta and ! $allergenes_matiere_fta) {
    
} else {
    $pdf->SetFont($t2_police, $t2_style, $t3_size);
    $pdf->Bookmark($chapitre . ' - Informations Supplémentaires');
    $chapitre = $chapitre + 1;
    $pdf->SetFillColor(150, 250, 230);
    $pdf->Cell(0, $t4_size, 'INFORMATIONS SUPPLEMENTAIRES', 1, 1, 'C', 1);
    $pdf->SetY($pdf->GetY() + 2);
    $data_table = array(
        //***********
//        array($NOM_presentation_fta, $presentation_fta),
        array($NOM_apres_ouverture_fta, $apres_ouverture_fta),
        array($NOM_remarque_fta, $remarque_fta),
        array($NOM_origine_matiere_fta, $origine_matiere_fta),
        array($NOM_allergenes_matiere_fta, $allergenes_matiere_fta)
    );

    foreach ($data_table as $information) {
        $title = $information[0];
        $data = $information[1];
//        if ($data == NULL) {
//            $data = "Données manquantes";
//        }
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
