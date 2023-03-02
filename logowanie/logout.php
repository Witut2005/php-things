

<html>
    <body>
        <?php
            session_start();
            $_SESSION['just_logged_out'] = 'logged out successfully';
            $_SESSION['signed'] = false;
            header('Location: login.php');
            exit();
        ?>

    </body>

</html>