<?php
echo "
<br>
<table width=\"100%\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
        <tr>
          <td colspan=\"2\" class=\"loginFFCC66\">recherche</td>
        </tr>
       <form name=\"recherche\" action=\"rechercher.php\" method=post>
        <tr>
          <td align=\"left\" valign=\"middle\" width=\"100\" class=\"loginFFFFFF\">
            <input type=\"text\" name=\"mots\" size=\"15\" maxlength=\"15\" class=\"loginFFFFFF\">
          </td>
          <td align=\"left\" valign=\"middle\" width=\"30\"><input type=image src=\"../zimages/go.gif\" border=0 name=\"Submit\"></td>
        </tr>
        </form>
        <tr>
          <td align=\"center\" valign=\"middle\" class=\"loginFFCC66\">recherche avanc&eacute;e
          </td>
          <td align=\"left\" valign=\"middle\" width=\"30\"><a href=\"recherchefine.php\"><img src=\"../zimages/go.gif\" width=\"20\" height=\"20\" border=0></a></td>
        </tr>
</table>
<br>
";
?>