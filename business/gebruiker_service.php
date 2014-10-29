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
}
