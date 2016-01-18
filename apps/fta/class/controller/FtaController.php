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
    public static function getComment($paramAction, $paramUser, $paramCommentaire) {
        $newComment = "\n"
                . "==============================\n\n"
                . "Action : " . $paramAction . " \n"
                . "Date: " . date('d-m-Y') . "\n"
                . "Utilisateur: " . $paramUser . "\n";

        if ($paramCommentaire) {
            $newComment .= "Commentaire: \n" . $paramCommentaire;
        }

        return $newComment;
    }

}

?>
