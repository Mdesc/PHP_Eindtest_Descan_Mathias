<?php

require_once ("data/gemeenteDAO.php");

class gemeente_service{
    public function addGemeente($postcode,$gemeente){
        $gemeenteDAO= new gemeenteDAO();
        $gemeenteDAO->addGemeente($postcode,$gemeente);
    }
    public function deleteGemeente($postcode_id){
        $gemeenteDAO = new gemeenteDAO();
        $gemeenteDAO->deleteGemeente($postcode_id);
    }
    public function updateGemeente($postcode_id,$postcode,$gemeente){
        $gemeenteDAO = new gemeenteDAO();
        $gemeenteDAO->updateGemeente($postcode_id,$postcode,$gemeente);
    }
    public function getByPostcode_id($postcode_id){
       $gemeenteDAO = new gemeenteDAO();
       $locatie= $gemeenteDAO->getByPostcode_id($postcode_id);
       return $locatie;
    }
    public function getByPostcode($postcode){
        $gemeenteDAO = new gemeenteDAO();
        $lijstGemeenten= $gemeenteDAO->getByPostcode($postcode);
        return $lijstGemeenten;
    }
    public function getByGemeente($gemeente){
        $gemeenteDAO = new gemeenteDAO();
        $lijstGemeenten= $gemeenteDAO->getByGemeente($gemeente);
        return $lijstGemeenten;
    }
    public function bestaandControle($postcode,$gemeente){
        $gemeenteDAO = new gemeenteDAO();
        $bestaandelocatie= $gemeenteDAO->bestaandControle($postcode,$gemeente);
        return $bestaandelocatie;
    }
    public function getPostcode_idByGemeentePostcode($postcode,$gemeente){
        $gemeenteDAO = new gemeenteDAO();
        $postcode_id= $gemeenteDAO->getPostcode_idByGemeentePostcode($postcode,$gemeente);
        return $postcode_id;
    }
}

