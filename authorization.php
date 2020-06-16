<?php
session_start();
require "db.php";

$login = $_POST["login"];
$password = $_POST["password"];
$submit = $_POST["submit"];

$mysqli = new mysqli ('localhost','root', '','user') or die(mysqli_error($mysqli));

$counter = 0;

if( isset($login) and isset($password) ){

    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);

    $query = sprintf("SELECT * FROM users WHERE login='%s' and password='%s'", 
        mysqli_real_escape_string($connection, $login),
        mysqli_real_escape_string($connection, $password));

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);    

    if( $count == 1 ){
        $arr = mysqli_fetch_assoc($result);
        $_SESSION = $arr;
        

        if($arr["role"] == "1"){
            header("Location: roles/admin.php");
        }
        else if($arr["role"] == "2"){
            header("Location: roles/manager.php");
        }
        else if($arr["role"] == '3'){
            header("Location: roles/client.php");
        }
    }
    else {
        echo "Connection error!";
    }
}

require "index.php";
?>