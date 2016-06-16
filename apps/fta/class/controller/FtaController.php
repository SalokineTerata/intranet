<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FtaController
 *
 * @author salokine
 */
class FtaController {

    const CALLBACK_LINK_TO_TRANSITER_PAGE = "Retour";
    const CALLBACK_LINK_TO_TRANSITER_PAGE_VALIDATE = "Confirmer";
    const TEST = ModuleConfig::VALUE_MAX_MOTEUR_RECHERCHE;

    /**
     * Duplication d'une table donné par son id
     * @param string $paramTable
     * @param int $paramId
     * @return int
     */
    public static function duplicateId($paramTable, $paramId) {
        $key = StaticStandardModel::duplicateRowsById($paramTable, $paramId);

        return $key;
    }

    /**
     * Duplication d'une table avec un nouvelle id 
     * @param type $paramTable
     * @param type $paramIdOLD
     * @param type $paramIdNEW
     * @return type
     */
    public static function duplicateWithNewId($paramTable, $paramIdOLD, $paramIdNEW) {
        StaticStandardModel::duplicateRowsByIdReplaceLast($paramTable, $paramIdOLD, $paramIdNEW);
    }

    /**
     *  Génère le commentaire d'un changement d'espace de travail
     * @param string $paramWorkflowOLD
     * @param string $paramWorkflowNEW
     * @param string $paramUser
     * @return string
     */
    public static function getCommentWorkflowChange($paramWorkflowOLD, $paramWorkflowNEW, $paramUser) {

        $comment = UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_1
                . $paramWorkflowOLD . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_2
                . $paramWorkflowNEW;
        $action = UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_1;

        $fullComment = self::getComment($action, $paramUser, $comment);

        return $fullComment;
    }

    /**
     * Mise en forme du commentaire de changement de gestionnaire
     * @param string $paramGestionnaireOLD
     * @param string $paramGestionnaireNEW
     * @param string $paramUser
     * @return string
     */
    public static function getCommentGestionnaireChange($paramGestionnaireOLD, $paramGestionnaireNEW, $paramUser) {

        $comment = UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_1
                . $paramGestionnaireOLD . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_2
                . $paramGestionnaireNEW;
        $action = UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_1;

        $fullComment = self::getComment($action, $paramUser, $comment);

        return $fullComment;
    }

    /**
     * Mise en forme des commentaires
     * @param string $paramAction
     * @param string $paramUser
     * @param string $paramCommentaire
     * @return string
     */
    public static function getComment($paramAction, $paramUser, $paramCommentaire, $paramDate = NULL) {
        if (!$paramDate) {
            $paramDate = date('d-m-Y H:i:s');
        } else {
            $paramDate = FtaController::changementDuFormatDeDateFR($paramDate);
        }
        $newComment = "\n"
                . "==============================\n\n"
                . "Action : " . $paramAction . " \n"
                . "Date: " . $paramDate . "\n"
                . "Utilisateur: " . $paramUser . "\n";

        if ($paramCommentaire) {
            $newComment .= "Commentaire:   " . $paramCommentaire;
        }

        return $newComment;
    }

    /**
     * On vérifie si la date est au bon format français
     * @param date $value
     * @return boolean
     */
    public static function isCheckDateFormat($value) {
        $result = DateTime::createFromFormat("d-m-Y H:i:s", $value);
        return $result;
    }

    /**
     * Modifie le format de date vers le FR
     * @param string $paramValeurDate
     * @return string
     */
    public static function changementDuFormatDeDateFR($paramValeurDate) {
        /*
          Dictionnaire des variables:
         * **************************
          $valeur_date: contient la date au format AAAA-MM-JJ
         */
        $checkValue = FtaController::isCheckDateFormat($paramValeurDate);
        if ($checkValue) {
            /**
             * Extraction de l'année
             * Format Français
             */
            $annee = substr($paramValeurDate, 6, 9);
            $mois = substr($paramValeurDate, 3, 2);
            $jours = substr($paramValeurDate, 0, 2);
            $heure = substr($paramValeurDate, 11, 2);
            $minute = substr($paramValeurDate, 14, 2);
            $seconde = substr($paramValeurDate, 17, 2);
        } else {
            /**
             * Extraction de l'année
             * Format Anglais
             */
            $annee = substr($paramValeurDate, 0, 4);
            $mois = substr($paramValeurDate, 5, 2);
            $jours = substr($paramValeurDate, 8, 2);
            $heure = substr($paramValeurDate, 11, 2);
            $minute = substr($paramValeurDate, 14, 2);
            $seconde = substr($paramValeurDate, 17, 2);
        }
        $date = $jours . "-" . $mois . "-" . $annee . " ";
        if ($heure AND $minute AND $seconde) {
            $temps = $heure . ":" . $minute . ":" . $seconde;
        }
        $return = $date . $temps;
        return $return;
    }

    /**
     * On récupère le nombre indiqué de caractères
     * @param string $paramString
     * @param int $paramLimitNumber
     * @return string
     */
    public static function getFirstStringNumber($paramString, $paramLimitNumber) {
        $result = "";
        if ($paramString) {
            $result = substr($paramString, 0, $paramLimitNumber);
        }
        return $result;
    }

    /**
     * Retourne le résultat de ce calcul valeur * (2/3)
     * @param string $param
     * @return float
     */
    public static function getTwoOfThreeValue($param) {
        $result = floor(($param * "2") / "3");
        return $result;
    }

    /**
     * Actualisation du calcul de la duree de vie client pour les espace de trvail MDD
     * @param string $paramWorkflow
     * @param string $paramNomChapitre
     * @param FtaModel $paramFtaModel
     */
    public static function refreshDureeDeVieMDD($paramWorkflow, $paramNomChapitre, FtaModel $paramFtaModel) {

        switch ($paramWorkflow) {
            case FtaWorkflowModel::NOM_FTA_WORKFLOW_MDD_AVEC:
            case FtaWorkflowModel::NOM_FTA_WORKFLOW_MDD_SANS:

                if ($paramNomChapitre == FtaChapitreModel::NOM_CHAPITRE_DUREE_DE_VIE) {
                    $dureeDeVieProductionValue = $paramFtaModel->getDureeDeVieClientByDureeDeVieProduction();
                    $paramFtaModel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->setFieldValue($dureeDeVieProductionValue);
                    $paramFtaModel->saveToDatabase();
                }

                break;

            default:
                break;
        }
    }

    /**
     * On vérifie si un text ne contient que des  lettres en majuscule et en excluant les espaces auparavant
     * @param type $paramString
     * @return type
     */
    public static function isStringIsUperCase($paramString) {
        $temp = str_replace(' ', '', $paramString);
        return ctype_upper(preg_replace('/[0-9]+/', '', $temp));
    }

    /**
     * On vérifie si un text ne contient que des lettre en minuscule et en excluant les espaces auparavant
     * @param type $paramString
     * @return type
     */
    public static function isStringIsUperLower($paramString) {
        return ctype_lower(str_replace(' ', '', $paramString));
    }

    /**
     * On vérifie si un text contient des caractère spéciaux en excluant les espaces auparavant
     * @param type $paramString
     * @return type
     */
    public static function isStringHasSpecialCaracter($paramString, $paramCheckList) {
        return preg_match($paramCheckList, str_replace(' ', '', $paramString));
    }

    /**
     * Indique si une valeur appartient à un tableau
     * @param string $paramValue
     * @param array $paramArray
     * @return boolean
     */
    public static function isValueInArray($paramValue, $paramArray) {
        if ($paramArray) {
            $checkData = in_array($paramValue, $paramArray);
        } else {
            $checkData = FALSE;
        }

        return $checkData;
    }

    /**
     * Vérifie si une clé existe dans un tableau
     * @param string $paramKey
     * @param array $paramArray
     * @return boolean
     */
    public static function isValueIsInKeyArray($paramKey, $paramArray) {
        if ($paramArray) {
            $checkData = array_key_exists($paramKey, $paramArray);
        } else {
            $checkData = FALSE;
        }

        return $checkData;
    }

    /**
     * On vérifie si la donnée en BDD se trouve dans le tableau
     * Sinon alors on vide la donnée de la BDD
     * @param DatabaseDataField $paramDataField
     * @param array $paramArray
     * @return \DatabaseDataField
     */
    public static function checkDataInArrayKeyList(DatabaseDataField $paramDataField, $paramArray) {
        $checkDataResgister = FtaController::isValueIsInKeyArray($paramDataField->getFieldValue(), $paramArray);
        if (!$checkDataResgister) {
            $paramDataField->setFieldValue("");
        }

        return $paramDataField;
    }

}

?>
