<?php

class Database {

    // connection variable
    protected $conn;
    protected $_query;


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
     * @work If failed return error, if not return the result
     * @param $result
     * @return mixed
     */
    private function confirm_query($result)
    {
        if(!$result){
            die("Query Failed");
        }
        return $result;
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


}