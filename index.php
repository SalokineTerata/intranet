<?php

/*
 * Copyright (C) 2014 salokine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

$ServerName = $_SERVER['SERVER_NAME'];

/**
 * Redirection vers le proxy de production (tester en copie prod)
 */
if ($ServerName == "fta05401.grpldc.com" 
//        or $ServerName == "cop-fta05401.svlidc.com"
        ) {
//    header('Location: https://cop-fta05401.lesidc.com/v3/apps/index.php');
    header('Location: https://fta05401.lesidc.com/v3/apps/index.php');
} else {
    header('Location: apps/index.php');
}