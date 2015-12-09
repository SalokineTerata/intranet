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

    const FR_LAST_50_FTA = "Consultation des 50 dernières FTA";
    const FR_LOGIN_PROCESS_ACCOUNT_LOCKED = "Votre compte est bloqué suite à trois tentatives ratées.<br><br>Contactez un Administrateur pour réactiver votre compte.<br>";
    const FR_SESSION_EXPIRED = "Erreur, la session précédement connecté à expirer.<br>Veuillez vous reconnecter.<br>";
    const FR_SESSION_EXPIRED_TITLE = "Déconnexion";
    const FR_WARNING_ACCES_RIGHTS = "Vous n'avez pas les droits d'accès nécessaire.<br><br>";
    const FR_WARNING_ACCES_RIGHTS_TITLE = "Erreur d'accès";
    const FR_WARNING_DATA_VALIDATION_FTA_CODE_LDC = "Le Code LDC doit être unique.";
    const FR_WARNING_EMBALLAGE_COLIS = "Il ne doit y avoir qu'un seul emballage Colis";
    const FR_WARNING_EMBALLAGE_PALETTE = "Il ne doit y avoir qu'une seule Palette";
    const FR_WARNING_MESSAGE_URL_MODIF = "Veuillez ne pas modifier URL.<br><br>";
    const FR_WARNING_NOT_HANDLE_TITLE = "Cas non géré";
    const FR_WARNING_PARAM_ID_FTA = "Erreur la Fta n'est passé en paramètre.<br><br>";
    const FR_WARNING_PARAM_ID_FTA_NOT_EXISTANT = "Erreur la Fta n'existe pas.<br><br>";
    const FR_WARNING_PARAM_ID_FTA_TITLE = "Affichage d'une Fta";
    const FR_WARNING_DATA_ID_FTA = "Veuillez saisir un id_fta existant à dupliquer .<br><br>";
    const FR_WARNING_DATA_ID_FTA_TITLE = "Manque de donnée id_fta";
    const FR_WARNING_DATA_DESIGNATION_COMMERCIALE = "Veuillez saisir une désignation commerciale .<br><br>";
    const FR_WARNING_DATA_DESIGNATION_COMMERCIALE_TITLE = "Désignation commerciale d'une Fiche Technique Article";
    const FR_WARNING_DATA_SITE_DE_PRODUCTION = "Veuillez selectionner un site de production .<br><br>";
    const FR_WARNING_DATA_SITE_DE_PRODUCTION_TITLE = "Site de production d'une Fiche Technique Article";
    const FR_WARNING_DATA_ESPACE_DE_TRAVAIL = "Veuillez selectionner un espace de travail .<br><br>";
    const FR_WARNING_DATA_ESPACE_DE_TRAVAIL_TITLE = "Espace de travail d'une Fiche Technique Article";

}
