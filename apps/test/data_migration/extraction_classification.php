<?php
$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 

$connect = new PDO('mysql:host=dev-intranet.agis.fr;dbname=intranet_v3_0_dev;charset=utf8', 'root', '8ale!ne') or die("connexion impossible");
$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect) or die("connexion impossible");
?>

<html>
    <head>
        <style>
            table, td, th {
                font-size : 12px; 
                font-family : Verdana, arial, helvetica, sans-serif; 
                border: 1px solid green;
                background-color : #d6d3ce; 
            }

            th {
                background-color: green;
                color: white;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>

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



        <?php

//        $table_req = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu,classification_fta';                                      //nom de la table contenant l'association "Père" / "Fils"
//        $champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
//        $champ_fta = 'id_fta';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
//        $champ_id_fils = 'classification_arborescence_article.id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
//        $champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
//        $id_recherche = 1;
//
//
//        $requete_principale = " SELECT " . $champ_id_fils . "," . $champ_id_pere . "," . $champ_fta . "," . $champ_valeur . " "
//                . " FROM " . $table_req . ""
//                . " WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
//                . "AND classification_arborescence_article.id_classification_arborescence_article=classification_fta.id_classification_arborescence_article "
//                . "ORDER BY `classification_fta`.`id_fta` ASC";
//
//        $resultat = $connect->query($requete_principale);
//        $i = 0;
//        foreach ($resultat as $rip) {
//            $valeur_pere[$i] = $rip["id_classification_arborescence_article"];
//            $valeur_fta[$i] = $rip["id_fta"];
//            $valeur_fils[$i] = $rip["id_classification_arborescence_article"];
//            $valeur_nom[$i] = $rip["nom_classification_arborescence_article_categorie_contenu"];
//            $i = $i + 1;
//            // $tableau = recursif($resultat, $id_recherche, $valeur_pere, $valeur_fils, $valeur_fta);
//            //print_r($mark);
//        }
//        "SELECT ascendant_classification_arborescence_article_categorie_contenu, classification_arborescence_article.id_classification_arborescence_article, nom_classification_arborescence_article_categorie_contenu, id_fta 
//    FROM classification_arborescence_article,classification_arborescence_article_categorie_contenu, classification_fta 
//    WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu 
//    AND classification_arborescence_article.id_classification_arborescence_article=classification_fta.id_classification_arborescence_article 
//    ORDER BY `classification_arborescence_article`.`id_classification_arborescence_article` ASC
//";


        function recursif($paramrows, $param_nb_ligne, $param_id_pere, $param_id_fils, $param_valeur, $param_id_recherche, $param_return, $param_tableau) {


            $tableau_debut = "<table>";
            $tableau_tr_ligne = "<tr>";
            $tableau_tr_ligne_fin = "</tr>";
            $tableau_td_cellule = "<td>";
            $tableau_td_cellule_fin = "</td>";
            $tableau_tmp = "/";
            $tableau_espace = "<br>";

            $tableau_fin = "</table>";
            //Compteur de la boucle

            $i = 0;
            $param_return[$i] = null;
            while ($i < ($param_nb_ligne)) {
                foreach ($paramrows as $rows) {
                    if ($param_id_pere == $param_id_recherche) {
                        //Enregistrement des informations
                        //echo "test".$extension[3];
                        //Structure
                        $param_return[0] .= $tableau_debut . $tableau_espace . $tableau_tr_ligne;
                        //Liens
                        if ($param_tableau[1]) {
                            $deploy = $param_tableau[0]
                                    //. $extension[1]
                                    . $param_id_fils
                                    . $param_tableau[2]
                            ;
                        }
                    }
                    if (isset($param_return[1]) and $param_id_fils) {
                        $return[1] .= ",";
                    }
                    $param_return[1] .= $param_id_fils;

                    //Structure et Données
                    $param_return[2] .= $tableau_debut . $tableau_espace . $deploy . " " . $param_valeur . $tableau_td_cellule_fin . $tableau_tr_ligne_fin;


                    $id_recherche_ancien = $param_id_recherche;
                    $param_id_recherche = $param_id_fils;

                    //Appel recursif de la fonction
                    //echo "<br>".$id_recherche." ".$extension[3]." --- ". strstr($extension[3], ",".$id_recherche.",")."<br>";
                    //echo strstr("123456", "2");
                    //$test = strstr($extension[3], ",".$id_recherche.",");
                    $liste_id = $param_tableau[3];
                    $dont_explore = $return[2];    //Permet de ne deployer tous les dossiers HTML tout en parcourant l'ensemble de l'arboresence.
                    $param_return = recursif(
                            $paramrows, $param_nb_ligne, $param_id_pere, $param_id_fils, $param_valeur, $param_id_recherche, $param_return, $param_tableau
                    );

//                    if ($_SESSION["module"] <> "fiches_mp_achats") { //A optimiser !!
//                        if (!strstr($liste_id, "," . $id_recherche . ",")) {
//                            $return[2] = $dont_explore;
//                        }
//                    }
//                    $param_id_recherche = $id_recherche_ancien;
//
//                    $id_recherche_ancien = $param_id_recherche;
//                    $param_id_recherche = $rows[$champ_id_fils];
//                    $return = recursif($resultat, $id_recherche, $champ_id_pere, $champ_id_fils, $champ_fta);
                }
                $i = $i + 1;
            }
            return $param_return;
        }

        function recurse_tree($paramParent, $i, $result) {

            $nombre_ligne = $result->rowCount();
            $franck = array();
            while ($i < ($nombre_ligne)) {
                foreach ($result as $rows) {
                    if ($paramParent == $rows['id_classification_arborescence_article']) {
                        $franck[] = array(
                            'id_fta' => $rows['id_fta'],
                            'nom_classification_arborescence_article_categorie_contenu' => $rows['nom_classification_arborescence_article_categorie_contenu'],
                            'classification_arborescence_article.id_classification_arborescence_article' => recurse_tree($rows['classification_arborescence_article.id_classification_arborescence_article'], ($i + 1), $result)
                        );
                    }
                }
                return $franck;
            }
        }
        ?>

        <tr>
        <tr>truc2 
        </tr>
        <tr>truc1</tr>
        <td>test1</td>
        <td>test2</td>
    </tr>

    <?php

    function select() { ?>
        <SELECT name = "Propiétaire" size = "1">
            <?php
            $proprietaire_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=1 order by nom_classification_arborescence_article_categorie_contenu");
            while ($proprietaire = $proprietaire_req->fetch()) {
                ?>
                <OPTION value="<?php echo $proprietaire["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $proprietaire["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }
                ;
                ?>
        </SELECT>
        <SELECT>
            <?php
            $marque_req2 = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=2 order by nom_classification_arborescence_article_categorie_contenu ");
            while ($marque = $marque_req2->fetch()) {
                ?>
                <OPTION value="<?php echo $marque["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $marque["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $activite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=3 order by nom_classification_arborescence_article_categorie_contenu");
            while ($activite = $activite_req->fetch()) {
                ?>
                <OPTION value="<?php echo $activite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $activite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $rayon_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=4 order by nom_classification_arborescence_article_categorie_contenu");
            while ($rayon = $rayon_req->fetch()) {
                ?>
                <OPTION value="<?php echo $rayon["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $rayon["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $reseau_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=5 order by nom_classification_arborescence_article_categorie_contenu");
            while ($reseau = $reseau_req->fetch()) {
                ?>
                <OPTION value="<?php echo $reseau["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $reseau["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $environnement_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=51 order by nom_classification_arborescence_article_categorie_contenu");
            while ($environnement = $environnement_req->fetch()) {
                ?>
                <OPTION value="<?php echo $environnement["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $environnement["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $saisonalite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=52 order by nom_classification_arborescence_article_categorie_contenu");
            while ($saisonalite = $saisonalite_req->fetch()) {
                ?>
                <OPTION value="<?php echo $saisonalite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $saisonalite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <SELECT>
            <?php
            $export_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=7 order by nom_classification_arborescence_article_categorie_contenu");
            while ($export = $export_req->fetch()) {
                ?>
                <OPTION value="<?php echo $export["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $export["nom_classification_arborescence_article_categorie_contenu"]; ?>
                    <?php
                }  
                ?>
        </SELECT>
        <?php
    }
    ?>
    <tbody> <!-- Corps du tableau -->

        <tr>
            <td>
                <?php

                function arborescence_tableau($table, $champ_valeur, $champ_id_fils, $champ_id_pere, $id_racine) {
                    $table_req = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu,classification_fta';                                      //nom de la table contenant l'association "Père" / "Fils"
                    $champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
                    $champ_fta = 'id_fta';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
                    $champ_id_fils = 'classification_arborescence_article.id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
                    $champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
                    $id_recherche = 1;


                    $requete_principale = " SELECT " . $champ_id_fils . "," . $champ_id_pere . "," . $champ_fta . "," . $champ_valeur . " "
                            . " FROM " . $table_req . ""
                            . " WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
                            . "AND classification_arborescence_article.id_classification_arborescence_article=classification_fta.id_classification_arborescence_article "
                            . "ORDER BY `classification_fta`.`id_fta` ASC";

                    $resultat = $connect->query($requete_principale);
                    $i = 0;
                    foreach ($resultat as $rip) {
                        $arborescence[] = array(
                            $valeur_pere[$i] => $rip["id_classification_arborescence_article"],
                            $valeur_fta[$i] = $rip["id_fta"],
                            $valeur_fils[$i] = $rip["id_classification_arborescence_article"],
                            $valeur_nom[$i] = $rip["nom_classification_arborescence_article_categorie_contenu"]
                        );
                        $i = $i + 1;
                        // $tableau = recursif($resultat, $id_recherche, $valeur_pere, $valeur_fils, $valeur_fta);
                        ?>
                    </td>
                    <td> 

                    </td>
                    <td> 
                    </td>
                    <td>
                    </td>
                    <td> 
                    </td>
                    <td> 
                    </td>
                    <td>        
                    </td>
                    <td>        
                    </td>
                    <?php
                }
            }
            ?>
        </tr>


        <tr>

            <td>        
                <SELECT name="Propiétaire" size="1">
                    <?php
                    $proprietaire_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=1 order by nom_classification_arborescence_article_categorie_contenu ");
                    while ($proprietaire = $proprietaire_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $proprietaire["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $proprietaire["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $marque_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=2 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($marque = $marque_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $marque["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $marque["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $activite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=3 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($activite = $activite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $activite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $activite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $rayon_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=4 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($rayon = $rayon_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $rayon["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $rayon["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $reseau_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=5 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($reseau = $reseau_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $reseau["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $reseau["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $environnement_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=51 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($environnement = $environnement_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $environnement["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $environnement["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $saisonalite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=52 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($saisonalite = $saisonalite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $saisonalite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $saisonalite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $export_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=7 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($export = $export_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $export["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $export["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>

        </tr>



        <tr>

            <td>        
                <SELECT name="Propiétaire" size="1">
                    <?php
                    $proprietaire_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=1 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($proprietaire = $proprietaire_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $proprietaire["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $proprietaire["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $marque_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=2 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($marque = $marque_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $marque["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $marque["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $activite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=3 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($activite = $activite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $activite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $activite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $rayon_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=4 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($rayon = $rayon_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $rayon["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $rayon["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $reseau_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=5 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($reseau = $reseau_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $reseau["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $reseau["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $environnement_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=51 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($environnement = $environnement_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $environnement["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $environnement["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $saisonalite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=52 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($saisonalite = $saisonalite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $saisonalite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $saisonalite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $export_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=7 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($export = $export_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $export["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $export["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>

        </tr>


        <tr>

            <td>        
                <SELECT name="Propiétaire" size="1">
                    <?php
                    $proprietaire_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=1 order by nom_classification_arborescence_article_categorie_contenu ");
                    while ($proprietaire = $proprietaire_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $proprietaire["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $proprietaire["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $marque_req2 = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=2 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($marque = $marque_req2->fetch()) {
                        ?>
                        <OPTION value="<?php echo $marque["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $marque["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $activite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=3 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($activite = $activite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $activite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $activite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $rayon_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=4 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($rayon = $rayon_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $rayon["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $rayon["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $reseau_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=5 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($reseau = $reseau_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $reseau["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $reseau["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $environnement_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=51 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($environnement = $environnement_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $environnement["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $environnement["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $saisonalite_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=52 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($saisonalite = $saisonalite_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $saisonalite["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $saisonalite["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>
            <td>        
                <SELECT>
                    <?php
                    $export_req = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=7 order by nom_classification_arborescence_article_categorie_contenu");
                    while ($export = $export_req->fetch()) {
                        ?>
                        <OPTION value="<?php echo $export["id_classification_arborescence_article_categorie_contenu"] ?>"> <?php echo $export["nom_classification_arborescence_article_categorie_contenu"]; ?>
                            <?php
                        }  
                        ?>
                </SELECT>
            </td>

        </tr>
    </tbody>
</table>
</html>




