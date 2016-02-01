<?php

/*
 * Copyright (C) 2015 bs4300280
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of UserMessage
 *
 * @author bs4300280
 */
class UserInterfaceMessage {

    const FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_1 = " Changement de l'espace travail ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_2 = " vers l'espace de travail ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_3 = " par ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_ESPACE_DE_TRAVAIL_4 = " le ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_1 = " Changement du gestionnaire ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_2 = " pour ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_3 = " par ";
    const FR_DATABASE_MESSAGE_CHANGEMENT_GESTIONNAIRE_FTA_4 = " le ";
    const FR_DUPLICATION_DE_FTA_1 = "Dès que vous aurez cliqué sur le bouton Dupliquer, <br>
                 un double de l 'ensemble de la fiche technique article sera créé sous le nom <b>";
    const FR_DUPLICATION_DE_FTA_2 = "</b>.<br>
                 Cette opération est irreversible<br>";
    const FR_LAST_50_FTA = "Consultation des dernières FTA";
    const FR_LOGIN_PROCESS_ACCOUNT_LOCKED = "Votre compte est bloqué suite à trois tentatives ratées.<br><br>Contactez un Administrateur pour réactiver votre compte.<br>";
    const FR_NONE_FTA = "Aucune Fta identifiée.<br><br>";
    const FR_SESSION_EXPIRED = "Erreur, la session précédement connecté à expirer.<br>Veuillez vous reconnecter.<br>";
    const FR_SESSION_EXPIRED_TITLE = "Déconnexion";
    const FR_TRANSITION_FTA = " La transition de l'état d'une fiche permet de changer son état tout en laissant le système contrôler la cohérence et la version de la fiche.<br>
                <br>
                Suivant l'état de votre fiche, seuls certains états sont accessibles. Vous pouvez considérer la transition de l'état d'une fiche comme un contrôle sur son espace de travail.<br>
                <br>
";
    const FR_TRANSITION_FTA_TITLE = "Transiter l'Etat d'une Fiche Technique Article";
    const FR_WARNING_ACCES_RIGHTS = "Vous n'avez pas les droits d'accès nécessaire.<br><br>";
    const FR_WARNING_ACCES_RIGHTS_TITLE = "Erreur d'accès";
    const FR_WARNING_CHAPITRES = " Veuillez selectionner un chapitre<br>";
    const FR_WARNING_CHAPITRES_TITLE = " Chapitres Fta<br>";
    const FR_WARNING_CHAPITRES_DE_FTA = " Attention, vous êtes sur le point de dévalidé aussi les chapitres suivants:<br>";
    const FR_WARNING_DATA_CLASIFICATION = "Veuillez saisir une classification";
    const FR_WARNING_DATA_CLASIFICATION_TITLE = "Classification d'une Fiche Technique Article";
    const FR_WARNING_DATA_DATE_ECHEANCE = "Veuillez saisir une date d'écheance de la Fta .<br><br>";
    const FR_WARNING_DATA_DATE_ECHEANCE_INCOHERENCE = "Veuillez saisir une date d'écheance supérieur à la date d'aujourd'hui .<br><br>";
    const FR_WARNING_DATA_DESIGNATION_COMMERCIALE = "Veuillez saisir une désignation commerciale .<br><br>";
    const FR_WARNING_DATA_DESIGNATION_COMMERCIALE_TITLE = "Désignation commerciale d'une Fiche Technique Article";
    const FR_WARNING_DATA_ESPACE_DE_TRAVAIL = "Veuillez selectionner un espace de travail .<br><br>";
    const FR_WARNING_DATA_ESPACE_DE_TRAVAIL_CHANGEMENT = "Veuillez selectionner un espace de travail différents.<br><br>";
    const FR_WARNING_DATA_ESPACE_DE_TRAVAIL_TITLE = "Espace de travail d'une Fiche Technique Article";
    const FR_WARNING_DATA_GESTIONNAIRE = "Veuillez selectionner un gestionnaire de Fiche Technique Article différents.<br><br>";
    const FR_WARNING_DATA_GESTIONNAIRE_TITLE = "Gestionnaire d'une Fiche Technique Article";
    const FR_WARNING_DATA_ID_FTA = "Veuillez saisir un id_fta existant à dupliquer .<br><br>";
    const FR_WARNING_DATA_ID_FTA_TITLE = "Manque de donnée id_fta";
    const FR_WARNING_DATA_MISSING_TITLE = "Manque de donnée";
    const FR_WARNING_DATA_SITE_DE_PRODUCTION = "Veuillez selectionner un site de production .<br><br>";
    const FR_WARNING_DATA_SITE_DE_PRODUCTION_TITLE = "Site de production d'une Fiche Technique Article";
    const FR_WARNING_DATA_VALIDATION_FTA_CODE_LDC = "Le Code LDC doit être unique.";
    const FR_WARNING_DUPLICATION_DE_FTA = " Attention, vous êtes sur le point de dupliquer la Fiche Technique Article suivante:<br>";
    const FR_WARNING_ECHEANCE_DEPASSEE = "Certaines échéances sont dépassées !";
    const FR_WARNING_EMBALLAGE_COLIS = "Il ne doit y avoir qu'un seul emballage Colis";
    const FR_WARNING_EMBALLAGE_PALETTE = "Il ne doit y avoir qu'une seule Palette";
    const FR_WARNING_EMBALLAGE_SUPPRESION = "Vous ne pouvez pas supprimer cette Fiche Technique Emballage.<br><br>
                    En effet, elle est encore utilisée dans certaines Fiches Techniques Articles.<br><br>";
    const FR_WARNING_EMBALLAGE_SUPPRESION_TITLE = "Suppression d'une Fiche Technique Emballage";
    const FR_WARNING_MESSAGE_URL_MODIF = "Veuillez ne pas modifier URL.<br><br>";
    const FR_WARNING_NOT_HANDLE_TITLE = "Cas non géré";
    const FR_WARNING_PARAM_ID_FTA = "Erreur la Fta n'est passé en paramètre.<br><br>";
    const FR_WARNING_PARAM_ID_FTA_NOT_EXISTANT = "Erreur la Fta n'existe pas.<br><br>";
    const FR_WARNING_PARAM_ID_FTA_TITLE = "Affichage d'une Fta";
    const FR_WARNING_FTA_ETAT_REMOVE = "Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indems.";
    const FR_WARNING_WORKFLOW_INACTIF_1 = "L'espace de travail \"";
    const FR_WARNING_WORKFLOW_INACTIF_2 = "\" est inactif";
    const FR_WARNING_WORKFLOW_INACTIF_TITLE = "Espace de travail inactif.";

}
