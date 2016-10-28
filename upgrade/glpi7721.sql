#Ajout du champs id_site_valorisation
ALTER TABLE `geo_arcadia` ADD `id_site_valorisation` INT NOT NULL ;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '43' WHERE `geo_arcadia`.`id_geo` = 1;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '46' WHERE `geo_arcadia`.`id_geo` = 3;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '47' WHERE `geo_arcadia`.`id_geo` = 6;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '215' WHERE `geo_arcadia`.`id_geo` = 11;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 12;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 13;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 14;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 15;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 16;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 17;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 19;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 20;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 38;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 54;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 159;
UPDATE `geo_arcadia` SET `id_site_valorisation` = '995' WHERE `geo_arcadia`.`id_geo` = 335;
