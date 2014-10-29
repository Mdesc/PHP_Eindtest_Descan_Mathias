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
}