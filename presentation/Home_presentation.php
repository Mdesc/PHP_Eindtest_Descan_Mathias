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
                    <nav class="headmenu">
                        <ul class="menu">
                            <li>home</li>
                            <li>register</li>
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
                            <input type="submit" value="login" name="submit">
                        </form> 
                    <?php
                    }
                    ?>
                    
                </section>
            </header>
            <section class="body">
                test
            </section>
            <footer class="footer">
                test
            </footer>
        </div>
    </body>
</html>

