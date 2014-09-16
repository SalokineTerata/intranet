-- UDR 2011-06-07
--
-- ======================================
-- Tables écrasées (structure et données)
-- ======================================
-- 
-- [V] annexe_unite_facturation
-- [V] arcadia_atelier
-- [V] arcadia_client_reseau
-- [V] arcadia_client_reseau_segment_association
-- [V] arcadia_client_segment
-- [V] arcadia_maquette_etiquette
-- [V] arcadia_poste
-- [V] fta --> vidée
-- [V] fta_chapitre
-- [V] fta_composant --> vidée
-- [V] fta_conditionnement --> vidée
-- [V] fta_derogation_duree_vie --> vidée
-- [V] fta_processus
-- [V] fta_processus_cycle
-- [V] fta_processus_multisite
-- [V] fta_saisie_obligatoire
-- [V] fta_suivi_projet --> vidée
-- [V] fta_tarif --> vidée
-- [V] geo
-- [V] intranet_actions
-- [V] intranet_column_info
-- [V] intranet_modules


-- ======================================
-- Requêtes SQL
-- ======================================

ALTER TABLE `fta_categorie` 
MODIFY COLUMN `abreviation_fta_categorie` varchar(10)  NULL DEFAULT NULL ,
DROP INDEX `abreviation_fta_categorie`,
ADD INDEX `abreviation_fta_categorie`(`abreviation_fta_categorie`);

ALTER TABLE `intranet_column_info` 
ADD COLUMN `explication_intranet_column_info` text  NULL DEFAULT NULL ;

ALTER TABLE `intranet_actions` 
ADD COLUMN `parent_intranet_actions` text  NULL DEFAULT NULL ,
ADD COLUMN `forme_intranet_actions` text  NULL DEFAULT NULL ,
DROP COLUMN `chemin_acces_intranet_actions`,
DROP COLUMN `file_acces_intranet_actions`;

ALTER TABLE `intranet_actions` 
MODIFY COLUMN `parent_intranet_actions` text  NULL DEFAULT NULL ,
MODIFY COLUMN `forme_intranet_actions` text  NULL DEFAULT NULL ;

ALTER TABLE `arcadia_client_reseau` 
CHANGE `id_arcadia_client_circuit` `id_arcadia_client_circuit` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE `arcadia_client_reseau_segment_association` 
CHANGE `id_arcadia_client_reseau` `id_arcadia_client_reseau` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `id_arcadia_client_segment` `id_arcadia_client_segment` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE `arcadia_client_segment` 
CHANGE `nom_arcadia_client_segment` `nom_arcadia_client_segment` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;

ALTER TABLE `fta` CHANGE `last_id_fta` `last_id_fta` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `id_arcadia_client_circuit` `id_arcadia_client_circuit` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `id_arcadia_client_reseau` `id_arcadia_client_reseau` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `id_arcadia_client_segment` `id_arcadia_client_segment` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `frequence_hebdomadaire_estime_commande` `frequence_hebdomadaire_estime_commande` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE `id_arcadia_type_calibre` `id_arcadia_type_calibre` INT( 11 ) NULL DEFAULT NULL ,
CHANGE `perte_matiere_fta` `perte_matiere_fta` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE `fta` 
ADD COLUMN `id_arcadia_type_calibre` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `nom_client_demandeur` tinytext  NULL DEFAULT NULL ,
ADD COLUMN `besoin_fiche_technique` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `echeance_demandeur` date  NULL DEFAULT NULL ,
ADD COLUMN `besoin_compostage_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `calibre_defaut` text  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_emballage_type` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_client_segment` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `quantite_hebdomadaire_estime_commande` varchar(50)  NULL DEFAULT NULL ,
ADD COLUMN `nom_machine_fta` varchar(50)  NULL DEFAULT NULL ,
MODIFY COLUMN `last_id_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `frequence_hebdomadaire_estime_commande` varchar(50)  NULL DEFAULT NULL ,
ADD COLUMN `tare_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `largeur_dimension_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `perte_matiere_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `besoin_fiche_rendement` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `nom_demandeur_fta` tinytext  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_atelier` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_client_circuit` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `id_annexe_environnement_conservation_groupe` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `societe_demandeur_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `type_marinade_fta` varchar(50)  NULL DEFAULT NULL ,
ADD COLUMN `besoin_fiche_productivite_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_poste` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `date_demandeur_fta` date  NULL DEFAULT NULL ,
ADD COLUMN `id_annexe_unite_facturation` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `type_minerai` varchar(50)  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_client_reseau` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `id_arcadia_maquette_etiquette` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `hauteur_dimension_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `longueur_dimension_fta` int(11)  NULL DEFAULT NULL ,
ADD COLUMN `etude_prix_fta` tinyint(1)  NULL DEFAULT NULL ,
ADD COLUMN `bon_fabrication_atelier` int(11)  NULL DEFAULT NULL ,
DROP INDEX `last_id_fta`,
ADD INDEX `last_id_fta`(`last_id_fta`);

ALTER TABLE `fta_conditionnement` 
ADD COLUMN `pcb_fta_conditionnement` int(11)  NULL DEFAULT NULL ;

RENAME TABLE `fta`.`intranet_description` TO `fta`.`old_intranet_description` ;
