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
 * Description of FtaProcessusDelaiView
 *
 * @author salokine
 */
class FtaProcessusDelaiView {

    /**
     * Model de donnée d'une FTA
     * @var FtaProcessusDelaiModel
     */
    private $modelFtaProcessusDelai;

    public function __construct(FtaModel $paramFtaModel) {
        $this->setFtaProcessusDelaiModel(new FtaProcessusDelaiModel);
        $this->getFtaProcessusDelaiModel()->setModelFtaById($paramFtaModel->getKeyValue());
    }

    /**
     * 
     * @return FtaProcessusDelaiModel
     */
    public function getFtaProcessusDelaiModel() {
        return $this->modelFtaProcessusDelai;
    }

    public function setFtaProcessusDelaiModel(FtaProcessusDelaiModel $ftaProcessusDelaiModel) {
        $this->modelFtaProcessusDelai = $ftaProcessusDelaiModel;
    }

}
