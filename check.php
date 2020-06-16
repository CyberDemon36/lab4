<?php
session_start();
require "classes.php";


$user=auth($_SESSION);

if ($user == null){
    header("Location: ../authorization.php");
}
if($_POST["exit"]){ 

    session_destroy();
    header("Location: ../authorization.php");
}
if (empty($user->getLang())){
    header("Location: ../foo_user.php");
}
?>
