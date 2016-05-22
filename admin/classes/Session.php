<?php

class Session{

    private $signed_in = false;
    public $user_id;



    public function __construct()
    {
        $this->check_login();
    }


    /**
     * @work If there is a session set values or else unset values and set false
     */
    private function check_login()
    {
        if(isset($_SESSION['user_id']))
        {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;

        } else {

            unset($this->user_id);
            $this->signed_in = false;
        }
    }


//--------------------------------------------------------------------------------------//


    public function login()
    {

    }


//--------------------------------------------------------------------------------------//

}

$session = new Session();