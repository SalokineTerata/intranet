<?php
$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 

$connect = new PDO('mysql:host=dev-intranet.agis.fr;dbname=intranet_v3_0_dev;charset=utf8', 'root', '8ale!ne') or die("connexion impossible");
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

        <tbody> <!-- Corps du tableau -->

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
                        $marque_req2 = $connect->query("SELECT DISTINCT nom_classification_arborescence_article_categorie_contenu FROM `classification_arborescence_article_categorie_contenu` where id_classification_arborescence_article_categorie=2 order by nom_classification_arborescence_article_categorie_contenu ");
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




