<?php
include_once("../init/autoload.php");

$photo = new Photo();

$id = Helper::escape_string(Helper::decode($_GET['id']));
$file = Helper::decode($_GET['file']);


// delete from database and if succeed
if($photo->delete('photo_id', $id, '='))
{
    // delete from disk
    $photo->delete_file($file);
}

// redirect user
Helper::redirect("../index.php?p=photos");
