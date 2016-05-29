<?php


class DBObject {

    protected $tableName;
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
}
