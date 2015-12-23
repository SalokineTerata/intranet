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
     * Génère le commentaire d'un changement d'espace de travail
     * @return string
     */
    public static function getCommentWorkflowChange($paramWorkflowOLD, $paramWorkflowNEW, $paramUser) {
        return UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_1
                . $paramWorkflowOLD . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_2
                . $paramWorkflowNEW . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_3
                . $paramUser . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_4 . date("Y-m-d") ;
    }
    public static function getCommentGestionnaireChange($paramGestionnaireOLD, $paramGestionnaireNEW, $paramUser) {
        return UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_1
                . $paramGestionnaireOLD . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_2
                . $paramGestionnaireNEW . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_3
                . $paramUser . UserInterfaceMessage::FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_4 . date("Y-m-d") ;
    }

}

?>
