<?php

require_once ("entities/product_entitie.php");
require_once ("DBconfig.php");

class productDAO{
    //variables
    
    //functions
    public function addProduct($productgroep_id,$product,$kostprijs_stuk){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="insert into product (productgroep_id,product,kostprijs_stuk) values ('".$productgroep_id."','".$product."','".$kostprijs_stuk."')";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteProduct($product_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="delete from product where product_id= ".$product_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function updateProduct($product_id,$productgroep_id,$product,$kostprijs_stuk){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "update product set productgroep_id='".$productgroep_id."',product='".$product."',kostprijs_stuk='".$kostprijs_stuk."' where product_id= ".$product_id;
        $dbh->exec($sql);
        $dbh= null;
        print_r($sql);
    }
    public function getByProduct_id($product_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select product_id,productgroep_id,product,kostprijs_stuk from product where".$product_id;
        $resultset= $dbh->query($sql);
        $rij= $resultset->fetch();
        $product= product::create($rij["product_id"],$rij["productgroep_id"],$rij["product"],$rij["kostprijs_stuk"]);
        return $product;
    }
    public function getByProductgroep_id($productgroep_id){
        $LijstProductgroep_id= array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select product_id,productgroep_id,product,kostprijs_stuk from product where".$productgroep_id;
        $resultset= $dbh->query($sql);
        foreach ($reultset as $rij){
            $product= product::create($rij["product_id"],$rij["productgroep_id"],$rij["product"],$rij["kostprijs_stuk"]);
            array_push($LijstProductgroep_id,$product);
        }
        return $LijstProductgroep_id;
    }
    public function getProducten(){
        $LijstProducten= array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select product_id,productgroep_id,product,kostprijs_stuk from product order by productgroep_id";
        $resultset= $dbh->query($sql);
        foreach ($reultset as $rij){
            $product= product::create($rij["product_id"],$rij["productgroep_id"],$rij["product"],$rij["kostprijs_stuk"]);
            array_push($LijstProductgroep_id,$product);
        }
        return $LijstProducten;
    }
}