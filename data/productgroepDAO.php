<?php

require_once ("entities/productgroep_entitie.php");
require_once ("DBconfig.php");

class productgroepDAO{
    //variables
    
    //functions
    public function addProductgroep($productgroep_naam){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="insert into productgroep (productgroep_naam) values ('".$productgroep_naam."')";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteProductgroep($productgroep_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "delete from productgroep where productgroep_id= ".$productgroep_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function updateProductgroep($productgroep_id,$productgroep_naam){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "update productgroep set productgroep_naam='".$productgroep_naam."' where productgroep_id= ".$productgroep_id;
        print_r($sql);
        $dbh->exec($sql);
        $dbh= null;
    }
}