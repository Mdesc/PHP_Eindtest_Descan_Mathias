<?php

class productgroep{
    //variables
    private static $idMap=array();
    private $productgroep_id;
    private $productgroep_naam;
    private $productgroep_image;
    
    //constructor
    private function __construct($productgroep_id,$productgroep_naam,$productgroep_image){
        $this->productgroep_id=$productgroep_id;
        $this->productgroep_naam=$productgroep_naam;
        $this->productgroep_image=$productgroep_image;
    }
    
    //functions
    public static function create($productgroep_id,$productgroep_naam,$productgroep_image){
        if(!isset(self::$idMap[$productgroep_id])){
            self::$idMap[$productgroep_id]= new productgroep($productgroep_id,$productgroep_naam,$productgroep_image);
        }
        return self::$idMap[$productgroep_id];
    }
    
    //getters
    public function GetProductgroep_id(){
        return $this->productgroep_id;
    }
    public function GetProductgroep_naam(){
        return $this->productgroep_naam;
    }
    public function GetProductgroep_image(){
        return $this->productgroep_image;
    }
    //setters
    public function SetProductgroep_id($productgroep_id){
        $this->productgroep_id=$productgroep_id;
    }
    public function SetProductgroep_naam($productgroep_naam){
        $this->productgroep_naam=$productgroep_naam;
    }
    public function SetProductgroep_image($productgroep_image){
        $this->productgroep_image=$productgroep_image;
    }
}

