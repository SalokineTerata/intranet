<!DOCTYPE html>
<!--
Copyright (C) 2015 bs4300280

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="subform_post.php">
            <fieldset>
                <legend>TEST</legend>
                <div id="child">
                    <input type="text" class="enf" name ="enfant['1'][nom]">
                    <input type="text"  name ="enfant['1'][prenom]">
                    <input type="text"  name ="enfant['1'][DateNaiss]">
                    <input type="text" class="enf" name ="enfant['2'][nom]">
                    <input type="text"  name ="enfant['2'][prenom]">
                    <input type="text"  name ="enfant['2'][DateNaiss]">
                </div><input type="button" value="Ajouter un enfant" onclick="ajouter()">

            </fieldset>
            <input type=submit value=\"Enregistrer les informations saisies\">
        </form>
    </body>
</html>
