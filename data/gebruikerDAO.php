<?php

require_once ("entities/gebruiker_entitie.php");
require_once ("DBconfig.php");

//variables
$bestaandGebruiker= null;
    
class gebruikerDAO{
    //functions
    public function addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
       $bestaand= $this->getByEmail($email);
       if($bestaand->GetKlant_id()!=0){
           throw new emailInUseException();
       }
       $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
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
    public function getByEmail($email){
       $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
       $sql ="select klant_id,naam,voornaam,straat,huisnr,bus,postcode_id,email,wachtwoord,block from gebruiker where email='".$email."' ";
       $resultset= $dbh->query($sql);
       $rij=$resultset->fetch();
       $gebruiker= gebruiker::create($rij["klant_id"],$rij["naam"],$rij["voornaam"],$rij["straat"],$rij["huisnr"],$rij["bus"],$rij["postcode_id"],$rij["email"],$rij["wachtwoord"],$rij["block"]);
       return $gebruiker;
    }
    public function getByklant_id($klant_id){
       $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
       $sql ="select klant_id,naam,voornaam,straat,huisnr,bus,postcode_id,email,wachtwoord,block from gebruiker where klant_id=".$klant_id;
       $resultset= $dbh->query($sql);
       $rij=$resultset->fetch();
       $gebruiker= gebruiker::create($rij["klant_id"],$rij["naam"],$rij["voornaam"],$rij["straat"],$rij["huisnr"],$rij["bus"],$rij["postcode_id"],$rij["email"],$rij["wachtwoord"],$rij["block"]);
       return $gebruiker;
    }
    public function generateWachtwoord() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $wachtwoordArr = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $char = rand(0, $alphaLength);
            $wachtwoordArr[] = $alphabet[$char];
        }
        $wachtwoord = implode($wachtwoordArr);
        return $wachtwoord;
    }
    public function getGebruikers(){
        $lijstgebruikers=array();
        $dbh= new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $sql ="select klant_id,naam,voornaam,straat,huisnr,bus,postcode_id,email,wachtwoord,block from gebruiker order by naam";
        $resultset= $dbh->query($sql);
        foreach ($resultset as $rij){
            $gebruiker= gebruiker::create($rij["klant_id"],$rij["naam"],$rij["voornaam"],$rij["straat"],$rij["huisnr"],$rij["bus"],$rij["postcode_id"],$rij["email"],$rij["wachtwoord"],$rij["block"]);
            array_push($lijstgebruikers,$gebruiker);
        }
        return $lijstgebruikers;
    }
}

