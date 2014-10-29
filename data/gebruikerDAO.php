<?php

require_once ("entities/gebruiker_entitie.php");
require_once ("DBconfig.php");

//variables
$bestaandGebruiker= null;
    
class gebruikerDAO{
    //functions
    public function addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        print_r($dbh);
        $sql="insert into gebruiker (naam,voornaam,straat,huisnr,bus,postcode_id,email,wachtwoord,block)
              values ('".$naam."','".$voornaam."','".$straat."','".$huisnr."','".$bus."'
              ,'".$postcode_id."','".$email."','".$wachtwoord."','".$block."') ";
        $dbh->exec($sql);
        $dbh= null;
    }
    public function deleteGebruiker($klant_id){
       $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
       $sql="delete from gebruiker where klant_id= ".$klant_id;
       $dbh->exec($sql);
       $dbh= null;
    }
    public function updateGebruiker($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
       $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
       $sql= "update gebruiker set naam='".$naam."',voornaam='".$voornaam."',straat='".$straat."',huisnr='".$huisnr."',bus='".$bus."',postcode_id='".$postcode_id."'
             ,email='".$email."',wachtwoord='".$wachtwoord."',block='".$block."' where klant_id= ".$klant_id; 
       $dbh->exec($sql);
       $dbh= null;
    }
    
}

