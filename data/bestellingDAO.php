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
}