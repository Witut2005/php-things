<html>

    <body>
        <?php
            
            require_once("db_data.php");
            require_once('sql_interface.php');
            
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

            session_start();

            if(strlen($_POST['nick'] > 0) && strlen($_POST['email'] > 0 && $_POST['haslo'] > 0 && $_POST['powtorz_haslo'] > 0))
            {
                $nick = $_POST['nick'];
                $email = $_POST['email'];
                $pass = $_POST['haslo'];
                $pass2 = $_POST['powtorz_haslo'];

                if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
                {
                    $_SESSION['email_error'] =  "email validation error";
                    header('Location: index.php');
                    exit();
                }

                if($pass != $pass2)
                {
                    $_SESSION['password_error'] = "passwords do not match";
                    header('Location: index.php');
                    exit();
                }

                $database = new mysqli($host, $user, $db_pass, $db_name);

                if($database->connect_errno == 0)
                {

                    $RegisterSqlInterface = new SqlInterface($database, 'logowanko');
                    $result = $RegisterSqlInterface->select(array('*'), "WHERE nick='$nick'");

                    $row = $result->fetch_assoc();
                    $result->free_result();

                    if($row != null)
                    {
                        $_SESSION['nick_error'] = 'this nick is used already';
                        header('Location: index.php');
                        exit();
                    }

                    $result = $RegisterSqlInterface->select(array('*'), "WHERE email='$email'");

                    $row = $result->fetch_assoc();
                    $result->free_result();

                    if($row != null)
                    {
                        $_SESSION['email_error'] = 'account exists with this email';
                        header('Location: index.php');
                        exit();
                    }

                    $pass = password_hash($pass, PASSWORD_DEFAULT);

                    $RegisterSqlInterface->insert(array('nick', 'email', 'pass'), array(array($nick, 'str'), array($email, 'str'), array($pass, 'str')));
                    $result = $RegisterSqlInterface->select(array('id'), "WHERE nick='$nick' and email='$email' and pass='$pass'");

                    $_SESSION['login_id'] = $result->fetch_assoc()['id'];

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