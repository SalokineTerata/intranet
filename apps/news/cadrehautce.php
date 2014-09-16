<table width="770" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150" valign="top">
<?php
$titi=DatabaseOperation::query("select * from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);
if ($toto[membre_ce] == "oui"){
include("../news/menuce.php"); }
else if ($id_type==4){
include("../news/menuce.php"); }
?>
</td>
<td valign="top">