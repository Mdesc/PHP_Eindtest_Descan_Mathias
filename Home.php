<?php

require_once ("business/gebruiker_service.php");
require_once ("business/bestelling_service.php");
require_once ("business/gemeente_service.php");
require_once ("business/product_service.php");
require_once ("business/productgroep_service.php");

include ("/presentation/Home_presentation.php");

 
$gebruikersvc= new gebruiker_service();
//$gebruikersvc->addGebruiker("naam","voonaam","straat",34,0,1,"email","wachtwoord",0);     //add
//$gebruikersvc->deleteGebruiker(8);                                                        //delete
//$gebruikersvc->updateGebruiker(4,"mathias","descan","hogestraat",34,0,2,"mathias.descan@yahoo.com","wachtwoord",false);
                                                                                            //update

//$datetime = new DateTime();
//$datum = $datetime->format('Y-m-d H');
//print_r($datum);
  
$bestellingsvc= new bestelling_service();
//$bestellingsvc->addBestelling(1,1,1,$datum,$datum);                                       //add
//$bestellingsvc->deleteBestelling(8);                                                      //delete

  
$gemeentesvc= new gemeente_service();
//$gemeentesvc->addGemeente(8610,"gemeente");                                               //add
//$gemeentesvc->deleteGemeente(8);                                                          //delete
//$gemeentesvc->updateGemeente(2, 8610, "kortemark");                                       //update
  
$productsvc= new product_service();
//$productsvc->addProduct(1,"product",11,25);                                               //add
//$productsvc->deleteProduct(8);                                                            //delete
//$productsvc->updateProduct(2,1,'volkoren brood',25.25);                                   //update                                                  //delete
  
$productgroepsvc= new productgroep_service();
//$productgroepsvc->addProductgroep("productgroep_naam");                                   //add
//$productgroepsvc->deleteProductgroep(8);                                                  //delete
//$productgroepsvc->updateProductgroep(6,"raverne");                                        //update