<?php

class gemeente{
    //variables
    private static $idMap=array();
    private $postcode_id;
    private $postcode;
    private $gemeente;
    
    //constructor
    private function __construct($postcode_id,$postcode,$gemeente){
        $this->postcode_id=$postcode_id;
        $this->postcode=$postcode;
        $this->gemeente=$gemeente;
    }
    
    //functions
    public static function create($postcode_id,$postcode,$gemeente){
      if(!isset(self::$idMap[$postcode_id])){
          self::$idMap[$postcode_id]= new gemeente($postcode_id,$postcode,$gemeente);
      }  
      return self::$idMap[$postcode_id];
    }

    //>>getters
    public function GetPostcode_id(){
        return $this->postcode_id;
    }
    public function GetPostcode(){
        return $this->postcode;
    }
    public function GetGemeente(){
        return $this->gemeente;
    }

    //>>setters
    public function SetPostcode_id($postcode_id){
        $this->postcode_id=$postcode_id;
    }
    public function SetPostcode($postcode){
        $this->postcode=$postcode;
    }
    public function SetGemeente($gemeente){
        $this->gemeente=$gemeente;
    }
}

