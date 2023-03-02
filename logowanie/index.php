<?php
    session_start();
    $secret_key = "6LfWgbIkAAAAAPHpwrAgdEdYSq8NP4M1neuHtmBj";
    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
?>

<html>

    <head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    

    <body>

        <form method="post" id="fromik" action="register.php">

            <label for="nick">nick</label>
            <br>
            <input type="text" name="nick"/>
            <?php
                if(isset($_SESSION['nick_error']))
                {
                    echo '<p style="display: inline; color: red;">'.$_SESSION['nick_error'].'</p>';
                    unset($_SESSION['nick_error']);
                }
            ?>
            <br>

            <label for="email">email</label>
            <br>
            <input type="text" name="email"/>
            <?php
                if(isset($_SESSION['email_error']))
                {
                    echo '<p style="display: inline; color: red;">'.$_SESSION['email_error'].'</p>';
                    unset($_SESSION['email_error']);
                }
            ?>
            <br>

            <label for="haslo">haslo</label>
            <br>
            <input type="text" name="haslo"/>
            <?php
                if(isset($_SESSION['password_error']))
                {
                    echo '<p style="display: inline; color: red;">'.$_SESSION['password_error'].'</p>';
                    unset($_SESSION['password_error']);
                }
            ?>
            <br>

            <label for="powtorz_haslo">powtorz haslo</label>
            <br>
            <input type="text" name="powtorz_haslo"/>
            <br>
            <br>

            <input type="submit" placeholder="zarejestruj"/>

            <div class="g-recaptcha" data-sitekey="6LfWgbIkAAAAALB7coQQqkM7qjT1kymWdquAE7X3"></div>

            <a href="login.php">Login page</a>

        </form>

        <?php


            if(isset($_SESSION['logerr']))
            {
                echo $_SESSION['logerr'];
                unset($_SESSION['logerr']);
            }

        ?>

    </body>

</html>