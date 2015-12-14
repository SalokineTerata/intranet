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
        return UserInterfaceMessage::FR_DATABESE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_1
                . $paramWorkflowOLD . UserInterfaceMessage::FR_DATABESE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_2
                . $paramWorkflowNEW . UserInterfaceMessage::FR_DATABESE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_3
                . $paramUser . UserInterfaceMessage::FR_DATABESE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_4 . date("Y-m-d") ;
    }

}

?>
