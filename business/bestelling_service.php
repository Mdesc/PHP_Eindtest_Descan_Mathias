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
    public function updateBestelling($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $bestellingDAO= new bestellingDAO();
        $bestellingDAO->updateBestelling($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
    }
    public function createWinkelmandRow($bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $bestellingDAO= new bestellingDAO();
        $winkelmandrow= $bestellingDAO->createWinkelmandRow($bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
        return $winkelmandrow;
    }
    public function addtowinkelmand($winkelmand,$bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        if(isset($_SESSION['winkelmand'])){
            $winkelmand=  unserialize($_SESSION['winkelmand']);
        }
        $winkelmandrow= $this->createWinkelmandRow($bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
        array_push($winkelmand,$winkelmandrow);
        $_SESSION['winkelmand']=  serialize($winkelmand);
        return $winkelmand;
    }
    public function getBestellingByKlant_id($klant_id){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        return $bestellingen;
    }
    
    public function getBestellingen(){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getbestellingen($bestellingen,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getbestellingen($bestellingen,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getbestellingen($bestellingen,$datum_start,$datum_end);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getbestellingen($bestellingen,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function bestelrowcount($bestelrow){
        if(isset($_SESSION['bestelrow'])){
           $bestelrow=$_SESSION['bestelrow'];
        }
        $bestelrow=$bestelrow+1;
        $_SESSION['bestelrow']=$bestelrow;
        return$bestelrow;
    }
    public function removebestelrow($bestelrow){
        if(isset($_SESSION['winkelmand'])){
            $winkelmand=  unserialize($_SESSION['winkelmand']);
            if(isset($_SESSION['aantalitems'])){
                $aantalitems=$_SESSION['aantalitems'];
            }
            $newwinkelmand=array();
            foreach ($winkelmand as $row){
                if($bestelrow!=$row->GetBestelling_id()){
                    array_push($newwinkelmand,$row);                    
                }
            }
            $aantalitems=$aantalitems-1;
            $_SESSION['aantalitems']=$aantalitems;
            $_SESSION['winkelmand']=  serialize($newwinkelmand);
        }
    }
}

