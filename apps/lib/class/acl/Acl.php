<?php

/*
 * Copyright (C) 2015 tp4300001
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
 * Description of AclClass
 * @author tp4300001
 */
class Acl {

    /**
     * Nom du tableau contenant les droits d'accès de l'utilisateur
     */
    const ARRAY_NAME_ACCES_RIGHT = "Rights";
    const ACL_FTA_CONSULTATION = "fta_consultation";
    const ACL_FTA_IMPRESSION = "fta_impression";
    const ACL_FTA_MODIFICATION = "fta_modification";

    /**
     * Enregistrement des droits d'accès
     */
    static function setAccesRightsValues($accesRightsNames, $accesRightsValues) {
        $_SESSION[get_class()][self::ARRAY_NAME_ACCES_RIGHT][$accesRightsNames] = $accesRightsValues;
    }

    /**
     * Retourne le niveau d'accès du nom d'accès demandé
     * @param string $accesRightsNames Nom du droits d'accès
     */
    public static function getValueAccesRights($accesRightsNames) {
        return $_SESSION[get_class()][self::ARRAY_NAME_ACCES_RIGHT][$accesRightsNames];
    }

    /**
     * Retire les droits d'utilisateur connecté
     */
    public static function cancelValueAccesRights() {
        unset($_SESSION[get_class()]);
    }

    /**
     * Retire les informations de l'utiisateur connectée
     */
    public static function cancelUserInfos() {
        unset($_SESSION[UserModel::FIELDNAME_PASSWORD]);
        unset($_SESSION['nom_famille_ses']);
        unset($_SESSION[UserModel::FIELDNAME_LOGIN]);
        unset($_SESSION[UserModel::FIELDNAME_PRENOM]);
        unset($_SESSION[UserModel::KEYNAME]);
        unset($_SESSION[UserModel::FIELDNAME_ID_CATSOPRO]);
        unset($_SESSION[UserModel::FIELDNAME_ID_SERVICE]);
        unset($_SESSION[UserModel::FIELDNAME_ID_TYPE]);
        unset($_SESSION['num_log']);
        unset($_SESSION['position']);
        unset($_SESSION["mail_user"]);
        unset($_SESSION[UserModel::FIELDNAME_LIEU_GEO]);
        unset($_SESSION[UserModel::FIELDNAME_PORTAIL_WIKI_SALARIES]);
    }

    /**
     * On initialise les droits d'accès de l'utilisateur selon sont rôle
     * @param int $paramIdUser
     * @param int $paramRole
     */
    public static function setRightsAcces($paramIdUser, $paramRole) {
        if ($_SESSION['CheckIdFtaRole'] <> $paramRole) {

            /**
             *  Nous recuperons la liste des identifiant intranet actions selon le role et l'utilisateur connecté
             */
            $idIntranetActions = IntranetDroitsAccesModel::getIdIntranetActionsByRoleANDSiteFromUser($paramIdUser, $paramRole);
            /**
             * Nous avons un tableau des id intranet actions pour lesquels l'utilisateur à accès pour tel rôle
             */
            $checkIdIntranetActions = IntranetDroitsAccesModel::checkIdIntranetActionsByRoleANDSiteFromUser($paramIdUser, $paramRole);

            $idIntranetActionsValide = array_intersect($idIntranetActions, $checkIdIntranetActions);

            $_SESSION['IntranetActionsValide'] = $idIntranetActionsValide;
            $_SESSION['CheckIdFtaRole'] = $paramRole;
        }
    }

}
