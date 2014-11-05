<?php

require_once ("data/productgroepDAO.php");

class productgroep_service{
    public function addProductgroep($productgroep_naam,$productgroep_image){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->addProductgroep($productgroep_naam,$productgroep_image);
    }
    public function deleteProductgroep($productgroep_id){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->deleteProductgroep($productgroep_id);
    }
    public function updateProductgroep($productgroep_id,$productgroep_naam,$productgroep_image){
        $productgroepDAO= new productgroepDAO();
        $productgroepDAO->updateProductgroep($productgroep_id,$productgroep_naam,$productgroep_image);
    }
    public function getByProductgroep_id($productgroep_id){
        $productgroepDAO= new productgroepDAO();
        $productgroep= $productgroepDAO->getByProductgroep_id($productgroep_id);
        return $productgroep;
    }
    public function getByProductgroep_naam($productgroep_naam){
        $productgroepDAO= new productgroepDAO();
        $productgroep= $productgroepDAO->getByProductgroep_naam($productgroep_naam);
        return $productgroep;
    }
}