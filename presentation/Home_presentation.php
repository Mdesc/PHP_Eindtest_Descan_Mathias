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
                        <p class="titel">Bakkertje<p>
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
                        echo "<br/><a href='home.php?logout=exit'><input type='button' value='logout'/></a>";
                        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] != "admin"){
                            echo '<br/><br/>';?>
                            <a class='white' href='Bestelling.php?Winkelmand=yes'>Winkelmand (<?php echo $aantalitems; ?>)</a><br/><?php
                        }
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
                if(isset($_GET['blocked']) && $_GET['blocked']=='yes'){
                    ?><p class="blockmessage">u werd geblocked en hebt het recht niet meer om op deze site te bestellen</p><?php
                }
                ?>
                <h2>Welkom beste bezoeker</h2>
                <p>Hier op onze website vind u een breed assortiment aan producten. 
                    Die allemaal zeer verzord worden bereid. Door onze gemeentelijke bakker op het plein. </p>
                <u><h4>Enkele regels in verband met bestellen</h4></u>
                <ul class="regels">
                    <li>
                        Om te kunnen bestellen dient u zich te registreren.
                    </li>
                    <li>
                        U kunt bestellen uit ons assortiment, maximaal 3 dagen verder/minimaal 1 dag verder.
                    </li>
                    <li>
                        Indien u voor de volgende dag wil bestellen dient dit voor 20uur gebeuren.
                    </li>
                    <li>
                        Indien u dingen vergeet bij bestelling kunt u voorgaande annuleren om te corrigeren.
                    </li>
                </ul>
                <img alt="taart" src="Images/taart_page5678.jpg" title="taart" class="homeimg" width="320" height="240"/>
            </section>
            <footer class="footer">
                <p class="footerinfo">Site gemaakt door Mathias Descan &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; PHP eindtest &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; fictieve bakker shop</p>
            </footer>
        </div>
    </body>
</html>