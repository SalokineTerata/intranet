<?php

/**
 * Description of FtaEtatHistoriqueModel
 * Table de l'historique des changements d'états des Fta 
 *
 * @author franckwastaken
 */
class FtaEtatHistoriqueModel extends AbstractModel {

    const TABLENAME = 'fta_etat_historique';
    const KEYNAME = 'id_fta_etat_historique';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_ID_DOSSIER_FTA = 'id_dossier_fta';
    const FIELDNAME_ID_DOSSIER_VERSION_FTA = 'id_version_dossier_fta';
    const FIELDNAME_ID_FTA_ETAT_INIT = 'id_fta_etat_init';
    const FIELDNAME_ID_FTA_ETAT_DEST = 'id_fta_etat_dest';
    const FIELDNAME_ID_USER = 'id_user';
    const FIELDNAME_STATE_CHANGE_DATE = 'state_change_date';
    const DATE = 'date';
    const NOM = 'nom';
    const VERSION = 'version';
    const ETAT = 'etat';
    const OLD_VALUE = 'oldValue';
    const NEW_VALUE = 'newValue';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_FTA . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_FTA] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Historisation du changement d'état de la Fta
     * @param int $paramIdFta
     * @param int $paramIdFtaDossier
     * @param int $paramIdDossierVersion
     * @param int $paramInitEtat
     * @param int $paramDestEtat
     * @param int $paramIdUser
     * @param string $paramInitAbreviationFta
     */
    public static function setFtaEtatHistorique($paramIdFta, $paramIdFtaDossier, $paramIdDossierVersion, $paramInitEtat, $paramDestEtat, $paramIdUser, $paramInitAbreviationFta) {

        if ($paramInitAbreviationFta == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            $idFtaEtatHistorique = self::createNewRecordset(
                            array(self::FIELDNAME_ID_FTA => $paramIdFta)
            );

            $ftaEtatHistoriqueModel = new FtaEtatHistoriqueModel($idFtaEtatHistorique);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_DOSSIER_FTA)->setFieldValue($paramIdFtaDossier);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_DOSSIER_VERSION_FTA)->setFieldValue($paramIdDossierVersion);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_FTA_ETAT_INIT)->setFieldValue($paramInitEtat);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_FTA_ETAT_DEST)->setFieldValue($paramDestEtat);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_USER)->setFieldValue($paramIdUser);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_STATE_CHANGE_DATE)->setFieldValue(date("Y-m-d H:i:s"));
            $ftaEtatHistoriqueModel->saveToDatabase();
        }
    }

    /**
     * Affiche l'historique de la Fta
     * @param int $paramIdFtaDossier
     * @param int $paramIdFtaWorkflow
     * @return string
     */
    public static function getHtmlHistoriqueFta($paramIdFtaDossier, $paramIdFtaWorkflow) {
        /**
         * Historisation des changement d'état initialisé en modification
         */
        $arrayHistoValidationFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_FTA
                        . "," . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_VERSION_FTA . "," . FtaEtatHistoriqueModel::FIELDNAME_ID_FTA_ETAT_DEST
                        . "," . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
                        . "," . FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE
                        . " FROM " . FtaEtatHistoriqueModel::TABLENAME . "," . UserModel::TABLENAME
                        . " WHERE " . FtaEtatHistoriqueModel::TABLENAME . "." . FtaEtatHistoriqueModel::FIELDNAME_ID_USER
                        . "=" . UserModel::TABLENAME . "." . UserModel::KEYNAME
                        . " AND " . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_FTA . "=" . $paramIdFtaDossier
                        . " ORDER BY " . FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE . " DESC "
        );

        if ($arrayHistoValidationFta) {
            foreach ($arrayHistoValidationFta as $rowsHistoValidationFta) {
                $ftaEtatModel = new FtaEtatModel($rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_FTA_ETAT_DEST]);
                $nomFtaEtat = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue();
                $versionEncours = "V" . $rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_VERSION_FTA];
                $nomSignataire = $rowsHistoValidationFta[UserModel::FIELDNAME_PRENOM] . " " . $rowsHistoValidationFta[UserModel::FIELDNAME_NOM];
                $dateValidation = $rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE];
                /**
                 * Changment de format de date
                 */
                $date = FtaController::changementDuFormatDeDateFR($dateValidation);
                $arrayHistoModif[] = array("date" => $date
                    , "nom" => $nomSignataire
                    , "version" => $versionEncours
                    , "etat" => $nomFtaEtat
                    , "oldValue" => $oldValue
                    , "newValue" => $newValue
                );
            }
        }
        /**
         * Listes des tables Fta à vérifier
         */
        $arrayTableCheck = array(FtaModel::TABLENAME, FtaComposantModel::TABLENAME, FtaConditionnementModel::TABLENAME);
        /**
         * Historiques des changement de données par les utilisateurs
         */
        foreach ($arrayTableCheck as $rowsTableCheck) {

            /**
             * Tableau des Fta selon le dossier encours
             */
            $arrayIdFta = FtaModel::getArrayIdFtaByIdDossierFta($paramIdFtaDossier);
            foreach ($arrayIdFta as $rowsIdFta) {
                $idFtaEncours = $rowsIdFta[FtaModel::KEYNAME];
                $ftaModelEncours = new FtaModel($idFtaEncours);
                $versionFta = "V" . $ftaModelEncours->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
                /**
                 * Listes des noms des champs avec le label de la table encours
                 */
                if ($rowsTableCheck == FtaModel::TABLENAME) {
                    $model = new FtaModel($idFtaEncours);
                    $model->setDataFtaTableToCompare();

                    $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
                                    . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                                    . "," . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE
                                    . " FROM " . IntranetColumnInfoModel::TABLENAME
                                    . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                                    . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
                    );
                    foreach ($arrayChamps as $rowsChamps) {

                        $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO])->isFieldDiff();

                        if ($check) {
                            $htmlObjetOld = Html::getHtmlObjectFromDataField($model->getDataToCompare()->getDataFieldByFieldName($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                            $oldValue = $htmlObjetOld->getRawContent();
                            $htmlObjetNew = Html::getHtmlObjectFromDataField($model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                            $newValue = $htmlObjetNew->getRawContent();
                            $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                            $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                            $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                            $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($paramIdFtaWorkflow, $idFtaChapitreArray);
                            if ($idFtaChapitre) {
                                $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                                $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                                $arrayHistoModif[] = array("date" => $dateValidation
                                    , "nom" => $nomSignataire
                                    , "version" => $versionFta
                                    , "etat" => $label
                                    , "oldValue" => $oldValue
                                    , "newValue" => $newValue
                                );
                            }
                        }
                    }
                } elseif ($rowsTableCheck == FtaComposantModel::TABLENAME) {
                    /**
                     * On récupère la liste des composants
                     */
                    $arraIdFtaComposant = FtaComposantModel::getArrayIdFtaComposantTable($idFtaEncours);
                    if ($arraIdFtaComposant) {
                        foreach ($arraIdFtaComposant as $rowsIdFtaComposant) {
                            $idFtaComposant = $rowsIdFtaComposant[FtaComposantModel::KEYNAME];

                            $model = new FtaComposantModel($idFtaComposant);
                            $model->setDataFtaComposantTableToCompare();

                            $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                            "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
                                            . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                                            . "," . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE
                                            . " FROM " . IntranetColumnInfoModel::TABLENAME
                                            . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                                            . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
                            );
                            foreach ($arrayChamps as $rowsChamps) {

                                $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO])->isFieldDiff();

                                if ($check) {
                                    $htmlObjetOld = Html::getHtmlObjectFromDataField($model->getDataToCompare()->getDataFieldByFieldName($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                                    $oldValue = $htmlObjetOld->getRawContent();
                                    $htmlObjetNew = Html::getHtmlObjectFromDataField($model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                                    $newValue = $htmlObjetNew->getRawContent();
                                    $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                                    $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                                    $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                                    $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($paramIdFtaWorkflow, $idFtaChapitreArray);
                                    if ($idFtaChapitre) {
                                        $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                                        $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                                        $arrayHistoModif[] = array("date" => $dateValidation
                                            , "nom" => $nomSignataire
                                            , "version" => $versionFta
                                            , "etat" => $label
                                            , "oldValue" => $oldValue
                                            , "newValue" => $newValue
                                        );
                                    }
                                }
                            }
                        }
                    }
                } elseif ($rowsTableCheck == FtaConditionnementModel::TABLENAME) {
                    $arraIdFtaConditionnment = FtaConditionnementModel::getArrayIdFtaConditionnement($idFtaEncours);
                    /**
                     * On récupère la liste des embalalges
                     */
                    if ($arraIdFtaConditionnment) {
                        foreach ($arraIdFtaConditionnment as $rowsIdFtaConditionnment) {
                            $idFtaConditionnement = $rowsIdFtaConditionnment[FtaConditionnementModel::KEYNAME];

                            $model = new FtaConditionnementModel($idFtaConditionnement);
                            /**
                             * On vérifie si l'un des champs de l'emballage encours est différents de la version précedentes
                             */
                            $model->setDataFtaConditionnementTableToCompare();

                            /**
                             * restraiendre la liste des champs
                             */
                            $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                            "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
                                            . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                                            . " FROM " . IntranetColumnInfoModel::TABLENAME
                                            . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                                            . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
                            );
                            foreach ($arrayChamps as $rowsChamps) {


                                $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO])->isFieldDiff();

                                if ($check) {
                                    $htmlObjetOld = Html::getHtmlObjectFromDataField($model->getDataToCompare()->getDataFieldByFieldName($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                                    $oldValue = $htmlObjetOld->getRawContent();
                                    $htmlObjetNew = Html::getHtmlObjectFromDataField($model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]));
                                    $newValue = $htmlObjetNew->getRawContent();
                                    $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                                    $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                                    $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                                    $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($paramIdFtaWorkflow, $idFtaChapitreArray);
                                    if ($idFtaChapitre) {
                                        $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                                        $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                                        $arrayHistoModif[] = array("date" => $dateValidation
                                            , "nom" => $nomSignataire
                                            , "version" => $versionFta
                                            , "etat" => $label
                                            , "oldValue" => $oldValue
                                            , "newValue" => $newValue
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        /**
         * Affichage du tableau
         */
        if (is_array($arrayHistoModif)) {
            FtaController::arraySortByColumn($arrayHistoModif, "date");

            $tableauFiche .= '<th>'
                    . 'Date'
                    . '</th><th>'
                    . 'Ultilisateur'
                    . '</th><th>'
                    . 'Version du dossier FTA'
                    . '</th><th>'
                    . 'Colonne'
                    . '</th><th>'
                    . 'Ancienne valeur'
                    . '</th><th>'
                    . 'Nouvelle valeur'
                    . '</th>';

            foreach ($arrayHistoModif as $rowsHistoModif) {

                $tableauFiche .= '<tr class=contenu >'
                        . '<td width=8%> ' . $rowsHistoModif["date"] . '</td>'//Date de modif
                        . '<td >' . $rowsHistoModif["nom"] . '</td>'//Utilisateur ayant fait la modification
                        . '<td >' . $rowsHistoModif["version"] . '</td>'//Version du dossier Fta
                        . '<td >' . $rowsHistoModif["etat"] . '</td>'// Etat de la Fta ou nom de la colonne
                        . '<td >' . $rowsHistoModif["oldValue"] . '</td>'// Ancienne valeur de la Fta
                        . '<td >' . $rowsHistoModif["newValue"] . '</td>'// Nouvelle valeur de la Fta
                        . '</tr >';
            }
        }
        return $tableauFiche;
    }

}
