<?php
class User {


    private $tableName = 'users';   // Database table name
    private $db;                    // Database connection


    public function __construct() {
        // Instantiating the Database Class
        $this->db = new Database();
    }


    /**
     * fetch every thing from given table
     * @internal param $tableName :Database table name
     * @return array              :Return object data array
     */
    public function find_all_users()
    {
        $query = "SELECT * FROM ".$this->tableName;
        $data = $this->db->execute_query($query);
        return $data;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work Get selected columns from database with conditions
     * @internal param $tableName   :Database table name
     * @param array $rows           :Selected column name
     * @param null $where_name      :Column name
     * @param null $where_condition :Where condition symbol
     * @param null $where_data      :Where condition data
     * @param null $limit           :Limit the data from database
     * @return array|bool|mixed     :Return object data array or data
     */
    public function fetch_selected_users($rows = array(), $where_name = null, $where_condition = null, $where_data = null, $limit = null)
    {
        $query = "SELECT ";
        $query .= strtolower(implode(", ", $rows));
        $query .= " FROM ".$this->tableName;

        // Checking if there is a where condition
        if($where_name != null){
            $query .= " WHERE ".$where_name." ".$where_condition." ".$where_data;
        }

        // Checking if there is a limit
        if($limit != null && $limit == 1){
            $query .= " LIMIT 1";
            $data = $this->db->execute_query($query);
            return !empty($data) ? array_shift($data) : false;
        }

        $data = $this->db->execute_query($query);
        return $data;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work Check if user exists or not
     * @param $user_id
     * @return bool
     */
    public function user_exists($user_id)
    {
        $query = "SELECT user_id FROM ".$this->tableName." WHERE user_id = ".$user_id;
        $rows = $this->db->num_rows($query);
        if($rows == true){
            return true;
        } else {
            return false;
        }
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work Get user id by user_name and password
     * @param $user_name
     * @param $user_password
     * @return mixed
     */

    public function fetch_user_id($user_name, $user_password)
    {
        $user_name = Helper::escape_string($this->db->mysql_escape($user_name));
        $user_password = md5(Helper::escape_string($this->db->mysql_escape($user_password)));

        $query = "SELECT user_id, user_is_admin FROM ".$this->tableName." WHERE user_name = '{$user_name}' AND
                  user_password = '{$user_password}'";

        $data = $this->db->execute_query($query);
        return !empty($data) ? array_shift($data) : false;
    }


}
