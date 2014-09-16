<?php
/*************
Début Code PDF
*************/

// Création d'une nouvelle page
$pdf->AddPage();
/*******************************************************************************
Titre principal
*******************************************************************************/

$pdf->SetFont($t1_police,$t1_style,$t1_size);
$pdf->Bookmark($chapitre.' - Mon Chapitre');
$pdf->Cell(0,$t1_size,'Mon Chapitre',1,1,'C');

$pdf->SetFont($t3_police,$t3_style,$t3_size);
$section++;
$pdf->Bookmark($section.' - Ma section',1,-1);
$pdf->Cell(0,$t2_size,$section.' - Ma section',1,1,'C');


//Création des objets PDF (listes déroulante, cases à cocher ...etc.)
$pdf->SetFont($contenu_police,$contenu_style,$contenu_size);

$data = "Voici un\n"
      . "TEST\n"
      ;

$pdf->MultiCell(0,$contenu_size,$data,1);
$pdf->Ln();

/***********
Fin Code PDF
***********/
?>