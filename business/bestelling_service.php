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
    
    public function getBestellingen(){//haalt de bestellingen op voor de komende 3 dagen ver
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
    public function afhaalByKlantVandaag($klant_id){
        $vandaag_daytime= new DateTime();
        $vandaag=$vandaag_daytime->format('Y-m-d H:i:s');
    }
    public function bestellingVandaag($klant_id){
        $vandaag=false;//deze veranderd pas als er in de array een bestelling gevonden word met afhaaldatum van vandaag
        //bestellingen van klant verkrijgen;
        $bestellingenklant=  $this->getBestellingByKlant_id($klant_id);
        //aanmaken van daytime objecten om mee te controleren
        $vandaag_daytime= new DateTime();
        $vandaag_daytime->setTime(0,0,0);
        $vandaag_begin=$vandaag_daytime->format('Y-m-d H:i:s');
        $vandaag_daytime2= new DateTime();
        $vandaag_daytime2->setTime(23,59,59);
        $vandaag_eind=$vandaag_daytime2->format('Y-m-d H:i:s');
        foreach ($bestellingenklant as $bestelling){
            $datum_af=$bestelling->GetDatum_Afhalen();
            if($vandaag_begin<=$datum_af && $vandaag_eind>=$datum_af){
                $vandaag=true;
            }
        }
        return $vandaag;
    }
    public function bestellingMorgen($klant_id){
        $morgen=false;//deze zal verander als er een afhaaldatum gevonde word met deze datum
        $bestellingenklant=  $this->getBestellingByKlant_id($klant_id);
        //aanmaken van daytime objecten om mee te controleren
        $vandaag_daytime= new DateTime();
        $vandaag_daytime->setTime(0,0,0);
        $vandaag_daytime->modify('+1 day');
        $morgen_begin=$vandaag_daytime->format('Y-m-d H:i:s');
        $vandaag_daytime2= new DateTime();
        $vandaag_daytime2->setTime(23,59,59);
        $vandaag_daytime2->modify('+1 day');
        $morgen_eind=$vandaag_daytime2->format('Y-m-d H:i:s');
        foreach ($bestellingenklant as $bestelling){
            $datum_af=$bestelling->GetDatum_Afhalen();
            if($morgen_begin<=$datum_af && $morgen_eind>=$datum_af){
                $morgen=true;
            }
        }
        return $morgen;
    }
    public function bestellingOvermorgen($klant_id){
        $overmorgen=false;//deze zal verander als er een afhaaldatum gevonde word met deze datum
        $bestellingenklant=  $this->getBestellingByKlant_id($klant_id);
        //aanmaken van daytime objecten om mee te controleren
        $vandaag_daytime= new DateTime();
        $vandaag_daytime->setTime(0,0,0);
        $vandaag_daytime->modify('+2 day');
        $overmorgen_begin=$vandaag_daytime->format('Y-m-d H:i:s');
        $vandaag_daytime2= new DateTime();
        $vandaag_daytime2->setTime(23,59,59);
        $vandaag_daytime2->modify('+2 day');
        $overmorgen_eind=$vandaag_daytime2->format('Y-m-d H:i:s');
        foreach ($bestellingenklant as $bestelling){
            $datum_af=$bestelling->GetDatum_Afhalen();
            if($overmorgen_begin<=$datum_af && $overmorgen_eind>=$datum_af){
                $overmorgen=true;
            }
        }
        return $overmorgen;
    }
    public function bestellingOverovermorgen($klant_id){
        $overovermorgen=false;//deze zal verander als er een afhaaldatum gevonde word met deze datum
        $bestellingenklant=  $this->getBestellingByKlant_id($klant_id);
        //aanmaken van daytime objecten om mee te controleren
        $vandaag_daytime= new DateTime();
        $vandaag_daytime->setTime(0,0,0);
        $vandaag_daytime->modify('+3 day');
        $overovermorgen_begin=$vandaag_daytime->format('Y-m-d H:i:s');
        $vandaag_daytime2= new DateTime();
        $vandaag_daytime2->setTime(23,59,59);
        $vandaag_daytime2->modify('+3 day');
        $overovermorgen_eind=$vandaag_daytime2->format('Y-m-d H:i:s');
        foreach ($bestellingenklant as $bestelling){
            $datum_af=$bestelling->GetDatum_Afhalen();
            if($overovermorgen_begin<=$datum_af && $overovermorgen_eind>=$datum_af){
                $overovermorgen=true;
            }
        }
        return $overovermorgen;
    }
    public function totaalwinkelmand($totaal,$bedrag){
        $totaal = $totaal+$bedrag;
        return $totaal;
    }
    public function getBestellingVandaagByKlant_id($klant_id){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function getBestellingMorgenByKlant_id($klant_id){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function getBestellingOvermorgenByKlant_id($klant_id){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datetime_start->modify('+2 day');
        $datetime_end->modify('+2 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function getBestellingOverovermorgenByKlant_id($klant_id){//haalt de bestellingen op voor de komende 3 dagen van de klant
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datetime_start->modify('+3 day');
        $datetime_end->modify('+3 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function AnnulerenBestelling($klant_id,$dag){
        if($dag=='morgen'){
            $Annubestelling=  $this->getBestellingMorgenByKlant_id($klant_id);
            foreach ($Annubestelling as $Annu){
                $this->deleteBestelling($Annu->GetBestelling_id());
            }
        }
        if($dag=='overmorgen'){
            $Annubestelling= $this->getBestellingOvermorgenByKlant_id($klant_id);
            foreach ($Annubestelling as $Annu){
                $this->deleteBestelling($Annu->GetBestelling_id());
            }
        }
        if($dag=='overovermorgen'){
            $Annubestelling= $this->getBestellingOverovermorgenByKlant_id($klant_id);
            foreach ($Annubestelling as $Annu){
                $this->deleteBestelling($Annu->GetBestelling_id());
            }
        }
    }
    public function checkout($datum_afhalen){
        if(isset($_SESSION['winkelmand'])){
            $winkelmand=  unserialize($_SESSION['winkelmand']);
            print_r($winkelmand);
            foreach ($winkelmand as $bestellingrow){
                $this->addBestelling($bestellingrow->GetKlant_id(),$bestellingrow->GetProduct_id(),$bestellingrow->GetAantal(),$bestellingrow->GetDatum_gemaakt(),$datum_afhalen);
            }
            unset($_SESSION['winkelmand']);
            unset($_SESSION['aantalitems']);
            unset($_SESSION['bestelrow']);
            header('location: Home.php?succeed=yes');
        }else{
            header('location: Home.php?Geen=gegevens');
        }
    }
    public function getBestellingenMorgen(){
        $bestellingDAO= new bestellingDAO();
        $bestellingen= array();
        $datetime_start= new DateTime();
        $datetime_end= new DateTime();
        $datetime_start->setTime(0,0,0);
        $datetime_end->setTime(23,0,0);
        $datetime_start->modify('+1 day');
        $datetime_end->modify('+1 day');
        $datum_start=$datetime_start->format('Y-m-d H:i:s');
        $datum_end=$datetime_end->format('Y-m-d H:i:s');
        $bestellingen= $bestellingDAO->getBestellingtijd($bestellingen,$datum_start,$datum_end);
        return $bestellingen;
    }
    public function getBestellingenMorgenTotalProducts($lijstProducten){
        $allbestellingen= $this->getBestellingenMorgen();
        $lijstProducten;//zijn de bestellingen voor de volgende dag
        $allProductenBesteldMorgen= array();
        $aantal=0;
        $row=0;
        $col=0;
        //product_id ,productgroep_id,aantal
        foreach ($lijstProducten as $prod){
            /*echo*/ $allProductenBesteldMorgen[$row][$col]=$prod->GetProduct_id();
            $col=$col+1;
            /*echo*/ $allProductenBesteldMorgen[$row][$col]=$prod->GetProductgroep_id();
            $col=$col+1;
            /*echo*/ $allProductenBesteldMorgen[$row][$col]=$aantal;
            //echo '<br/>';
            $row=$row+1;
            $col=0;
        }
        
        //echo $allProductenBesteldMorgen[13][2];
        
        
        foreach($allbestellingen as $prod){
            $product_id=$prod->GetProduct_id();
            $aantal=$prod->GetAantal();
            
            $allProductenBesteldMorgen[$product_id][2]=$aantal+$allProductenBesteldMorgen[$product_id][2];
        }
        
        return $allProductenBesteldMorgen;
    }    
}

