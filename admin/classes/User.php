<?php

class User extends Application{

    public $my_query = [];

    /**
     * fetch every thing from given table
     * @param $tableName
     * @return array
     */
    public function find_all_data($tableName)
    {
        $query = "SELECT * FROM ".$tableName;
        $data = $this->db->execute_query($query);

        return $data;
    }


    /**
     * @work Get selected columns from database with conditions
     * @param $tableName
     * @param array $rows
     * @param null $where_name
     * @param null $where_con
     * @param null $where_data
     * @return array
     */
    public function fetch_selected_rows($tableName, $rows = array(), $where_name = null, $where_con = null, $where_data = null)
    {
        $query = "SELECT ";
        $query .= strtolower(implode(", ", $rows));
        $query .= " FROM ".$tableName;
        if($where_name != null){
            $query .= " WHERE ".$where_name." ".$where_con." ".$where_data;
        }
        $data = $this->db->execute_query($query);
        return $data;

    }


}


