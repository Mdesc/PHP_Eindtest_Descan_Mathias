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
}

