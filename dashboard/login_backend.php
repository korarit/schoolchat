<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"].'/functions/dashboard.php');

use SW\Function\dashboard;

$dashboard_func = new dashboard();

if( $_POST['user_id'] !='' && $_POST['cardID'] != '' ) {
    $user_id = $_POST['user_id'];
    $cardID = sha1($_POST['cardID']);
    if($dashboard_func->dashboard_login($user_id, $cardID) == 'trues'){
        $_SESSION["Login_dashboard"] = "login_true";

        Header("Location: teacher.php");
    }
    elseif($dashboard_func->dashboard_login($user_id, $cardID) == 'falses'){
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>Swal.fire(
            'รหัสผ่านหรือ passwordไม่ถูกต้อง!',
            'รหัสผ่านหรือ passwordไม่ถูกต้อง!',
            'error'
          )</script>";
    }
}else{
    
}
?>