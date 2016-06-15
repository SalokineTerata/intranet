<?php

//Inclusions
require_once '../inc/main.php';
$idIntranetColumnInfo = Lib::getParameterFromRequest(IntranetColumnInfoModel::KEYNAME);
$retour= "<br><a href=popup-mysql_field_desc.php?id_intranet_column_info=" . $idIntranetColumnInfo."&edit_mode=1 >Retour</a>";
$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
//$taille_maxi = 100000;
//$taille = filesize($_FILES['avatar']['tmp_name']);
//$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.txt', '.doc', '.docx', '.odt', '.xlsx', '.csv', '.ppt' , '.pptx');
//$extension = strrchr($_FILES['avatar']['name'], '.');
////Début des vérifications de sécurité...
//if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
//    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, pdf, jpeg, txt, doc, docx, odt, ppt, pptx, xlsx ou csv';
//}
//if ($taille > $taille_maxi) {
//    $erreur = 'Le fichier est trop gros...';
//}
//if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
    //On formate le nom du fichier ici...
    $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        $intranetColumInfoModel = new IntranetColumnInfoModel($idIntranetColumnInfo);
        $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_UPLOAD_NAME_FILE)->setFieldValue($fichier);
        $intranetColumInfoModel->saveToDatabase();
        //Redirection
        header("Location: popup-mysql_field_desc.php?id_intranet_column_info=" . $idIntranetColumnInfo."&edit_mode=1");
    } else { //Sinon (la fonction renvoie FALSE).
        echo 'Echec de l\'upload ! ';
        echo $retour;
    }
//} else {
//    echo $erreur;
//     echo $retour;
//}

