<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/leave.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/sms.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/line.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\function\user;
use SW\function\leave;
use SW\function\sms;

use SW\Function\Line\LineMessage;
use SW\function\configs;

$laeve_func = new leave();
$sms_func = new sms();

$line_func = new LineMessage();
$config_func = new configs();
$user_func = new user();

$request_data=json_decode(file_get_contents("php://input"), true);
file_put_contents('logss.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);

if($request_data['action'] == 'ลา'){

    if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){

        $output=array("code"=>"200", "data" => 'file='.$request_data['file'].'file_name='.$request_data['file_name']);
        echo json_encode($output);

        $type_file = explode(".", $request_data['file_name']);
        $name_file = rand();
        file_put_contents('logss.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/leave/$name_file.".$type_file[1], file_get_contents($request_data['file']));

        $laeve_func->add_data($request_data['userid'], $request_data['line_userid'], $request_data['name'], $request_data['type_leave'], $request_data['reason_leave'], "/uploads/leave/$name_file.".$type_file[1], $request_data['grade_student'], $request_data['class_student'], $request_data['start_date'],$request_data['end_date']);
        
        //ส่ง sms หาผู้ปกครอง ผ่าน sms gateway API
        $phone_parent = $user_func->get_phone_parent($request_data['line_userid']);

        $sms_msg = "บุตรหรือหลานของท่านได้แจ้งลา:https://sw-chatbot.cf/check/?id=".$request_data['userid'];
        $sms_log = $sms_func->send_sms($sms_msg, $phone_parent);

        file_put_contents('sms_log.txt', json_encode($sms_log) . PHP_EOL, FILE_APPEND);
    }
}
elseif($request_data['action'] == 'get_leave_student'){
    if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){
        $get_data = $laeve_func->get_data($request_data['grade'], $request_data['class']);

        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
        file_put_contents('log_leave.txt', json_encode($output) . PHP_EOL, FILE_APPEND);
    }
}
elseif($request_data['action'] == 'get_byid'){
    $get_data = $laeve_func->get_byid($request_data['id_leave']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log_leave.txt', json_encode($output) . PHP_EOL, FILE_APPEND);
}
?>