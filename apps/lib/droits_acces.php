<?php

/* ------------------------------------------------
  ACQUISITION DES DROITS D'ACCES DE intranet.agis.fr
  ------------------------------------------------ */

//Création des variables globales de tous les droits d'acces de l'intranet
//$timestart = time();
$nom_droits_acces = Lib::isDefined('nom_droits_acces');
$id_user = Lib::isDefined('id_user');

//Requête retournant tous les droits d'accès de l'intranet pour l'utilisateur en cours
$array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                'SELECT ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                . ', ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                . ', ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES
                . ', ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                . ' FROM ' . IntranetActionsModel::TABLENAME . ', ' . IntranetDroitsAccesModel::TABLENAME
                . ', ' . IntranetModulesModel::TABLENAME
                . ' WHERE ( ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                . ' = ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                . ' = ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . ' = ' . $id_user . ') '
                . ' ORDER BY ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES
                . ' ASC, ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS . ' ASC '
);
if ($array) {
    foreach ($array as $rows) {
        //Déclaration du droit d'accès
        $nom_droits_acces = $rows['nom_intranet_modules'] . '_' . $rows['nom_intranet_actions'];

        //Affectation du niveau du droit d'accès
//        $$nom_droits_acces = $rows["niveau_intranet_droits_acces"];

        //Vérification
        //echo $nom_droits_acces.'='.$$nom_droits_acces.'<br>';
        //Enregistrement du droits d'accès dans les variables de session PHP
        
        AclClass::setAccesRightsValues($nom_droits_acces, $rows["niveau_intranet_droits_acces"]);
//        $_SESSION["$nom_droits_acces"] = $$nom_droits_acces;

        //Réinitialisation pour préaparer la nouvelle boucle
//        $nom_droits_acces = "";
//        $$nom_droits_acces = 0;
    }
} else {
    $titre = 'Attention';
    $message = 'Votre compte utilisateur n\'est pas déclaré dans l\'Intranet.<br>'
            . 'Veuillez contacter votre service informatique.<br>';
    $redirection = false;
    afficher_message($titre, $message, $redirection);
}

//Requête retournant tous les droits d'accès de l'intranet

/*
  $req1 = 'SELECT * FROM intranet_modules, intranet_actions ';
  $req1.= 'ORDER BY id_intranet_modules ASC';
  $req1.= ', id_intranet_actions ASC';
  $result1=DatabaseOperation::query($req1);
  while ($rows1=mysql_fetch_array($result1))
  {
  //Création du nom de la variable définissant un droit d'accès spécifique
  $nom_droits_acces=$rows1[nom_intranet_modules].'_'.$rows1[nom_intranet_actions];

  //Critère de recherche des droits d'accès de l'utilisateur connecté
  //$id_user est déjà définit.
  $id_intranet_modules=$rows1[id_intranet_modules];
  $id_intranet_actions=$rows1[id_intranet_actions];

  //Recherche des droits d'accès définit pour l'utilisateur
  $req2 = 'SELECT * FROM intranet_actions, intranet_droits_acces, intranet_modules ';
  $req2.= 'WHERE id_user=$id_user ';
  $req2.= 'AND intranet_modules.id_intranet_modules=intranet_droits_acces.id_intranet_modules ';
  $req2.= 'AND intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions ';
  $req2.= 'AND intranet_modules.id_intranet_modules=$id_intranet_modules ';
  $req2.= 'AND intranet_actions.id_intranet_actions=$id_intranet_actions ';
  $result2=DatabaseOperation::query($req2);
  $nb2=mysql_num_rows($result2);

  //Si l'utilisateur a le droit d'accès
  if ($nb2)
  {//Un droits d'accès est définit pour l'utilisateur,
  //donc on affecte la valeur de ce droit d'accès
  $$nom_droits_acces=mysql_result($result2, 0, niveau_intranet_droits_acces);
  }

  //Si l'utilisateur n'a pas le droit d'accès
  else
  {//Il n'y a pas de droits d'accès pour l'utilisateur
  //Alors le droits d'accès est vérouillé (=0)
  $$nom_droits_acces=0;
  }

  //Enregistrement du droits d'accès en temps que variable de session PHP
  //session_register ($nom_droits_acces);

  //Vérifications des droits d'accès:
  //echo  '<br><h6>$nom_droits_acces: '.$$nom_droits_acces.'</h6>';
  }
 */


//
//$timestop = time();
////2011-01-31 Boris Sanègre - Neutralisation du timeout.
////$delay = $timestop - $timestart;
//$delay = 1;
//
//$_SESSION['delay'] = $delay;
//$delay.' secondes';
?>