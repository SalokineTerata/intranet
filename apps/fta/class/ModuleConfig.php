<?php

abstract class ModuleConfig {
    /*     * *************************
      VARIABLES GLOBALES DU MODULE
     * ************************* */


    /*
      Permet d'activer le mode de débuggage.
      Par exemple, en activant ce mode, vous pouvez désactiver des chapitres validés
      0 = Le mode est désactivé
      1 = Le mode standard est activé
     */

    const MODE_DEBUG = FALSE;

    /*
      Permet d'activer ou de désactiver le système d'information par mail
      0 = Désactiver
      1 = Activer
     */
    const NOTIFY_MAIL_WORKFLOW = TRUE;


    /*
      Limite maximale du poids net d'un colis en Kg
     */
    const MAX_POIDS_NET_COLIS = 12;

    /*
      Limite maximale du nombre de FTA affichée dans l'index
     */
    const LIMIT_AFFICHAGE_FTA = 50;

    /**
     * Le code article LDC peut-il être utilisé sur plusieurs FTA ?
     * Ce contrôle est effectuée uniquement au moment de l'enregistrement
     * de la FTA.
     */
    const CODE_LDC_UNIQUE = true;

    /**
     * Nombre de jours par défaut utilisé pour calculer l'échéance d'un processus
     */
    const DELAI_ECHEANCE_PROCESSUS_JOUR = 7;

    /**
     * Activer la visualisation des modifications effectuées depuis la version précédente
     */
    const ENABLE_SHOW_DIFF_FTA = true;

    /**
     * Nombre maximale de fta afficher sur le moteur de recherche
     */
    const VALUE_MAX_MOTEUR_RECHERCHE = 250;
    /**
     * Nombre maximale de fta afficher sur la page d'acceuil en moficiation
     */
    const VALUE_MAX_PAR_PAGE = 100;

    /**
     * Nombre maximale de fta afficher sur la page d'acceuil en consultation
     */
    const VALUE_MAX_PAR_PAGE_CONSUL = 50;

    /**
     * Nombre de jour attribué pour une première notification sur la date de validation d'une fta afficher sur la page d'acceuil
     */
    const VALUE_DATE_NOTIFICATION = 15;

    /**
     * Nombre de jour attribué pour une deuxième notification sur la date de validation d'une fta afficher sur la page d'acceuil
     */
    const VALUE_DATE_NOTIFICATION2 = 7;

    /**
     * Nombre de jour par défaut d'une date d'échéance de validation d'une Fta en création
     * par rapport à la date actuelle
     */
    const VALUE_DATE_PLUS_CREATION = 35;
    /**
     * Nombre de jour par défaut d'une date d'échéance de validation d'une Fta mise à jour
     * par rapport à la date actuelle
     */
    const VALUE_DATE_PLUS_MISE_A_JOUR = 14;

}

?>