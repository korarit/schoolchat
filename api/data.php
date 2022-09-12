<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/data.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/dialogflow/dialogflow.php');

use SW\function\data;
use SW\function\dialogflow;

$data_func = new data();
$dialogflow_func = new dialogflow();

$request_data=json_decode(file_get_contents("php://input"), true);

if($request_data['action'] == 'add_course'){

    $get_filename_banner = explode(".", $request_data['file_banner_name']);
    $name_filebanner = rand();
    $preview = $name_filebanner.".".$get_filename_banner[1];

    file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/course/".$preview, file_get_contents($request_data['file_banner']));

    $data_func->post_course($request_data['name_course_eng'], $request_data['name_course_thai'], $request_data['about_course'], "/uploads/course/".$preview);
}
elseif($request_data['action'] == 'getdata_for_dashboard'){

    $get_data = $data_func->getabout_course();

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}
elseif($request_data['action'] == 'remove_course'){

    $get_data = $data_func->remove_course($request_data['id']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}

elseif($request_data['action'] == 'get_data_byid'){

    $get_data = $data_func->get_course_byid($request_data['id']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}

//overview dashboard
elseif($request_data['action'] == 'getdata_for_overview'){
    $get_data = $data_func->getdata_for_overview();

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}

//dialogflow 
elseif($request_data['action'] == 'getdata_for_dialogflow'){

    $get_data = $data_func->get_dialogflow_intent();

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}
elseif($request_data['action'] == 'dialogflow_have_intent'){

    $get_data = $data_func->dialogflow_have_intent($request_data['name_intent']);

    $output=array("code"=>"200", "data" => $get_data);
    echo json_encode($output);
}
elseif($request_data['action'] == 'add_intent_dialogflow'){


    $name_intent = $dialogflow_func->add_intent($request_data['name_intent'], $request_data['input_intent'], $request_data['output_intent']);
    $data_func->get_dialogflow_addintent($name_intent, $request_data['name_intent'], $request_data['input_intent'], $request_data['output_intent']);

    $output=array("code"=>"200", "data" => $name_intent);
    echo json_encode($output);
}
elseif($request_data['action'] == 'remove_intent_dialogflow'){


    $name_intent = $data_func->get_name_intent($request_data['ids']);
    $dialogflow_func->remove_intent($name_intent);

    $output=array("code"=>"200", "data" => $name_intent);
    $data_func->remove_intent($request_data['ids']);
    echo json_encode($output);
}
?>