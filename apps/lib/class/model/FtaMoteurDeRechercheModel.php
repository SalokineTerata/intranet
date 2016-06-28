<?php
/**
 * Description of FtaMoteurDeRechercheModel
 * @author franckwastaken
 */
class FtaMoteurDeRechercheModel extends AbstractModel {

    const TABLENAME = 'fta_moteur_de_recherche';
    const KEYNAME = 'id_moteur_de_recherche';
    const FIELDNAME_TABLE_MOTEUR_DE_RECHERCHE = 'table_moteur_de_recherche';
    const FIELDNAME_NOM_CHAMP_MOTEUR_DE_RECHERCHE = 'nom_champ_moteur_de_recherche';
    const FIELDNAME_NOM_CHAMP_USEL_MOTEUR_DE_RECHERCHE = 'nom_champ_usuel_moteur_de_recherche';
    const FIELDNAME_PRIORITE_MOTEUR_DE_RECHERCHE = 'priorite_moteur_de_recherche';
    const FIELDNAME_CHEMIN_FORCE_MOTEUR_DE_RECHERCHE = 'chemin_force_moteur_de_recherche';

    protected function setDefaultValues() {
        
    }

}
