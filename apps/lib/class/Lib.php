<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib
 *
 * @author bs4300280
 */
class Lib {

//public static $my_static = 'foo';
    public static $module = '';
    public static $title = '';

    public static function showMessage($titre, $message, $redirection = NULL) {
        /*
          Dictionnaire des variables:
         * **************************
         */
        if ($redirection == NULL) {
            $redirection = '\'Javascript:;\' onClick=\'history.go(-1);return(false);\'';
        }
        $bouton_valider = '
                       <a href=' . $redirection . '>
                       <img src=../lib/images/bouton_valider_jaune.gif border=0>
                       </a>
                       ';
        echo
        '
         <TABLE>
         <TR>
             <td id=tableProps width=70 valign=top align=center>
                 <IMG id=pagerrorImg SRC=../lib/images/icone_information.png width=20 height=38>

             </td><TD id=tablePropsWidth width=400>
                      <h1 id=errortype style=\'font:14pt/16pt verdana;
        color:#4e4e4e\'>
        <id id = \'Comment1\'><!--Problem--></id><id id = \'errorText\'>' . $titre . '</id></h1>
        <id id = \'Comment2\'><!--Probable causes:< --></id><id id = \'errordesc\'><font style = \'font:9pt/12pt verdana; color:black\'>
        ' . $message . '
        </id>
        <br><br>
        <hr size = 1 color = \'blue\'>
        <br>
        <ID id = term1>
       ' . $bouton_valider . '
        </ID>
        <P>
        </ul>
        <BR>
        </TD>
        </TR>
        <!/TABLE>
        ';
        exit;
        //include ('../lib/fin_page.inc');
    }

    /**
     * IsDefine n'est plus à utiliser pour récuperer les éléments de l'url
     * @param type $variable_name
     * @param type $variable_default_value
     * @return type
     */
    public static function isDefined($variable_name, $variable_default_value = null) {
//$result = (isset($_REQUEST[$variable_name]) && $_REQUEST['$variable_name'] != '') ? $_REQUEST['$variable_name'] : '$variable_default_value';
        $result = '';
        if (isset($_REQUEST[$variable_name]) && $_REQUEST[$variable_name] != '') {
            $result = $_REQUEST[$variable_name];
        } else {
            if (isset($_SESSION[$variable_name]) && $_SESSION[$variable_name] != '') {
                $result = $_SESSION[$variable_name];
            } else {
                if (isset($GLOBALS[$variable_name]) && $GLOBALS[$variable_name] != '') {
                    $result = $GLOBALS[$variable_name];
                } else {
                    $result = $variable_default_value;
                }
            }
        }
        return $result;
    }

    /**
     * Récupère la valeur d'un paramètre passé par requête HTTP (GET ou POST)
     * @param <type> $variable_name Nom de la variable
     * @param <type> $variable_default_value Si le paramètre n'existe pas, valeur par défaut à affecter
     * @return <type> Retourne la valeur de la variable
     */
    public static function getParameterFromRequest($variable_name, $variable_default_value = null) {

        $result = null;
        if (isset($_REQUEST[$variable_name])) {
            $result = $_REQUEST[$variable_name];
        } else {
            $result = $variable_default_value;
        }

        return $result;
    }

    public static function getModule() {
        return Lib::$module;
    }

    public static function getModuleId() {

        $req = 'SELECT id_intranet_modules FROM intranet_modules WHERE nom_intranet_modules = \'' . Lib::$module . '\'';
        $result = DatabaseOperation::query($req, 'table');
        $return = $result[0]['id_intranet_modules'];
//print_r ($return);
        return $return;
    }

    public static function setModule($module = null) {

        $return = '';
        $conf = new GlobalConfig();
        $scriptName = $_SERVER['SCRIPT_NAME'];
        if ($module == null) {
            $subdir = '/' . $conf->getConf()->getUrlRoot() . '/' . $conf->getConf()->getUrlSubdir() . '/';
            $tmp = substr($scriptName, strlen($subdir));
            $return = substr($tmp, 0, strlen($tmp) - strlen(strstr($tmp, '/')));
        } else {
            $return = $module;
        }
        Lib::$module = $return;

        return $return;
    }

    public static function getTitle() {
        return Lib::$title;
    }

    public static function setTitle($title = null) {

        $return = '';

        if ($title == null) {
            $globalConfig = new GlobalConfig();
            $title = $globalConfig->getConf()->getApplicationTitle()
                    . ' (v' . $_SESSION['intranet_modules']['lib']['version_intranet_modules'] . ') '
                    . ' - '
                    . $_SESSION['intranet_modules'][self::$module]['nom_usuel_intranet_modules']
                    . ' (v' . $_SESSION['intranet_modules'][self::$module]['version_intranet_modules'] . ')';
            $return = $title;
        } else {
            $return = $title;
        }
        self::$title = $return;

        return self::$title;
    }

    public static function includeJS($JavascriptFile) {
        echo '<script type = \'text/javascript\' src=\'' . $JavascriptFile . '\'></script>';
    }

    /**
     * Inclus l'ensemble des fichiers d'un répertoire
     * @param type $paramPhpPackagePath répertoire
     */
    public static function importPhpPackage($paramPhpPackagePath) {
        foreach (glob($paramPhpPackagePath . '/*.php') as $filename) {
            require_once $paramPhpPackagePath . '/' . $filename;
        }
    }

}

?>
