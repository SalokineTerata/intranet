
SELECT DISTINCT id_next_fta_processus 
FROM fta_processus_cycle,fta_processus,intranet_actions,intranet_droits_acces,intranet_modules 
WHERE 1 AND ( 1 )  
AND fta_processus_cycle.id_next_fta_processus=fta_processus.id_fta_processus 
AND fta_processus.id_intranet_actions=intranet_actions.id_intranet_actions 
AND intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions 
AND intranet_droits_acces.id_intranet_modules=intranet_modules.id_intranet_modules 
AND id_user=58 
AND nom_intranet_modules='fta' 
AND niveau_intranet_droits_acces=1 
AND id_etat_fta_processus_cycle='I'  
AND id_fta_categorie= '3' 
