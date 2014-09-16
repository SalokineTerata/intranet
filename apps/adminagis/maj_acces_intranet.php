<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

  identification1("salaries", $login, $pass);

  echo "<hr />\n".
       "Update des droits d'accès dans la table intranet_droit_acces (SM - avril 2004 11:50:28)<br>";

  $req= "select id_user from intranet_droits_acces group by id_user";
  $result=DatabaseOperation::query($req);
  $nb_ligne=mysql_num_rows($result);

  $cpt=0;
  while ($cpt<$nb_ligne)
  {
    $id_user =mysql_result($result,$cpt);
    //test sur un salarie $id_user=10;

    for ($module=9;$module<12;$module++)
    {
    $req1="insert into intranet_droits_acces (id_intranet_modules, id_user, id_intranet_actions, niveau_intranet_droits_acces)
           values ('$module', '$id_user', '1', '1')";
     $result1=DatabaseOperation::query($req1);
    //echo("<br>");
     $req2="insert into intranet_droits_acces (id_intranet_modules, id_user, id_intranet_actions, niveau_intranet_droits_acces)
           values ('$module', '$id_user', '2', '0')";
     $result2=DatabaseOperation::query($req2);
    //echo ("cpt = $cpt // module = $module, id_user = $id_user, (1,1), (2,0) <br>");
    }
    $cpt++;
  }
  echo ("<br><br> Traitement réalisé sur $cpt id_user. <br>"); // module = $module, id_user = $id_user, (1,1), (2,0) <br>");

?>
</body>

</html>