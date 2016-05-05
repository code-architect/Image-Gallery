<?php

class Database {

    // connection variable
    private $conn;


    public function __construct()
    {
        // database connection
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->conn = $connection;

        // if error occurred
        if(mysqli_connect_errno()){
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
        $result = mysqli_query($this->conn, $sql);
        $result = $this->confirm_query($result);
        return $result;
    }


//--------------------------------------------------------------------------------------//


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
        $escaped_string = mysqli_real_escape_string($this->db, $string);
        return $escaped_string;
    }

}