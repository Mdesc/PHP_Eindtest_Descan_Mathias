<?php

require_once ("data/gebruikerDAO.php");

class gebruiker_service{
    //functions
    public function addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block);
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
        $gebruiker= $gebruikerDAO->getByEmail($email);
        $_SESSION["succeed"]= false;
        
        if($gebruiker->GetEmail()==$email && $gebruiker->GetWachtwoord()==$wachtwoord){
            $_SESSION["succeed"]=true;
            $_SESSION["klant_id"]=$gebruiker->GetKlant_id();
        }
        return $_SESSION["succeed"];
    }
    public function getByKlant_id($klant_id){
        $gebruikerDAO = new gebruikerDAO();
        if($_SESSION["succeed"]==true){
            $gebruiker= $gebruikerDAO->getByklant_id($klant_id);
        }
    }
}
