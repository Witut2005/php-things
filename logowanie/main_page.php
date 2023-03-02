
<html>

    <head>
        <meta charset="UTF-8">
        <title>Todo</title>
        <link rel="stylesheet" href="todo.css"/>
    </head>

    <body>
        <?php

            session_start();

            if(isset($_SESSION['signed']) && $_SESSION['signed'] == true)
            {
                require_once('db_data.php');
                $database = new mysqli($host, $user, $db_pass, $db_name);
                if($database->connect_errno == 0)
                {
                    $login_id = $_SESSION['login_id'];
                    $mysql_query = "SELECT task_name FROM tasks WHERE login_id=$login_id";
                    $result = $database->query($mysql_query);

                    while(($dane = $result->fetch_array(MYSQLI_NUM)) != null)
                    {
                        echo '<p class="loaded-item">'.$dane[0].'</p>';
                    }


                    $result->free_result();
                    $database->close();
                }
                else
                {
                    echo "DATABASE ERROR";
                }
            }

            else
            {
                // echo $_SESSION['signed']."<br>";
                // echo "ale z ciebie kombinator chlopcze niekorzystny";
                $_SESSION['login_status'] = 'Please log in first';
                header('Location: login.php');
                exit();
            }

        ?>

        <div id="container">
            <header>
                <p>Todo</p>
            </header>

            <div>
                <input type="text" id="NewTaskName" placeholder="new task name"/>
                <div id="AddTask">
                    <p>Add</p>
                </div>
            </div>

            <div id="TaskContainer">

            </div>


            <form method="post" action="logout.php" style="margin-top: auto;">
                <input id="LogOut" value="Log Out" type="submit"/>
            </form>

        </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="todo.js"></script>

    </body>

</html>