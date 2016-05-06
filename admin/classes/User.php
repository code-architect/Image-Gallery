<?php

class User extends Application{



    public function find_all_data($tableName)
    {
        $data = array();
        $query = "SELECT * FROM ".$tableName;
        $result = $this->db->query($query);
        while($tableData = mysqli_fetch_assoc($result)) {
            $data[] = $tableData;
        }
        return $data;
    }
}


