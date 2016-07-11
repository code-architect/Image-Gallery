<?php
class User extends DBObject {


    protected $tableName = 'users';   // Database table name
    //protected $db;                    // Database connection



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
     * @work                Insert into user table from given array
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
                $val = Helper::excluding_fields($rows, 'user_', ['user_id']);

                // Encrypt the password
                foreach($val as $key => $value)
                {
                    $val[$key] = $value;

                    if($key == 'user_password'){
                        $val[$key] = md5($value);
                    }
                }

                // Getting the fields and the values
                $fields = array_keys($val);
                $data = array_values($val);


                // cleaning data given by user
                $new_row = $this->db->clean_array($data);

                // Building query
                $query = $this->db->insert_query($this->tableName, $fields, $new_row);
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
                $val = Helper::excluding_fields($rows, 'user_', ['user_id']);

                // Building Query
                $query = $this->db->update_query($this->tableName, $val, $field, $id);
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





//--------------------------------------------------------------------------------------//

    /**
     * @work Check if user data exists or not
     * @param $field
     * @param $email
     * @return bool
     */
    public function check_user_data_exists($field, $email)
    {
        $query = "SELECT user_email from ".$this->tableName." WHERE user_email = '".$email."'";
        $data = $this->db->custom_query($query);
        if($data->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}

