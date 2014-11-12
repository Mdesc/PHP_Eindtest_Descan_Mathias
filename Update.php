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
if(isset($_SESSION["status"]) && $_SESSION["status"]==true && isset($_SESSION["user_level"]) && $_SESSION["user_level"]=="admin"){
    
    if(isset($_GET["productid"]) && isset($_GET["update"]) && $_GET["update"]=="yes"){
        $product_id=$_GET["productid"];
        $product=$productsvc->getProductById($product_id);
        $productgroepen=$productgroepsvc->getproductgroeplijst();
    }
    if(isset($_GET["bijwerken"]) && $_GET["bijwerken"]=="yes"){
        $product_id=$_GET["product_id"];
        $productnaam=$_POST["productnaam"];
        $kostprijs=$_POST["kostprijs"];
        $productgroep_id=$_POST["productgroep"];
        
        $productsvc->updateProduct($product_id,$productgroep_id,$productnaam,$kostprijs);
        
        header("location: Beheren.php?inhoud=productenbeheren&productgroepview=".$productgroep_id);
    }
    
    //pagina view
    include ("/presentation/Update_presentation.php"); 
   
}  else {
    header("location: Home.php");
}
