<?php

//Barre de navigation du module
//Récupération des droits d'accès necessaire
$module = Lib::getModule();
$globalConfig = new GlobalConfig();
if ($globalConfig->getAuthenticatedUser()) {
    $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
    $idFtaRoleEncoursDefault = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($id_user);
}
$module_consultation = $module . '_consultation';
$module_modification = $module . '_modification';

$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME, $idFtaRoleEncoursDefault);
$fta_definition = Lib::isDefined('fta_definition');
$fta_composition = Lib::isDefined('fta_composition');

/*
  Menu accessible pour les utilisateurs ayant les droits
  en consultation sur ce module
 */
if ($_SESSION[$module_consultation]) {

    echo '<br>';
//   $action_rapide='recherche.php?url_page_depart=(/fta/recherche.php)&requete_resultat=SELECT+DISTINCT+fta.id_fta+FROM+fta+WHERE+fta.designation_commerciale_fta++LIKE+%28+%27%25test%25%27+%29+&nb_limite_resultat=1000&champ_recherche=4&operateur_recherche=1&nbcol=1&nbligne=1&nb_col_courant=0&nb_ligne_courant=0&ajout_col=0';
    echo '<form method=\'post\' action=\'recherche_post.php\' name=\'recherche_rapide\'>
        Recherche rapide <b><font size=2 color=#0000FF>Regate</font></b>:<br></font>
        <input type=\'text\' name=\'recherche\' size=\'15\' />
        <input type=\'image\' src=\'images/loupe.png\' width=\'20\' height=\'20\' title=\'Effectuer la recherche\' name=\'texte_recherche\' />
        <input type=hidden name=type_recherche value=regate />
        </form>';
//    echo '<form method=\'post\' action=\'recherche_post.php\' name=\'recherche_rapide\'>
//        Recherche rapide Agrologic:<br></font><input type=\'text\' name=\'recherche\' size=\'15\' />
//        <input type=\'image\' src=\'images/loupe.png\' width=\'20\' height=\'20\' title=\'Effectuer la recherche\' name=\'texte_recherche\' />
//        <input type=hidden name=type_recherche value=agrologic />
//        </form>';
    echo '<a href=index.php><img src=\'./images/bouton_menu_synthese.png\' border=\'0\' alt=\'R&eacute;capitulatif des Droits d\'acc&egrave;s\' /></a>';
    echo '<br>';
    echo '<a href=recherche.php><img src=\'./images/bouton_menu-rechercher.png\' border=\'0\' alt=\'R&eacute;capitulatif des Droits d\'acc&egrave;s\' /></a>';
    echo '<br>';
    echo '<a href=recapitulatif_droits_module.php><img src=\'./images/bouton_menu-droits_acces.png\' border=\'0\' alt=\'R&eacute;capitulatif des Droits d\'acc&egrave;s\' /></a>';
    echo '<br>';
    echo '<a href=aide.php><img src=\'./images/bouton_menu-documentation.png\' border=\'0\' alt=\'R&eacute;capitulatif des Droits d\'acc&egrave;s\' /></a>';
    echo '<br>';
}



echo '...';

/*
  Menu accessible pour les utilisateurs ayant les droits
  en modifications sur ce module
 */

/*
  Fonctions propres aux Assistantes de Direction Commerciales
 */
if (
        ($idFtaRole == 1) or ( $idFtaRole == 6)     //-> Chef de projet
) {
    //Créer une nouvelle Fiche Technique Article
    echo '<br>';
    echo '<a href=creer_fiche.php?id_fta_role=' . $idFtaRole . '><img src=../lib/images/bouton_menu-creer_une_fiche.png border=0></a>';

    //Mettre à jour une Fiche Technique Article existante
    //echo '<br>';
    //echo '<a href=modification0.php><img src=../lib/images/bouton_menu-mise_a_jour_une_fiche.png border=0></a>';
    //Archiver/Désarchiver une Fiche Technique Article
    //echo '<br>';
    //echo '<a href=archivage.php><img src=../lib/images/bouton_menu-gestion_des_archives.png border=0></a>';
}



/*
  Fonctionnalités communes
 */
if (
        $_SESSION[$module_modification] == 1 //-> Assistante Direction Commericale
) {
    /*
      //Accéder à son bloc de saisie sur les fiches en cours
      echo '<br>';
      echo '<a href=modification_liste.php><img src=../lib/images/bouton_menu-en_cours.png border=0></a>';

      //Valider la fin de la saisie de ses Fiches Techniques
      echo '<br>';
      echo '<a href=validation0.php><img src=../lib/images/bouton_menu-valider_la_fiche.png border=0></a>';
     */
    //Permet d'accéder directement aux Données Annexes dont l'utilisateur est gestionnaire de liste
    //echo '<br>';
    //echo '<a href=./index.php?menu=menu_table_annexe.inc target=_top><img src=../lib/images/bouton_menu-donnees_annexes.png border=0></a>';
    echo '<br><a href=consultation_tarif.php>Consulter les tarifs</a>';
    echo '<br>';
}
//   echo '...';

if (
        $idFtaRole == 3 //-> Service Qualité
) {
    /*
      //Accéder à son bloc de saisie sur les fiches en cours
      echo '<br>';
      echo '<a href=modification_liste.php><img src=../lib/images/bouton_menu-en_cours.png border=0></a>';

      //Valider la fin de la saisie de ses Fiches Techniques
      echo '<br>';
      echo '<a href=validation0.php><img src=../lib/images/bouton_menu-valider_la_fiche.png border=0></a>';
     */
    //Permet d'accéder directement aux Données Annexes dont l'utilisateur est gestionnaire de liste
    echo '<br>';
    echo '
            <a href=./derogation_duree_vie.php target=_top>
            <img src=images/bouton_menu-derogation_duree_vie.png border=0>
            </a>
            ';
}

//Migration de V1 vers V2
if ($globalConfig->getConf()->getExecDebugEnable()) {
    echo '<br>';
    echo '<a href=./migration.php target=_top>Administration du module</a>';
    echo '</td>';
}





//Génération du cadre de droite contenant la page .php
echo '<td width=100% valign=top>';
?>