<?php

class User extends Application{



    public function find_all_users()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->result($query);
        return $result;
    }
}


