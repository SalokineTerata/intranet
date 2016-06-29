<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class UserModel extends AbstractModel {

    const TABLENAME = 'salaries';
    const KEYNAME = 'id_user';
    const FIELDNAME_ACTIF = 'actif';
    const FIELDNAME_NOM = 'nom';
    const FIELDNAME_PRENOM = 'prenom';
    const FIELDNAME_ID_CATSOPRO = 'id_catsopro';
    const FIELDNAME_ID_SERVICE = 'id_service';
    const FIELDNAME_ID_TYPE = 'id_type';
    const FIELDNAME_LOGIN = 'login';
    const FIELDNAME_PASSWORD = 'pass';
    const FIELDNAME_MAIL = 'mail';
    const FIELDNAME_ECRITURE = 'ecriture';
    const FIELDNAME_MEMBRE_CE = 'membre_ce';
    const FIELDNAME_NEWSDEFIL = 'newsdefil';
    const FIELDNAME_BLOCAGE = 'blocage';
    const FIELDNAME_DATE_CREATION_SALARIES = 'date_creation_salaries';
    const FIELDNAME_DATE_BLOCAGE = 'date_blocage';
    const FIELDNAME_ASENDANT_ID_SALARIES = 'ascendant_id_salaries';
    const FIELDNAME_PORTAIL_WIKI_SALARIES = 'portail_wiki_salaries';
    const FIELDNAME_LIEU_GEO = 'lieu_geo';
    const USER_ACTIF = 'oui';
    const USER_NON_ACTIF = 'non';
    const USER_NON_DEFINIE = 'Non définie';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    public function getPrenomNom() {
        $prenom = $this->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $nom = $this->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $value = $prenom . ' ' . strtoupper($nom);
        return $value;
    }

    public function getLieuGeo() {
        return $this->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
    }

    /**
     * On récupère les informations des Fta 
     * @param type $paramArrayIdFta
     * @param type $paramOrderBy
     * @return type
     */
    public static function getIdFtaByUserAndWorkflow($paramArrayIdFta, $paramOrderBy, $paramDebut, $paramFtaModificatin) {
        if ($paramFtaModificatin) {
            $nbMaxParPage = ModuleConfig::VALUE_MAX_PAR_PAGE;
        } else {
            $nbMaxParPage = ModuleConfig::VALUE_MAX_PAR_PAGE_CONSUL;
            $paramOrderBy = FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA . ' DESC ';
        }

        /**
         * Attention dans la condition where de la requette ne pas mettre des conditions non présente lors de la création de la fta
         * Exemple ClassificationRaccourcisModel::TABLENAME 
         */
        if ($paramArrayIdFta) {
            $array['1'] = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                            . ', ' . FtaEtatModel::FIELDNAME_ABREVIATION . ', ' . FtaModel::FIELDNAME_LIBELLE
                            . ', ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . ', ' . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                            . ', ' . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . ', ' . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                            . ', ' . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . ', ' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                            . ', ' . FtaModel::FIELDNAME_DOSSIER_FTA . ', ' . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                            . ', ' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . ', ' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                            . ', ' . FtaModel::FIELDNAME_CREATEUR . ', ' . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                            . ', ' . FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT . ', ' . FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE
                            . ', ' . GeoModel::FIELDNAME_GEO . ', ' . FtaModel::TABLENAME . '. ' . FtaModel::FIELDNAME_WORKFLOW
                            . ' FROM ' . FtaModel::TABLENAME . ',' . UserModel::TABLENAME
                            . ', ' . FtaEtatModel::TABLENAME
                            . ', ' . FtaWorkflowModel::TABLENAME
                            . ', ' . GeoModel::TABLENAME
                            . ' WHERE ( 0 ' . FtaModel::addIdFtaLabel($paramArrayIdFta) . ')'
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_CREATEUR
                            . '=' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . '=' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                            . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                            . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                            . '=' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME
                            . ' ORDER BY ' . $paramOrderBy
                            . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ',' . UserModel::FIELDNAME_PRENOM . ' ASC' . ',' . UserModel::FIELDNAME_NOM . ' ASC'
                            . ',' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                            . ' LIMIT ' . $nbMaxParPage . ' OFFSET ' . $paramDebut
            );

            $array['2'] = DatabaseOperation::getRowsNumberOverLimitInSqlStatement(
                            'SELECT SQL_CALC_FOUND_ROWS ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                            . ', ' . FtaEtatModel::FIELDNAME_ABREVIATION . ', ' . FtaModel::FIELDNAME_LIBELLE
                            . ', ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . ', ' . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                            . ', ' . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . ', ' . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                            . ', ' . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . ', ' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                            . ', ' . FtaModel::FIELDNAME_DOSSIER_FTA . ', ' . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                            . ', ' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . ', ' . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                            . ', ' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . ', ' . FtaModel::FIELDNAME_CREATEUR
                            . ', ' . FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT . ', ' . FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE
                            . ', ' . GeoModel::FIELDNAME_GEO . ', ' . FtaModel::TABLENAME . '. ' . FtaModel::FIELDNAME_WORKFLOW
                            . ' FROM ' . FtaModel::TABLENAME . ',' . UserModel::TABLENAME
                            . ', ' . FtaEtatModel::TABLENAME
                            . ', ' . FtaWorkflowModel::TABLENAME
                            . ', ' . GeoModel::TABLENAME
                            . ' WHERE ( 0 ' . FtaModel::addIdFtaLabel($paramArrayIdFta) . ')'
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_CREATEUR
                            . '=' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . '=' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                            . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                            . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                            . '=' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME
                            . ' ORDER BY ' . $paramOrderBy
                            . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ',' . UserModel::FIELDNAME_PRENOM . ' ASC'
                            . ',' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                            . ' LIMIT ' . $nbMaxParPage . ' OFFSET ' . $paramDebut
            );


            $array['3'] = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaWorkflowModel::TABLENAME . '.*'
                            . ' FROM ' . FtaModel::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                            . ' WHERE ( ' . '0' . ' ' . FtaModel::addIdFtaLabel($array['1']) . ')'
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
            );


            return $array;
        }
    }

    /**
     * Suppression d'un salarié de l'intranet
     * @param type $paramIdSalaries
     */
    public static function suppressionIntranetUtilisateur($paramIdSalaries) {
        DatabaseOperation::execute(
                'DELETE FROM ' . LogModel::TABLENAME
                . ' WHERE ' . LogModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . ModesModel::TABLENAME
                . ' WHERE ' . ModesModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . DroitftModel::TABLENAME
                . ' WHERE ' . DroitftModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );

        DatabaseOperation::execute(
                'DELETE FROM ' . IntranetDroitsAccesModel::TABLENAME
                . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . LuModel::TABLENAME
                . ' WHERE ' . LuModel::FILEDNAME_ID_USER . '=' . $paramIdSalaries);
        DatabaseOperation::execute(
                'DELETE FROM ' . PlanningPresenceDetailModel::TABLENAME
                . ' WHERE ' . PlanningPresenceDetailModel::FILEDNAME_ID_USER . '=' . $paramIdSalaries);
        DatabaseOperation::execute(
                'DELETE FROM ' . PersoModel::TABLENAME
                . ' WHERE ' . PersoModel::KEYNAME . '=' . $paramIdSalaries);

        DatabaseOperation::execute(
                'DELETE FROM ' . UserModel::TABLENAME
                . ' WHERE ' . UserModel::KEYNAME . '=' . $paramIdSalaries
        );
    }

    /**
     * Cette fonction désactive le compte utilisateur
     * @param int $paramIdUser
     */
    public static function desactivationUser($paramIdUser) {
        DatabaseOperation::execute(
                'UPDATE ' . self::TABLENAME . ' SET ' . self::FIELDNAME_ACTIF . ' = \'' . self::USER_NON_ACTIF
                . '\' WHERE ' . self::KEYNAME . '=\'' . $paramIdUser . '\''
        );
    }

    /**
     * Verification du bon droits d'utilisateur pour les pages admin
     * @param type $paramTypePag
     * @param type $paramIdType
     */
    public static function securadmin($paramTypePag, $paramIdType) {
        if ($paramTypePag > $paramIdType) {
            header('Location: ../index.php?action=delog');
        }
        if (!$paramIdType) {
            header('Location: ../index.php?action=delog');
        }
    }

    /**
     * Liste des utilisateur à ajouter
     * @param array $paramIdUser
     * @return string
     */
    public static function AddIdUser($paramIdUser) {
        if ($paramIdUser) {
            foreach ($paramIdUser as $value) {
                $req .= ' OR ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * Vérifie si l'utilisateur a toujours sa session active.
     * Sinon, c'est qu'elle a expirée.
     * @param GlobalConfig $paramGlobalConfig
     * @return boolean
     */
    public static function isUserSessionExpired(GlobalConfig $paramGlobalConfig) {
        $errorReturn = FALSE;
        if (!$paramGlobalConfig->getAuthenticatedUser()) {
            $errorReturn = TRUE;
        }
        return $errorReturn;
    }

    /**
     * Vérifie si l'utilisateur a toujours sa session active.
     * Sinon, c'est qu'elle a expirée et un message est affiché.
     * @param GlobalConfig $paramGlobalConfig
     */
    public static function checkUserSessionExpired(GlobalConfig $paramGlobalConfig) {
        if (self::isUserSessionExpired($paramGlobalConfig)) {
            $titre = UserInterfaceMessage::FR_SESSION_EXPIRED;
            $message = UserInterfaceMessage::FR_SESSION_EXPIRED_TITLE;
            $redirection = "index.php";
            Lib::showMessage($titre, $message, $redirection);
        }
    }

    /**
     * On obtient id_user, le nom et prénom associé pour l'espace de travail et le site en paramètres
     * @param int $paramIdSiteDeProduction
     * @param int $paramIdWorkflow
     * @return array
     */
    public static function getArrayIdUserBySiteProdAndWorkflow($paramIdSiteDeProduction, $paramIdWorkflow) {
        $arrayIdIntranetActionsBySiteProdAndWorkflowAndGestion = IntranetActionsModel::getArrayIdIntranetActionByWorkflowAndSiteDeProdAndGestionnaire($paramIdWorkflow, $paramIdSiteDeProduction);

        $sql = self::getSqlGestionnaireByWorkflowAndSiteProd($arrayIdIntranetActionsBySiteProdAndWorkflowAndGestion);
        $arrayIdUser = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray($sql);

        return $arrayIdUser;
    }

    /**
     * Sql de la liste déroulant de Gestionnaire Fta
     * pour un espace de travail et un site de production donnée
     * @param array $paramArrayIdIntranetActions
     * @return string
     */
    public static function getSqlGestionnaireByWorkflowAndSiteProd($paramArrayIdIntranetActions) {
        $sql = 'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME
                . ', CONCAT_WS ( \' \',' . self::FIELDNAME_PRENOM
                . ',' . self::FIELDNAME_NOM . ' )'
                . ' FROM ' . IntranetDroitsAccesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                . ',' . self::TABLENAME
                . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME . '=' . $paramArrayIdIntranetActions["0"]
                . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ACTIF . '=\'' . self::USER_ACTIF
                . '\' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . self::KEYNAME
                . ' IN ( SELECT DISTINCT ' . self::KEYNAME
                . ' FROM ' . IntranetDroitsAccesModel::TABLENAME
                . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $paramArrayIdIntranetActions["1"]
                . ') ORDER BY ' . self::TABLENAME . '.' . self::FIELDNAME_PRENOM . ',' . self::FIELDNAME_NOM;
        return $sql;
    }

}

?>
