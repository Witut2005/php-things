
<html>

    <body>
        <?php            
            session_start();
        
            if(isset($_SESSION['login_status']))
            {
                echo $_SESSION['login_status'];
                unset($_SESSION['login_status']);
            }


        ?>

        <form method="post" action="login_check.php">

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
            <br>
            <input type="submit"/>

            <br>
            <a href="index.php">Register page</a>

        </form>

    </body>

</html>