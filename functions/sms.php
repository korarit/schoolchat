<?php
namespace SW\Function;
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\Function\configs;

class sms {

    public function send_sms ($msg, $phone){
        $config_func = new configs();

        $array_sms = [];
        $array_sms["sender"] = "NICHE";
        $array_sms["msisdn"] = ["$phone"];
        $array_sms["message"] = $msg;

        $ch = curl_init("https://thsms.com/api/send-sms");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $config_func->sms_token())
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array_sms));

        $response = json_decode(curl_exec($ch), true);

        curl_close($ch);
        return $response;
    }

    public function get_credit(){
        $ch = curl_init("https://thsms.com/api/me");
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://thsms.com/api/me',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$config_func->sms_token(),
            'Content-Type: application/json'
        ),
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return $response;
    }
}
?>