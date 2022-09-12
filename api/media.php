<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/data.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/line.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\function\data;
use SW\Function\Line\LineMessage;
use SW\function\configs;

$data_func = new data();
$line_func = new LineMessage;
$config_func = new configs();

$request_data=json_decode(file_get_contents("php://input"), true);

    if($request_data['action'] == 'get_data'){
        //if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){

            $get_data = $data_func->get_media($request_data['course_post'], $request_data['grade_post'], $request_data['class_student']);

            $output=array("code"=>"200", "count_data" => count($get_data),"data" => $get_data);
            echo json_encode($output);
            file_put_contents('log_board.txt', json_encode($output) . PHP_EOL, FILE_APPEND);

        //}
    }
    if($request_data['action'] == 'get_data_by_lineid'){
        //if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){

            $get_data = $data_func->get_media_lineid($request_data['lineid']);

            $output=array("code"=>"200", "count_data" => count($get_data),"data" => $get_data);
            echo json_encode($output);
            file_put_contents('log_board.txt', json_encode($request_data['lineid']) . PHP_EOL, FILE_APPEND);

        //}
    }
    elseif($request_data['action'] == 'postmedia_not_upload'){

        if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){
            $postdate = date("Y-m-d");

            $get_filename_show = explode(".", $request_data['file_show']);
            $name_fileshow = rand();
            $preview = $name_fileshow.".".$get_filename_show[1];

            file_put_contents('logss.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/media/preview/".$preview, file_get_contents($request_data['post_image']));

            $data_func->post_media($request_data['post_course'], $request_data['post_title'], $request_data['post_data'], "/uploads/media/preview/".$preview, $request_data['file_data'], $request_data['type_file'], $request_data['grade'], $request_data['class_student'], $request_data['post_by'], $request_data['line_userid']);
        }
    }
    elseif($request_data['action'] == 'postmedia_upload'){

        
        if($line_func->verify_access_token($request_data['access_token']) == $config_func->line_access_token()){

            $postdate = date("Y-m-d");

            $get_filename_show = explode(".", $request_data['file_show']);
            $get_filename_data = explode(".", $request_data['filename_data']);

            $name_fileshow = rand();
            $name_filedata = rand();

            $preview = $name_fileshow.".".$get_filename_show[1];
            $data_file = $name_filedata.".".$get_filename_data[1];

            file_put_contents('logss.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/media/preview/".$preview, file_get_contents($request_data['post_image']));
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/media/data/".$data_file, file_get_contents($request_data['data_file']));


            $data_func->post_media($request_data['post_course'], $request_data['post_title'], $request_data['post_data'], "/uploads/media/preview/".$preview, "/uploads/media/data/".$data_file, $request_data['type_file'], $request_data['grade'], $request_data['class_student'], $request_data['post_by'], $request_data['line_userid']);
        }
    }

?>