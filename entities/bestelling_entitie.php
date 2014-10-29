<?php

class bestelling{
    //variables
    private static $idMap=array();
    private $bestelling_id;
    private $klant_id;
    private $product_id;
    private $aantal;
    private $datum_gemaakt;
    private $datum_afhalen;
    
    //constructor
    private function __construct($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        $this->bestelling_id=$bestelling_id;
        $this->klant_id=$klant_id;
        $this->product_id=$product_id;
        $this->aantal=$aantal;
        $this->datum_gemaakt=$datum_gemaakt;
        $this->datum_afhalen=$datum_afhalen;
    } 
    //functions
    public static function create($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen){
        if(!isset(self::$idMap[$bestelling_id])){
            self::$idMap[$bestelling_id]= new bestelling($bestelling_id,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
        }
        return self::$idMap[$bestelling_id];
    }
    //>>getters
    public function GetBestelling_id(){
        return $this->bestelling_id;
    }
    public function GetKlant_id(){
        return $this->klant_id;
    }
    public function GetProduct_id(){
        return $this->product_id;
    }
    public function GetAantal(){
        return $this->aantal;
    }
    public function GetDatum_gemaakt(){
        return $this->datum_gemaakt;
    }
    public function GetDatum_Afhalen(){
        return $this->datum_afhalen;
    }

    //>>setters
    public function SetBestelling_id($bestelling_id){
        $this->bestelling_id=$bestelling_id;
    }
    public function SetKlant_id($klant_id){
        $this->klant_id=$klant_id;
    }
    public function SetProduct_id($product_id){
        $this->product_id=$product_id;
    }
    public function SetAantal($aantal){
        $this->aantal=$aantal;
    }
    public function SetDatum_gemaakt($datum_gemaakt){
        $this->datum_gemaakt=$datum_gemaakt;
    }
    public function SetDatum_afhalen($datum_afhalen){
        $this->datum_afhalen=$datum_afhalen;
    }
}

