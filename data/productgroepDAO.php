<?php

require_once ("entities/productgroep_entitie.php");
require_once ("DBconfig.php");

class productgroepDAO{
    //variables
    
    //functions
    public function addProductgroep($productgroep_naam,$productgroep_image){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="insert into productgroep (productgroep_naam,productgroep_image) values ('".$productgroep_naam."','".$productgroep_image."')";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteProductgroep($productgroep_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "delete from productgroep where productgroep_id= ".$productgroep_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function updateProductgroep($productgroep_id,$productgroep_naam,$productgroep_image){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "update productgroep set productgroep_naam='".$productgroep_naam."',productgroep_image='".$productgroep_image."' where productgroep_id= ".$productgroep_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function getByProductgroep_id($productgroep_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="select productgroep_id,productgroep_naam,productgroep_image from productgroep where productgroep_id=".$productgroep_id;
        $resultset= $dbh->query($sql);
        $rij=$resultset->fetch();
        $productgroep= productgroep::create($rij["productgroep_id"],$rij["productgroep_naam"],$rij["productgroep_image"]);
        return $productgroep;
    }
    public function getByProductgroep_naam($productgroep_naam){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="select productgroep_id,productgroep_naam,productgroep_image from productgroep where productgroep_naam='".$productgroep_naam."' ";
        $resultset= $dbh->query($sql);
        $rij= $resultset->fetch();
        $productgroep= productgroep::create($rij["productgroep_id"],$rij["productgroep_naam"],$rij["productgroep_image"]);
        return $productgroep;
    }
    public function getProductgroepen(){
        $lijstproductgroepen= array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select productgroep_id,productgroep_naam,productgroep_image from productgroep order by productgroep_id";
        $resultset= $dbh->query($sql);
        foreach ($resultset as $rij){
            $productgroep= productgroep::create($rij["productgroep_id"],$rij["productgroep_naam"],$rij["productgroep_image"]);
            array_push($lijstproductgroepen,$productgroep);
        }
        return $lijstproductgroepen;
    }
}