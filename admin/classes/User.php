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


//--------------------------------------------------------------------------------------//


    /**
     * @work                Create user from given array [array can be associative or numeric]
     * @param array $rows   Data Array
     * @return bool         Return true if executes
     */
    public function create($rows = array())
    {
        $val = [];
        $new_row = [];
        // check if given array is not empty
        if(!empty($rows)){

            // check if the given array is associative or not
            if(Helper::isAssoc($rows)) {

                // Excluding unnecessary fields
                foreach($rows as $key => $value){
                    if(strpos($key, 'user_') !== false)
                    {
                        unset($val['user_id']);         // Removing user_is
                        $val[$key] = $value;
                    }

                    // Encrypt the password
                    if($key == 'user_password'){
                        $val[$key] = md5($value);
                    }
                }

                // Getting the fields and the values
                $fields = array_keys($val);
                $data = array_values($val);


                // cleaning data given by user
                foreach ($data as $values) {
                    $new_row[] = Helper::html_entity(Helper::escape_string($this->db->mysql_escape($values)));
                }

                // Building query
                $query = "INSERT INTO " . $this->tableName . " (";
                $query .= implode(", ", $fields);
                $query .= ") VALUES ('";
                $query .= implode("', '", $new_row);
                $query .= "')";
            }
            else
            {
                // cleaning data given by user
                foreach ($rows as $row) {
                    $val[] = Helper::html_entity(Helper::escape_string($this->db->mysql_escape($row)));
                }

                // Building query
                $query = "INSERT INTO " . $this->tableName . " (";
                $query .= "user_name, user_password, user_email, user_fname, user_lname, user_is_admin";
                $query .= ") VALUES ('";
                $query .= implode("', '", $val);
                $query .= "')";
            }

            // If query execute return true, else false
            if($this->db->custom_query($query))
            {
                return true;
            } else {
                return false;
            }

        }else{
            // return false if the array is empty
            return false;
        }
    }// create method



//--------------------------------------------------------------------------------------//



    /**
     * @work                Update the existing table
     * @param array $rows   Data Array
     * @param $field        Where condition field
     * @param $id           Where condition data
     * @return bool         Return true if executes
     */
    public function update($rows = array(), $field, $id)
    {
        $val = [];
        $string = [];
        $id = $this->db->mysql_escape($id);

        // check if given array is not empty
        if(!empty($rows))
        {
            // check if the given array is associative or not
            if(Helper::isAssoc($rows))
            {
                // Excluding unnecessary fields
                foreach($rows as $key => $value){
                    if(strpos($key, 'user_') !== false)
                    {
                        unset($val['user_id']);         // Removing user_is
                        $val[$key] = $value;
                    }
                }

                // Building Query
                $query = "UPDATE ".$this->tableName." SET ";

                // Getting the field and data
                foreach($val as $key => $value)
                {
                    // escaping values and putting them in an array
                    $string[] = $key." = '".Helper::html_entity(Helper::escape_string($this->db->mysql_escape($value)))."'";
                }

                $query .= implode(", ", $string);
                $query .= " WHERE ".$field." = ".$id;
                // Building Query Ends
            }

            // Check if the user exists before updating the table
            if($this->user_exists($id))
            {
                // If query execute return true, else false
                if($this->db->custom_query($query))
                {
                    return true;
                } else {
                    return false;
                }
            }

        }
        else
        {
            // return false if the array is empty
            return false;
        }
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work        Delete User
     * @param $id   The user id to be deleted
     * @return bool Return true if executes
     */
    public function delete($id)
    {
        $id = $this->db->mysql_escape($id);

        // Building Query
        $query = "DELETE FROM ".$this->tableName." WHERE user_id = ".$id." LIMIT 1";

        // Check if the user exists before updating the table
        if($this->user_exists($id)) {

            // If query execute return true, else false
            if ($this->db->custom_query($query)) {
                return true;
            } else {
                return false;
            }
        }

    }




//--------------------------------------------------------------------------------------//


    /**
     * @work                Update or Create User
     * @param array $array
     * @param null $field
     * @param null $id
     * @return bool
     */
    public function save($array = array(), $field = null, $id = null)
    {
        // escape mysql injection
        $id = $this->db->mysql_escape($id);

        // Check if there are fields and id exists
        if($field != null && $id != null)
        {
            // If the user exists
            if($this->user_exists($id))
            {
                return $result = $this->update($array, $field, $id); // Update user
            }

        }
        // check if both fields are null to create user
        elseif($field == null && $id == null)
        {
            return $result = $this->create($array);                  // Create user
        }
        // if any of the fields are not null
        elseif($field == null || $id == null)
        {
            return false;                                           // return false
        }
    }










}

