#!/bin/sh
#Script permettant d'effectuer les copies Intersites
#ATTENTION !! Ce script a été autogénéré via datasync.sh
#Ne le modifiez qu'à l'aide du fichier PHP de l'intranet Agis

echo Base MySQL sélectionnée: intranet_v3_0_cod
echo 'Nombre de serveur(s) Linux concerné(s): 4'
echo 'Nombre de dossier(s) à mettre à jour: 37'
echo 
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/db_files/erp_data.mdb ldcadm@10.147.3.201:/u1/DATA01/users/db_files
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/suivi_investissement. ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/db_files/erp_data.mdb ldcadm@10.146.3.201:/u1/DATA01/users/db_files
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/plan_qualite ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/plan_qualite ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.131.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/enregistrements_qualite ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch ldcadm@10.146.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.131.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/enregistrements_qualite ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/test ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/operations_commerciales ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/mercuriales ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/mercuriales ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/veille_reglementaire ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gestion_crise ldcadm@10.143.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gestion_crise ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/operations_commerciales ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/organisation ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/rh_multi_sites ldcadm@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/rh_multi_sites ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/qualite ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gofast ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/etiquettage/modeles ldcadm@10.146.3.201:/u1/DATA01/users/shared_program/etiquettage
ssh -t ldcadm@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/codesoft ldcadm@10.147.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/etiquettage/modeles ldcadm@10.147.3.201:/u1/DATA01/users/shared_program/etiquettage
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gofast ldcadm@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/intranet ldcadm@10.146.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch ldcadm@10.131.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch ldcadm@10.131.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/etiquettage/modeles ldcadm@10.131.3.201:/u1/DATA01/users/shared_program/etiquettage
ssh -t ldcadm@10.131.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/enregistrements_qualite ldcadm@10.143.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/intranet ldcadm@10.131.3.201:/u1/DATA01/users/shared_program
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/ninja ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/ninja ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/ninja ldcadm@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/referent_office ldcadm@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/referent_office ldcadm@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t ldcadm@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/referent_office ldcadm@10.147.3.201:/u1/DATA01/users/users_data/partages
