<?php

require_once ("data/bestellingDAO.php");

class bestelling_service{
    public function addBestelling($klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $bestellingDAO= new bestellingDAO();
        $bestellingDAO->addBestelling($klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
    }
    public function deleteBestelling($bestelling_id){
        $bestellingDAO= new bestellingDAO();
        $bestellingDAO->deleteBestelling($bestelling_id);
    }
}

