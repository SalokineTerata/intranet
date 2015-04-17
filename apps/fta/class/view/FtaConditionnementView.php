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
 * Description of FtaConditionnementView
 *
 * @author franckwastaken
 */
class FtaConditionnementView {

    /**
     * Model de donnée d'une FTA
     * @var FtaConditionnementModel
     */
    private $ftaConditionnementModel;

  
    /**
     * 
     * @param FtaConditionnementModel 
     */
    
    public function __construct(FtaConditionnementModel $ParamFtaConditionnementModel) {
        $this->setFtaConditionnementModel($ParamFtaConditionnementModel);
    }

    /**
     * 
     * @return FtaConditionnementModel
     */

    //similaire à getModel
    public function getFtaConditionnementModel() {
        return $this->ftaConditionnementModel;
    }

    function setFtaConditionnementModel(FtaConditionnementModel $ftaConditonnementModel) {
        if ($ftaConditonnementModel instanceof FtaConditionnementModel) {
            $this->ftaConditionnementModel = $ftaConditonnementModel;
        }
    }
    
    public function getHtmlPoidsEmballageUVC() {


        $return = $this->getFtaConditionnementModel()->getArrayEmballageTypeUVC();

        $htmlPoidsUVC = new HtmlInputText();

        $htmlPoidsUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidsUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE]);
        $htmlPoidsUVC->setIsEditable(FALSE);
        return $htmlPoidsUVC->getHtmlResult();
    }

}
