<?php

/**
 * Description of ClassificationFtaModel
 * Table de classification Fta
 *
 * @author franckwastaken
 */
class ClassificationFtaModel extends AbstractModel {

    const TABLENAME = 'classification_fta';
    const KEYNAME = 'id_classification_fta';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE = 'id_classification_arborescence_article';
    const FIELDNAME_ID_FTA = 'id_fta';

    /**
     * 
     * @param type $paramIdFta
     */
    public static function DuplicateFtaClassificationByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        DatabaseOperation::query(
                ' INSERT INTO ' . ClassificationFtaModel::TABLENAME
                . ' (' . ClassificationFtaModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE
                . ',' . ClassificationFtaModel::FIELDNAME_ID_FTA . ')'
                . ' SELECT ' . ClassificationFtaModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE
                . ',' . $paramIdFtaNew
                . ' FROM ' . ClassificationFtaModel::TABLENAME
                . ' WHERE ' . ClassificationFtaModel::FIELDNAME_ID_FTA . '=' . $paramIdFtaOrig
        );
    }

    /**
     * Non fonctionnelle
     * @param type $paramIdFta
     * @param type $paramIdElement
     * @param type $paramExtension
     * @return int
     */
    public static function getElementClassificationFta($paramIdFta, $paramIdElement, $paramExtension) {
        /*
          Dictionnaire des variables:
         */
        $paramIdFta;     //Identifiant de la Fiche Technique Article
        $paramIdElement; //Identifiant du contenu de la catégorie de la classification à rechercher
        //(cf classification_arborescence_article_categorie_contenu)

        $paramExtension;    //Tableau de variables optionnelles
        $paramExtension[0]; //Si 0, Alors $id_element correspond à un contenu et la fonction retourne les éléments de la classification
        //Si 1, Alors $id_element correspond à une catégorie et la fonction retourne les éléments des contenus
        $return = Lib::isDefined('return');
        $return[0];    //0 ou 1: dit si l'élément a été touvé
        $return[1];    //Retourne la liste des clefs trouvées
        $return[2];    //Retourne la liste des valeurs trouvées
        $sql_where = Lib::isDefined('sql_where');
        $liste_recherche = Lib::isDefined('liste_recherche'); //Liste des éléments trouver dans l'ensemble des chemins


        switch ($paramExtension[0]) {
            case 0:
                $champ_recherche = ClassificationArborescenceArticleCategorieContenuModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME;
                break;

            case 1:
                $champ_recherche = ClassificationArborescenceArticleCategorieModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieModel::KEYNAME;
                break;
        }


        /*
          Corps de la fonction
         */
//echo $id_fta;
        if (!$paramIdFta) { //L'ID FTA est obligatoire
            return 0;
        }
        //Recherche des chemins de classification de l'Article
        $arrayClassification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . ClassificationArborescenceArticleModel::KEYNAME
                        . ',' . ClassificationFtaModel::TABLENAME . '.' . ClassificationFtaModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE
                        . ' FROM ' . ClassificationFtaModel::TABLENAME . ',' . ClassificationArborescenceArticleModel::TABLENAME
                        . ' WHERE ' . ClassificationFtaModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                        . ' AND ' . ClassificationFtaModel::TABLENAME . '.' . ClassificationFtaModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE
                        . '=' . ClassificationArborescenceArticleModel::TABLENAME . '.' . ClassificationArborescenceArticleModel::KEYNAME
        );
        if (!$arrayClassification) {//Vérification de l'existance de chemin de classifications
            //L'article n'a pas de classification
            $titre = 'Classification de l\'article';
            $message = 'Cet article n\'a pas de classification';
            $redirection;
            // afficher_message($titre, $message, $redirection);
        } else {
            //Récupération de toutes les classifications
            foreach ($arrayClassification as $rowsClassification) {
                $table = ClassificationArborescenceArticleModel::TABLENAME;
                $champ_valeur = ClassificationArborescenceArticleModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;
                $champ_id_fils = ClassificationArborescenceArticleModel::FIELDNAME_ASCENDANT_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;
                $champ_id_pere = ClassificationArborescenceArticleModel::KEYNAME;
                $id_racine = $rowsClassification[ClassificationArborescenceArticleModel::KEYNAME];
                $recup = ClassificationFtaModel::getClassificationName($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $sql_where, $paramExtension);
                $liste_recherche.=$recup[1];
            }

            //var_dump($liste_recherche);
            //Transformation de la liste de recherche sous forme de tableau
            $tableau_recherche = explode(',', $liste_recherche);

            //Construction de la requête de recherche
            $req = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME
                    . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                    . ' FROM ' . ClassificationArborescenceArticleModel::TABLENAME
                    . ',' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                    . ',' . ClassificationArborescenceArticleCategorieModel::TABLENAME
                    . ' WHERE ' . ClassificationArborescenceArticleCategorieModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieModel::KEYNAME
                    . '=' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE
                    . ' AND ' . ClassificationArborescenceArticleModel::TABLENAME . '.' . ClassificationArborescenceArticleModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                    . '=' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME
                    . ' AND ' . $champ_recherche . '=' . $paramIdElement
                    . ' AND '
            ;
            //Intégration dans la reqûete les éléments trouvés
            $tableau_recherche;
            $first_OR = 0;
            foreach ($tableau_recherche as $id_classification_arborescence_article) {
                if ($first_OR) {
                    $req .= ' OR ';
                } else {
                    $req .= '( ';
                }
                $req .= ClassificationArborescenceArticleModel::TABLENAME . '.' . ClassificationArborescenceArticleModel::KEYNAME . '=' . $id_classification_arborescence_article;
                $first_OR = 1;
            }
            $req .= ') ';


            $arrayNomClassification = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);


            //Si il y a des résultat
            if ($arrayNomClassification) {
                //Il y a au moins 1 résultat
                $return[0] = 1;

                $virg_enable = 0;
                $return[1] = '';
                $return[2] = '';
                foreach ($arrayNomClassification as $rowsNomClassification) {
                    if ($rowsNomClassification[ClassificationArborescenceArticleCategorieContenuModel::KEYNAME] <> 0) {
                        if ($virg_enable) {
                            $virg = ',';
                        } else {
                            $virg_enable = 1;
                        }
                        $return[1].=$virg . $rowsNomClassification[ClassificationArborescenceArticleCategorieContenuModel::KEYNAME];
                        $return[2].=$virg . $rowsNomClassification[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
                    }
                }
            } else {
                //Pas d'occurence
                $return[0] = 0;
            }
        }//Fin de la vérification de l'existance de chemin de classification de l'article


        return $return;
    }

    /**
     * Non fonctionnelle
     * @param type $table
     * @param type $champ_valeur
     * @param type $champ_id_fils
     * @param type $champ_id_pere
     * @param type $id_racine
     * @param string $sql_where
     * @param type $extension
     * @return type
     */
    public static function getClassificationName($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine, $sql_where, $extension) {
        /*
          Déclaration des variables:
         */
        /*     $table='matiere_premiere_composant';                       //nom de la table contenant l'association 'Père' / 'Fils'
          $champ_valeur='nom_matiere_premiere_composant';            //nom du champ contenant la valeur à afficher (sans le 'underscore' et le nom de la table)
          $champ_id_fils='id_matiere_premiere_composant';            //nom du champ fils contenant l'id (sans le 'underscore' et le nom de la table)
          $champ_id_pere='id_ascendant_matiere_premiere_composant';  //nom du champ père contenant l'id (sans le 'underscore' et le nom de la table)
         */
        $table;                    //nom de la table contenant l'association 'Père' / 'Fils'
        //Peux aussi être une liste de table séparé par une virgule ex: 'table1,table2'
        $champ_valeur;             //nom du champ contenant la valeur à afficher
        $champ_id_fils;            //nom du champ fils contenant l'id
        $champ_id_pere;            //nom du champ père contenant l'id

        $id_racine;                //Identifiant de l'enregistrement père racine (le premier)
        $id_recherche = $id_racine;  //Identifiant en cours de recherche
        $id_fils;                  //Identifiant du fils en cours de traitement
        $id_pere;                  //Identifiant du pre en cours de traitement
        $tab;                      //Nombre de tabulation permettant un affichage en cascade de l'arborescence
        $tab_init = '    ';          //Representation de la tabulation
        $sql_where;                //Permet de personnaliser la clause SQL 'WHERE' comme pour insérer une jointure par exemple
        $return = '';                //Valeur retourne par la fonction
        //$return[1] --> liste de éléments séparé par une virgule
        //$return[2] --> Réprésentation de l'arborescence au format texte


        $extension = Lib::isDefined('extension');                //Tableau d'argument optionnelle de la fonction
//    $extension[0];             //Code HTML qui sera ajouter à la fin de la valeur dans la représentation graphique
//    $extension[1];             //0 ou 1. Permet de terminer le code HTML créé par $extension[0] avec l'id de l'objet en cours
//    $extension[2];             //Ordre tri: 0=Valeur, 1=Clefs Fils et 2=Clef Père
//    $extension[3];             //Liste des id à développer, si NULL, alors tout est développé
//    $extension[4];             //Lien lorqu'on clic sur un élément de l'arborescence (terminé par l'id)
        $tri;                      //Champ à trier

        /*
          Initialisation des variables
         */
        //$champ_valeur .= '_'.$table;
        //$champ_id_fils.= '_'.$table;
        //$champ_id_pere.= '_'.$table;
        $id_pere = $id_racine;
        $tab_arborescence = '|';       //Signe Nouvelle Arborescence
        $tab_fils = '---> ';           //Signe Nouveau Fils
        $tab_espace = '----->';         //Espace de décalage
        if ($sql_where) {
            $sql_where = 'WHERE ' . $sql_where;
        }

        if (!$extension[2]) {
            $extension[2] = 1;  //Tri par défaut
        }

        //Configuration du tri de l'arborescence
        switch ($extension[2]) {

            case 0 : $tri = $champ_valeur;
                break;
            case 1 : $tri = $champ_id_fils;
                break;
            case 2 : $tri = $champ_id_pere;
                break;
        }


        $requete_principale = 'SELECT ' . $champ_id_pere . ',' . $champ_id_fils . ',' . $champ_valeur
                . ' FROM ' . $table
                . $sql_where
                . ' ORDER BY ' . $tri . ' ASC ';
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($requete_principale);
        if ($array) {
            $nombre_ligne = count($array);
        } else {
            $nombre_ligne = AccueilFta::VALUE_0;
        }

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

   

}
