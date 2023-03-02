

<?php

    class SqlInterface
    {

        private $database;
        private $table;

        function __construct($database, string $table)
        {
            $this->database = $database;
            $this->table = $table;
        }

        // private function str_concat(string $str="", array $args=[]): string
        // {
        //     for($i = 0; $i < count($args); $i++)
        //     {
        //         $str .= $args[$i];
        //     }
        //     return $str;
        // }

        // private function if_string($str, $action, array $action_args)
        // {

        //     if($str == 'str')
        //     {
        //         return $action($str, $action_args);
        //     }

        // }

        function insert(array $fields, array $values): void
        {


            $query = "INSERT INTO ".$this->table." (";
            for($i = 0; $i < count($fields); $i++)
            {
                if($i < count($fields) - 1)
                {
                    $query .= $fields[$i].", ";
                }

                else
                {
                    $query .= $fields[$i].") VALUES (";
                }
            }    

            for($i = 0; $i < count($values); $i++)
            {
                if($i < count($values) - 1)
                {
                    if($values[$i][1] == 'str')
                        $query .= '"';
                    

                    $query = $query.$values[$i][0];

                    if($values[$i][1] == 'str')
                        $query .= '"';

                    $query .= ', ';
                }

                else
                {
                    if($values[$i][1] == 'str')
                        $query .= '"';

                    $query .= $values[$i][0];

                    if($values[$i][1] == 'str')
                        $query .= '"';
                    
                    $query .= ')';
                }
            }    
            // echo $query;
            $this->database->query($query);
        }

        function select(array $fields, $options = "")
        {
            $query = "SELECT ";

            for($i = 0; $i < count($fields); $i++)
            {
                if($i < count($fields) - 1)
                {
                    $query .= $fields[$i].", ";
                }

                else
                {
                    $query .= $fields[$i]. " ";
                }
            }    

            $query .= "FROM ".$this->table." ";

            $query .= $options;
            return $this->database->query($query);
        }

        function table_set($table): void
        {
            $this->table = $table;
        }


    }

?>