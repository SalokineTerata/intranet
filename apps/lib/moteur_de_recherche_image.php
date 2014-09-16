<?php
/*
         Creation de l'image ET et de l'image OU
*/

// on spécifie le type de document que l'on va créer (ici une image au format PNG )
header ("Content-type: image/png");

// on définit la largeur et la hauteur de notre image
$largeur = 25;
$hauteur = 25;

// on crée une ressource pour notre image qui aura comme largeur $largeur et $hauteur comme hauteur
$im = ImageCreate ($largeur, $hauteur) or die ("Erreur lors de la création de l'image");


//Definition des couleurs
// ($nom_image,rouge, vert, bleu)
$orange_fonce = ImageColorAllocate ($im, 250, 130, 75);
$orange_clair = ImageColorAllocate ($im, 250, 200, 150);
$noir = ImageColorAllocate ($im, 0, 0, 0);   

// dessin du cadre qui entoure l'image
ImageLine ($im, 0, 0, $largeur, 0, $noir);
ImageLine ($im, 0, $hauteur-1, $largeur, $hauteur-1, $noir);
ImageLine ($im, 0, 0, 0, $hauteur-1, $noir);
ImageLine ($im, $largeur-1, 0,$largeur-1, $hauteur-1, $noir);

imagestring ( $im, 5, 4, 5, $op, $orange_clair);

/* Envoyer l'image */
imageinterlace($im, false);
Imagepng($im);
imagedestroy($im);


?>


