<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

include_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/functions/data.php');

use SW\function\user;
use SW\function\data;

$user_func = new user();
$data_func = new data();

$request_data=json_decode(file_get_contents("php://input"), true);

//เพิ่ม บุคลากร ลง database
if($request_data['action'] == 'get_course'){
    $get_data = $data_func->getall_course();

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}
elseif($request_data['action'] == 'add_teacher'){
    $line_userid = $user_func->get_lineuserid($request_data['teacher_id']);

    if($line_userid != null){
        $get_data = $user_func->add_teacher($request_data['teacher_id'], $line_userid,$request_data['course_teach'], $request_data['grade_teach'], $request_data['class_teach'], $request_data['level']);
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }else{
        $output=array("code"=>"400");
        echo json_encode($output);
    }
    //file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}
elseif($request_data['action'] == 'getdata_for_dashboard'){
    if($request_data['get_type'] == 'all'){
        $get_data = $user_func->get_teacherall();
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }
    elseif($request_data['get_type'] == 'course'){
        $get_data = $user_func->get_teachercourse($request_data['course_post']);
        $output=array("code"=>"200", "data" => $get_data);
        echo json_encode($output);
    }
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}
elseif($request_data['action'] == 'remove_teacher'){
    $get_data = $user_func->remove_teacher($request_data['id_linebot_teacher']);
    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
    file_put_contents('log.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

}

?>