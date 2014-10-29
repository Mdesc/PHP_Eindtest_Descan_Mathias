<?php

require_once ("data/productgroepDAO.php");

class productgroep_service{
    public function addProductgroep($productgroep_naam){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->addProductgroep($productgroep_naam);
    }
    public function deleteProductgroep($productgroep_id){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->deleteProductgroep($productgroep_id);
    }
    public function updateProductgroep($productgroep_id,$productgroep_naam){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->updateProductgroep($productgroep_id,$productgroep_naam);
    }
}