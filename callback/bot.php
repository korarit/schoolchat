<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

//เรียกใช้ framework  ต่างๆ
require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/line.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/tem.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/data.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/dialogflow/dialogflow.php');

//เรียกใช้ line sdk
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;

use LINE\LINEBot\MessageBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\CarouselColumnTemplateBuilder;

use LINE\LINEBot\RichMenuBuilder;

//เรียกใช้ function ที่เขียนเอง
use SW\Function\Line\LineMessage;

use SW\Function\configs;
use SW\Function\user;
use SW\Function\tem_massage;
use SW\Function\data;

//เรียกใช้ dialogflow
use SW\Function\dialogflow;


//เรียกใช้ function จากด้านบน
$config_func = new configs();
$user_func = new user();
$tem_func = new tem_massage();
$data_func = new data();

$line_func = new LineMessage();

//เรียกใช้ SW\Function\dialogflow
$dialogflow_func = new dialogflow();

//use line bot sdk
$httpClient = new CurlHTTPClient($config_func->Botline('channel_access'));
$bot = new LINEBot($httpClient, ['channelSecret' => $config_func->Botline('channel_secret')]);

//get input data
$data = file_get_contents('php://input');
$data_json = json_decode($data,true);

//logs line data
file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

//ดึง ประเภท
$type = $data_json['events'][0]['type'];
//ดึง user_id
$user_id = $data_json['events'][0]['source']['userId'];

$token = $data_json['events'][0]['replyToken'];
if($type == "follow"){

    $token = $data_json['events'][0]['replyToken'];

    //เช็คว่าเคยเชื่อมกับ bot ยัง
    if($user_func->check_register($user_id) == false){
        //send richmenu register to user
        $bot->linkRichMenu($user_id, $config_func->get_richmenu("register"));
    }else{
        if($user_func->check_Usertype($user_id) == "student"){

            $bot->unlinkRichMenu($user_id);
            
            $bot->linkRichMenu($user_id, $config_func->get_richmenu("student"));

        }
        elseif($user_func->check_Usertype($user_id) == "teacher"){
            
            $bot->unlinkRichMenu($user_id);

            $bot->linkRichMenu($user_id, $config_func->get_richmenu("teacher"));

        }
    }
}
//เช็คว่า เป็น type postback
if($type == 'postback'){

}
//เช็คว่า เป็น type massage
if($type == 'message'){

    $type_massage = $data_json['events'][0]['message']['type'];
    if($type_massage == 'text'){
        $message = $data_json['events'][0]['message']['text'];

        if(str_contains($message, 'สมัครใช้ chatbot')){
            $explode_message = explode(" : ", $message);

            if($user_func->check_Usertype($user_id) == "student"){

                $bot->unlinkRichMenu($user_id);
                $getuser_name = $user_func->getdata_regiser($user_id);
                file_put_contents('log.txt', json_encode($getuser_name) . PHP_EOL, FILE_APPEND);
                $name = $getuser_name[0]['name'].' '.$getuser_name[0]['lastname'];
                $profile = json_decode($line_func->getProfile($user_id), true);

                $class = $user_func->get_grade($user_id)."/".$user_func->get_class($user_id);

                $replyJson = $tem_func->tem_register_student($token, $config_func->line_template('welcome', 'background'), $profile["pictureUrl"], $name, $config_func->line_template('welcome', 'url_project'), $class);
                $line_func->sendMessageOnJson($replyJson);
                $bot->linkRichMenu($user_id, $config_func->get_richmenu("student"));

            }
            elseif($user_func->check_Usertype($user_id) == "teacher"){
                
                $bot->unlinkRichMenu($user_id);

                $getuser_data = $user_func->getdata_regiser($user_id);
                $teacher_data = $user_func->getdata_teacher($user_id);

                file_put_contents('log.txt', json_encode($getuser_name) . PHP_EOL, FILE_APPEND);
                $name = $getuser_name[0]['name'].' '.$getuser_name[0]['lastname'];
                $profile = json_decode($line_func->getProfile($user_id), true);

                $replyJson = $tem_func->tem_register_teacher($token, $config_func->line_template('welcome', 'background'), $profile["pictureUrl"], $name, $config_func->line_template('welcome', 'url_project'), $getuser_name[0]['course']);
                $line_func->sendMessageOnJson($replyJson);
                $bot->linkRichMenu($user_id, $config_func->get_richmenu("teacher"));

            }
            elseif($user_func->check_Usertype($user_id) == "Management"){
                $replyJson = new TextMessageBuilder('student:'.$explode_message[1]);
                $bot->replyMessage($token, $msg);
                //$bot->linkRichMenu($user_id, $config_func->get_richmenu("Management"));
            }
            elseif($user_func->check_Usertype($user_id) == "admin"){
                
            }

        }
        elseif($message == 'ข่าวประชาสัมพันธ์'){

            if($user_func->check_Usertype($user_id) == "student"){

                $data = $data_func->get_courseall();

                $board_list = [];
                $board_list["replyToken"] = $token;
                $board_list["messages"][0]["type"] = "flex";
                $board_list["messages"][0]["altText"] = "เลือกกลุ่มสาระ เพื่อดูข่าวประชาสัมพันธ์";
                $board_list["messages"][0]["contents"] = $tem_func->generate_board($data);

                //$send_msg = file_get_contents("template_board.json");
                $send_msg = json_encode($board_list);

                file_put_contents('logss.txt', ($send_msg) . PHP_EOL, FILE_APPEND);
                $back = $line_func->sendMessageOnJson($send_msg);

                file_put_contents('logsss.txt', ($back) . PHP_EOL, FILE_APPEND);

            }
            elseif($user_func->check_Usertype($user_id) == "teacher"){
                $teacher_data = $user_func->getdata_teacher($user_id);

                $send_msg = json_encode($tem_func->teacher_board($token, $teacher_data[0]['course']));

                file_put_contents('logss.txt', ($send_msg) . PHP_EOL, FILE_APPEND);
                $back = $line_func->sendMessageOnJson($send_msg);

                file_put_contents('logsss.txt', ($back) . PHP_EOL, FILE_APPEND);
            }
        }
        elseif($message == 'ดูข่าวประชาสัมพันธ์สำหรับครู'){

            if($user_func->check_Usertype($user_id) == "teacher"){
                
                $data = $data_func->get_courseall();

                $board_list = [];
                $board_list["replyToken"] = $token;
                $board_list["messages"][0]["type"] = "flex";
                $board_list["messages"][0]["altText"] = "เลือกกลุ่มสาระ เพื่อดูข่าวประชาสัมพันธ์";
                $board_list["messages"][0]["contents"] = $tem_func->generate_board($data);

                //$send_msg = file_get_contents("template_board.json");
                $send_msg = json_encode($board_list);

                file_put_contents('logss.txt', ($send_msg) . PHP_EOL, FILE_APPEND);
                $back = $line_func->sendMessageOnJson($send_msg);

                file_put_contents('logsss.txt', ($back) . PHP_EOL, FILE_APPEND);

            }
        }
        elseif($message == 'สื่อการสอน'){

            if($user_func->check_Usertype($user_id) == "student"){

                $user_data = $user_func->getuserdata_formedia($user_id);
                $data = $data_func->get_courseall();

                $board_list = [];
                $board_list["replyToken"] = $token;
                $board_list["messages"][0]["type"] = "flex";
                $board_list["messages"][0]["altText"] = "เลือกกลุ่มสาระ เพื่อดูสื่อการสอน";
                $board_list["messages"][0]["contents"] = $tem_func->generate_media($data, $user_data[0]['grade'], $user_data[0]['class']);

                //$send_msg = file_get_contents("template_board.json");
                $send_msg = json_encode($board_list);

                file_put_contents('logss.txt', ($send_msg) . PHP_EOL, FILE_APPEND);
                $back = $line_func->sendMessageOnJson($send_msg);

                file_put_contents('logsss.txt', ($back) . PHP_EOL, FILE_APPEND);
            }
            elseif($user_func->check_Usertype($user_id) == "teacher"){
                $teacher = $user_func->getdata_teacher($user_id);
                $send_msg = json_encode($tem_func->teacher_media($token, $teacher[0]['course'], $teacher[0]['line_userid']));

                file_put_contents('logss.txt', ($send_msg) . PHP_EOL, FILE_APPEND);
                $back = $line_func->sendMessageOnJson($send_msg);

                file_put_contents('logsss.txt', ($back) . PHP_EOL, FILE_APPEND);
            }
        }elseif($message == 'เพิ่มข้อมูลลง dialogflow'){
            $dialogflow_func->add_intent('3', 'แม่ง', 'อะไรว่ะ');
        }else{
                $ai = $dialogflow_func->detect_intent_texts($config_func->dialogflow("project_id"), $message, '123456');

                if($ai["status"] == "is_confidence"){
                    if($ai["confidence"] >= 60){
                        $msg = new TextMessageBuilder($ai["get_text"]);
                        $bot->replyMessage($token, $msg);
                    }else{
                        $msg = new TextMessageBuilder($ai["get_text"]);
                        $bot->replyMessage($token, $msg);
                    }
                }else{
                    $msg = new TextMessageBuilder('ฉันไม่เข้าใจขออภัยด้วย');
                    $bot->replyMessage($token, $msg);
                }

        }
    }
}
?>