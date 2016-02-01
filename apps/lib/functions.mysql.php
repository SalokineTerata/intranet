<?php

//Include des fonctions thématiques
//Fonctions diverses
//Autorisation de consulter le module:
//En effet cette page est chargee par toutes les page de ce module
/*
  if (nom_du_module==0)
  {
  header ("Location: none.php");
  }
 */

/*
  Initialisation des variables globales du modules:
  ----------------------------------------------- */

/* -----------------------------------------------------
  Determination du profil de l'utilisateur pour ce module
  ----------------------------------------------------- */

/*
  Dictionnaire des variables:
  ---------------------------
 */

/* ---------------------------------------------
  FONCTIONS GLOBALES DE TOUS LES MODULE INTRANET
  --------------------------------------------- */

/*
  Exemple de declaration de fonctions
 * **********************************
 */

/* function fonction1($variable1,$variable2, $variable3, $variable4)

  /*
  Dictionnaire des variables:
 * **************************
 */

/*
  {
  //Corps de la fonction

  }
 */

/*
 * ******************************************************************************
 *                            DEBUT DES FONCTIONS                              *
 * ******************************************************************************
 */

/*
  Analyse les différences entre les deux versions d'enregistrement d'une même table
  Pour ce faire, la table doit contenir un champ nommé last_id_nom_de_la_table
  Ce champ doit contenir la clef de la version précédente de l'enregsitrement en cours
  Cette fonction retourne un tableau de résultat dont l'index est le nom du champ, et la valeur
  est 1 ou 0.
  0 = Aucune différence
  1 = Différence entre les deux versions

  le paramètre $parent_id peut être utilisé dans le cas de table ne possédant pas le champ
  PARENT_ID_nom_de_la_table. Dans ce cas, il faut indiqué explicitement cette variable.

  Prêt-à-coller:
  //Récupération du différenciel de version
  $table_name_1="access_arti2";
  $id_1 = $current_id_access_arti2;
  $table_name_2="access_arti2";
  $id_2 = $last_id_access_arti2;
  $debug=0;
  ${"diff_".$table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);

 */
function mysql_field_desc($table_name, $field_name) {

    return DatabaseDescription::getFieldDocLabel($table_name, $field_name);
}

/*
  Récupération de la description d'un champ
 * ****************************************
 */

/*
  Conversion date
 * **************

  Cette fonction permet de recuperer le jour, le mois et l'annee saisie e
  partir de la fonction selection_date_pour_mysql(). Elle récupère et format
  la date au format MySQL
  La function renvoi la variable nouvellement créée.
 */

/*
  Exemple de syntaxe de la fonction:
  $nom_date="validation_matiere_premiere";
  $nom_liste="selection_".$nom_date;
  if($$nom_date)
  {
  $date_defaut=$$nom_date;
  }else{
  $date_defaut=date('Y-m-d');
  }
  $$nom_liste=selection_date_pour_mysql($nom_date, $date_defaut);
 */

function recuperation_date_pour_mysql($jour_date, $mois_date, $annee_date, $nom_date)

/*
  Dictionnaire des variables:
 * **************************
  $nom_date: contient le nom du champ MySQL qui sera ensuite une variable
  contenant la date au format MySQL
 */ {
    //Initialisation des variables
    $$nom_date = "";
    $message = "";


//   Si c'est egal à 1, l'erreur provoquera l'affichage d'un message.
//   Cette variable est de type "global", ainsi on peut la retraiter hors de la fonction.
    //echo $GLOBALS['erreur'];
    if ($GLOBALS['erreur']) {
        $GLOBALS['erreur'] = 1;
    } else {
        $GLOBALS['erreur'] = 0;
    }

//   Validation des valeurs saisies
//   ******************************

    if (!$jour_date and ! $mois_date) {
        $jour_date = '00';
        $mois_date = '00';
        $annee_date = '0000';
    } else {
        //Jours
        if (($jour_date < "1") OR ( $jour_date > "31")) {
            $message.= "
                         La date du jour est incorrecte sur $nom_date
                         <br>
                         ";
            $erreur = 1;
        } else {

            if (strlen($jour_date) == 1) {
                $jour_date = "0" . $jour_date;
            }
        }

        //Mois
        if (($mois_date < 1) OR ( $mois_date > 12)) {
            $message.= "
                         Le mois est incorrect sur $nom_date
                         <br>
                         ";
            $erreur = 1;
        } else {

            if (strlen($mois_date) == 1) {
                $mois_date = "0" . $mois_date;
            }
        }

        //Annee
        if ((strlen($annee_date) <> 2) AND ( strlen($annee_date) <> 4)) {
            $message.= "
                         L'annee est incorrecte sur $nom_date
                         <br>
                         ";
            $erreur = 1;
        } else {
            if (strlen($annee_date) == 2) {
                $annee_date = "20" . $annee_date;
            }
        }

        //Si une erreur est apparue, affichage de celui-ci
        if ($erreur) {
            $GLOBALS['erreur'] = 1;
            $redirection = "'javascript :;' onClick='history.go(-1);return(false)'";
            afficher_message($titre, $message, $redirection);
        }
    }//Fin de validation des valeur saisies
//  Creation de la variable
//   ***********************

    $$nom_date = $annee_date . "-" . $mois_date . "-" . $jour_date;
    return $$nom_date;
}

/* * *************************************************************************** */
/* * *************************************************************************** */

function recuperation_date_depuis_mysql($valeur_date) {
    /*
      Dictionnaire des variables:
     * **************************
      $valeur_date: contient la date au format AAAA-MM-JJ
     */
    $valeur_date = "2015-01-25";
    $checkValue =  FtaController::isCheckDateFormat($valeur_date);
    if ($checkValue) {
        /**
         * Extraction de l'année
         * Format Français
         */
        $annee = substr($valeur_date, 6, 9);
        $mois = substr($valeur_date, 3, 2);
        $jours = substr($valeur_date, 0, 2);
    } else {
        /**
         * Extraction de l'année
         * Format Anglais
         */
        $annee = substr($valeur_date, 0, 4);
        $mois = substr($valeur_date, 5, 2);
        $jours = substr($valeur_date, 8, 2);
    }
    $return = $jours . "/" . $mois . "/" . $annee;
    return $return;
}

/*
  Creation des listes de selection_d'une date
 * *****************************************
  Cette fonction cree des variables qui pourront etre reutilise avec
  la fonction recuperation_date_pour_mysql.

  Pour afficher cet objet dans une page, il faut utiliser la variable nomme:
  $selection_$$nom_date. Par exemple: si $nom_date=date_de_saisie, alors pour afficher
  la liste correspondante, utiliser la commande:
  echo $selection_date_de_saisie;

  Axe d'amelioration: gestion d'un veritable calendrier
 */

/*
  Exemple de syntaxe
  $nom_date="validation_matiere_premiere";
  $txt1="jour_date_".$nom_date;
  $jour_date=$$txt1;
  $txt1="mois_date_".$nom_date;
  $mois_date=$$txt1;
  $txt1="annee_date_".$nom_date;
  $annee_date=$$txt1;
  $$nom_date=recuperation_date_pour_mysql($jour_date,$mois_date, $annee_date, $nom_date);
 */

function selection_date_pour_mysql($nom_date, $date_defaut) {
    /*
      Dictionnaire des variables:
     * **************************
     */
    $i = 0;                                        //Compteur generique
    $annee_actuelle = date("Y");                   //Annee en cours
    $annee_max = ($annee_actuelle + 2);          //Annee maximale de la liste deroulante
    $annee_min = ($annee_actuelle - 10);          //Devinez !?
//$date_defaut                                 La date doit-etre au format MySQL
    $selected = 0;                               //Permet de savoir si un eleement
    //de la liste a deje etait selectionne
    //0=Non et 1=Oui
//Corps de la fonction
    //Formatage de la date par defaut
    if ($date_defaut)
        $jour_date_defaut = substr($date_defaut, -2);
    $mois_date_defaut = substr($date_defaut, 5, 2);
    $annee_date_defaut = substr($date_defaut, 0, 4);

    //Creation de la liste de selection du jour
    $i = 1;
    $liste_jour_date = "<select name="
            . "jour_date"
            . "_"
            . $nom_date
            . ">"
            . "<option value=''>Jour</option>"
    ;
    while ($i <= 31) {
        $liste_jour_date .= "<option value=$i";
        if ($i == $jour_date_defaut and $jour_date_defaut) {
            $liste_jour_date .= " selected";
        }
        $liste_jour_date .= ">$i</option>";
        $i = $i + 1;
    }
    $liste_jour_date .= "</select>";


    //Creation de la liste de selection du mois
    $i = 1;
    $liste_mois_date = "<select name="
            . "mois_date"
            . "_"
            . $nom_date
            . ">"
            . "<option value=''>Mois</option>"
    ;
    while ($i <= 12) {
        $liste_mois_date .= "<option value=$i";
        if ($i == $mois_date_defaut and $mois_date_defaut) {
            $liste_mois_date .= " selected";
        }
        $liste_mois_date .= ">$i</option>";
        $i = $i + 1;
    }
    $liste_mois_date .= "</select>";

    //Creation de la liste de selection de l'annee
    $i = $annee_max;
    $liste_annee_date = "<select name="
            . "annee_date"
            . "_"
            . $nom_date
            . ">"
    ;
    while ($i >= ($annee_min)) {
        $liste_annee_date .= "<option value=$i";
        //echo $i."=".$annee_date_defaut."<br>";
        if ($i == $annee_date_defaut and $annee_date_defaut) {
            $liste_annee_date .= " selected";
            $selected = 1;
        } else {
            if ($i == $annee_actuelle and ! $selected) {
                $liste_annee_date .=" selected";
            }
        }

        $liste_annee_date .= ">$i</option>";
        $i = ($i - 1);
    }
    $liste_annee_date .= "</select>";

    //Fonction de calendrier
    $calendrier .="<input name=$nom_date value=$date_defaut />"
            . " <a href=javascript:openCalendar('lang=fr-iso-8859-1&amp;server=1','form_action','$nom_date','date') />"
            //. " <a href=javascript:MM_openBrWindow('theURL','winName','features') />"
            . "<img src=../lib/images/bouton_calendar.png width=16 height=16 border=0 />"
            . "</a>"
    ;
    //openCalendar(params, form, field, type);
    //Envoi des listes deroulantes
    $retour_fonction = $liste_jour_date . $liste_mois_date . $liste_annee_date;
    //$retour_fonction=$calendrier;
    return $retour_fonction;
}

/* * *************************************************************************** */
/* * *************************************************************************** */





/*
  Chargement rapide de toutes les variables d'une table
 * ****************************************************
  Faites vous plaisir, optimsez cette fonction !

  Cree par :
  Boris Sanegre           - 2003.06.02

  Ameliore par:
  C'est e vous ...

  Merci e: HAPedit, www.php.net

  Cette fonction permet de creer les variables d'un table MySQL pour un enregistrement particulier.
  Prenons un exemple:

  Vous avez une page index.php contenant des objet HTML (liste, text, textarea ...)
  Vous souhaitez charger les donnees d'une Fiche Ne23 d'une table "recette".

  Solution:
  Le nom des variables definissant le valeurs par defaut des objets HTML doivent etre
  identique au nom des champs de la table:

  Nom de la table: recette
  Champs:
  id_recette
  nom_recette
  ... (et 450 autres champs)

  Donc dans votre code, il y a les variables $id_recette,
  $nom_recette (...etc.) pour les 'value=' de vos objets HTML

  Pour charger l'enregistrement Ne23, mettez en debut de page

  # $nom_table = 'recette';
  # $id_recette = '23'; //Cette variable sera INDIRECTEMENT
  //reprise par la fonction
  # mysql_table_load($nom_table);

  La fonction recherche l'existance des clefs et leur valeur
  Et toute vos variables sont chargees immediatement!!
  Tres utile lorsqu'il y a beaucoup de variables.

  Voici la fonction en question e inclure.
  Note: Une fois la saisie terminee, vous pouvez utiliser la fonction perso
  mysql_table_operation()

  Remarque: La seule contrainte est d'etre rigoureux dans le nom des champs
  MySQL et des variables ... mais la rigeure devient efficacite sur le long terme.
 */

/**
 * Charge dans $_SESSION les valeurs des champs du recordset
 * /!\ Cette fonction ne doit plus être utilisée /!\
 * @deprecated since version 3.0
 * @param string $paramTableName nom de la table dont il faut charger le recordset
 */
function mysql_table_load($paramTableName) {
    $KeyValue = $_SESSION[DatabaseDescription::getTableKeyName($paramTableName)];
    if ($KeyValue) {
        $recordset = new DatabaseRecord($paramTableName, $KeyValue);

        $fields = $recordset->getFieldsArray();
        foreach ($fields as $key => $value) {
            /**
             * Exportation de la valeur de la variable dans
             * Une variable globale accessible hors de la fonction
             * Formatage des données pour préparation à intégration dans MySQL
             * 
             * TRES TRES SALE !!
             */
            $GLOBALS[$key] = $value;
        }
    }

    return $recordset;
}

function mysql_table_load_old($nom_table) {


    /*
      Dictionnaire des variables:
     * **************************
     */

    $bdd = Lib::isDefined("bdd");            //Variable Globale definissant le nom de la base de donnees MySQL
    $show_help = Lib::isDefined("show_help"); //Activer l'aide en ligne Pop-up
    $nom_table;                        //Nom de la table e charger
    $premiere_operateur_where = 1;     //Permet de supprimer les AND en trop dans la
    $return = "";
    //construction des WHERE
    /*
      Travaux preparatoires:
     * *********************
     */

//Requete MySQL
    $req_where = " WHERE ";

//Recherche des clefs de la table
    $propriete = DatabaseOperation::query("DESC $nom_table");

    while ($rows1 = mysql_fetch_array($propriete)) {
        //Creation de la variable potentiellement PRIMARY KEY
        $primary_key = $rows1["Field"];

        //Est-ce que ce champ est une clef et qu'une variable est definit
        if ($rows1["Key"] == "PRI") {
            //Affectation de la valeur de la variables
            $$primary_key = Lib::isDefined($primary_key);

            //Integration de la clef PRIMAIRE dans les requetes
            $operateur = " AND ";
            if ($premiere_operateur_where) {
                $operateur = '';
            }
            $premiere_operateur_where = 0;
            $req_where .=$operateur
                    . "`" . $primary_key . "`"
                    . "="
                    . "'" . $$primary_key . "'"
            ;
        }//Fin de Recherche de la clef sur ce champ
    }//Fin WHILE de recherche des clefs

    $req1 = "SELECT * FROM $nom_table " . $req_where;
    $result1 = DatabaseOperation::query($req1);
    if ($result1) {
        $num_rows1 = mysql_num_rows($result1);
    } else {
        $titre = "Erreur de Programmation sur cette Page";
        $message = "Certaines clefs n'ont pas été definies avant l'appel de la fonction mysql_table_load().";
        afficher_message($titre, $message, $redirection);
    }

    /*
      Corps de la fonction
     * *******************
     */
    $fields = mysql_list_fields($bdd, $nom_table);
    $num_fields = mysql_num_fields($fields);
    for ($i = 0; $i < $num_fields; $i++) {
        if ($num_rows1) {
            //Recuperation du nom de la variables
            $nom_variable = mysql_field_name($fields, $i);

            //Récupération/Exportation du commentaire qui va servir d'étiquette
            $comment = "NOM_" . $nom_variable;
            $GLOBALS[$comment] = mysql_field_desc($nom_table, $nom_variable, $show_help);

            //Exportation de la valeur de la variable dans
            //Une variable globale accessible hors de la fonction
            //Formatage des données pour préparation à intégration dans MySQL
            $GLOBALS[$nom_variable] = stripslashes(mysql_result($result1, 0, $nom_variable));

            //Recherche si la valeur n'est pas NULL
            if ($GLOBALS[$nom_variable] == 0) {
                $req_null = "SELECT * FROM `$nom_table` $req_where AND `$nom_variable` = NULL";
                $result_null = DatabaseOperation::query($req_null);
                if (mysql_num_rows($result_null)) {
                    $GLOBALS[$nom_variable] = "";
                }//Fin de if(mysql_num_rows($result_null))
            }//Fin de Recherche si la valeur n'est pas NULL
            //Enregistrement du tableau de résultat
            $return[$i][0] = $_SESSION["COMMENT_" . $nom_variable];
            $return[$i][1] = $GLOBALS[$nom_variable];
        }//Fin de if ($num_rows1)
    }//Fin de for ($i = 0; $i < $num_fields; $i++)

    return $return;
}

//Fin de function mysql_table_load()



/* * *************************************************************************** */
/* * *************************************************************************** */




/*
  Mise e jour ou insertion d'un enregistrement dans une table MySQL
 * ****************************************************************
  Faites vous plaisir, optimsez cette fonction !

  Cree par :
  Boris Sanegre           - 2003.06.02

  Ameliore par:
  C'est e vous ...

  Merci à: HAPedit, www.php.net


  Cette fonction permet d'effectuer des operations de base sur un
  enregistrement d'une table MySQL. Les operations sont definit par
  la variable $operation dont voici les possibilites actuelles:

  - update  : Effectue une mise e jour de l'enregistrement

  - delete  : Supprime l'enregistrement

  - rewrite : Reecrit entierement l'enregistrement en gardant le "$id_nom_table"

  - copy    : copie l'enregistrement en affectant un nouvel identifiant.
  Seule la variable "$id_nom_table" est modifiée dans le nouvel enregistrement

  - clone   : Cree un doublon de l'enregistrement "$id_nom_table"

  - insert  : Cree un nouvel enregistrement. (Ne tient pas compte de la variable
  "$id_nom_table")

  (gestion multi-clef non-supporté)

 */

function mysql_table_operation($nom_table, $operation) {

    /*
      Dictionnaire des variables:
     * **************************
     */

    //$bdd = $_SESSION["mysql_database_name"];                //Variable Globale definit dans /lib/session.php et
    $globalConfig = new GlobalConfig();
    //$conf = $_SESSION["globalConfig"];
    $bdd = $globalConfig->getConf()->getMysqlDatabaseName();
    //$bdd = $conf->mysql_database_name;
    //represente le nom de la base de donnees
    $nom_table;                            //Nom de la table e charger
    $operation;                            //update, delete, rewrite, copy, clone ou insert
    $premiere_virgule_update = 1;          //Permet de supprimer les virgules en trop dans la
    //construction des requetes UPDATE
    $premiere_virgule_insert = 1;          //Permet de supprimer les virgules en trop dans la
    //construction des requetes INSERT et REWRITE
    $premiere_operateur_where = 1;         //Permet de supprimer les AND en trop dans la
    //construction des WHERE
    $premiere_operateur_retour = 1;        //Permet de supprimer le '&' en trop dans la
    //construction du retour de la fonction
    $return = '';                          //Valeur que renvoi la fonction

    $nom_id = "";

    //$list_key_field = array();    //liste des noms des champs étant des clefs

    /*
      Corps de la fonction
     * *******************
     */


//Initialisation des requetes
    $req_update = "UPDATE `" . $nom_table . "` SET ";
    $req_where = " WHERE ";
    $req_delete = "DELETE FROM `" . $nom_table . "`";
    $req_insert = "INSERT INTO `" . $nom_table . "` (";
    $req_insert_values = "VALUES (";
    $req_rewrite = $req_delete;
    $req_copy = $req_insert;
    $req_copy_values = $req_insert_values;
    $req_clone;        //Reste e creer
//Recupération des variables
    $fields = mysql_list_fields($bdd, $nom_table);
    $propriete = DatabaseOperation::query("DESC $nom_table");
    $num_fields = mysql_num_fields($fields);

//Recherche des clefs de la table
    while ($rows1 = mysql_fetch_array($propriete)) {
        //Creation de la variable potentiellement PRIMARY KEY
        $primary_key = $rows1["Field"];

        //$$primary_key=$_SESSION["$primary_key"];
        //Comment récupérer ce qui vient de l'URL ?
        $$primary_key = Lib::isDefined($primary_key);

        if ($rows1["Key"] == "PRI") {
            //Enregistrement de la clef (gestion multi-clef non-supporté)
            $nom_id = $primary_key;
        }

        //Est-ce que ce champ est une clef et qu'une variable est definit
        if (
                ($rows1["Key"] == "PRI") AND
                //(isset($_SESSION["$primary_key"]))
                ( $$primary_key != null)
        ) {
            //$list_key_field[]=$nom_id; //Enregistrement du nom de la clef dans la listes des clefs
            //Affectation de la valeur de la variables Key
            if ($operation == 'copy') {
                $_SESSION["$primary_key"] = '';
                //$$primary_key = '';
            }
            $$primary_key = $_SESSION["$primary_key"];

            //Intégration de la clef PRIMAIRE dans les requetes
            $operateur = " AND ";
            if ($premiere_operateur_where) {
                $operateur = '';
            }
            $premiere_operateur_where = 0;
            $req_where .=$operateur
                    . "`" . $primary_key . "`"
                    . "="
                    . "'" . $$primary_key . "'"
            ;

            //Construction du lien de retour de fonction
            $operateur = "&";
            if ($premiere_operateur_retour) {
                $operateur = '';
            }
            $premiere_operateur_retour = 0;
            $return .=$operateur . $primary_key . "=" . $$primary_key;

            //Effacement des clefs pour eviter de les retrouver dans la suite des requetes
            switch ($operation) {
                case 'insert':
                case 'copy' :

                    $$primary_key = '';
                    break;
            }
        }//Fin de Recherche de la clef sur ce champ
    }//Fin de recherche des clefs
//Integration des variables dans les requetes
    for ($i = 0; $i < $num_fields; $i++) {
        //Recuperation du nom des variables
        $nom_variable = mysql_field_name($fields, $i);

        //$valeur_variable = "test";
        //Verification de la declaration de cette variable,
        //$valeur_variable=$_SESSION["$nom_variable"];
        //Comment récupérer ce qui vient de l'URL ?
        //$valeur_variable=Lib::isDefined($nom_variable);
        $valeur_variable = $_SESSION[$nom_variable];

        if ($valeur_variable != null) {
            //Formatage des données pour préparation à intégration dans MySQL
            // 2009-05-11 BS - Fait planter la duplication d'une FTA: $$nom_variable = "\"" . $GLOBALS[$nom_variable] . "\"";
            // 2011-04-01 BS - Tentative pour enregistrer dans la base des données "propre":
            // $valeur_variable = "'" . addslashes($valeur_variable) . "'";
            $valeur_variable = DatabaseOperation::convertDataForQuery($valeur_variable);
            //$$nom_variable = "'" . htmlentities($GLOBALS[$nom_variable]) . "'";
            //Le champs peut-il etre NULL
            $rechercher_not_null = mysql_field_flags($fields, $i);
            $trouver_not_null = stristr($rechercher_not_null, 'not_null');

            if (
                    (!$trouver_not_null) and ( $valeur_variable == "''")
            ) {
                $valeur_variable = "NULL";
            }

            //Construction des requetes
            //Requete UPDATE
            $virgule = ", ";
            if ($premiere_virgule_update) {
                $virgule = '';
            }
            $premiere_virgule_update = 0;

            $req_update .=$virgule
                    . "`"
                    . $nom_variable
                    . "`="
                    . $valeur_variable
            ;

            //Requete INSERT, REWRITE et COPY
            $virgule = ", ";
            if ($premiere_virgule_insert) {
                $virgule = '';
            }
            $premiere_virgule_insert = 0;

            $req_insert .=$virgule
                    . "`"
                    . $nom_variable
                    . "`"
            ;
            $req_insert_values .=$virgule
                    . $valeur_variable
            ;
        }
    }//Fin de la construction des requetes
//Finalisation des requetes
    //Requete UPDATE:
    $req_update .= $req_where;

    //Requete DELETE:
    $req_delete .= $req_where;

    //Requete INSERT:
    $req_insert .= ")"
            . $req_insert_values
            . ");"
    ;
    $req_insert . "<br>";

    //Requete REWRITE:
    // un DELETE, puis un INSERT
    //Requete COPY:
    $req_copy = $req_insert;


    //Requete CLONE:
    $req_clone;


//Execution des requetes
    switch ($operation) {
        case 'update' :

            DatabaseOperation::query($req_update);
            //echo $req_update."<br>";
            break;

        case 'delete' :

            DatabaseOperation::query($req_delete);

            break;

        case 'insert' :

            DatabaseOperation::query($req_insert);
            //echo $req_insert."<br>";
            break;

        case 'rewrite':

            DatabaseOperation::query($req_delete);
            DatabaseOperation::query($req_insert);

            break;

        case 'copy' :

            DatabaseOperation::query($req_copy);

            break;

        case 'clone' :

            DatabaseOperation::query($req_clone);

            break;
    }

//Renvoi de la fonction
    switch ($operation) {
        case 'copy' :
        case 'insert' :
            //$id = "id_" . $nom_table;
            $id = $nom_id;

            //Externalisation de la variable (pour une table e 1 clef)
            $_SESSION[$id] = mysql_insert_id();
            $return = $id . "=" . $_SESSION[$id];
            break;

        default:
            $return;
            break;
    }
    return $return;
}

//Fin de la fonction "operation_mysql"
?>
