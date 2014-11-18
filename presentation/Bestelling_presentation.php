<!DOCTYPE html>

<html>
    <head>
        <title>Descan Mathias Eindtest PHP piza shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/Main_Css.css" rel="stylesheet">
    </head>
    <body>
        <div class="cotianer">
            <header class="header">
                <section class="container_nav_title">
                    <section class="title">
                        
                    </section>
                    <nav id="headmenu">
                        <ul class="menu">
                            <a href="Home.php"/><li>Home</li></a>
                            <?php   if(!isset($_SESSION["status"])){?>
                            <a href="Register.php"/><li>Register</li></a>
                            <?php   }?>
                            <a href="Producten.php"/><li>Producten</li></a>
                            <?php   if(isset($_SESSION["status"]) && $_SESSION["status"] == true && isset($block) && $block == false && isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "klant"){?>
                            <a href="Bestelling.php"/><li>Bestelling</li></a>
                            <?php   }?>
                            <?php   if(isset($_SESSION["status"]) && $_SESSION["status"] == true && isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "admin"){?>
                            <a href="Beheren.php" /><li>Beheren</li></a>
                            <?php   }?>
                            <a href="OverOns.php"/><li>Over ons</li></a>
                        </ul>
                    </nav>
                </section>
                <section class="login">
                    <?php
                    if(isset($_SESSION["status"]) && $_SESSION["status"]==true){
                    ?>welcome : <?php
                    echo $gebruiker->GetVoornaam();
                    echo "<a href='home.php?logout=exit'><input type='button' value='logout'/></a>";
                    echo '<br/><br/>';?>
                    <a class='white' href='Bestelling.php?Winkelmand=yes'>Winkelmand (<?php echo $aantalitems; ?>)</a><br/><?php
                    }else{
                    ?>
                        <form method="post" action="Home.php?login=start">
                            <label for="username">username:</label>
                            <input type="text" name="email" value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"]; }?>" placeholder="email"><br/>
                            <label for="password">password:</label>
                            <input type="password" name="wachtwoord" value="<?php if(isset($_COOKIE["wachtwoord"])){ echo $_COOKIE["wachtwoord"]; }?>"><br/>
                            <input type="submit" id="loginbutton" value="login" name="submit">
                        </form> 
                    <?php
                    }
                    ?>
                    
                </section>
            </header>
            <section class="body">
                <?php
                if(isset($_GET['Winkelmand']) && $_GET['Winkelmand']=='yes'){
                    //inhoud van winkel mandje
                    ?>
                        <p class="warning">Pas op u kunt slecht een bestelling per dag plaatsen</p>
                        <br/>
                    <?php
                    if($aantalitems==0){
                        echo 'geen items in winkelmand';
                    }
                    foreach($winkelmand as $item){?>
                        <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                        <?php echo $stuks=$productmand->GetKostprijs_stuk(),'&nbsp&nbsp','aantal : ',$aantal=$item->GetAantal(),'&nbsp&nbsp','totaal product prijs : ',$totpro=$aantal*$stuks,'&nbsp&nbsp'; $totaal=$bestellingsvc->totaalwinkelmand($totaal,$totpro);?>
                        <a href="Bestelling.php?remove=yes&bestelrow=<?php echo $item->GetBestelling_id() ?>">remove</a>    
                        </li><?php
                    }
                    ?><u>totaal winkelmand :</u><?php echo '&nbsp',$totaal;
                    ?>
                    <form method="post" action="bestelling.php?checkout=yes">
                        <label for="afhaal_datum">afhaal datum:</label>
                        <select type="" name="afhaal_datum" value="" placeholder="afhaal datum" required>
                            <?php
                                  if($morgen==true && $overmorgen==true && $overovermorgen==true){
                            ?>
                            <option value="onmogelijk">geen bestelling mogelijk</option>
                            <?php
                                  }
                                  if($morgen!=true){ 
                            ?>
                            <option value="<?php echo $datum_morgen; ?>"><?php echo $datum_morgen; ?></option>
                            <?php }
                                  if($overmorgen!=true){
                            ?>
                            <option value="<?php echo $datum_overmorgen; ?>"><?php echo $datum_overmorgen; ?></option>
                            <?php }
                                  if($overovermorgen!=true){
                            ?>
                            <option value="<?php echo $datum_overovermorgen; ?>"><?php echo $datum_overovermorgen; ?></option>
                            <?php }
                            ?>
                        </select><br/>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="submit" id="checkout" value="checkout" name="submit">
                    </form>
                    <?php
                }else{
                    if(isset($_GET['mijn']) && $_GET['mijn']=='view'){
                        ?>
                        <a href='Bestelling.php?'>Terug naar producten lijst</a><br/>
                        <br/>
                        <u>Vandaag af te halen</u><br/>
                        <?php
//                        if(isset($bestellingmij) && $vandaag=$getdatum_afhalen){
//                            
//                        }
                        if($vandaag==true){
                            if(isset($_GET['moment']) && $_GET['moment']=='vandaag'){
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view">Bestelling vandaag af te halen verbergen</a><br/><br/>
                                <?php
                                foreach($bestellingmij as $item){?>
                                <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                                <?php echo $stuks=$productmand->GetKostprijs_stuk(),'&nbsp&nbsp','aantal : ',$aantal=$item->GetAantal(),'&nbsp&nbsp','totaal product prijs : ',$totpro=$aantal*$stuks,'&nbsp&nbsp'; $totaal=$bestellingsvc->totaalwinkelmand($totaal,$totpro);?>  
                                </li><?php
                                }
                                ?><u>totaal bestelling :</u><?php echo '&nbsp',$totaal; 
                                ?>
                                <br/>
                                <?php
                            }else{
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view&moment=vandaag">Bestelling vandaag af te halen bekijken</a>
                                <?php
                            }
                        }else{
                            echo "geen besteling af te halen";
                        }
                        ?>
                        <br/>
                        <u>Andere bestellingen</u><br/>
                        <?php
                        if($morgen==true){
                            if(isset($_GET['moment']) && $_GET['moment']=='morgen'){
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view">Bestelling voor morgen af te halen verbergen</a><br/><br/>
                                <?php
                                foreach($bestellingmij as $item){?>
                                <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                                <?php echo $stuks=$productmand->GetKostprijs_stuk(),'&nbsp&nbsp','aantal : ',$aantal=$item->GetAantal(),'&nbsp&nbsp','totaal product prijs : ',$totpro=$aantal*$stuks,'&nbsp&nbsp'; $totaal=$bestellingsvc->totaalwinkelmand($totaal,$totpro);?>  
                                </li><?php
                                }
                                ?><u>totaal bestelling :</u><?php echo '&nbsp',$totaal,'&nbsp&nbsp&nbsp&nbsp'; 
                                ?>
                                <a href="Bestelling.php?mijn=view&moment=morgen&anulatie=annuleren">Annuleren</a>
                                <br/><br/>
                                <?php
                            }else{
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view&moment=morgen">Bestelling voor morgen af te halen bekijken</a><br/>
                                <?php
                            }
                        }
                        if($overmorgen==true){
                            if(isset($_GET['moment']) && $_GET['moment']=='overmorgen'){
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view">Bestelling voor overmorgen af te halen verbergen</a><br/><br/>
                                <?php
                                foreach($bestellingmij as $item){?>
                                <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                                <?php echo $stuks=$productmand->GetKostprijs_stuk(),'&nbsp&nbsp','aantal : ',$aantal=$item->GetAantal(),'&nbsp&nbsp','totaal product prijs : ',$totpro=$aantal*$stuks,'&nbsp&nbsp'; $totaal=$bestellingsvc->totaalwinkelmand($totaal,$totpro);?>  
                                </li><?php
                                }
                                ?><u>totaal bestelling :</u><?php echo '&nbsp',$totaal,'&nbsp&nbsp&nbsp&nbsp'; 
                                ?>
                                <a href="Bestelling.php?mijn=view&moment=overmorgen&anulatie=annuleren">Annuleren</a>
                                <br/><br/>
                                <?php
                            }else{
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view&moment=overmorgen">Bestelling voor overmorgen af te halen bekijken</a><br/>
                                <?php
                            }
                        }
                        if($overovermorgen==true){
                            if(isset($_GET['moment']) && $_GET['moment']=='overovermorgen'){
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view">Bestelling voor overovermorgen af te halen verbergen</a><br/><br/>
                                <?php
                                foreach($bestellingmij as $item){?>
                                <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                                <?php echo $stuks=$productmand->GetKostprijs_stuk(),'&nbsp&nbsp','aantal : ',$aantal=$item->GetAantal(),'&nbsp&nbsp','totaal product prijs : ',$totpro=$aantal*$stuks,'&nbsp&nbsp'; $totaal=$bestellingsvc->totaalwinkelmand($totaal,$totpro);?>  
                                </li><?php
                                }
                                ?><u>totaal bestelling :</u><?php echo '&nbsp',$totaal,'&nbsp&nbsp&nbsp&nbsp'; 
                                ?>
                                <a href="Bestelling.php?mijn=view&moment=overovermorgen&anulatie=annuleren">Annuleren</a>
                                <br/><br/>
                                <?php
                            }else{
                                ?>
                                &nbsp&nbsp - <a href="Bestelling.php?mijn=view&moment=overovermorgen">Bestelling voor overovermorgen af te halen bekijken</a><br/>
                                <?php
                            }
                        }
                        if($morgen==false && $overmorgen==false && $overovermorgen==false){
                            echo 'geen bestelling voor de volgende dagen';
                        }
                    }else{
                    ?>
                    <a href='Bestelling.php?mijn=view'>Mijn geplaatste bestellingen bekijken</a><br/>
                    <br/>
                    <?php
                        foreach ($productgroepen as $productgroep){
                            if(isset($_GET["productgroepview"]) && $_GET["productgroepview"]== $productgroep->GetProductgroep_id()){
                                ?><a href="Bestelling.php?productgroepview=<?php echo $productgroep->GetProductgroep_id();?>"/><?php echo $productgroep->GetProductgroep_naam();?></a><br/><br/>
                                <ul class="productlijst">
                                <?php
                                foreach ($productlijstbyproductgroep_id as $prod){
                                    ?>
                                    <li class="lijst"><?php echo $prod->GetProduct(),'&nbsp&nbsp &#8364';?>
                                        <?php echo $prod->GetKostprijs_stuk(),'&nbsp&nbsp';?>           
                                        <form method="post" action="Bestelling.php?addproduct=yes&productgroepview=<?php echo $prod->GetProductgroep_id();?>">
                                            <input type="number" name="aantal" value="" placeholder="aantal">
                                            <input type="hidden" name="product_id" value="<?php echo $prod->GetProduct_id(); ?>">
                                            <input type="submit" id="toevoegen" value="toevoegen" name="toevoegen">
                                        </form>
                                    </li>
                                    <br/>
                                    <?php
                                }
                                ?>
                                </ul>
                                <?php
                            }else{
                                ?><a href="Bestelling.php?productgroepview=<?php echo $productgroep->GetProductgroep_id();?>"/><?php echo $productgroep->GetProductgroep_naam();?></a><br/>
                                <img class="productgroep_foto" src="<?php echo $productgroep->GetProductgroep_image();?>" alt="<?php echo $productgroep->GetProductgroep_naam();?>" title="<?php echo $productgroep->GetProductgroep_naam();?>"><br/><br/>
                                <?php 
                            }
                        }
                    }
                }
                ?>
            </section>
            <footer class="footer">
                <p class="footerinfo">Site gemaakt door Mathias Descan &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; PHP eindtest &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; fictieve bakker shop</p>
            </footer>
        </div>
    </body>
</html>