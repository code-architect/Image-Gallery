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


    public function query($sql)
    {
        $result = mysqli_query($sql, $this->conn);
        if(!$result){
            die("Query Failed");
        }
        return $result;
    }
}