<?php
namespace SW\Function;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');
use SW\Function\configs;

class dashboard {

    public function dashboard_login($userid, $card_id){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM user where user_id='$userid' and card_id='$card_id'");
        $row = $result->num_rows;

        if($row == 1){
            return 'trues';
        }else{
            return 'falses';
        }
        $conn->close();
    }
}
?>