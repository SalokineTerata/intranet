#!/bin/sh
#Script permettant d'effectuer les copies Intersites
#ATTENTION !! Ce script a été autogénéré via datasync.sh
#Ne le modifiez qu'à l'aide du fichier PHP de l'intranet Agis
echo Base MySQL sélectionnée: agis
echo 'Nombre de serveur(s) Linux concerné(s): 4'
echo 'Nombre de dossier(s) à mettre à jour: 29'
echo 
ssh -t root@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gestion_crise root@10.143.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/suivi_investissement root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/db_files/erp_data.mdb root@10.146.3.201:/u1/DATA01/users/db_files
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/plan_qualite root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch root@10.146.3.201:/u1/DATA01/users/shared_program
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/enregistrements_qualite root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/mercuriales root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/veille_reglementaire root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/operations_commerciales root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/rh_multi_sites root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gofast root@10.146.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/etiquettage/modeles root@10.146.3.201:/u1/DATA01/users/shared_program/etiquettage
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/intranet root@10.146.3.201:/u1/DATA01/users/shared_program
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/db_files/erp_data.mdb root@10.147.3.201:/u1/DATA01/users/db_files
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/plan_qualite root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/enregistrements_qualite root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch root@10.147.3.201:/u1/DATA01/users/shared_program
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/test root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/operations_commerciales root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/mercuriales root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/etiquettage/modeles root@10.147.3.201:/u1/DATA01/users/shared_program/etiquettage
ssh -t root@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gestion_crise root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/organisation root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/qualite root@10.147.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.146.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/codesoft root@10.147.3.201:/u1/DATA01/users/shared_program
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/rh_multi_sites root@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/users_data/partages/gofast root@10.131.3.201:/u1/DATA01/users/users_data/partages
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch root@10.131.3.201:/u1/DATA01/users/shared_program
ssh -t root@10.143.3.201 rsync -avzO --delete --no-p /u1/DATA01/users/shared_program/batch root@10.131.3.201:/u1/DATA01/users/shared_program
