<?php
include_once("../init/autoload.php");

$user = new User();

$id = Helper::escape_string(Helper::decode($_GET['id']));

// delete from database and if succeed
if($user->delete('user_id', $id, '='))
{
    // redirect user
    Helper::redirect("../index.php?p=users");
}



