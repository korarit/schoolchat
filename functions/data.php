<?php
namespace SW\Function;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php'); 

use SW\Function\configs;

class data {
    public function get_board($course){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM board where course='$course' and remove_post='0'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function post_board($post_course, $post_title, $post_data, $post_image, $data_file, $post_by, $line_userid, $postdate){
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("INSERT INTO board (course, title, data ,preview, data_file, post_by, line_userid, post_date) VALUES ('$post_course', '$post_title', '$post_data', '$post_image', '$data_file', '$post_by', '$line_userid', '$postdate')");
        $conn->close();        
    }

    public function get_courseall(){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM course");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function getdata_for_overview(){

        $config = new configs();
        $num = [];

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $all = $conn->query("SELECT id FROM user");
        $all_num = $all->num_rows;

        $g1 = $conn->query("SELECT id FROM user Where grade='1'");
        $num['m1'] = $g1->num_rows;
        
        $g2 = $conn->query("SELECT id FROM user Where grade='2'");
        $num['m2'] = $g2->num_rows;
        
        $g3 = $conn->query("SELECT id FROM user Where grade='3'");
        $num['m3'] = $g3->num_rows;

        $g4 = $conn->query("SELECT id FROM user Where grade='4'");
        $num['m4'] = $g4->num_rows;

        $g5 = $conn->query("SELECT id FROM user Where grade='5'");
        $num['m5'] = $g5->num_rows;

        $g6 = $conn->query("SELECT id FROM user Where grade='6'");
        $num['m6'] = $g6->num_rows;
        $conn->close();

        return $num;

    }

    public function get_dialogflow_addintent($name_intent, $display_name, $input_text, $output_text){
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("INSERT INTO dialogflow (name_intent, display_name, input_text, output_text) VALUES ('$name_intent', '$display_name','$input_text', '$output_text')");
        $conn->close();
    }


    public function get_dialogflow_intent(){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM dialogflow");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }
    public function dialogflow_have_intent($display_name){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT id FROM dialogflow where display_name='$display_name'");
        $row = $result->num_rows;

        if($row == 0){
            return "not_have";
        }else{
            return "have";
        }
        $conn->close();

    }

    public function get_name_intent($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT name_intent FROM dialogflow where id='$id'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data[0]["name_intent"];

    }

    public function remove_intent($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("DELETE FROM dialogflow where id='$id'");
        $conn->close();

        return $data;

    }

    //ส่วนสำหรับ สื่อการสอน
    public function get_media($course, $grade, $class){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM media where course='$course' and grade='$grade' and class='$class' and media_remove='0'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }
    public function get_media_lineid($line_userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM media where line_userid='$line_userid'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function post_media($post_course, $post_title, $post_data, $post_image, $data_file, $type_file, $grade, $class, $post_by, $line_userid){

        $postdate = date("Y-m-d");
        $config_func = new configs();

        $conn = new \mysqli($config_func->database('host'), $config_func->database('user'), $config_func->database('password'), $config_func->database('database'));
        $result = $conn->query("INSERT INTO media (course, name, data, preview, file, type_file, grade, class, post_by, line_userid, post_date) VALUES ('$post_course', '$post_title', '$post_data', '$post_image', '$data_file', '$type_file', '$grade', '$class', '$post_by', '$line_userid', '$postdate')");
        $conn->close();        
    }

    //ส่วนหรับ dashboard กลุ่มสาระ
    public function getall_course(){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT course, name_course FROM course");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function post_course($name_course_eng, $name_course_thai, $about_course, $file_name){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("INSERT INTO course (course, name_course, about_course, banner_course) VALUES ('$name_course_eng', '$name_course_thai', '$about_course', '$file_name')");
        $conn->close();

        return $result;

    }

    public function getabout_course(){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM course");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function get_course_byid($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM course where id='$id'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function remove_course($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("DELETE FROM course where id='$id'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }
}
?>