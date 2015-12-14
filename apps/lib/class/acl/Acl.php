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
    const ACL_INTRANET_ACTIONS_VALIDE = "IntranetActionsValide";

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

            $_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE] = $idIntranetActionsValide;
            $_SESSION['CheckIdFtaRole'] = $paramRole;
        }
    }

    /**
     * Vérification et correction des incohérences de droits d'accès.
     * @param int $paramIdUser
     */
    public static function checkHeritedRightsRemovedByUser($paramIdUser) {

        /**
         * Propagation de la suppresion des droits d'accès sur les actions héritées
         */
        $arrayParentAction = self::getArrayIdParentActionByIntranetModule();

        foreach ($arrayParentAction as $arrayIdIntranetActionIdIntranetModule) {
            $IdIntranetAction = $arrayIdIntranetActionIdIntranetModule[IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS];
            $IdIntranetModule = $arrayIdIntranetActionIdIntranetModule[IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS];
            /**
             * L'utilisateur a-t-il le doit sur cet id_intranet_action pour cet id_intranet_module ?
             */
            $isUserHaveRight = self::isUserHaveRight($paramIdUser, $IdIntranetModule, $IdIntranetAction);

            /**
             * Si il n'a pas les accès, alors, 
             */
            if ($isUserHaveRight == FALSE) {
                /**
                 * Nettoyage des accès sur toutes les actions liées
                 */
                self::eraseUserRightOnIntranetAction($paramIdUser, $IdIntranetModule, $IdIntranetAction); //SQL DELETE liaison entre droits.action = action.parent  pour ce user et ce module
            }
        }
    }

    /**
     * On obtient le tableau des id intranet actions parent
     * @return array
     */
    private static function getArrayIdParentActionByIntranetModule() {
        return IntranetActionsModel::getArrayIdIntranetActionParentWithIdModule();
    }

    /**
     * On verifie si l'utilisateur connecté à les droits sur id intranet actions parent
     * @param int $paramIdUser
     * @param int $paramIdIntranetModule
     * @param int $paramIdIntranetAction
     * @return boolean
     */
    private static function isUserHaveRight($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction) {
        return IntranetDroitsAccesModel::checkUserHaveRightsAcces($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction);
    }

    /**
     * On supprime les droits sur id intranet actions de l'utilisateur connecté 
     * correspondants à l'id intranet actions parents en cours
     * @param int $paramIdUser
     * @param int $paramIdIntranetModule
     * @param int $paramIdIntranetAction
     * @return boolean
     */
    private static function eraseUserRightOnIntranetAction($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction) {
        return IntranetDroitsAccesModel::eraseUserRightsAcces($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction);
    }

}
