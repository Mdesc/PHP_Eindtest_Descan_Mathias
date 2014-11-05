<?php

require_once ("data/gebruikerDAO.php");

class gebruiker_service{
    //functions
    public function addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block);
    }
    public function userInputCheck($naam,$voornaam,$straat,$huisnr,$bus,$postcode,$gemeente,$email){
        //heeft nog wat uitbreiding nodig
        $naam= str_replace("/", "<p/>", $naam);
        $voornaam= str_replace("/", "<p/>", $voornaam); 
        $straat= str_replace("/", "<p/>", $straat);
        $huisnr= str_replace("/", "<p/>",$huisnr);
        $bus= str_replace("/", "<p/>", $bus);
        $postcode= str_replace("/", "<p/>", $postcode);
        $gemeente= str_replace("/", "<p/>", $gemeente);
        $email= str_replace("/", "<p/>", $email);
        
        $naam= strip_tags(trim($naam));
        $voornaam= strip_tags(trim($voornaam)); 
        $straat= strip_tags(trim($straat));
        $huisnr= strip_tags(trim($huisnr));
        $bus= strip_tags(trim($bus));
        $postcode= strip_tags(trim($postcode));
        $gemeente= strip_tags(trim($gemeente));
        $email= strip_tags(trim($email));
        
        $naam= htmlspecialchars($naam);
        $voornaam=  htmlspecialchars($voornaam); 
        $straat=  htmlspecialchars($straat);
        $huisnr=  htmlspecialchars($huisnr);
        $bus=  htmlspecialchars($bus);
        $postcode=  htmlspecialchars($postcode);
        $gemeente=  htmlspecialchars($gemeente);
        $email=  htmlspecialchars($email);
        
        $naam= stripslashes($naam);
        $voornaam= stripslashes($voornaam); 
        $straat= stripslashes($straat);
        $huisnr= stripslashes($huisnr);
        $bus= stripslashes($bus);
        $postcode= stripslashes($postcode);
        $gemeente= stripslashes($gemeente);
        $email= stripslashes($email);
        
        $naam= mysql_real_escape_string($naam);
        $voornaam= mysql_real_escape_string($voornaam); 
        $straat= mysql_real_escape_string($straat);
        $huisnr= mysql_real_escape_string($huisnr);
        $bus= mysql_real_escape_string($bus);
        $postcode= mysql_real_escape_string($postcode);
        $gemeente= mysql_real_escape_string($gemeente);
        $email= mysql_real_escape_string($email);
        
        //echo $naam,' ',$voornaam,' ',$straat,' ',$huisnr,' ',$bus,' ',$postcode,' ',$gemeente,' ',$email;
    }
    public function deleteGebruiker($klant_id){
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->deleteGebruiker($klant_id);
    }
    public function updateGebruiker($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->updateGebruiker($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block);
    }
    public function logincheck($email,$wachtwoord){
        $db_wachtwoord= sha1($wachtwoord);
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker= $this->getByEmail($email);
        $status= false;
        if($gebruiker->GetEmail()==$email && $gebruiker->GetWachtwoord()==$db_wachtwoord){
            //als inlog klopt
            $status= true;
        }
        return $status;
    }
    public function getByKlant_id($klant_id){
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker= $gebruikerDAO->getByklant_id($klant_id);
        return $gebruiker;
    }
    public function getByEmail($email){
        $gebruikerDAO= new gebruikerDAO();
        $gebruiker= $gebruikerDAO->getByEmail($email);
        return $gebruiker;
    }
    public function getKlant_idByEmail($email){
        $gebruikerDAO= new gebruikerDAO();
        $gebruiker= $gebruikerDAO->getByEmail($email);
        $klant_id= $gebruiker->GetKlant_id();
        return $klant_id;
    }
    public function checkAdmin($email){
        //in deze functie word hardcode het email van amdin geplaatst om inlog te controleren
        $user_level;
        if($email == "admin@yahoo.com"){
            $user_level="admin";
        }else{
            $user_level="klant";
        }
        return $user_level;
    }
    public function login($email,$wachtwoord){
        $status= $this->logincheck($email, $wachtwoord);
        if($status == true){
            $user_level= $this->checkAdmin($email);
            //create sessie gegevens
            $klant_id= $this->getKlant_idByEmail($email);
            $this->createSessieInfo($status,$user_level,$klant_id);
            setcookie("username",$email);
            setcookie("wachtwoord",$wachtwoord);
        }
    }
    public function createSessieInfo($status,$user_level,$klant_id){
        $_SESSION["status"]=$status;
        $_SESSION["user_level"]=$user_level;
        $_SESSION["klant_id"]=$klant_id;
    }
    public function logout($key_out){
        if($key_out=="exit"){
            session_destroy(); 
        }
    }
    public function generateWachtwoord(){
        $gebruikerDAO= new gebruikerDAO();
        $wachtwoord= $gebruikerDAO->generateWachtwoord();
        return $wachtwoord;
    }
}
