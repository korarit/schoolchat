<?php
//set time zone to thai
date_default_timezone_set('Asia/Bangkok');

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/user.php');

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

//function
use SW\Function\configs;
use SW\Function\user;

$config_func = new configs();
$user_func = new user();

$request_data=json_decode(file_get_contents("php://input"), true);

$httpClient = new CurlHTTPClient($config_func->Botline('channel_access'));
$bot = new LINEBot($httpClient, ['channelSecret' => $config_func->Botline('channel_secret')]);

//ส่ง brocast เป็น ข้อความ
if($request_data['action'] == 'brocast_text'){

    if($request_data['type_brocast'] == 'all'){
        $msg = new TextMessageBuilder($request_data['brocast_data']);
        $bot->broadcast($msg);
    }
    elseif($request_data['type_brocast'] == 'grade'){

        $list_lineuserid = json_encode($user_func->get_lineuserid_bygrade($request_data['grade_brocast']));
        $msg = new TextMessageBuilder($request_data['brocast_data']);
        $bot->multicast($list_lineuserid, $msg);

        echo $get_data;
    }
    elseif($request_data['type_brocast'] == 'class'){

        $list_lineuserid = $user_func->get_lineuserid_byclass($request_data['grade_brocast'], $request_data['class_brocast']);
        $msg = new TextMessageBuilder($request_data['brocast_data']);
        $bot->multicast($list_lineuserid, $msg);
    }
}
//ส่ง brocast เป็น รูปภาพ
elseif($request_data['action'] == 'brocast_image'){
    if($request_data['type_brocast'] == 'all'){

        $name_file = rand();
        $get_filename = explode(".", $request_data['file_name']);
        $data_file = $name_file.".".$get_filename[1];

        file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/line_brocast/".$data_file, file_get_contents($request_data['filedata']));

        $msg = new ImageMessageBuilder($config_func->domain()."/uploads/line_brocast/".$data_file, $config_func->domain()."/uploads/line_brocast/".$data_file);
        $bot->broadcast($msg);
    }
    elseif($request_data['type_brocast'] == 'grade'){

        $list_lineuserid = $user_func->get_lineuserid_bygrade($request_data['grade_brocast']);

        $name_file = rand();
        $get_filename = explode(".", $request_data['file_name']);
        $data_file = $name_file.".".$get_filename[1];

        file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/line_brocast/".$data_file, file_get_contents($request_data['filedata']));

        $msg = new ImageMessageBuilder($config_func->domain()."/uploads/line_brocast/".$data_file, $config_func->domain()."/uploads/line_brocast/".$data_file);
        $bot->multicast($list_lineuserid, $msg);
        
    }
    elseif($request_data['type_brocast'] == 'class'){
        $list_lineuserid = $user_func->get_lineuserid_byclass($request_data['grade_brocast'], $request_data['class_brocast']);

        $name_file = rand();
        $get_filename = explode(".", $request_data['file_name']);
        $data_file = $name_file.".".$get_filename[1];

        file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/line_brocast/".$data_file, file_get_contents($request_data['filedata']));

        $msg = new ImageMessageBuilder($config_func->domain()."/uploads/line_brocast/".$data_file, $config_func->domain()."/uploads/line_brocast/".$data_file);
        $bot->multicast($list_lineuserid, $msg);
    }
}
?>