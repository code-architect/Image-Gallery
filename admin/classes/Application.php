<?php
class Application {

    public $user;
    public $photo;

    // declare needed instances in here to use them
    public function __construct() {
        $this->user = new User();
        $this->photo = new Photo();

    }

}