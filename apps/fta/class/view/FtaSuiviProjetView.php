<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FtaView
 *
 * @author salokine
 */
class FtaSuiviProjetView extends AbstractView {

    /**
     * Model de donnée d'un suivi de projet de FTA
     * @var FtaSuiviProjetModel 
     */
    private $model;

    /**
     * 
     * @param FtaSuiviProjetModel $ParamFtaSuiviProjetModel
     */
    public function __construct(FtaModel $ParamFtaSuiviProjetModel) {
        $this->setModel($ParamFtaSuiviProjetModel);
    }

    function getModel() {
        return $this->model;
    }

    function setModel(FtaSuiviProjetModel $model) {
        $this->model = $model;
    }

    public function getHtmlCommentaireChapitre() {
        $return = NULL;


        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->ftaModel->getDataField(FtaModel::KEYNAME)->getFieldValue()
                        , 1
        );
        $recordsetIdFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $HtmlSuiviProjet = new DataFieldToHtmlTextArea(
                $recordsetIdFtaSuiviProjet->getDataField(
                        FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
                )
        );
        $HtmlSuiviProjet->setIsEditable(TRUE);

        $return .= $HtmlSuiviProjet->getHtmlResult();
        return $return;
    }

    function getFtaSuiviProjetModel() {

        $idFtaChapitre = $this->getFtaChapitreModel()->getKeyValue();
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->getModel()->getKeyValue(), $idFtaChapitre
        );
        $ftaSuiviProjetModel = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $ftaSuiviProjetModel->setIsEditable($this->getIsEditable());
        return $ftaSuiviProjetModel;
    }

}
