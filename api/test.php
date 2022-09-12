<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');

use SW\Function\configs;
use SW\Function\user;

//เรียกใช้งาน functionที่เรียก
$cogfig_func = new configs();
$user_func = new user();

$get_config = $_GET["config"];

print_r($user_func->check_register("1122"));
?>