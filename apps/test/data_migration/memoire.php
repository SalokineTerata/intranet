
<?php

function arborescence_construction($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $sql_where, $extension) {

    $table = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu,classification_fta';                                      //nom de la table contenant l'association "Père" / "Fils"
    $champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
    $champ_fta = 'classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
    $champ_id_fils = 'id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
    $champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
    $id_racine = 1;                                                                     //Identifiant de l'enregistrement père racine (le premier)
    if (!$liste_id) {
        $liste_id = "," . $id_racine . ",";
    }
    if ($add_id) {
        $liste_id.=$add_id . ",";
    }
//echo    $liste_id;
//echo    $_GET;
//    print_r(parse_url($url));
    $sql_where = "classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu";                //Permet de personnaliser la clause SQL "WHERE" comme pour insérer une jointure par exemple
    // Déclaration des variables:
    ///    $table='matiere_premiere_composant';                       //nom de la table contenant l'association "Père" / "Fils"
    //  $champ_valeur='nom_matiere_premiere_composant';            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
    //  $champ_id_fils='id_matiere_premiere_composant';            //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
    //  $champ_id_pere='id_ascendant_matiere_premiere_composant';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)

    $table;                    //nom de la table contenant l'association "Père" / "Fils"
    //Peux aussi être une liste de table séparé par une virgule ex: "table1,table2"
    $champ_valeur;             //nom du champ contenant la valeur à afficher
    $champ_id_fils;            //nom du champ fils contenant l'id
    $champ_id_pere;            //nom du champ père contenant l'id

    $id_racine;                //Identifiant de l'enregistrement père racine (le premier)
    $id_recherche = $id_racine;  //Identifiant en cours de recherche
    $id_fils;                  //Identifiant du fils en cours de traitement
    $id_pere;                  //Identifiant du pre en cours de traitement
    $tab;                      //Nombre de tabulation permettant un affichage en cascade de l'arborescence
    $tab_init = '    ';          //Representation de la tabulation
    $sql_where;                //Permet de personnaliser la clause SQL "WHERE" comme pour insérer une jointure par exemple
    $return = '';                //Valeur retourne par la fonction
    //$return[1] --> liste de éléments séparé par une virgule
    //$return[2] --> Réprésentation de l'arborescence au format texte


    $extension = Lib::isDefined("extension");                //Tableau d'argument optionnelle de la fonction
//    $extension[0];             //Code HTML qui sera ajouter à la fin de la valeur dans la représentation graphique
//    $extension[1];             //0 ou 1. Permet de terminer le code HTML créé par $extension[0] avec l'id de l'objet en cours
//    $extension[2];             //Ordre tri: 0=Valeur, 1=Clefs Fils et 2=Clef Père
//    $extension[3];             //Liste des id à développer, si NULL, alors tout est développé
//    $extension[4];             //Lien lorqu'on clic sur un élément de l'arborescence (terminé par l'id)
    $tri;                      //Champ à trier

    /*
      Initialisation des variables
     */
    //$champ_valeur .= "_".$table;
    //$champ_id_fils.= "_".$table;
    //$champ_id_pere.= "_".$table;
    $id_pere = $id_racine;
    if ($sql_where) {
        $sql_where = "WHERE " . $sql_where;
    }

    if (!$extension[2]) {
        $extension[2] = 1;  //Tri par défaut
    }

    //Configuration du tri de l'arborescence
    switch ($extension[2]) {

        case 0:$tri = $champ_valeur;
            break;
        case 1:$tri = $champ_id_fils;
            break;
        case 2:$tri = $champ_id_pere;
            break;
    }


    $requete_principale = "SELECT $champ_id_pere, $champ_id_fils, $champ_valeur FROM $table "
            . "$sql_where "
            . "ORDER BY $tri ASC "
    ;

    //echo $requete_principale;
    $resultat = DatabaseOperation::query($requete_principale);
    $nombre_ligne = mysql_num_rows($resultat);

    /*
      Corps de la fonction
     */



    //Lancement de la fonction
    //Appel recursif de la fonction
    $i = 1;    //Affiche le niveau dans lequel on est

    $return = recursif(
            $resultat, $id_recherche, $champ_id_pere, $champ_id_fils, $champ_valeur, $tab_fils, $tab_arborescence, $tab_espace, $return, $nombre_ligne, $extension
    );

    //var_dump($return);
    return $return;
}

//Requete principale donnant les l'aborence complet (la fin ) par id_fta  5  416 résultat

/**
 * Fonction récursive pour arborescence
 *
 * @param nombre $parent pour les catégories ayant cet id_parent 
 * @param nombre $niveau, uniquement pour que la fonction sache ou elle en est
 * @param array $array spécifie le tableau à passer dans la fonction
 *
 * @return array multidimensionnel sous forme d'arborescence
 */
function recurse_tree($parent, $niveau, $array) {
    $result = array();
    foreach ($array as $noeud) {
        if ($parent == $noeud['parent_id']) {
            $result[] = array(
                'id' => $noeud['page_id'],
                'name' => $noeud['page_nom'],
                'children' => recurse_tree($noeud['page_id'], ($niveau + 1), $array)
            );
        }
    }
    return $result;
}

//Compteur de la boucle
$i = 0;
$return[$i] = null;
while ($i < ($nombre_ligne)) {
//$id_recherche;
    //if (mysql_result($resultat, $i, $champ_id_pere) == $id_recherche)
    if ($resultat->fetchColumn("ascendant_classification_arborescence_article_categorie_contenu") == $resultat->fetchColumn()) {
        //Enregistrement des informations
        //echo "test".$extension[3];
        //Structure
        $return[0] .= $tab_return . $tab_espace;

        //Liens
        if ($extension[1]) {
            $deploy = $extension[0]
                    //. $extension[1]
                    . mysql_result($resultat, $i, $champ_id_fils)
                    . $extension[2]
            ;
        }
        if ($extension[4]) {
            $html_link_1 = "<a href="
                    . $extension[4]
                    . mysql_result($resultat, $i, $champ_id_fils)
                    . " >"
            ;
            $html_link_2 = "</a>";
        }

        //Données
        if (isset($return[1]) and mysql_result($resultat, $i, $champ_id_fils)) {
            $return[1] .= ",";
        }
        $return[1] .= mysql_result($resultat, $i, $champ_id_fils);

        //Structure et Données
        $return[2] .= $tab_return . $tab_espace . $deploy . " " . $html_link_1 . stripslashes(mysql_result($resultat, $i, $champ_valeur)) . $html_link_2;


        $id_recherche_ancien = $id_recherche;
        $id_recherche = mysql_result($resultat, $i, $champ_id_fils);

        //Appel recursif de la fonction
        //echo "<br>".$id_recherche." ".$extension[3]." --- ". strstr($extension[3], ",".$id_recherche.",")."<br>";
        //echo strstr("123456", "2");
        //$test = strstr($extension[3], ",".$id_recherche.",");
        $liste_id = $extension[3];
        $dont_explore = $return[2];    //Permet de ne deployer tous les dossiers HTML tout en parcourant l'ensemble de l'arboresence.
        $return = recursif(
                $resultat, $id_recherche, $champ_id_pere, $champ_id_fils, $champ_valeur, $tab_fils, $tab_arborescence, $tab_espace, $return, $nombre_ligne, $extension
        );

        if ($_SESSION["module"] <> "fiches_mp_achats") { //A optimiser !!
            if (!strstr($liste_id, "," . $id_recherche . ",")) {
                $return[2] = $dont_explore;
            }
        }
        $id_recherche = $id_recherche_ancien;
    }

    $i = $i + 1;
}

$return;
?>