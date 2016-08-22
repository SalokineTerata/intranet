<?php

/*
 * Copyright (C) 2016 fa4301632
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

/**
 * Page ayant la fonction d'intermétaire dans le traitement autocomplaison de jQuery
 */

/**
 * Initialisation
 */
require_once '../inc/main.php';

/**
 * Variables
 */
$paramValue = Lib::getParameterFromRequest(DatabaseDataJquery::VALUE);
$paramTerm = Lib::getParameterFromRequest(DatabaseDataJquery::TERM);
$param1 = Lib::getParameterFromRequest(DatabaseDataJquery::PARAM1);
$param2 = Lib::getParameterFromRequest(DatabaseDataJquery::PARAM2);

/**
 * Récuperation de la donnée sous le format JSON
 */
$databaseJqueryModel = new DatabaseDataJquery($paramValue, $paramTerm, $param1, $param2);

//Retour de la donnée au forma JSON traité par la fonction jQuery
echo $databaseJqueryModel->getReturnJSON();

