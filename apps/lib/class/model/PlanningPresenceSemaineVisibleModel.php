<?php

/**
 * Description of PlanningPresenceSemaineVisibleModel
 * 
 *
 * @author franckwastaken
 */
class PlanningPresenceSemaineVisibleModel extends AbstractModel {

    const TABLENAME = 'planning_presence_semaine_visible';
    const KEYNAME = 'id_planning_presence_semaine_visible';
    const FIELDNAME_ANNEE_PLANNING_PRESENCE_SEMAINE_VISIBLE = 'annee_planning_presence_semaine_visible';
    const FIELDNAME_VISIBLE_PLANNING_PRESENCE_SEMAINE_VISIBLE = 'visible_planning_presence_semaine_visible';
    const VISIBLE_PLANNING_PRESENCE_SEMAINE_VISIBLE_TRUE = '1';
    const VISIBLE_PLANNING_PRESENCE_SEMAINE_VISIBLE_FALSE = '0';

    protected function setDefaultValues() {
        
    }

    /**
     * Construction du tableau de la liste des semaines visibles par l'utilisateur
     * @param int $paramPlanningPresenceModification
     * @return string
     */
    public static function getReqListeSemaineVisible($paramPlanningPresenceModification) {
        $req = "SELECT DISTINCT " . PlanningPresenceSemaineVisibleModel::KEYNAME
                . "," . PlanningPresenceSemaineVisibleModel::FIELDNAME_ANNEE_PLANNING_PRESENCE_SEMAINE_VISIBLE
                . " FROM " . PlanningPresenceSemaineVisibleModel::TABLENAME;
        if ($paramPlanningPresenceModification == "0") {
            $req .= " WHERE " . PlanningPresenceSemaineVisibleModel::FIELDNAME_VISIBLE_PLANNING_PRESENCE_SEMAINE_VISIBLE
                    . "=" . PlanningPresenceSemaineVisibleModel::VISIBLE_PLANNING_PRESENCE_SEMAINE_VISIBLE_TRUE;
        }
        $req .= " ORDER BY " . PlanningPresenceSemaineVisibleModel::FIELDNAME_ANNEE_PLANNING_PRESENCE_SEMAINE_VISIBLE
                . " DESC ," . PlanningPresenceSemaineVisibleModel::KEYNAME . " DESC";
        return $req;
    }


}
