<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 

$connect = new PDO('mysql:host=dev-intranet.agis.fr;dbname=intranet_v3_0_dev;charset=utf8', 'root', '8ale!ne') or die("connexion impossible");

$table_req = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu';                                      //nom de la table contenant l'association "Père" / "Fils"
$champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
$champ_id_fils = 'classification_arborescence_article.id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
$champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
$id_racine = 1;



$requete_principale = " SELECT " . $champ_id_fils . "," . $champ_id_pere . "," . $champ_valeur . " "
        . " FROM " . $table_req . ""
        . " WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
        ;

$resultat = $connect->query($requete_principale);
if (!$liste_id) {
    $liste_id = "<td>" . $id_racine . "</td>";
}

$tableau[0] = "<tr>";         //Début de tableau Valeur du tableau
$tableau[1] = $liste_id;         //Début de tableau Valeur du tableau
$tableau[2] = 1;                        //Termine le lien par l'id de l'objet de l'arborescence
$tableau[3] = "</tr>";                // fin de l'arborescence
//$tableau[5] = $liste_id;        //Liste des id à développer, si NULL, alors tout est développé



$arbo = arborescence_tableau($table_req, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $tableau);

echo "
 <table>
        <caption>Classification Agis</caption>

        <thead> <!-- En-tête du tableau -->
            <tr>
                <th>Propriétaire</th>
                <th>Marque</th>
                <th>Activité</th>
                <th>Rayon</th>
                <th>Réseau</th>
                <th>Environnement</th>
                <th>Saisonalité</th>
                <th>Export</th>
            </tr>
        </thead>

        <tfoot> <!-- Pied de tableau -->
            <tr>
                <th>Propriétaire</th>
                <th>Marque</th>
                <th>Activité</th>
                <th>Rayon</th>
                <th>Réseau</th>
                <th>Environnement</th>
                <th>Saisonalité</th>
                <th>Export</th>
            </tr>
        </tfoot>
       $arbo[2]
            
</table>
    "
?>



<?php

function arborescence_tableau($paramtable, $param_valeur, $param_id_fils, $param_id_pere, $param_id_racine, $param_tableau) {

    $paramtable;                        //nom de la table contenant l'association "Père" / "Fils"
    $param_valeur;                      //nom du champ contenant la valeur à afficher
    $param_id_pere;                      //Identifiant du pre en cours de traitement
    $param_id_fils;                     //Identifiant du fils en cours de traitement
    $param_id_racine;                   //Identifiant de l'enregistrement père racine (le premier)
    $id_recherche = $param_id_racine;         //Identifiant en cours de recherche
    $param_tableau;                           //un truc qui sert à l'affichage de l'arborescene en tableau
    $return = '';                       //Valeur retourne par la fonction
    $tri;                               //Champ à trier



    $param_id_pere = $param_id_racine;

    $connect = new PDO('mysql:host=dev-intranet.agis.fr;dbname=intranet_v3_0_dev;charset=utf8', 'root', '8ale!ne') or die("connexion impossible");

    $table_req = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu';                                      //nom de la table contenant l'association "Père" / "Fils"
    $champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
    $champ_id_fils = 'id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
    $champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)

    if (!$param_tableau[3]) {
        $param_tableau[3] = 1;  //Tri par défaut
    }

    //Configuration du tri de l'arborescence
    switch ($param_tableau[3]) {

        case 0 : $tri = $champ_valeur;
            break;
        case 1 : $tri = $champ_id_fils;
            break;
        case 2 : $tri = $champ_id_pere;
            break;
    }

    $requete_principale = " SELECT " . $champ_id_fils . "," . $champ_id_pere . "," . $champ_valeur . " "
            . " FROM " . $table_req . ""
            . " WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu";

    $resultat = $connect->query($requete_principale);

    $nombre_ligne = $resultat->rowCount();
    foreach ($resultat as $rip) {
        $return = recursif($rip, $nombre_ligne, $champ_id_pere, $champ_id_fils, $champ_valeur, $id_recherche, $return, $param_tableau);
        ?>

        <?php
    }

    return $return;
}

function recursif($paramrows, $param_nb_ligne, $param_id_pere, $param_id_fils, $param_valeur, $param_id_recherche, $param_return, $param_tableau) {



    $tableau_tr_ligne = "<tr>";
    $tableau_tr_ligne_fin = "</tr>";
    $tableau_td_cellule = "<td>";
    $tableau_td_cellule_fin = "</td>";
    $tableau_tmp = "/";
    $tableau_espace = "<br>";


    //Compteur de la boucle

    $i = 0;
    $param_return[$i] = null;
    while ($i < ($param_nb_ligne)) {

        if ($paramrows[$param_id_pere] == $param_id_recherche) {
            //Enregistrement des informations
            //echo "test".$extension[3];
            //Structure
            $param_return[0] .= $tableau_espace . $tableau_tr_ligne;
            //Liens
            if ($param_tableau[2]) {
                $deploy = $param_tableau[1]
                        //. $extension[1]
                        . $tableau_espace
                        . $tableau_td_cellule
                        . $paramrows[$param_id_fils]
                        . $tableau_td_cellule_fin
                //fin d'une cellule
                ;
            }

            if (isset($param_return[1]) and $paramrows[$param_id_fils]) {
                $param_return[1] .= "<td>";
            }
            $param_return[1] .= $paramrows[$param_id_fils];

            //Structure et Données
            $param_return[2] .= $tableau_tr_ligne . $tableau_espace . $tableau_td_cellule . $paramrows[$param_valeur] . $tableau_td_cellule_fin . $tableau_tr_ligne_fin;


            $id_recherche_ancien = $param_id_recherche;
            $param_id_recherche = $param_id_fils;

            //Appel recursif de la fonction
            //echo "<br>".$id_recherche." ".$extension[3]." --- ". strstr($extension[3], ",".$id_recherche.",")."<br>";
            //echo strstr("123456", "2");
            //$test = strstr($extension[3], ",".$id_recherche.",");
            $liste_id = $param_tableau[1];
            $dont_explore = $param_return[2];    //Permet de ne deployer tous les dossiers HTML tout en parcourant l'ensemble de l'arboresence.
//                     $param_return = recursif(
//                            $paramrows, $param_nb_ligne, $param_id_pere, $param_id_fils, $param_valeur, $param_id_recherche, $param_return, $param_tableau
//                    );

            if ($_SESSION["module"] <> "fiches_mp_achats") { //A optimiser !!
                if (!strstr($liste_id, "<tr>" . $param_id_recherche . "</tr>")) {
                    $param_return[2] = $dont_explore;
                }
            }
            $param_id_recherche = $id_recherche_ancien;

            $id_recherche_ancien = $param_id_recherche;
            $param_id_recherche = $param_id_fils;
            // $param_return = recursif($paramrows, $param_nb_ligne, $param_id_pere, $param_id_fils, $param_valeur, $param_id_recherche, $param_return, $param_tableau);
        }
        $i = $i + 1;
    }

    return $param_return;
}
?>
