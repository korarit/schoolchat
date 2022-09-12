<?php
namespace SW\Function;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\Function\configs;

class leave {

    public function add_data($user_id, $line_userid, $name, $type, $reason, $premise, $grade, $class, $start_date, $end_start){
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("INSERT INTO leave_data (user_id, line_userid, name ,type, reason, premise, grade, class, start_date, end_date) VALUES ('$user_id', '$line_userid', '$name', '$type', '$reason', '$premise', '$grade', '$class', '$start_date', '$end_start')");
        $conn->close();        
    }

    public function get_data($grade, $class_student){
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("SELECT id, name, type, reason, premise, grade, class, start_date, end_date FROM leave_data where grade='$grade' and class='$class_student'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function get_byid($id){
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("SELECT id, name, type, reason, premise, grade, class, start_date, end_date FROM leave_data where id='$id'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }
}
?>