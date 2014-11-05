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
                <?php
                                    echo 'bestelling';
                ?>
            </section>
            <footer class="footer">
                <p class="footerinfo">Site gemaakt door Mathias Descan &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; PHP eindtest &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; fictieve bakker shop</p>
            </footer>
        </div>
    </body>
</html>