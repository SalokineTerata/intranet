<?php

/*
 * Copyright (C) 2015 bs4300280
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
 * Cette page PHP gère les appels entre les pages PHP du site.
 */
switch (Lib::getParameterFromRequest(GlobalConfig::DISPATCHER_VARNAME)) {

    case GlobalConfig::DISPATCHER_ACTION_VIEW_RECORD:
        Lib::getParameterFromRequest("tablename");
        Lib::getParameterFromRequest("keyvalue");
        break;

    default:
        break;
};

