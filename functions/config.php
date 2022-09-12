<?php
namespace SW\Function;

class configs {

    public function Botline ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["line"][$get];
    }

    public function get_richmenu ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["line_richmenu"][$get];
    }

    public function line_liff ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["line_liff"][$get];
    }

    public function line_access_token (){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["line_liff_channel_id"];
    }

    public function line_template ($getfile, $get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/template/'.$getfile.".json"), true);

        return $json[$get];
    }

    public function image_template ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/image_template.json'), true);

        return $json[$get];
    }

    public function database ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["database"][$get];
    }

    public function domain (){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["domain"];
    }

    public function sms_token (){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["sms_token"];
    }

    public function dialogflow ($get){
        $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/config/main.json'), true);

        return $json["dialogflow"][$get];
    }
}
?>