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
}

