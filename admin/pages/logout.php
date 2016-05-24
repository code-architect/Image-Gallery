<?php
include_once("../init/autoload.php");

$session = new Session();

$session->logout();
Helper::redirect("../login.php");

