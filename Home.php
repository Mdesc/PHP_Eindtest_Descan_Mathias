<?php
session_start();

require_once ("business/gebruiker_service.php");
require_once ("business/bestelling_service.php");
require_once ("business/gemeente_service.php");
require_once ("business/product_service.php");
require_once ("business/productgroep_service.php");

require_once ("exceptions/emailInUseException.php");

$gebruikersvc= new gebruiker_service();
//$gebruikersvc->addGebruiker("descan","mathias","hogestraat",34,0,2,"mathias.descan@yahoo.com","morang",0);     //add
//$gebruikersvc->deleteGebruiker(8);                                                        //delete
//$gebruikersvc->updateGebruiker(4,"mathias","descan","hogestraat",34,0,2,"mathias.descan@yahoo.com","wachtwoord",false);
                                                                                            //update
//$gebruikersvc->logincheck("mathias.descan@yahoo.com", "morang");
//$gebruikersvc->getByKlant_id($_SESSION["klant_id"]);
/*try {
    $gebruikersvc->addGebruiker("descan","jonas","hogestraat",34,0,2,"laponza.descan@yahoo.com","wachtwoord",false);
} catch (emailInUseException $eiuex) {
    echo 'failed to add';
}*/
                                                                                            //exception test
//$gebruiker= $gebruikersvc->logincheck("mathias.descan@yahoo.com", "morang");
//echo 'hier is het resultaat van de login try:',$gebruiker;                                //test logincheck
//$gebruikersvc->userInputCheck("des  can", "http://www.google.be", "hoges\traat", 34, 0, "<p>8610</p>", "wer//\\<br/>ken", "mathias.descan@yahoo.com");

//$datetime = new DateTime();
//$datum = $datetime->format('Y-m-d H');
//print_r($datum);

/*$bestellingsvc= new bestelling_service();
$gemeentesvc= new gemeente_service();
$productsvc= new product_service();
$productgroepsvc= new productgroep_service();*/

$bestellingsvc= new bestelling_service();
//$bestellingsvc->addBestelling(1,1,1,$datum,$datum);                                       //add
//$bestellingsvc->deleteBestelling(8);                                                      //delete
//$bestellingsvc->updateBestelling(2,5,16,100,$datum,$datum);                                 //update
  
$gemeentesvc= new gemeente_service();
//$gemeentesvc->addGemeente(8610,"gemeente");                                               //add
//$gemeentesvc->deleteGemeente(8);                                                          //delete
//$gemeentesvc->updateGemeente(2, 8610, "kortemark");                                       //update
  
$productsvc= new product_service();
//$productsvc->addProduct(1,"product",11,25);                                               //add
//$productsvc->deleteProduct(8);                                                            //delete
//$productsvc->updateProduct(2,1,'volkoren brood',25.25);                                   //update                                                  //delete
//$lijst= $productsvc->getProducten();
//print_r($lijst);                                                                          //test lijst
//$lijstid= $productsvc->getByproductgroep_id(2);
//print_r($lijstid);                                                                        //lijst per id 

$productgroepsvc= new productgroep_service();
//$productgroepsvc->addProductgroep("productgroep_naam");                                   //add
//$productgroepsvc->deleteProductgroep(8);                                                  //delete
//$productgroepsvc->updateProductgroep(6,"raverne");                                        //update

//$productgroep= $productgroepsvc->getByProductgroep_id(5);                                 //test getby
//print_r($productgroep);
//$productgroep= $productgroepsvc->getByProductgroep_naam("raverne");
//print_r($productgroep);
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

include ("/presentation/Home_presentation.php");