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
                            <a href="home.php"/><li>Producten</li></a>
                            <?php   if(isset($_SESSION["status"]) && $_SESSION["status"] == true && isset($block) && $block == false && isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "klant"){?>
                            <a href="home.php"/><li>Bestelling</li></a>
                            <?php   }?>
                            <?php   if(isset($_SESSION["status"]) && $_SESSION["status"] == true && isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "admin"){?>
                            <a href="home.php" /><li>Beheren</li></a>
                            <?php   }?>
                            <a href="home.php"/><li>Over ons</li></a>
                            
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
                            <input type="text" name="email" value="" placeholder="email"><br/>
                            <label for="password">password:</label>
                            <input type="password" name="wachtwoord" value=""><br/>
                            <input type="submit" id="loginbutton" value="login" name="submit">
                        </form> 
                    <?php
                    }
                    ?>
                    
                </section>
            </header>
            <section class="body">
                <?php if(isset($_GET["registreer"]) && $_GET["registreer"]=="complete"){
                    echo 'uw username:',$_COOKIE["email"],'<br/><br/>';
                    echo 'uw wachtwoord:',$_COOKIE["wachtwoordunhashed"],'<br/><br/>';
                    echo '! hou u wachtwoord ergen opgeschreven goed bij !'?>
                <?php }else{
                    if(isset($_GET["registreer"]) && $_GET["registreer"]=="emailerror"){
                        echo 'Het ingevoerde emailadres :',$_COOKIE["email"],' is reed in gebruik.<br/><br/>';
                    }else{
                        //hier is er niks die moet gebeuren
                    }
?>
                <form method="post" action="Register.php?registreer=reg">
                    <label for="naam">naam*:</label>
                    <input type="text" name="naam" value="<?php if(isset($_COOKIE["naam"])){ echo $_COOKIE["naam"]; }?>" placeholder="naam" required><br/>
                    <label for="voornaam">voornaam*:</label>
                    <input type="text" name="voornaam" value="<?php if(isset($_COOKIE["voornaam"])){ echo $_COOKIE["voornaam"]; }?>" placeholder="voornaam" required><br/>
                    <label for="straat">straat:</label>
                    <input type="text" name="straat" value="<?php if(isset($_COOKIE["straat"])){ echo $_COOKIE["straat"]; }?>" placeholder="straat"><br/>
                    <label for="huisnummer">huisnummer:</label>
                    <input type="text" name="huisnummer" value="<?php if(isset($_COOKIE["huisnr"])){ echo $_COOKIE["huisnr"]; }?>" placeholder="huisnummer"><br/>
                    <label for="bus">bus:</label>
                    <input type="text" name="bus" value="<?php if(isset($_COOKIE["bus"])){ echo $_COOKIE["bus"]; }?>" placeholder="bus"><br/>
                    <label for="postcode">postcode:</label>
                    <input type="text" name="postcode" value="<?php if(isset($_COOKIE["postcode"])){ echo $_COOKIE["postcode"]; }?>" placeholder="postcode"><br/>
                    <label for="gemeente">gemeente:</label>
                    <input type="text" name="gemeente" value="<?php if(isset($_COOKIE["gemeente"])){ echo $_COOKIE["gemeente"]; }?>" placeholder="gemeente"><br/>
                    <label for="email">email*:</label>
                    <input type="text" name="email" value="<?php if(isset($_COOKIE["email"])){ echo $_COOKIE["email"]; }?>" placeholder="email" required><br/>
                    <input type="submit" id="registreerbutton" value="registreer" name="registreer">
                </form>
                <?php }?>
            </section>
            <footer class="footer">
                <p class="footerinfo">Site gemaakt door Mathias Descan &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; PHP eindtest &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; fictieve bakker shop</p>
            </footer>
        </div>
    </body>
</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

