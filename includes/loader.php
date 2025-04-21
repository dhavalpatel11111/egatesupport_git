<?php

# LOAD FUNCTIONS
require($scriptpath . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions.php');

spl_autoload_register('classAutoload');

# LOAD CONFIGURAGION FILE FILE
if(file_exists($scriptpath . DIRECTORY_SEPARATOR . "config.php")) require($scriptpath . DIRECTORY_SEPARATOR . 'config.php'); else { header("Location:install/index.php"); exit;}

# INITIALIZE MEDOO
$database = new medoo($DBconfig);
$param = array(
        'mode' => '',
        'format' => 'A4',
        'font_size' => 0,
        'font_default' => '',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 16,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'oriental' => 'P'
    );
$mpdf = new mPDF($param['mode'],$param['format'],$param['font_size'],$param['font_default'],
                $param['margin_left'],$param['margin_right'],$param['margin_top'],$param['margin_bottom'],
                $param['margin_header'],$param['margin_footer'],$param['oriental']);

# IF ROUTE IS EMPTY LOAD DEFAULT PAGE (DASHBOARD)
if (empty($_GET['route'])) $route = "dashboard"; else $route = $_GET['route'];


# CHECK IF USER IS LOGGED IN, EXCEPT ON LOGIN OR RECOVER PASSWORD PAGE
if ($route != "login" && $route != "forgot") isLoggedIn();

#INITIALIZE LOGGED IN ADMIN ARRAY
if ($route != "login" && $route != "forgot") { $lia = $database->get("people", "*", ["sessionid" => session_id() ]); }

# STORE SECTION AND STATUS FROM GET
if (isset($_GET['section'])) $section = $_GET['section']; else $section = "";
if (isset($_GET['status'])) { $statuscode = $_GET['status']; $status = array(); $statusmessage = $database->get("statuscodes", "*", ["code" => $statuscode]); }

#INITIALIZA TIME AND DATE
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");

// LOGIN
if(isset($_POST['login'])) logIn($_POST['email'],$_POST['password']);
if(isset($_POST['resetConfirmation'])) resetConfirmation($_POST['email']);
if(isset($_POST['resetPassword'])) resetPassword($_POST['resetkey'],$_POST['password']);

# LOAD CONTROLLER
if(isset($lia['type'])) require('includes/controller-'.$lia['type'].'.php');


?>
