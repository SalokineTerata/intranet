<?php

class HtmlResult {

    const ROOT_VALUE = 1;
    const ID_ARBORESCENCE = "IdArborescence";
    const PROPRIETAIRE = "Proprietaire";
    const MARQUE = "Marque";
    const ACTIVITE = "Activite";
    const RAYON = "Rayon";
    const RESEAU = "Reseau";
    const ENVIRONNEMENT = "Environnement";
    const SAISONALITE = "Saisonnalite";

    private $isProprietaireEnd;
    private $arrayResult;
    private $htmlResult;
    private $idArborescence;
    private $proprietaire;
    private $proprietaire2;
    private $marque;
    private $activite;
    private $rayon;
    private $reseau;
    private $environnement;
    private $saisonalite;
    private $export;
    private $tmp;
    private $idproprietaire;
    private $idproprietaire2;
    private $idmarque;
    private $idactivite;
    private $idrayon;
    private $idreseau;
    private $idenvironnement;
    private $idsaisonalite;
    private $idexport;

    function getIsProprietaireEnd() {
        return $this->isProprietaireEnd;
    }

    function setIsProprietaireEndToTrue() {
        $this->isProprietaireEnd = TRUE;
    }

    function setIsProprietaireEndToFalse() {
        $this->isProprietaireEnd = FALSE;
    }

    function unsetProprietaire() {
        $this->proprietaire = NULL;
    }

    function cleanAll() {

        $this->idArborescence = NULL;
        $this->proprietaire = NULL;
        $this->marque = NULL;
        $this->activite = NULL;
        $this->rayon = NULL;
        $this->reseau = NULL;
        $this->environnement = NULL;
        $this->saisonalite = NULL;
        $this->export = NULL;
    }

    function getArrayResult() {
        return $this->arrayResult;
    }

    function setArrayResult($arrayResult) {
        $this->arrayResult = $arrayResult;
    }

    function getProprietaire() {
        return $this->proprietaire;
    }

    function getMarque() {
        return $this->marque;
    }

    function getActivite() {
        return $this->activite;
    }

    function getRayon() {
        return $this->rayon;
    }

    function getReseau() {
        return $this->reseau;
    }

    function getEnvironnement() {
        return $this->environnement;
    }

    function getSaisonalite() {
        return $this->saisonalite;
    }

    function removeLastProprietaire() {
        array_pop($this->proprietaire);
    }

    function removeLastIdProprietaire() {
        array_pop($this->idproprietaire);
    }

    function setProprietaire($proprietaire) {


//        if ($this->getIsProprietaireEnd() == TRUE) {
//            array_pop($this->proprietaire);
//            $this->setIsProprietaireEndToFalse();
//        }
        $this->proprietaire[] = $proprietaire;
    }

    function setMarque($marque) {
        $this->marque = $marque;
    }

    function setActivite($activite) {
        $this->activite = $activite;
    }

    function setRayon($rayon) {
        $this->rayon = $rayon;
    }

    function setReseau($reseau) {
        $this->reseau = $reseau;
    }

    function setEnvironnement($environnement) {
        $this->environnement = $environnement;
    }

    function setSaisonalite($saisonalite) {
        $this->saisonalite = $saisonalite;
    }

    function getIdArborescence() {
        return $this->idArborescence;
    }

    function setIdArborescence($idArborescence) {
        $this->idArborescence = $idArborescence;
    }

    function getProprietaire2() {
        return $this->proprietaire2;
    }

    function setProprietaire2($proprietaire2) {
        $this->proprietaire2 = $proprietaire2;
    }

    function getExport() {
        return $this->export;
    }

    function setExport($export) {
        $this->export = $export;
    }

    function getIdproprietaire() {
        return $this->idproprietaire;
    }

    function getIdproprietaire2() {
        return $this->idproprietaire2;
    }

    function getIdmarque() {
        return $this->idmarque;
    }

    function getIdactivite() {
        return $this->idactivite;
    }

    function getIdrayon() {
        return $this->idrayon;
    }

    function getIdreseau() {
        return $this->idreseau;
    }

    function getIdenvironnement() {
        return $this->idenvironnement;
    }

    function getIdsaisonalite() {
        return $this->idsaisonalite;
    }

    function getIdexport() {
        return $this->idexport;
    }

    function setIdproprietaire($idproprietaire) {
        $this->idproprietaire[] = $idproprietaire;
    }

    function setIdproprietaire2($idproprietaire2) {
        $this->idproprietaire2 = $idproprietaire2;
    }

    function setIdmarque($idmarque) {
        $this->idmarque = $idmarque;
    }

    function setIdactivite($idactivite) {
        $this->idactivite = $idactivite;
    }

    function setIdrayon($idrayon) {
        $this->idrayon = $idrayon;
    }

    function setIdreseau($idreseau) {
        $this->idreseau = $idreseau;
    }

    function setIdenvironnement($idenvironnement) {
        $this->idenvironnement = $idenvironnement;
    }

    function setIdsaisonalite($idsaisonalite) {
        $this->idsaisonalite = $idsaisonalite;
    }

    function setIdexport($idexport) {
        $this->idexport = $idexport;
    }

    function getTmp() {
        return $this->tmp;
    }

    function setTmp($tmp) {
        $this->tmp = $tmp;
    }

    function getHtmlResult() {
        return $this->htmlResult;
    }

    function setHtmlResult($htmlResult) {
        $this->htmlResult = $htmlResult;
    }

}
