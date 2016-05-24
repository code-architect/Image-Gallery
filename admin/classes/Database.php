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
}
