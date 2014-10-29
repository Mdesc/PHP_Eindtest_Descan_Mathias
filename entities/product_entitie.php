<?php

class product{
    //variables
    private static $idMap=array();
    private $product_id;
    private $productgroep_id;
    private $product;
    private $kostprijs_stuk;
    
    //constructor
    private function __construct($product_id,$productgroep_id,$product,$kostprijs_stuk){
        $this->product_id=$product_id;
        $this->productgroep_id=$productgroep_id;
        $this->product=$product;
        $this->kostprijs_stuk=$kostprijs_stuk;
    }
    //functions
    public static function create($product_id,$productgroep_id,$product,$kostprijs_stuk){
        if(!isset(self::$idMap[$product_id])){
            self::$idMap[$product_id]= new product($product_id,$productgroep_id,$product,$kostprijs_stuk);
        }
        return self::$idMap[$product_id];
    }
    
    //>>getters
    public function GetProduct_id(){
        return $this->product_id;
    }
    public function GetProductgroep_id(){
        return $this->productgroep_id;
    }
    public function GetProduct(){
        return $this->product;
    }
    public function GetKostprijs_stuk(){
        return $this->kostprijs_stuk;
    }

    //>>setters
    public function SetProduct_id($product_id){
        $this->product_id=$product_id;        
    }
    public function SetProductgroep_id($productgroep_id){
        $this->productgroep_id=$productgroep_id;
    }
    public function SetProduct($product){
        $this->product=$product;
    }
    public function SetKostprijs_stuk($kostprijs_stuk){
        $this->kostprijs_stuk=$kostprijs_stuk;
    }
    
}

