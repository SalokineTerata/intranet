<?php
//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
      require_once '../inc/main.php';

/*
-----------------
 ACTION A TRAITER
-----------------
-----------------------------------
 Détermination de l'action en cours
-----------------------------------

 Cette page est appelé pour effectuer un traitement particulier
 en fonction de la variable "$action". Ensuite elle redige le
 résultat vers une autre page.

 Le plus souvent, le traitement est délocalisé sous forme de
 fonction situé dans le fichier "functions.php"

*/

switch ($action)
{





/*******************************************************************************
                             MOTEUR DE RECHERCHE
*******************************************************************************/


/*******************************************************************************
Recherche :

A partir de 3 tableaux :
                       - $champ_recherche (contenant l'identifiant du nom du champ)
                       - $operateur_recherche (contenant l'identifiant de l'oprateur de recherche)
                       - $texte_recherche (contenant le texte a rechercher)

Cette action va permettre, une fois que l'utilisateur a selectionné 'Fin de saisie'
d'ecrire et d'executer la requete SQL qui va fournir le resultat demandé.

Vu que PHPMYADMIN n'apprécie pas les longues requetes, la grand requete finale
est découpe en sous-requete a chaque fois qu'apparait un OR.

Les resultats sont stokés dans un tableau renvoyé par url a la page index.php
Vu que l'url ne supporte pas un nombre trop elevé de données et qu'une recherche
qui fournit plus de 1000 n'est pas interessante le nombre de resultats est limité et
si le nombre de resultat de la requete depasse 1000, l'utilisateur est prié d'affiner sa
recherche
*******************************************************************************/

case 'recherche':


         // Dictionnaire des variables
         $nbligne=$GLOBALS['nbligne'];   // Nombre de lignes totales
         $nbcol = $GLOBALS['nbcol'];         // nombre de colonnes de la ligne courante
         $champ_recherche = $GLOBALS['champ_recherche']; //tableau des identifiants des champs choisis
         $operateur_recherche = $GLOBALS['operateur_recherche'];  //tableau des identifiants des operateurs choisis
         $texte_recherche = $GLOBALS['texte_recherche'];  //table au des valeurs entrées par l'utilisateur
         $champ_courant = $GLOBALS['champ_courant'];   // Valeur de l'identifiant du champ qui vient juste d'etre saisie par l'utilisateur
         $operateur_courant = $GLOBALS['operateur_courant']; // Valeur de l'identifiant de l'operateur qui vient juste d'etre saisie par l'utilisateur
         $texte_courant = $GLOBALS['texte_courant']; // Valeur du texte qui vient juste d'etre saisie par l'utilisateur
         $nb_col_courant = $GLOBALS['nb_col_courant'];  // numero de la colonne courante
         $nb_ligne_courant = $GLOBALS['nb_ligne_courant'];// numero de la ligne courante
         $ajout_col = $GLOBALS['ajout_col'];      //si $ajout_col = 1 : ajout d'une colonne dans la ligne courante
         $module_table = $GLOBALS['module_table'];  // nom du module courant
         $champ_retour= $GLOBALS['champ_retour'];   // nom du champ reponse de la requete
         $url=substr($url_page_depart,1);
         $url=substr($url,0,strlen($url)-1);
         $module = $module_table;
         $join = array();
         $y = 0;
         $z = 0;
         $join[$y][$z][1] = false;
         
         // Découpage des tableaux
         //Les lignes étant séparées par || et les colonnes par ;;
         $champ_recherche = explode ('||',$champ_recherche);
         $operateur_recherche = explode ('||',$operateur_recherche);
         $texte_recherche = explode ('||',$texte_recherche);
         for ($i=0;$i<$nbligne;$i++)
             {
             $champ_recherche[$i]= explode (';;',$champ_recherche[$i]);
             $operateur_recherche[$i]= explode (';;',$operateur_recherche[$i]);
             $texte_recherche[$i] = explode (';;',$texte_recherche[$i]);
             }

         // nom de la table de stockage de tous les champs
         //que l'on peut utiliser pour une recherche
         $table_tous_champs_rech = $module_table.'_moteur_de_recherche';
         $table_tous_champs_rech= $GLOBALS['table_tous_champs_rech'];

         // Nom de la table du champ retour
         $tmp=explode ('.',$champ_retour);
         $table_champ_retour = $tmp[0];
         $table_champ_retour = $GLOBALS['table_champ_retour'];


         // Parcours des tableaux de données pour ecrire les requetes
         $i=0;
         unset($tab_resultat);  //on vide le tableau
         while ($champ_recherche[$i][0]!='')
               {
               $j=0;
               $where='';  // on vide la variable qui contiendra une partie du where
               while ($champ_recherche[$i][$j])
                     {
                     // Récuperation du nom du champ correspondant a l'identifiant
                     // contenu dans $champ_recherche[$i][$j]
                     $tmp=$champ_recherche[$i][$j];
                     $nom1='nom_champ_moteur_de_recherche';
                     $nom1bis='table_moteur_de_recherche';
                     $nom2=$module_table.'_moteur_de_recherche';
                     $nom3= 'id_moteur_de_recherche';

                     $sql= " SELECT $nom1,$nom1bis
                             FROM $nom2
                             WHERE $nom3 =' $tmp'";
                     //$res= DatabaseOperation::query($sql)or die('Erreur SQL !'.$sql.'<br>'.mysql_error()) ;
                     $res= DatabaseOperation::query($sql);

                     //nom du champ
                     $champ = mysql_fetch_array($res,MYSQL_NUM);


                     // recuperation des jointures
//echo         $GLOBALS['table_champ_retour'];  // table du champ retour
//echo        $GLOBALS['table_tous_champs_rech'];

                     $join[$j] = jointure($champ[0],$url_page_depart,$module);

                     // Recuperation de l'operateur
                     $tmp=$operateur_recherche[$i][$j];
                     $sql2= " SELECT valeur_intranet_moteur_de_recherche_operateur_sur_champ
                              FROM intranet_moteur_de_recherche_operateur_sur_champ
                              WHERE  id_intranet_moteur_de_recherche_operateur_sur_champ=' $tmp'";
                     //$res2= DatabaseOperation::query( $sql2)or die('Erreur SQL !'.$sql2.'<br>'.mysql_error()) ;
                     $res2= DatabaseOperation::query( $sql2);

                     //operateur
                     $operateur = mysql_fetch_array($res2,MYSQL_NUM);

                     $table_et_champ=$champ[1].'.'.$champ[0];
                     switch ($operateur_recherche[$i][$j])
                     {
                        case 1: $where .=$table_et_champ.'  LIKE ( \'%'. $texte_recherche[$i][$j].'%\' ) ';
                        break;

                        case 2: $where .=$table_et_champ.' NOT LIKE ( \'%'. $texte_recherche[$i][$j].'%\' ) ';
                        break;

                        case 3: $where .=$table_et_champ.'  LIKE ( \''. $texte_recherche[$i][$j].'%\' ) ';
                        break;

                        case 9: $where .=$table_et_champ.'  LIKE ( \''. $texte_recherche[$i][$j].'\' ) ';
                        break;

                        default:

                           $where .= $table_et_champ;
                           $where .= $operateur[0];
                           $where .= '\''. $texte_recherche[$i][$j].'\'';

                        break;
                     }

                     if ($j<count($champ_recherche[$i])-1)
                        $where .=' AND ';
                     $j++;
                     }
         $z=0;
         $y=0;

/*******************************************************************************
Pour ne pas surcharger PhpMyAdmin les differentes jointures seront executées
separement

Mais il faut tenir compte du fait que la recherche demandée par l'utilisateur
peut contenir plusieurs champs avec des jointures que l'on peut modeliser de la facon suivante
(a OU b) ET (c OU d) que l'on doit decomposer en :
                                                  - a ET c
                                                  - a ET d
                                                  - b ET c
                                                  - b ET d
Pour cela on va utiliser l'algorithme ( utilisé precedement dans la fonction jointure)
de parcours en profondeur.
$join est un tableau a 3 dimensions qui contient sur chaque ligne, une ligne de
jointure differente. Chaque ligne de jointure contient un tableau qui lui meme
contient dans la premiere colonne 0 ou 1 selon si la ligne est lu ou non et dans
la deuxieme colonne contient un chemin complet de jointure pour un champ.
*******************************************************************************/

/*
echo "\$y=".$y."<br>";
echo "\$z=".$z."<br>";
echo "\$join[0]=".$join[$y][$z][0]."<br>";
echo "\$join[1]=".$join[$y][$z][1]."<br>";
*/



//initialisation de la boucle version Nathalie
if ($join[$y][$z][1])
{
  //Si jointure existante
  $boucle=1;
}else{
//Si il n'y a pas de jointure
  $boucle=2;
}


while ($boucle)
//while ($join[$y][$z][1]!='')
               {
               //Récupération de la première jointure
               unset($pile);
               $pile=array();                        // creation d'un tableau
               array_push($pile,$join[$y][$z][1]);   // on empile la jointure
               $join[$y][$z][0]=1;                   //On tag cette jointure
               $jointure = $join[$y][$z][1];         // requete des jointures
               $jointure .= ' AND ';
               $y++;
               //Fin de Récupération de la première jointure



               //Parcours et exploitation du reste du tableau $join
/*En commentaire par Boris
               while (count($pile)>0)     // tant que la pile n'est pas vide
                     {
*/

                     //Récupération du reste des jointures
                     while ($join[$y][$z][1]!='')
                           {
                           if ($join[$y][$z][0]!=1)
                              {
                              array_push($pile,$join[$y][$z][1]);  // on empile la jointure
                              $join[$y][$z][0]=1;   // on marque la jointure
                              $jointure1 .= $join[$y][$z][1];
                              $jointure1 .= ' AND ';

                              $y++;
                              $z=0;
                              }
                           else
                               $z++;
                           }
//echo $jointure.$jointure1." 1";
//echo "TEST1";
                     // fin d'un chemin : execution de la requete
                     if ($join[$y][$z][0]=='')  //Est-ce utile ? Vu la boucle précédente, on arrive toujours à la fin du tableau --Boris 2005-01-25.
                        {

                        // recuperation des noms des tables
/*
Optimisation par Boris:
On rajoute "AND 1" à la fin
                        //Si $jointure1 est vide, on supprime le " AND" en bout de ligne de $jointure
                        if ($jointure1=='')
                           $jointure= substr($jointure,0,-4);
                        //Sinon, on supprime le " AND" en bout de $jointure1
                        else
                            $jointure1= substr($jointure1,0,-4);
                        $jointure_fin=$jointure.$jointure1;
*/
                        $jointure_fin=$jointure.$jointure1;
                        $table_requete='';

                        //Boris 2005-09-15: Ajout des espaces car sinon les mots contenant "AND" étaient découpés !
                        //$joint=str_replace('=',' ', $jointure_fin);
                        //$joint=str_replace('AND',' ', $joint);
                        $joint=str_replace('=',' ', $jointure_fin);
                        $joint=str_replace(' AND ',' ', $joint);
                        $joint=explode(' ',$joint);

                        //Boris 2005-09-15: Ajout des espaces car sinon les mots contenant "AND" étaient découpés !
                        //$where_dec=explode('AND',$where);
                        $where_dec=explode(' AND ',$where);
                        $g=0;
                        while ($g<count($where_dec))
                              {
                              $where_dec[$g]=trim($where_dec[$g]);
                               $aux=explode(' ',$where_dec[$g]);
                               $aux1=explode('.',$aux[0]);
                               $where_dec[$g]=trim($aux1[0]);
                               $g++;
                              }
                        $g=0;
                        while ($g<count($joint))
                              {
                              $aux=explode('.',$joint[$g]);
                              $joint[$g]=trim($aux[0]);
                              $g++;
                              }
//echo $where_dec;
                        $t=array_merge($where_dec,$joint);
                        $t=array_unique($t);
                        sort($t,SORT_STRING);
                        $g=0;
                        while ($g<=count($t))
                              {
                              if( $t[$g]!='')
                                  {
                                  $table_requete.= $t[$g];
                                  if ($g<count($t)-1)
                                     $table_requete.= ',';
                                  }
                              $g++;
                              }


                        // where : requete directe
                        $requete = "SELECT DISTINCT $champ_retour FROM ";
                        $requete.= $table_requete;
                        $requete.= " WHERE ";
                        $requete .=$where;

                        // Ajout de la jointure si existante
                        if ($boucle==1)
                        //if($jointure_fin)
                        {
                            $requete .= ' AND ';
                            $requete .=$jointure_fin." 1";
                            $boucle=0;
                            //$pile=0;
                        }

//echo $requete;

                        // execution de la requete
                        $result = DatabaseOperation::query($requete) ;
                        // recuperation  des resultats
                        while ($enr= mysql_fetch_array($result,MYSQL_NUM))
                                {
                                $tab_resultat[]=$enr[0];
                                }
                        $depile=array_pop($pile);  // on depile le dernier element
                        // remise a zero du marquage
                        $nul=0;
                        unset($jointure1);
                        while ($join[$y][$nul][1]!='')
                              {
                              $join[$y][$nul][0]=0;
                              $nul++;
                              }
                        $y--;
                        }
//echo "test";
/*En commentaire par Boris
                     }
               $z++;
               $y=0;
*/
//Affichage de la requête final
//echo $requete;



               //Si il n'y a plus de jointure, on arrête la boucle
               if ($join[$y][$z][1]=='') $boucle=0;
               }
             $i++;
               }

         // Transformation des tableaux en une chaine de caratères
         //Les lignes étant séparées par || et les colonnes par ;;
         if ($nbligne==1)    // Si une seule ligne
            {
            if ($champ_recherche[0][0]!='')
               $champ_recherche_aux = implode (';;',$champ_recherche[0]);
            if ($operateur_recherche[0][0]!='')
               $operateur_recherche_aux = implode (';;',$operateur_recherche[0]);
            if ($texte_recherche[0][0]!='')
               $texte_recherche_aux = implode (';;',$texte_recherche[0]);
            }
         else
             {
             for ($i=0;$i<$nbligne;$i++)
                 {
                 $champ_recherche_aux .= implode (';;',$champ_recherche[$i]);
                 $champ_recherche_aux.='||';
                 $operateur_recherche_aux.= implode (';;',$operateur_recherche[$i]);
                 $operateur_recherche_aux.='||';
                 $texte_recherche_aux .= implode (';;',$texte_recherche[$i]);
                 $texte_recherche_aux.='||';
                 }
             }
          $champ_recherche =$champ_recherche_aux;
          $operateur_recherche=$operateur_recherche_aux;
          $texte_recherche=$texte_recherche_aux;

          if (count($tab_resultat)>$nb_limite_resultat)
             {
             $titre = 'ERREUR';
             $message = 'Votre demande a plus de 1000 résultats, veuillez précisez votre recherche !';
             afficher_message($titre, $message, $redirection);
             }
          else
              {
              if (count($tab_resultat)>0)
                 {
                  $tab_resultat= array_unique($tab_resultat);
                  sort( $tab_resultat);
                  $tab_resultat = implode (';;',$tab_resultat);
                  }
              /*
              Optimisation par Boris
              Au lieu d'envoyer les ID, on envoi uniquement la requête.
              if (!strstr($url_page_depart,'?'))
                 $lien = $url. '?url_page_depart='.$url_page_depart.'&tab_resultat='.$tab_resultat.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
              else
                 $lien = $url. '&url_page_depart='.$url_page_depart.'&tab_resultat='.$tab_resultat.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
              header ("Location: $lien");
*/
              if (!strstr($url_page_depart,'?'))
              {
                 $lien = $url. '?';
              }
              else
              {
                 $lien = $url. '&';
              }
//urlencode($requete);
$requete=urlencode($requete);
              $lien.= 'url_page_depart='.$url_page_depart
                    .'&requete_resultat='.$requete
                    .'&nb_limite_resultat='.$nb_limite_resultat
                    .'&champ_recherche='.$champ_recherche
                    .'&operateur_recherche='.$operateur_recherche
                    .'&texte_recherche='.$texte_recherche
                    .'&nbcol='.$nbcol.'&nbligne='.$nbligne
                    .'&nb_col_courant='.$nb_col_courant
                    .'&nb_ligne_courant='.$nb_ligne_courant
                    .'&ajout_col='.$ajout_col
                    ;
//echo "test";
//echo $lien;
              header ("Location: $lien");
              }
          unset($tab_resultat);

          break;



/*******************************************************************************
Cette action est utilisé des que l'utilisateur valide un formulaire.

Il peut y avoir plusieurs actions :

   - ET :  * valide le formulaire en cours
           * enregistre la valeur rentrée par l'ordinateur
           * crée un nouveau formulaire à droite de celui en cours
           (en augmentant le nombre de colonne de la ligne courante)

   - OU :  * valide le formulaire en cours
           * enregistre la valeur rentrée par l'ordinateur
           * crée un nouveau formulaire en dessous de celui en cours
           (en augmentant le nombre de lignes )

   - OU AVEC RECOPIE :  * valide le formulaire en cours
                        * enregistre la valeur rentrée par l'ordinateur
                        * recopie la ligne en cours des tableaux :
                                                                   - $champ_recherche
                                                                   - $operateur_recherche
                                                                   - $texte_recherche
                        a la fin de ces memes tableaux et on augmente le nombre de lignes )
   - SUPPR : Suppression du formulaire courant
             suppression de la ligne en cours des tableaux :
                                                            - $champ_recherche
                                                            - $operateur_recherche
                                                            - $texte_recherche
             on decremente le nombre de lignes et le nombre de colonnes
   - FIN : fin de la saisie de l'utilisateur
           * valide le formulaire en cours
           * enregistre la valeur rentrée par l'ordinateur
           * on va vers l'action recherche

*******************************************************************************/

case 'ajout' :
     // Dictionnaire des variables
     $nbligne = $GLOBALS['nbligne'];   // Nombre de lignes totales
     $nbcol = $GLOBALS['nbcol'];         // nombre de colonnes de la ligne courante
     $champ_recherche = $GLOBALS['champ_recherche']; //tableau des identifiants des champs choisis
     $operateur_recherche = $GLOBALS['operateur_recherche'];  //tableau des identifiants des operateurs choisis
     $texte_recherche = $GLOBALS['texte_recherche'];  //table au des valeurs entrées par l'utilisateur
     $champ_courant = $GLOBALS['champ_courant'];    // Valeur de l'identifiant du champ qui vient juste d'etre saisie par l'utilisateur
     $operateur_courant = $GLOBALS['operateur_courant']; // Valeur de l'identifiant de l'operateur qui vient juste d'etre saisie par l'utilisateur
     $texte_courant = $GLOBALS['texte_courant']; // Valeur du texte qui vient juste d'etre saisie par l'utilisateur
     $nb_col_courant = $GLOBALS['nb_col_courant'];  // numero de la colonne courante
     $nb_ligne_courant = $GLOBALS['nb_ligne_courant']; // numero de la ligne courante
     $ajout_col = $GLOBALS['ajout_col'];      //si $ajout_col = 1 : ajout d'une colonne dans la ligne courante
     $module_table=$GLOBALS['module_table'];
     $champ_retour=$GLOBALS['champ_retour'];
     $url=substr($url_page_depart,1);
         $url=substr($url,0,strlen($url)-1);

     // Si la valeur entrée par l'utilisateur est une date
     $name_j=$name_val.'_jour';
     if ($$name_j)
        {
        $name_m=$name_val.'_mois';
        $name_a=$name_val.'_annee';
        //transformation de la date en YYYY-MM-DD
        $texte_courant=$$name_a.'-'.$$name_m.'-'.$$name_j;
        }
     else  // Sinon c'est un champ texte
         $texte_courant=$$name_val;

     $ajout_col=0;

     // Découpage des tableaux
     //Séparation des lignes
     $champ_recherche_aux = explode ('||',$champ_recherche);
     $operateur_recherche_aux = explode ('||',$operateur_recherche);
     $texte_recherche_aux = explode ('||',$texte_recherche);
     // Séparation des colonnes
     for ($i=0;$i<$nbligne;$i++)
         {
         $champ_recherche_aux[$i]= explode (';;',$champ_recherche_aux[$i]);
         $operateur_recherche_aux[$i]= explode (';;',$operateur_recherche_aux[$i]);
         $texte_recherche_aux[$i] = explode (';;',$texte_recherche_aux[$i]);
         }

     // Si l'utilisateur veut supprimer un formulaire sans en avoir rempli tous les champs
     if (($champ_recherche_aux[$nb_ligne_courant][$nb_col_courant]=='' OR $operateur_recherche_aux[$nb_ligne_courant][$nb_col_courant]=='' OR $texte_courant=='') AND $boutton_operateur=='Suppr')
        {
        unset($champ_recherche);  //suppression du tableau
        unset($operateur_recherche);   //suppression du tableau
        unset($texte_recherche);  //suppression du tableau
        if ($nbcol==1 )          // Si on vient de supprimer la dernière valeur de la ligne, on supprime la ligne
           {
           if ($nbligne!=1)
               $nbligne--;
           }
        // transformation du tableau en chaine de caractere
        if ($nbligne==1)    // Si une seule ligne
           {
           if (isset($champ_recherche_aux[0][0]))
               $champ_recherche = implode (';;',$champ_recherche_aux[0]);
           if (isset($operateur_recherche_aux[0][0]))
              $operateur_recherche = implode (';;',$operateur_recherche_aux[0]);
           if (isset($texte_recherche_aux[0][0]))
               $texte_recherche = implode (';;',$texte_recherche_aux[0]);
           }
        else
           {
           for ($i=0;$i<$nbligne;$i++)
               {
               $champ_recherche .= implode (';;',$champ_recherche_aux[$i]);
               $champ_recherche.='||';
               $operateur_recherche .= implode (';;',$operateur_recherche_aux[$i]);
               $operateur_recherche.='||';
               $texte_recherche .= implode (';;',$texte_recherche_aux[$i]);
               $texte_recherche.='||';
               }
           }

        if (!strstr($url_page_depart,'?'))
           $lien = $url.'?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
        else
            $lien = $url.'&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
        header ("Location: $lien");
        }
     else
        {
        if ($champ_recherche_aux[$nb_ligne_courant][$nb_col_courant]=='')
           {
           // premiere liste vide
           $titre = 'ERREUR';
           $message = 'Choisissez une catégorie dans la première liste';
           afficher_message($titre, $message, $redirection);
           }
        else
            {
            if ($operateur_recherche_aux[$nb_ligne_courant][$nb_col_courant]=='')
               {
               //la deuxieme liste est vide
               $titre = 'ERREUR';
               $message = 'Choisissez un oprérateur dans la deuxième liste';
               afficher_message($titre, $message, $redirection);
               }
            else
                {
                if ($texte_courant=='')
                   {
                   //Pas de valeur a rechercher
                   $titre = 'ERREUR';
                   $message = 'Entrez un mot à rechercher';
                   afficher_message($titre, $message, $redirection);
                   }
                else
                    {
                    // tout est rempli
                    //On insere la valeur a rechercher dans le tableau des valeurs
                    $texte_recherche_aux[$nb_ligne_courant][$nb_col_courant]=$texte_courant;
                    if ($boutton_operateur)   // si l'utilisateur a choisi une action
                       {
                       if ($boutton_operateur=='et')
                          {
                          $ajout_col=1;     // variable qui va incrementer le nombre de colonne de la ligne courante
                          unset($texte_recherche);    //suppression du tableau
                          // transformation du tableau en chaine de caractere
                          if ($nbligne==1)
                             $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                          else
                              {
                              for ($i=0;$i<$nbligne;$i++)
                                  {
                                  $texte_recherche.= implode (';;',$texte_recherche_aux[$i]);
                                  $texte_recherche.='||';
                                  }
                              }

                          if (!strstr($url_page_depart,'?'))
                             $lien = $url.'?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          else
                             $lien = $url.'&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          header ("Location: $lien");
                          }
                       if ($boutton_operateur=='ou')
                          {
                          unset($texte_recherche);   //suppression du tableau
                          // transformation du tableau en chaine de caractere
                          if ($nbligne==1)
                             $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                          else
                              {
                              for ($i=0;$i<$nbligne;$i++)
                                  {
                                  $texte_recherche.= implode (';;',$texte_recherche_aux[$i]);
                                  $texte_recherche.='||';
                                  }
                              }
                          $nbligne++;  //on incremente le nombre de lignes
                          if (!strstr($url_page_depart,'?'))
                             $lien = $url.'?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          else
                              $lien = $url.'&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          header ("Location: $lien");
                          }
                       if ($boutton_operateur=='fin')
                          {
                          unset($texte_recherche); //suppression du tableau
                          // transformation du tableau en chaine de caractere
                          if ($nbligne==1)
                             $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                          else
                              {
                              for ($i=0;$i<$nbligne;$i++)
                                  {
                                  $texte_recherche.= implode (';;',$texte_recherche_aux[$i]);
                                  $texte_recherche.='||';
                                  }
                              }
                          $action = 'recherche';
                          $lien= 'action.php?url_page_depart='.$url_page_depart.'&module='.$module.'&module_table='.$module_table.'&champ_retour='.$champ_retour.'&action='.$action.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          header ("Location: $lien");
                          }
                       if ($boutton_operateur=='Ou_avec')
                          {
                          unset($champ_recherche);    //suppression du tableau
                          unset($operateur_recherche);  //suppression du tableau
                          unset($texte_recherche);  //suppression du tableau

                          //Copie de la ligne en cours à la fin du tableau
                          $champ_recherche_aux[$nbligne]=$champ_recherche_aux[$nb_ligne_courant];
                          $operateur_recherche_aux[$nbligne]=$operateur_recherche_aux[$nb_ligne_courant];
                          $texte_recherche_aux[$nbligne]=$texte_recherche_aux[$nb_ligne_courant];
                          $nbligne++;
                          // transformation du tableau en chaine de caractere
                          if ($nbligne==1)    // Si une seule ligne
                             {
                             if (isset($champ_recherche_aux[0][0]))
                                $champ_recherche = implode (';;',$champ_recherche_aux[0]);
                             if (isset($operateur_recherche_aux[0][0]))
                                $operateur_recherche = implode (';;',$operateur_recherche_aux[0]);
                             if (isset($texte_recherche_aux[0][0]))
                                $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                             }
                          else
                              {
                              for ($i=0;$i<$nbligne;$i++)
                                  {
                                  $champ_recherche .= implode (';;',$champ_recherche_aux[$i]);
                                  $champ_recherche.='||';
                                  $operateur_recherche .= implode (';;',$operateur_recherche_aux[$i]);
                                  $operateur_recherche.='||';
                                  $texte_recherche .= implode (';;',$texte_recherche_aux[$i]);
                                  $texte_recherche.='||';
                                  }
                              }
                          $nbcol=1;
                          if (!strstr($url_page_depart,'?'))
                             $lien = $url. '?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          else
                              $lien = $url. '&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          header ("Location: $lien");
                          }
                       if ($boutton_operateur=='Suppr')
                          {
                          unset($champ_recherche_aux[$nb_ligne_courant][$nb_col_courant]); //supression de la valeur du tableau de coordonnées($nb_ligne_courant,$nb_col_courant)
                          unset($operateur_recherche_aux[$nb_ligne_courant][$nb_col_courant]);
                          unset($texte_recherche_aux[$nb_ligne_courant][$nb_col_courant]);
                          unset($champ_recherche);  //suppression du tableau
                          unset($operateur_recherche);   //suppression du tableau
                          unset($texte_recherche);  //suppression du tableau
                          if ($nbcol==1 )          // Si on vient de supprimer la dernière valeur de la ligne, on supprime la ligne
                             {
                             for ($i=$nb_ligne_courant;$i<$nbligne;$i++)
                                 {
                                 $champ_recherche_aux[$i]=$champ_recherche_aux[$i+1];
                                 $operateur_recherche_aux[$i]=$operateur_recherche_aux[$i+1];
                                 $texte_recherche_aux[$i]=$texte_recherche_aux[$i+1];
                                 }
                             if ($nbligne>1)
                                $nbligne--;
                             }


                          // transformation du tableau en chaine de caractere
                          if ($nbligne==1)    // Si une seule ligne
                             {
                             if (isset($champ_recherche_aux[0][0]) OR isset($champ_recherche_aux[0][1]))
                                 $champ_recherche = implode (';;',$champ_recherche_aux[0]);
                             if (isset($operateur_recherche_aux[0][0]) OR isset($operateur_recherche_aux[0][1]))
                                $operateur_recherche = implode (';;',$operateur_recherche_aux[0]);
                             if (isset($texte_recherche_aux[0][0]) OR isset($texte_recherche_aux[0][1]))
                                $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                             }
                          else
                              {
                              for ($i=0;$i<$nbligne;$i++)
                                  {
                                  $champ_recherche .= implode (';;',$champ_recherche_aux[$i]);
                                  $champ_recherche.='||';
                                  $operateur_recherche .= implode (';;',$operateur_recherche_aux[$i]);
                                  $operateur_recherche.='||';
                                  $texte_recherche .= implode (';;',$texte_recherche_aux[$i]);
                                  $texte_recherche.='||';
                                  }
                              }
                          if (!strstr($url_page_depart,'?'))
                             $lien = $url.'?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          else
                              $lien = $url.'&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                          header ("Location: $lien");
                          }
                       }
                    else   // Si aucune case n'est cochée, on enregiste juste la valeur entrée par l'utilisateur
                        {
                        unset($texte_recherche);
                        if ($nbligne==1)
                            $texte_recherche = implode (';;',$texte_recherche_aux[0]);
                        else
                            {
                            for ($i=0;$i<$nbligne;$i++)
                                {
                                $texte_recherche.= implode (';;',$texte_recherche_aux[$i]);
                                $texte_recherche.='||';
                                }
                            }
                        if (!strstr($url_page_depart,'?'))
                           $lien = $url.'?url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                        else
                            $lien = $url.'&url_page_depart='.$url_page_depart.'&nb_limite_resultat='.$nb_limite_resultat.'&champ_recherche='.$champ_recherche.'&operateur_recherche='.$operateur_recherche.'&texte_recherche='.$texte_recherche.'&nbcol='.$nbcol.'&nbligne='.$nbligne.'&nb_col_courant='.$nb_col_courant.'&nb_ligne_courant='.$nb_ligne_courant.'&ajout_col='.$ajout_col;
                        header ("Location: $lien");
                        }
                    }
                }
        }
     }
     break;

/************
Fin de switch
************/
}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

