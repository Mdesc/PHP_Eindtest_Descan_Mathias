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

if(isset($_SESSION['bestelrow'])){
    $bestelrow=$_SESSION['bestelrow'];
}
if(isset($_SESSION['winkelmand'])){
    $winkelmand=  unserialize($_SESSION['winkelmand']);
}
if(isset($_SESSION['aantalitems'])){
    $aantalitems=$_SESSION['aantalitems'];
}

if(isset($_GET["login"]) && $_GET["login"]=="start"){
    $email=$_POST["email"];
    $wachtwoord=$_POST["wachtwoord"];
    $gebruikersvc->userInputCheck(0,0,0,0,0,0,0,$email);
    
    $gebruikersvc->login($email, $wachtwoord);
}
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
if(isset($_SESSION["status"]) && $_SESSION["status"]==true && isset($_SESSION["user_level"]) && $_SESSION["user_level"]=="klant" && $block==false){
    
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
    
//    $productgroepcount=  count($productgroepen);
//    print_r($productgroepcount);
    if(!isset($winkelmand)){
        $winkelmand= array();        
    }
    if(!isset($bestelrow) || $bestelrow==0){
        $bestelrow=1;
    }
    if(!isset($aantalitems)){
        $aantalitems=0;
    }
    if(!isset($totaal)){
        $totaal=0;
    }
    
    if(isset($_GET["addproduct"]) && $_GET["addproduct"]=='yes'){
        
        $product_id = $_POST['product_id'];
        $aantal = $_POST['aantal'];
        
        
        $datetime = new DateTime();
        $datum_gemaakt = $datetime->format('Y-m-d H:i:s');
        $datum_afhalen = $datetime->format('Y-m-d H:i:s');
        if($aantal>0){
            $winkelmand= $bestellingsvc->addtowinkelmand($winkelmand,$bestelrow,$klant_id,$product_id,$aantal,$datum_gemaakt,$datum_afhalen);
            //print_r($winkelmand);
            $bestelrow= $bestellingsvc->bestelrowcount($bestelrow);
            $aantalitems=$aantalitems+1;
            $_SESSION['aantalitems']=$aantalitems;
        }
        //hieronderstaand word gebruikt om meteen terug naar ander pagina te gaan
        if(isset($_GET['productgroepview'])){
            $productview=$_GET['productgroepview'];
            $location="location: Bestelling.php?productgroepview=".$productview." ";
            //header($location);            
        }else{
            //header("location: Bestelling.php");
        }
        //-------------------------------------------------------------------------
        
    }else{
        
    }
    
    //remove product
    if(isset($_GET['remove']) && isset($_GET['bestelrow']) && $_GET['remove']=='yes' && $_GET['bestelrow']>0){
        $removeditem=$_GET['bestelrow'];
        $bestellingsvc->removebestelrow($removeditem);
        header("location: Bestelling.php?Winkelmand=yes");
    }
    
    if(isset($_GET['mijn']) && $_GET['mijn']=='view'){
        //heb ik niet meer nodig denk ik
    }
    
    $vandaag=$bestellingsvc->bestellingVandaag($klant_id);
    $morgen=$bestellingsvc->bestellingMorgen($klant_id);
    $overmorgen=$bestellingsvc->bestellingOvermorgen($klant_id);
    $overovermorgen=$bestellingsvc->bestellingOverovermorgen($klant_id);
    
    $daytime= new DateTime();
    $uur=$daytime->format('H');
    if($uur<20){
        $daytime->modify('+1 day');
        $datum_morgen=$daytime->format('Y-m-d');
        //echo $datum_morgen,'<br/>';
        $daytime->modify('+1 day');
        $datum_overmorgen=$daytime->format('Y-m-d');
        //echo $datum_overmorgen,'<br/>';
        $daytime->modify('+1 day');
        $datum_overovermorgen=$daytime->format('Y-m-d');
        //echo $datum_overovermorgen,'<br/>';
    }else{
        $daytime->modify('+2 day');
        $datum_morgen=$daytime->format('Y-m-d');
        //echo $datum_morgen,'<br/>';
        $daytime->modify('+1 day');
        $datum_overmorgen=$daytime->format('Y-m-d');
        //echo $datum_overmorgen,'<br/>';
        $daytime->modify('+1 day');
        $datum_overovermorgen=$daytime->format('Y-m-d');
        //echo $datum_overovermorgen,'<br/>';
    }
    
    if(isset($_GET['moment']) && $_GET['moment']=='vandaag'){
        $bestellingmij=$bestellingsvc->getBestellingVandaagByKlant_id($klant_id);
    }
    if(isset($_GET['moment']) && $_GET['moment']=='morgen'){
        $bestellingmij=$bestellingsvc->getBestellingMorgenByKlant_id($klant_id);
        if(isset($_GET['anulatie']) && $_GET['anulatie']='annuleren'){
            $dag=$_GET['moment'];
            $bestellingsvc->AnnulerenBestelling($klant_id,$dag);
            header('location: Bestelling.php?mijn=view');
        }
    }
    if(isset($_GET['moment']) && $_GET['moment']=='overmorgen'){
        $bestellingmij=$bestellingsvc->getBestellingOvermorgenByKlant_id($klant_id);
        if(isset($_GET['anulatie']) && $_GET['anulatie']='annuleren'){
            $dag=$_GET['moment'];
            $bestellingsvc->AnnulerenBestelling($klant_id,$dag);
            header('location: Bestelling.php?mijn=view');
        }
    }
    if(isset($_GET['moment']) && $_GET['moment']=='overovermorgen'){
        $bestellingmij=$bestellingsvc->getBestellingOverovermorgenByKlant_id($klant_id);
        if(isset($_GET['anulatie']) && $_GET['anulatie']='annuleren'){
            $dag=$_GET['moment'];
            $bestellingsvc->AnnulerenBestelling($klant_id,$dag);
            header('location: Bestelling.php?mijn=view');
        }
    }
    //checkout
    if(isset($_GET['checkout']) && $_GET['checkout']=='yes'){
        $afhaal_datum=$_POST['afhaal_datum'];
        $bestellingsvc->checkout($afhaal_datum);
    }
    
    include ("/presentation/Bestelling_presentation.php");
}else{
    if(!isset($_SESSION["user_level"])){
        header("location: home.php");
    }elseif($block==true){
        header("location: home.php?blocked=yes");
    }
}