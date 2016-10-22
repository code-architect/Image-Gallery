<?php

class Session{

    private $signed_in = false;
    public $user_id;
    public $count;



    public function __construct()
    {
        $this->check_login();
        $this->visitorCount();
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

    /**
     * @work To check if signed_in is true or not
     * @return bool
     */
    public function is_signed_in()
    {
        return $this->signed_in;
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work Logging in your by user id
     * @param $user
     */
    public function login($user)
    {
        if($user)
        {
            $this->user_id = $_SESSION['user_id'] = $user->user_id;
            $_SESSION['is_admin'] = $user->user_is_admin;
            $_SESSION['signed_in'] = $this->signed_in = true;
        }
    }


//--------------------------------------------------------------------------------------//


    /**
     * @work Destroy all session and unset values
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['signed_in']);
        unset($_SESSION['is_admin']);

        unset($this->user_id);
        $this->signed_in = false;
        session_destroy();
    }
//--------------------------------------------------------------------------------------//

    public function visitorCount()
    {
        if(isset($_SESSION['count']))
        {
            return $this->count = $_SESSION['count']++;
        } else
        {
            return $_SESSION['count'] = 1;
        }
    }

//--------------------------------------------------------------------------------------//

}

//$session = new Session();

