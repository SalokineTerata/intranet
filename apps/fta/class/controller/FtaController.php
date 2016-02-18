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
            $paramDate = date('d-m-Y');
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
        $result = DateTime::createFromFormat("d-m-Y", $value);
        return $result;
    }

    /**
     * Affiche le bouton de retour vers la Fta
     * @return string
     */
    public static function getHtmlButtonReturnTransition($paramIdFta, $paramAction, $paramIdFtaRole, $paramSyntheseAction, $paramDemandeAbreviationFtaEtat) {
        return '<td><center>'
                . '<a href=transiter.php?'
                . 'id_fta=' . $paramIdFta
                . '&action=' . $paramAction
                . '&id_fta_role=' . $paramIdFtaRole
                . '&synthese_action=' . $paramSyntheseAction
                . '&demande_abreviation_fta_transition=' . $paramDemandeAbreviationFtaEtat
                . '>' . self::CALLBACK_LINK_TO_TRANSITER_PAGE . '</a></center></td>';
    }

    /**
     * Affiche le bouton de retour vers la Fta
     * @return string
     */
    public static function getHtmlButtonConfirmationTransition($paramIdFta, $paramAction, $paramIdFtaRole, $paramChapitresSelectionne, $paramChapitres) {
        return '<td><center>'
                . '<a href=transiter.php?'
                . 'id_fta=' . $paramIdFta
                . '&action=' . $paramAction
                . '&id_fta_role=' . $paramIdFtaRole
                . '&checkPost=1'
                . $paramChapitresSelectionne
                . $paramChapitres
                . '>' . self::CALLBACK_LINK_TO_TRANSITER_PAGE_VALIDATE . '</a></center></td>';
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
        } else {
            /**
             * Extraction de l'année
             * Format Anglais
             */
            $annee = substr($paramValeurDate, 0, 4);
            $mois = substr($paramValeurDate, 5, 2);
            $jours = substr($paramValeurDate, 8, 2);
        }
        $return = $jours . "-" . $mois . "-" . $annee;
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

}

?>
