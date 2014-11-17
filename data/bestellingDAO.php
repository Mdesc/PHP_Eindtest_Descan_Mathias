<?php

require_once ("entities/bestelling_entitie.php");
require_once ("DBconfig.php");

class bestellingDAO{
    //variables
    
    //functions
    public function addBestelling($klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "insert into bestelling (klant_id,product_id,aantal,datum_gemaakt,datum_afhalen) values
              ('".$klant_id."','".$product_id."','".$aantal."','".$datum_gemaakt."','".$datum_afhalen."')";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteBestelling($bestelling_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="delete from bestelling where bestelling_id= ".$bestelling_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function updateBestelling($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="update bestelling set klant_id='".$klant_id."',product_id='".$product_id."',aantal='".$aantal."',datum_gemaakt='".$datum_gemaakt."',datum_afhalen='".$datum_afhalen."' where bestelling_id=".$bestelling_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function createWinkelmandRow($bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $winkelmandrow=  bestelling::create($bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
        return $winkelmandrow;
    }
    public function getBestellingByKlant_id($bestellingen,$klant_id,$datum_start,$datum_end){//datum die meegegven word door vorig functie,3maal max drie dagen verder bestellen
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select bestelling_id,klant_id,product_id,aantal,datum_gemaakt,datum_afhalen from bestelling where klant_id=".$klant_id." and datum_afhalen between'".$datum_start."' and '".$datum_end."' ";
        $resultset=$dbh->query($sql);
        foreach ($resultset as $rij){
            $bestelling=  bestelling::create($rij['bestelling_id'],$rij['klant_id'],$rij['product_id'],$rij['aantal'],$rij['datum_gemaakt'],$rij['datum_afhalen']);
            array_push($bestellingen,$bestelling);
        }
        $dbh= null; 
        return $bestellingen;
    }
    public function getbestellingen($datum_start,$datum_end){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select bestelling_id,klant_id,product_id,aantal,datum_gemaakt,datum_afhalen from bestelling where datum_afhalen between'".$datum_start."' and '".$datum_end."' ";
        $resultset=$dbh->query($sql);
        foreach ($resultset as $rij){
            $bestelling=  bestelling::create($rij['bestelling_id'],$rij['klant_id'],$rij['product_id'],$rij['aantal'],$rij['datum_gemaakt'],$rij['datum_afhalen']);
            array_push($bestellingen,$bestelling);
        }
        $dbh= null; 
        return $bestellingen;
    }
}