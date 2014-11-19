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

/*if(isset($_GET["login"]) && $_GET["login"]=="start"){
    $email=$_POST["email"];
    $wachtwoord=$_POST["wachtwoord"];
    $gebruikersvc->userInputCheck(0,0,0,0,0,0,0,$email);
    
    $gebruikersvc->login($email, $wachtwoord);
}*/
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
    //form handeling
    //productgroep-------------------------------------------------------------------------------------------------
    if(isset($_GET['productgroep']) && $_GET['productgroep']=='add'){
        if(isset($_FILES["productgroep_image"])){
            $target_folder="Images/";
            $target_file= $target_folder.basename($_FILES["productgroep_image"]["name"]);
            $uploadSucces=1;
            $imageFileType=  pathinfo($target_file,PATHINFO_EXTENSION);
            
            $productgroep_naam=$_POST["productgroep"];
            
            $productgroep_naam= ucfirst(strtolower($productgroep_naam));
            
            $target_file = $target_folder . basename($productgroep_naam.".".$imageFileType);//rename

            $productgroep_image=$target_file;

            //controle op image beschikbaar
            $check = getimagesize($_FILES["productgroep_image"]["tmp_name"]);
            if($check !== false) {
                $uploadSucces = 1;
            } else {
                $uploadSucces = 0;
            }

            //controle of bestand al bestaat in folder
            if (file_exists($target_file)) {
                header("location: beheren.php?message=bestaat");
                $uploadSucces = 0;
            }

            //max grootte op 2mb --ongeveer--
            echo $_FILES["productgroep_image"]["size"];
            if ($_FILES["productgroep_image"]["size"] > 1000000) {
                header("location: beheren.php?message=size");
                $uploadSucces = 0;
            }

            // laat enkel jpg,png,jpeg,gif door 
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                header("location: beheren.php?message=extentie");
                $uploadSucces = 0;
            }

            // controle of alle checks geslaagd waren
            if ($uploadSucces == 0) {
                //er word geen bestand upgeload
            } else {
                if (move_uploaded_file($_FILES["productgroep_image"]["tmp_name"], $target_file)) {
                    $productgroepsvc->addProductgroep($productgroep_naam, $productgroep_image);
                    header("location: beheren.php?message=addproductgroep");
                    //als file upgeload werd
                } else {
                    //als niet correct is
                }
            }

        }else{
            header("location: beheren.php?message=sizephp");
        }    
    }
    //einde productgroep toevoegen-----------------------------------------------------------------------
    //nieuw product toevoegen
    $productgroepen=$productgroepsvc->getproductgroeplijst();
    if(isset($_GET["addproduct"]) && $_GET["addproduct"]=="add"){
        $product_naam=$_POST["productnaam"];
        $product_kostprijs=$_POST["kostprijs"];
        $productgroep_id=$_POST["productgroep"];
        
        $product_naam=  strtolower($product_naam);
        if($product_naam!= "" && $product_kostprijs > 0){
            $productsvc->addProduct($productgroep_id,$product_naam,$product_kostprijs);
        }
    }
    
    //einde nieuw product
    //product beheer begin
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
    if(isset($_GET["delete"]) && isset($_GET["productid"]) && $_GET["delete"]=="yes"){
        $product_id=$_GET["productid"];
        $productsvc->deleteProduct($product_id);
    }
    if(isset($_GET["delete"]) && isset($_GET['productgroepid']) && $_GET['delete']=="yes"){
        $productgroepid= $_GET['productgroepid'];
        $productsvc->deleteProductgroep($productgroepid);
        $productgroepsvc->deleteProductgroep($productgroepid);
        header('location :Beheren.php?inhoud=productenbeheren');
    }
    //einde product beheer
    //begin klanten beheer
    if(isset($_GET["inhoud"]) && $_GET["inhoud"]=="klanten"){
        $gebruikerlijst=$gebruikersvc->getgebruikers();
        if(isset($_GET["klantid"])){
            $klantblockid=$_GET["klantid"];
            if(isset($_GET["block"]) && $_GET["block"]=="undo"){
                $block=false;
                $gebruikersvc->changeBlock($klantblockid, $block);
            }elseif(isset($_GET["block"]) && $_GET["block"]=="make"){
                $block=true;
                $gebruikersvc->changeBlock($klantblockid, $block);
            }
            header("location: beheren.php?inhoud=klanten");
        }
    }
    //einde klanten beheer
    //begin bestellingen
    $product_lijst=$productsvc->getProducten();//lijst van alle producten
    $productgroepen;//lijst van alle productgroepen
    $totaalMorgenBesteld=$bestellingsvc->getBestellingenMorgenTotalProducts($product_lijst);
    //einde bestellingen
    //pagina view
    include ("/presentation/Beheren_presentation.php"); 
   
}  else {
    header("location: Home.php");
}
