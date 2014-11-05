<?php

require_once ("entities/gemeente_entitie.php");
require_once ("DBconfig.php");

class gemeenteDAO{
    //variables
    
    //functions
    public function addGemeente($postcode,$gemeente){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="insert into gemeente (postcode,gemeente) values ('".$postcode."','".$gemeente."') ";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteGemeente($postcode_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql="delete from gemeente where postcode_id= ".$postcode_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function updateGemeente($postcode_id,$postcode,$gemeente){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "update gemeente set postcode='".$postcode."',gemeente='".$gemeente."' where postcode_id=".$postcode_id;
        $dbh->exec($sql);
        $dbh= null;
    }
    public function getByPostcode_id($postcode_id){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select product_id,postcode,gemeente from gemeente where postcode_id=".$postcode_id;
        $resultset= $dbh->exec($sql);
        $rij= $resultset->fetch();
        $gemeenteObj= gemeente::create($rij["postcode_id"],$rij["postcode"],$rij["gemeente"]);
        $dbh= null;
        return $gemeenteObj;
    }
    public function getByPostcode($postcode){
        $lijstResultaten=array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select postcode_id,postcode,gemeente from gemeente where postcode=".$postcode;
        $resultset= $dbh->query($sql);
        foreach ($resultset as $rij){
            $locatie= gemeente::create($rij["postcode_id"],$rij["postcode"],$rij["gemeente"]);
            array_push($lijstResultaten,$locatie);
        }
        $dbh= null;
        return $lijstResultaten;
    }
    public function getByGemeente($gemeente){
        $lijstResultaten=array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql= "select postcode_id,postcode,gemeente from gemeente where gemeente='".$gemeente."' " ;
        $resultset= $dbh->query($sql);
        foreach ($resultset as $rij){
            $locatie= gemeente::create($rij["postcode_id"],$rij["postcode"],$rij["gemeente"]);
            array_push($lijstResultaten,$locatie);
        }
        $dbh= null;
        return $lijstResultaten;
    }
    public function bestaandControle($postcode,$gemeente){
        //$dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $lijstPostcode=  $this->getByPostcode($postcode);
        $lijstGemeente= $this->getByGemeente($gemeente);
        $bestaandposcoderecord= false;
        foreach ($lijstPostcode as $PostcodeObj){
           if($postcode==$PostcodeObj->GetPostcode() && $gemeente==$PostcodeObj->GetGemeente()){
               $bestaandposcoderecord= true;               
           }
        }
        if($bestaandposcoderecord== false){
            foreach ($lijstGemeente as $gemeenteObj){
                if($gemeente==$gemeenteObj->GetGemeente() && $postcode==$gemeenteObj->GetPostcode()){
                    $bestaandposcoderecord= true;
                }
            }
        }
        return $bestaandposcoderecord;
    }
    public function getPostcode_idByGemeentePostcode($postcode,$gemeente){
        $lijst= $this->getByPostcode($postcode);
        foreach ($lijst as $GemeenteObj){
           if($postcode==$GemeenteObj->GetPostcode() && $gemeente==$GemeenteObj->GetGemeente()){
               return $GemeenteObj->GetPostcode_id();             
           }
        }  
    }
}