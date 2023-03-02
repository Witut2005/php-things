
<html>

    <body>
        <?php
            
            session_start();

            if(strlen($_POST['email'] > 0 && $_POST['haslo'] > 0))
            {

                $email = $_POST['email'];
                $pass = $_POST['haslo'];

                require_once("db_data.php");
                $database = new mysqli($host, $user, $db_pass, $db_name);

                if($database->connect_errno == 0)
                {


                    // if($haslo != $row['pass'])


                    $sql_insert_query = "SELECT * FROM logowanko WHERE email='$email'";
                    $result = $database->query("$sql_insert_query");

                    $row = $result->fetch_assoc();
                    $result->free_result();

                    if($row['email'] == null)
                    {
                        $_SESSION['email_error'] = 'no such email';
                        header('Location: login.php');
                        exit();
                    }

                    if(!password_verify($pass, $row['pass']))
                    {
                        $_SESSION['password_error'] = 'bad password';
                        header('Location: login.php');
                        exit();
                    }


                    $_SESSION['login_id'] = $row['id'];

                    $database->close();
                }

                else
                {
                    echo "DATABASE ERROR";
                }

                $_SESSION['signed'] = true; 
                header('Location: main_page.php');
                exit();

            }

            else
            {
                $_SESSION['logerr'] = '<p style="color:red;">Data Error</p>';
                header('Location: index.php');
                exit();
            }
        ?>
    </body>

</html>