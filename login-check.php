<?php
require_once('config.php');
$var_username = $_POST['frm_username'];
$var_password = $_POST['frm_password'];
$query = "select * from user 
        where user_name='" . $var_username . "' 
        AND 
        user_password='" . md5($var_password) . "' ";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

if ($rows > 0) {
    session_start();
    $data = mysql_fetch_array($result);
    $_SESSION['username'] = $data['user_name'];
    $_SESSION['password'] = $data['user_password'];
    header('location: index.php?hal=dashboard');
} else {
    header('location: login.php?action=failed');
}

