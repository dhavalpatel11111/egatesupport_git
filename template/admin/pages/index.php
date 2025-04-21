<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if ( function_exists( 'date_default_timezone_set' ) ) {
    date_default_timezone_set('Asia/Manila');
}
//die('test');
$scriptpath = __DIR__;

# APP LOADER
require($scriptpath . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'loader.php');

if($route == "login") {
    require($scriptpath . DIRECTORY_SEPARATOR . 'template'. DIRECTORY_SEPARATOR .$route.'.html');
}
elseif($route == "forgot") {
    require($scriptpath . DIRECTORY_SEPARATOR . 'template'. DIRECTORY_SEPARATOR . $route.'.html');
}
elseif($route == "reports/view") {
    require($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR .$lia['type']. DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route.'.html');
}
else {
    require($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'header.html');
    require($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.html');
    require($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'footer.html');
}

?>
