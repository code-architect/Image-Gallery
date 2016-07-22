<?php
include_once("../init/autoload.php");

$comments = new Comment();

$id = Helper::escape_string(Helper::decode($_GET['id']));

// delete from database and if succeed
if($comments->delete('comm_id', $id, '='))
{
    // redirect user
    Helper::redirect("../index.php?p=comments");
}
