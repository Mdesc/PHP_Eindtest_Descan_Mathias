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
                    ?>
                    welcome : 
                    <?php
                    echo $gebruiker->GetVoornaam();
                    echo "<a href='home.php?logout=exit'><input type='button' value='logout'/></a>";
                    
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
                <div class="submenu">
                    <nav id="submenu">
                        <ul class="submenu">
                            <a href="Beheren.php?inhoud=nieuwproduct"/><li>Nieuw Product</li></a>
                            <a href="Beheren.php?inhoud=nieuwproductgroep"/><li>Nieuw Productgroep</li></a>
                            <a href="Beheren.php?inhoud=productenbeheren"/><li>Producten Beheren</li></a>
                            <a href="Beheren.php?inhoud=klanten"/><li>Klanten</li></a>
                            <a href="Beheren.php?" /><li>Bestellingen</li></a>
                        </ul>
                    </nav>
                </div>
                <div class="inhoud">
                    <?php
                    if(isset($_GET["message"])){
                        if($_GET["message"]=="addproductgroep"){
                            echo "<p class='message'>toevoegen geslaagd</p>";                            
                        }elseif($_GET["message"]=="bestaat"){
                            echo "<p class='message'>productgroep bestaat</p>";
                        }elseif($_GET["message"]=="size"){
                            echo "<p class='message'>afbeelding te groot</p>";
                        }elseif($_GET["message"]=="extentie"){
                            echo "<p class='message'>afbeelding heeft foute extentie</p>";
                        }elseif($_GET["message"]=="sizephp"){
                            echo "<p class='message'>afbeelding overschreed php 8mb limiet</p>";
                        }
                        
                    }
                    if(isset($_GET["inhoud"]) && $_GET["inhoud"] =="nieuwproduct"){?>
                    <!--Begin nieuwe product pagina-->
                        <form method="post" action="Beheren.php?addproduct=add">
                            <label for="productnaam">product*:</label>
                            <input type="text" name="productnaam" value="" placeholder="productnaam" required><br/>
                            <label for="kostprijs">kostprijs/stuk:</label>
                            <input type="text" name="kostprijs" value="" placeholder="kostprijs" required><br/><br/>
                            <label for="productgroep">productgroep*:</label>
                            <select type="" name="productgroep" value="" placeholder="productgroep" required>
                                <?php
                                    foreach ($productgroepen as $productgroep) {
                                ?>
                                        <option value="<?php print($productgroep->GetProductgroep_id());?>">
                                        <?php print($productgroep->GetProductgroep_naam());?></option>
                                        <?php
                                    }
                                ?>
                            </select><br/><br/>
                            <input type="submit" value="toevoegen" name="toevoegen">
                        </form>
                    <!--Einde nieuwe product pagina-->
                    <?php }
                    if(isset($_GET["inhoud"]) && $_GET["inhoud"] =="nieuwproductgroep"){?>
                    <!--Begin nieuwe productgroep pagina-->
                        <form method="post" action="Beheren.php?productgroep=add" enctype="multipart/form-data">
                            <label for="productgroep">productgroep*:</label>
                            <input type="text" name="productgroep" value="" placeholder="productgroep" required><br/>
                            <label for="productgroep_image">productgroep foto:</label>
                            <input type="file" name="productgroep_image" id="" value="productgroep_image" placeholder="productgroep_foto" required><br/>
                            <input type="submit" value="toevoegen" name="toevoegen">
                        </form>
                    <!--Einde nieuwe productgroep pagina-->
                    <?php }
                    if(isset($_GET["inhoud"]) && $_GET["inhoud"] =="productenbeheren"){?>
                    <!--Begin product beheren pagina-->
                        <?php
                        foreach ($productgroepen as $productgroep){
                            if(isset($_GET["productgroepview"]) && $_GET["productgroepview"]== $productgroep->GetProductgroep_id()){
                                ?><a href="Beheren.php?inhoud=productenbeheren&productgroepview=<?php echo $productgroep->GetProductgroep_id();?>"/><?php echo $productgroep->GetProductgroep_naam();?></a><br/><br/>
                                <ul class="productlijst">
                                <?php
                                foreach ($productlijstbyproductgroep_id as $prod){
                                    ?>
                                    <li class="lijst"><?php echo $prod->GetProduct(),'&nbsp&nbsp';?>
                                        <?php echo $prod->GetKostprijs_stuk(),'&nbsp&nbsp';?>
                                        <a href="Update.php?update=yes&productid=<?php echo $prod->GetProduct_id()?>">Update</a>
                                        &nbsp-&nbsp
                                        <a href="Beheren.php?inhoud=productenbeheren&delete=yes&productid=<?php echo $prod->GetProduct_id()?>">Delete</a>
                                    </li><br/>
                                    <?php
                                }
                                ?>
                                </ul>
                                <?php
                            }else{
                                ?><a href="Beheren.php?inhoud=productenbeheren&productgroepview=<?php echo $productgroep->GetProductgroep_id();?>"/><?php echo $productgroep->GetProductgroep_naam();?></a><br/>
                                <img class="productgroep_foto" src="<?php echo $productgroep->GetProductgroep_image();?>" alt="<?php echo $productgroep->GetProductgroep_naam();?>" title="<?php echo $productgroep->GetProductgroep_naam();?>"><br/><br/>
                                <?php 
                            }
                        }
                        ?>
                    <!--Einde product beheren pagina-->
                    <?php }
                    if(isset($_GET["inhoud"]) && $_GET["inhoud"] =="klanten"){?>
                    <!--Begin klanten pagina-->
                    <u>geblokkeerde gebruikers</u><br/><br/>
                    <ul class="block">
                    <?php
                    foreach ($gebruikerlijst as $gebr){
                        if(isset($gebr) && $gebr->GetBlock()==true){
                            ?>
                            <li class="gebrblock"><?php echo $gebr->GetNaam(),'&nbsp&nbsp',$gebr->GetVoornaam(),'&nbsp&nbsp',$gebr->GetEmail(),'&nbsp&nbsp';?>
                            <a href="beheren.php?inhoud=klanten&block=undo&klantid=<?php echo $gebr->GetKlant_id(); ?>" >unblock</a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    </ul>
                    <u>vrije gebruikers</u><br/><br/>
                    <ul class="free">
                    <?php
                    foreach ($gebruikerlijst as $gebr){
                        if(isset($gebr) && $gebr->GetBlock()==false){
                            ?>
                            <li class="gebrfree"><?php echo $gebr->GetNaam(),'&nbsp&nbsp',$gebr->GetVoornaam(),'&nbsp&nbsp',$gebr->GetEmail(),'&nbsp&nbsp';?>
                            <a href="beheren.php?inhoud=klanten&block=make&klantid=<?php echo $gebr->GetKlant_id(); ?>">block</a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    </ul>
                    <!--Einde klanten pagina-->
                    <?php }
                    if(!isset($_GET["inhoud"])){?>
                    <!--Begin bestellingen pagina-->
                        
                    <!--Einde bestellingen pagina-->
                    <?php }?>
                </div>
            </section>
            <footer class="footer">
                <p class="footerinfo">Site gemaakt door Mathias Descan &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; PHP eindtest &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; fictieve bakker shop</p>
            </footer>
        </div>
    </body>
</html>