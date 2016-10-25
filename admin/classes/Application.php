<?php
class Application {

    public $user;
    public $photo;
    public $comment;
    //public $pagination;

    // declare needed instances in here to use them
    public function __construct() {
        $this->user = new User();
        $this->photo = new Photo();
        $this->comment = new Comment();
        //$this->pagination = new Pagination();

    }

}