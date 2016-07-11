<?php

class Database {


    protected $conn;    // connection variable
    protected $_query;  // SQL query


    public function __construct()
    {
        // database connection
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->conn = $connection;

        // if error occurred
        if($this->conn->connect_errno){
            die("Database connection failed.");
        }
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work check query and return result
     * @param $sql
     * @return bool|mysqli_result
     */
    public function query($sql)
    {
        $this->_query = filter_var($sql,FILTER_SANITIZE_STRING);
        $result = mysqli_query($this->conn, $this->_query);
        $this->confirm_query($result);
        return $result;

    }


//--------------------------------------------------------------------------------------//


    /**
     * @work executes the query and return data
     * @param $query
     * @return array
     */
    public function execute_query($query)
    {
        $data = array();
        $result = $this->conn->query($query);

        while ($tableData = $result->fetch_object()) {
            $data[] = $tableData;
        }
        return $data;

    }

//--------------------------------------------------------------------------------------//


    /**
     * @work Check if there are any rows returning
     * @param $query
     * @return bool
     */
    public function num_rows($query)
    {
        $this->_query = $this->mysql_escape($query);
        $result = $this->conn->query($this->_query);
        $num_rows = $result->num_rows;
        return ($num_rows > 0)? true : false;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work clear from mysql injection
     * @param $string
     * @return string
     */
    public function mysql_escape($string)
    {
        $escaped_string = mysqli_real_escape_string($this->conn, $string);
        return $escaped_string;
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work It will clean array not matter what the type associative or numeric
     * @param array $array
     * @return array
     */
    public function clean_array($array = array())
    {
        $clean_array = [];

        // if the given array is not empty
        if(Helper::check_data_array($array))
        {
            // if the array is associative array do this
            if(Helper::isAssoc($array))
            {
                foreach($array as $key => $value)
                {
                    $clean_array[$key]  = Helper::escape_string($this->mysql_escape($value));
                }
            }
            else    // Do this if numeric array
            {
                foreach ($array as $value) {
                    $clean_array[] = Helper::escape_string($this->mysql_escape($value));
                }
            }
        }

        // Return clean array
        return $clean_array;
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work If failed return error, if not return the result
     * @param $result
     * @return mixed
     */
    private function confirm_query($result)
    {
        if(!$result){
            die($this->conn->error);
        }
        return $result;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work custom query
     * @param $query
     * @return array
     */
    public function custom_query($query)
    {
        $result = mysqli_query($this->conn, $query);
        if(!$result){
            die($this->conn->error);
        }
        return $result;
    }


//--------------------------------------------------------------------------------------//




    /**
     * @work Building the Create Query by given Data
     * @param $tableName        The table name to be inserted
     * @param array $fields     This is a numeric array of fields E.g:Array ( [0] => user_id [1] => user_name [2] => user_password )
     * @param array $values     This is a numeric array of Values E.g: Array ( [0] => 1 [1] => user [2] => 123456 )
     * @return string           Return the query string
     */
    public function insert_query($tableName, $fields = array(), $values = array())
    {
        $query = "INSERT INTO " . $tableName . " (";
        $query .= implode(", ", $fields);
        $query .= ") VALUES ('";
        $query .= implode("', '", $values);
        $query .= "')";

        return $query;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @param $tableName    The table name to be updated
     * @param array $array  This is an associative array E.g: Array ( [user_id] => 1 [user_name] => nico [user_password] => 123456 )
     * @param $field        The condition field E.g: user_id
     * @param $id           The condition value E.g: 1
     * @return string       Return the query string
     */
    public function update_query($tableName, $array = array(), $field, $id)
    {
        $string = [];
        $query = "UPDATE ". $tableName." SET ";

        // Getting the field and data
        foreach($array as $key => $value)
        {
            // escaping values and putting them in an array
            $string[] = $key." = '".$this->mysql_escape($value)."'";
        }

        $query .= implode(", ", $string);
        $query .= " WHERE ".$field." = ".$id;

        return $query;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @param $tableName    The table name to be deleted
     * @param $field        The condition field E.g: user_id
     * @param $id           The condition value E.g: 1
     * @return string       Return the query string
     */
    public function delete_query($tableName, $field, $id, $whereCondition)
    {
        return $query = "DELETE FROM ".$tableName." WHERE ".$field." ".$whereCondition." ".$id." LIMIT 1";
    }


//--------------------------------------------------------------------------------------//
}
