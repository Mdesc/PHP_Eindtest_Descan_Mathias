<?php
session_start();

require_once ("business/gebruiker_service.php");
require_once ("business/bestelling_service.php");
require_once ("business/gemeente_service.php");
require_once ("business/product_service.php");
require_once ("business/productgroep_service.php");

require_once ("exceptions/emailInUseException.php");

$gebruikersvc= new gebruiker_service();
$bestellingsvc= new bestelling_service();
$gemeentesvc= new gemeente_service();
$productsvc= new product_service();
$productgroepsvc= new productgroep_service();

if(isset($_GET["logout"])){
    $key_out=$_GET["logout"];
    $gebruikersvc->logout($key_out);
    header("location: Home.php");
}

if(isset($_SESSION["status"]) && $_SESSION["status"]==true){
    $klant_id= $_SESSION["klant_id"];
    $gebruiker= $gebruikersvc->getByKlant_id($klant_id);
    $block= $gebruiker->GetBlock();
}
$productgroepen=$productgroepsvc->getproductgroeplijst();
if(isset($_GET["productgroepview"])){
    $productgroepview_id=$_GET["productgroepview"];
    //check if exist{
    $exist=$productgroepsvc->getByProductgroep_id($productgroepview_id);
    if($exist->GetProductgroep_id()==0){
        //dit is om mensen te weerhouden van link search aante passen met foute get
    }else{
        $productlijstbyproductgroep_id=$productsvc->getByproductgroep_id($productgroepview_id);
    }
}
//pagina view
include ("/presentation/Product_presentation.php"); 
   
//    header("location: Home.php");

