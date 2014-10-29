<?php

class gebruiker{
    //variables
    private static $idMap=array();
    private $klant_id;
    private $naam;
    private $voornaam;
    private $straat;
    private $huisnr;
    private $bus;
    private $postcode_id;
    private $email;
    private $wachtwoord;
    private $block;
    
    //constructor
    private function __construct($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        $this->klant_id=$klant_id;
        $this->naam=$naam;
        $this->voornaam=$voornaam;
        $this->straat=$straat;
        $this->huisnr=$huisnr;
        $this->bus=$bus;
        $this->postcode_id=$postcode_id;
        $this->email=$email;
        $this->wachtwoord=$wachtwoord;
        $this->block=$block;
    }
            
    //functions
    public static function create($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block){
        if(!isset(self::$idMap[$klant_id])){
            self::$idMap[$klant_id]= new gebruiker($klant_id,$naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block); 
        }
        return self::$idMap[$klant_id];
    }
    
    //>>getters
    public function GetKlant_id(){
        return $this->klant_id;
    }
    public function GetNaam(){
        return $this->naam;
    }
    public function GetVoornaam(){
        return $this->voornaam;
    }
    public function GetStraat(){
        return $this->straat;
    }
    public function GetHuisnr(){
        return $this->huisnr;
    }
    public function GetBus(){
        return $this->bus;
    }
    public function GetPostcode_id(){
        return $this->postcode_id;
    }
    public function GetEmail(){
        return $this->email;
    }
    public function GetWachtwoord(){
        return $this->wachtwoord;
    }
    public function GetBlock(){
        return $this->block;
    }
    
    //>>setters
    public function SetKlant_id($klant_id){
        $this->klant_id=$klant_id;
    }
    public function SetNaam($naam){
        $this->naam=$naam;
    }
    public function SetVoornaam($voornaam){
        $this->voornaam=$voornaam;
    }
    public function SetStraat($straat){
        $this->straat=$straat;
    }
    public function SetHuisnr($huisnr){
        $this->huisnr=$huisnr;
    }
    public function SetBus($bus){
        $this->bus=$bus;
    }
    public function SetPostcode_id($postcode_id){
        $this->postcode_id=$postcode_id;
    }
    public function SetEmail($email){
        $this->email=$email;
    }
    public function SetWachtwoord($wachtwoord){
        $this->wachtwoord=$wachtwoord;
    }
    public function SetBlock($block){
        $this->block=$block;
    }
}

