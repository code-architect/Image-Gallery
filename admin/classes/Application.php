<?php
class Application {

    public $user;

    // declare needed instances in here to use them
    public function __construct() {
        $this->user = new User();

    }

}