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

if(isset($_GET["login"]) && $_GET["login"]=="start"){
    $email=$_POST["email"];
    $wachtwoord=$_POST["wachtwoord"];
    $gebruikersvc->userInputCheck(0,0,0,0,0,0,0,$email);
    
    $gebruikersvc->login($email, $wachtwoord);
}

if(isset($_SESSION["status"]) && $_SESSION["status"]==true){
    $klant_id= $_SESSION["klant_id"];
    $gebruiker= $gebruikersvc->getByKlant_id($klant_id);
    $block= $gebruiker->GetBlock();
    header("location: Home.php");
}

if(isset($_GET["registreer"]) && $_GET["registreer"]=="reg"){
    $naam= $_POST["naam"];
    $voornaam= $_POST["voornaam"];
    $straat= $_POST["straat"];
    $huisnr= $_POST["huisnummer"];
    $bus= $_POST["bus"];
    $postcode= $_POST["postcode"];
    $gemeente= $_POST["gemeente"];
    $email= $_POST["email"];
    
    setcookie("naam",$naam,time()+60*3,"/");
    setcookie("voornaam",$voornaam,time()+60*3,"/");
    setcookie("straat",$straat,time()+60*3,"/");
    setcookie("huisnr",$huisnr,time()+60*3,"/");
    setcookie("bus",$bus,time()+60*3,"/");
    setcookie("postcode",$postcode,time()+60*3,"/");
    setcookie("gemeente",$gemeente,time()+60*3,"/");
    setcookie("email",$email,time()+60*3,"/");
    
    
    $gebruikersvc->userInputCheck($naam,$voornaam,$straat,$huisnr,$bus,$postcode,$gemeente,$email);
    $wachtwoordunhashed= $gebruikersvc->generateWachtwoord();
    setcookie("wachtwoordunhashed",$wachtwoordunhashed,time()+60*20,"/");
    $wachtwoord= sha1($wachtwoordunhashed);
    $block= false;
    //chack postcode gemeente comb exists
    if($postcode!="" && $gemeente!=""){
        $bestaandegemeente= $gemeentesvc->bestaandControle($postcode,$gemeente);
        if($bestaandegemeente== true){
            $postcode_id= $gemeentesvc->getPostcode_idByGemeentePostcode($postcode,$gemeente);
        }else{
            $gemeentesvc->addGemeente($postcode,$gemeente);
            $postcode_id= $gemeentesvc->getPostcode_idByGemeentePostcode($postcode,$gemeente);
        }
    }else{
        $postcode_id= 1;
    }
    
    try {
        $gebruikersvc->addGebruiker($naam,$voornaam,$straat,$huisnr,$bus,$postcode_id,$email,$wachtwoord,$block);
        header("location: Register.php?registreer=complete");
    } catch (emailInUseException $eiuex) {
        header("location: Register.php?registreer=emailerror");
    }
}

include ("/presentation/Register_presentation.php");