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

/**
 * Description of FtaChapitreModel
 *
 * @author salokine
 */
class FtaChapitreModel extends AbstractModel {

    const TABLENAME = "fta_chapitre";
    const KEYNAME = "id_fta_chapitre";
    const FIELDNAME_ID_PROCESSUS = "id_fta_processus";
    const FIELDNAME_NOM_CHAPITRE = "nom_fta_chapitre";
    const FIELDNAME_NOM_USUEL_CHAPITRE = "nom_usuel_fta_chapitre";

    /**
     * Processus associé à ce chapitre
     * @var FtaProcessusModel
     */
    private $modelFtaProcessus;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaProcessus(
                new FtaProcessusModel(
                $this->getDataField(self::FIELDNAME_ID_PROCESSUS)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    public function getModelFtaProcessus() {
        return $this->modelFtaProcessus;
    }

    private function setModelFtaProcessus(FtaProcessusModel $modelFtaProcessus) {
        $this->modelFtaProcessus = $modelFtaProcessus;
    }

}
