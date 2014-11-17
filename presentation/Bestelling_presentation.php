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
                    echo '<br/>';?>
                    <a class='white' href='Bestelling.php?Winkelmand=yes'>Winkelmand (<?php echo $bestelrow-1; ?>)</a><br/><?php
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
                    foreach($winkelmand as $item){?>
                        <li class="lijst"><?php $productmand=$productsvc->getProductById($item->GetProduct_id()); echo $productmand->GetProduct(),'&nbsp&nbsp &#8364';?>
                        <?php echo $item->GetKostprijs_stuk(),'&nbsp&nbsp';?>           
                        </li><?php
                    }
                }else{
                    if(isset($_GET['mijn']) && $_GET['mijn']=='view'){
                        ?>
                        <a href='Bestelling.php?'>Terug naar producten lijst</a><br/>
                        <br/>
                        <?php
                        //hier komt wat er besteld is  voor de klant voor de komende dagen
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