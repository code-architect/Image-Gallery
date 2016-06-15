<?php


class DBObject {

    protected $tableName;             // Database table name
    protected $tableNameArray;        // table column name
    protected $errors = [];     // errors array

    protected $db;                    // Database connection

    public function __construct() {
        // Instantiating the Database Class
        $this->db = new Database();
    }



//--------------------------------------------------------------------------------------//


    /**
     * fetch every thing from given table
     * @internal param $tableName :Database table name
     * @return array              :Return object data array
     */
    public function find_all()
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
    public function fetch_selected_column($rows = array(), $where_name = null, $where_condition = null, $where_data = null, $limit = null)
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
     * @work Check if the data exists or not
     * @param $field    Enter The field name E.g: user_id, photo_id
     * @param $data     Enter The id, or email
     * @return bool     Return true if found
     */

    public function data_exists($field, $data)
    {
        $query = "SELECT ".$field." FROM ".$this->tableName." WHERE ".$field." = ".$data;
        $rows = $this->db->num_rows($query);
        if($rows == true){
            return true;
        } else {
            return false;
        }
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work                    Delete field
     * @param $field            condition field
     * @param $id               Where condition data
     * @param $whereCondition   The where condition E.g : =, !=, >, <
     * @return bool             Return true if executes
     */

    public function delete($field, $id, $whereCondition)
    {
        $id = $this->db->mysql_escape($id);
        $field = $this->db->mysql_escape($field);

        // Building Query
        $query = $this->db->delete_query($this->tableName, $field, $id, $whereCondition);

        // Check if the data exists before updating the table
        if($this->data_exists($field,$id)) {

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
     * @work Delete files
     * @param $fileName
     * @return bool
     */
    public function delete_file($fileName)
    {
        if(unlink($fileName))
        {
            return true;
        }
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work                Insert data into desired table
     * @param array $rows   Associative array
     * @return bool         Return true if succeed
     */
    public function insert_into_table($rows = array())
    {
        $new_row = [];
        // check if given array is not empty
        if(!empty($rows)){

            // check if the given array is associative or not
            if(Helper::isAssoc($rows)) {

                // Getting the fields and the values
                $fields = array_keys($rows);
                $data = array_values($rows);


                // cleaning data given by user
                $new_row = $this->db->clean_array($data);

                // Building query
                $query = $this->db->insert_query($this->tableName, $fields, $new_row);
            }
            else
            {
                // If not associative array

                $fields = $this->tableNameArray;
                $data = $this->db->clean_array($rows);

                // Building query
                $query = $this->db->insert_query($this->tableName, $fields, $data);
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
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work                Update the table by given values
     * @param array $rows   Data array
     * @param $field        Condition Field
     * @param $id           Condition Id
     * @return bool         Return true on success
     */
    public function update_table($rows = array(), $field, $id)
    {
        $id = $this->db->mysql_escape($id);

        // check if given array is not empty
        if(!empty($rows))
        {
            // check if the given array is associative or not
            if(Helper::isAssoc($rows))
            {

                // Building Query
                $query = $this->db->update_query($this->tableName, $rows, $field, $id);
            }

            // Check if the user exists before updating the table
            if($this->data_exists($field, $id))
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
}
