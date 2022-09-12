<?php
namespace SW\Function\Line;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\Function\configs;

class LineMessage {
    
    public function sendMessageOnJson($replyJson){
        $config = new configs();

        $ch = curl_init("https://api.line.me/v2/bot/message/reply");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $config->BotLine('channel_access'))
            );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getProfile($line_userid){
        $config = new configs();

        $ch = curl_init("https://api.line.me/v2/bot/profile/".$line_userid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $config->BotLine('channel_access'))
            );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function Create_richMenu($replyJson){
        $config = new configs();

        $ch = curl_init("https://api.line.me/v2/bot/richmenu");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $config->BotLine('channel_access'))
            );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function upload_richMenu($image, $rich_id){
        $config = new configs();

        $ch = curl_init("https://api-data.line.me/v2/bot/richmenu/".$rich_id."/content");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: image/png',
            'Authorization: Bearer ' . $config->BotLine('channel_access'))
            );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $image);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function verify_access_token($token){
        $ch = curl_init("https://api.line.me/oauth2/v2.1/verify?access_token=".$token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $result['client_id'];
    }

}

?>