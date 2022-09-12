<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/line.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\function\user;
use SW\function\configs;
use SW\function\Line\LineMessage;

$user_func = new user();
$config_func = new configs();
$line_func = new LineMessage();

$request_data=json_decode(file_get_contents("php://input"), true);

//เพิ่ม user ลง database
if($request_data['action'] == 'add_user'){
    $get_data = $user_func->add_user($request_data['type_user'], $request_data['user_id'], sha1($request_data['card_id']), $request_data['name_user'], $request_data['lastname'], $request_data['grade_student'], $request_data['class_student'], $request_data['phone_parent']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}
elseif($request_data['action'] == 'student_register'){
    if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){
        $get_data = $user_func->user_register($request_data['userid'], sha1($request_data['card_id']), $request_data['line_userid']);

        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
        file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);
    }

}
elseif($request_data['action'] == 'getdata_for_leave'){
    $get_data = $user_func->get_dataforleave($request_data['line_userid']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}
elseif($request_data['action'] == 'getdata_for_media'){
    if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){
    $get_data = $user_func->getuserdata_formedia($request_data['line_userid']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);
    }
}
elseif($request_data['action'] == 'getdata_for_dashboard'){
    if($request_data['get_type'] == 'all'){
        $get_data = $user_func->dashboard_all();
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }
    elseif($request_data['get_type'] == 'grade'){
        $get_data = $user_func->dashboard_grade($request_data['grade_post']);
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }
    elseif($request_data['get_type'] == 'class'){
        $get_data = $user_func->dashboard_class($request_data['grade_post'], $request_data['class_post']);
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }
}

elseif($request_data['action'] == 'remove_user'){
    $get_data = $user_func->remove_user($request_data['id_linebot_user']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);
}
?>