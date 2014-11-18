<?php

require_once ("data/productDAO.php");

class product_service{
    public function addProduct($productgroep_id,$product,$kostprijs_stuk){
        $productDAO= new productDAO();
        $productDAO->addProduct($productgroep_id,$product,$kostprijs_stuk);
    }
    public function deleteProduct($product_id){
        $productDAO= new productDAO();
        $productDAO->deleteProduct($product_id);
    }
    public function updateProduct($product_id,$productgroep_id,$product,$kostprijs_stuk){
        $productDAO= new productDAO();
        $productDAO->updateProduct($product_id,$productgroep_id,$product,$kostprijs_stuk);
    }
    public function getByproductgroep_id($productgroep_id){
        $productDAO= new productDAO();
        $lijstproductgroep_id= $productDAO->getByProductgroep_id($productgroep_id);
        return $lijstproductgroep_id;
    }
    public function getProducten(){
        $productDAO= new productDAO();
        $lijstproducten= $productDAO->getProducten();
        return $lijstproducten;
    }
    public function getProductById($product_id){
        $productDAO= new productDAO();
        $product= $productDAO->getByProduct_id($product_id);
        return $product;
    }
    public function deleteProductgroep($productgroep_id){
        $productDAO= new productDAO();
        $productDAO->deleteProduct($productgroep_id);
    }
}

