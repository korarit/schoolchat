<?php
namespace SW\Function;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\Function\configs;

class user {

    public function add_user($type_user, $user_id, $card_id, $name_user, $lastname, $grade_student, $class_student, $phone_parent){

        $date_add = date("Y-m-d");

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("INSERT INTO user (user_id, card_id, name, lastname, phone_parent, grade, class, type_user, start_date) VALUES ('$user_id', '$card_id','$name_user','$lastname', '$phone_parent', '$grade_student','$class_student','$type_user', '$date_add');");
        $conn->close();

    }

    
    public function add_teacher($teacher_id, $line_userid, $course_teach, $grade_teach, $class_teach, $level){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("INSERT INTO teacher (user_id, line_userid, course, teach_grade, teach_class, levels) VALUES ('$teacher_id', '$line_userid', '$course_teach','$grade_teach','$class_teach','$level')");
        $conn->close();

        return $result;
    }

    public function remove_teacher($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("DELETE FROM teacher where id='$id'");
        $conn->close();

    }

    public function user_register($userid, $card_id, $line_userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT user_id FROM user where user_id='$userid' and card_id='$card_id'");
        $row = $result->num_rows;
        
        if($row == 1){
            $conn->query("UPDATE user SET register='1', line_userid='$line_userid' where user_id='$userid' and card_id='$card_id'");
            return "register_success";
        }else{
            return "not_student";
        }
        $conn->close();
    }

    public function check_register($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT register FROM user where line_userid='$userid'");
        $row = $result->num_rows;
        $conn->close();

        if($row == 0){
            return false;
        }else{
            return true;
        }

    }

    public function check_Usertype($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT type_user FROM user where line_userid='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["type_user"];

    }

    public function remove_user($id){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("DELETE FROM user where id='$id'");
        $conn->close();

    }

    public function get_name($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT name, lastname FROM user where line_userid='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["name"]." ".$data["lastname"];

    }

    public function get_grade($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT grade FROM user where line_userid='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["grade"];

    }

    public function get_lineuserid($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT line_userid FROM user where user_id='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["line_userid"];

    }


    public function get_phone_parent($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT phone_parent FROM user where line_userid='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["phone_parent"];

    }

    public function get_lineuserid_bygrade($grade){

        $array = [];
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT line_userid FROM user where grade='$grade'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        $i = 0;
        foreach($data as $list){
            $array[$i] = $list['line_userid'];

            $i += 1;
        }

        return $array;

    }

    public function get_lineuserid_byclass($grade, $class){

        $array = [];
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT line_userid FROM user where grade='$grade' and class='$class'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        $i = 0;
        foreach($data as $list){
            $array[$i] = $list['line_userid'];
            $i += 1;
        }

        return $array;

    }

    public function get_dataforleave($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT user_id, grade, class, name, lastname FROM user where line_userid='$userid'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function getuserdata_formedia($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT name, lastname, grade, class FROM user where line_userid='$userid'");
        $data = $result->fetch_all(MYSQLI_ASSOC);


        $conn->close();

        return $data;

    }
    

    public function getdata_regiser($userid){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT name, lastname, grade, class FROM user where line_userid='$userid'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function getdata_teacher($userid){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM teacher where line_userid='$userid'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;

    }

    public function get_class($userid){

        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT class FROM user where line_userid='$userid'");
        $data = $result->fetch_assoc();
        $conn->close();

        return $data["class"];

    }

    //สำหรับ dashboard user
    public function dashboard_all(){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT id, user_id, name, lastname, phone_parent, grade, class, type_user FROM user");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;
    }

    public function dashboard_grade($grade){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT id, user_id, name, lastname, phone_parent, grade, class, type_user FROM user where grade='$grade'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        
        return $data;
    }

    public function dashboard_class($grade, $class){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT id, user_id, name, lastname, phone_parent, grade, class, type_user FROM user where grade='$grade' and class='$class'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;
    }

    //สำหรับ teacher
    public function get_teacherall(){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM teacher");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;
    }

    public function get_teachercourse($course){
        $config = new configs();

        $conn = new \mysqli($config->database('host'), $config->database('user'), $config->database('password'), $config->database('database'));
        $result = $conn->query("SELECT * FROM teacher where course='$course'");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        return $data;
    }
}
?>