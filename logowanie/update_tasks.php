<?php 

    session_start();

    $taskName = $_POST['taskName'];
    $action = $_POST['action'];

    if(isset($_SESSION['signed']) && $_SESSION['signed'] == true)
    {
        require_once('db_data.php');
        require_once('sql_interface.php');
        $database = new mysqli($host, $user, $db_pass, $db_name);
        if($database->connect_errno == 0)
        {
            $login_id = $_SESSION['login_id'];

            if($action == 'update')
            {
                $UpdateTaskSqlInterface = new SqlInterface($database, 'tasks');
                $UpdateTaskSqlInterface->insert(array('login_id', 'task_name'), array($login_id, $taskName));
                $result = $database->query($mysql_insert_query);
                if($result == false)
                {
                    echo "DB ERROR";
                }
                else
                {
                    $result->free_result();
                }
            }

            else 
            {
                $mysql_delete_query = "DELETE from tasks WHERE task_name='$taskName' and login_id=$login_id LIMIT 1";
                @$database->query($mysql_delete_query);
            }

            $database->close();
        }
    }

?>