<?php

/**
 * Description of PlanningPresenceDetailModel
 * 
 *
 * @author franckwastaken
 */
class PlanningPresenceDetailModel extends AbstractModel {

    const TABLENAME = 'planning_presence_detail';
    const KEYNAME = 'id_planning_presence_detail';
    const FIELDNAME_JOURS = 'id_annexe_jours_semaine';
    const FIELDNAME_ANNEE = 'annee_planning_presence_semaine_visible';
    const FIELDNAME_SEMAINE = 'id_planning_presence_semaine_visible';
    const FIELDNAME_ID_USER = 'id_salaries';
    const FIELDNAME_JOURS_TYPE = 'jour_type_planning_presence_detail';
    const FIELDNAME_LIEU_1 = 'lieu_1_planning_presence_detail';
    const FIELDNAME_LIEU_2 = 'lieu_2_planning_presence_detail';

    protected function setDefaultValues() {
        
    }

    /**
     * Récupératin de la semaine en cours à partir d'une selection d'une semaine
     * @param int $paramSelectionSemaineEnCours
     * @param int $paramPlanningPresenceModification
     * @return string
     */
    public static function getSemaineEnCours($paramSelectionSemaineEnCours, $paramPlanningPresenceModification) {
        if (isset($paramSelectionSemaineEnCours)) {
            //Récupération du premier caractère de la selection de la semaine_en_cours
            $premier_caractere = substr($paramSelectionSemaineEnCours, 0, 1);

            //Formatage et affectation de la semaine en cours
            if ($premier_caractere == "0") {
                $semaine_en_cours = substr($paramSelectionSemaineEnCours, 1, 1);
            } else {
                $semaine_en_cours = substr($paramSelectionSemaineEnCours, 0, 2);
            }
        } else {
            //Construction du tableau de la liste des semaines visibles par l'utilisateur
            $req = PlanningPresenceSemaineVisibleModel::getReqListeSemaineVisible($paramPlanningPresenceModification);
            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

            //Affectation de la semaine en cours
            if ($array) {
                $semaine_en_cours = $array["0"][PlanningPresenceSemaineVisibleModel::KEYNAME];
            } else {
                $semaine_en_cours = '0';
            }
        }
        return $semaine_en_cours;
    }

    /**
     * Récupératin de l'année en cours à partir d'une selection d'une semaine
     * @param int $paramSelectionSemaineEnCours
     * @param int $paramPlanningPresenceModification
     * @return string
     */
    public static function getAnneeEnCours($paramSelectionSemaineEnCours, $paramPlanningPresenceModification) {
        if (isset($paramSelectionSemaineEnCours)) {
            //Affectation de l'année en cours
            $annee_en_cours = substr($paramSelectionSemaineEnCours, -4);
        } else {
            //Construction du tableau de la liste des semaines visibles par l'utilisateur
            $req = PlanningPresenceSemaineVisibleModel::getReqListeSemaineVisible($paramPlanningPresenceModification);
            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
            //Affectation de l'année en cours
            if ($array) {
                $annee_en_cours = $array["0"][PlanningPresenceSemaineVisibleModel::FIELDNAME_ANNEE_PLANNING_PRESENCE_SEMAINE_VISIBLE];
            } else {
                $annee_en_cours = '2003';
            }
        }
        return $annee_en_cours;
    }

    /**
     * On récupère le lieu du planninf de présence
     * @param int $paramIdUser
     * @param int $paramIdSemaine
     * @param int $paramIdAnnee
     * @param int $paramIdJours
     * @return string
     */
    public static function getLieuPlanningPresenceDetail($paramIdUser, $paramIdSemaine, $paramIdAnnee, $paramIdJours) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::FIELDNAME_LIEU_1
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_USER . "=" . $paramIdUser
                        . " AND " . self::FIELDNAME_SEMAINE . "=" . $paramIdSemaine
                        . " AND " . self::FIELDNAME_ANNEE . "=" . $paramIdAnnee
                        . " AND " . self::FIELDNAME_JOURS . "=" . $paramIdJours
        );

        foreach ($array as $value) {
            $lieuValue = $value[self::FIELDNAME_LIEU_1];
        }

        return $lieuValue;
    }

    /**
     * Mise à jour du lieu du planning de présence.
     * @param int $paramIdUser
     * @param int $paramIdSemaine
     * @param int $paramIdAnnee
     * @param int $paramIdJours
     * @param string $paramLieu
     * @return boolean
     */
    public static function updateLieuPlanningPresenceDetail($paramIdUser, $paramIdSemaine, $paramIdAnnee, $paramIdJours, $paramLieu) {

        $result = DatabaseOperation::execute(
                        "UPDATE " . self::TABLENAME
                        . " SET " . self::FIELDNAME_LIEU_1 . "='" . $paramLieu
                        . "' WHERE " . self::FIELDNAME_ID_USER . "=" . $paramIdUser
                        . " AND " . self::FIELDNAME_SEMAINE . "=" . $paramIdSemaine
                        . " AND " . self::FIELDNAME_ANNEE . "=" . $paramIdAnnee
                        . " AND " . self::FIELDNAME_JOURS . "=" . $paramIdJours);

        return $result;
    }

}
