<?php
require "db.php";

$name = $_POST['name'];
$surname = $_POST['surname'];
$lang = $_POST['lang'];

$name = htmlspecialchars($name);
$surname = htmlspecialchars($surname);
$lang = htmlspecialchars($lang);




    if( !empty($name) && !empty($surname) && !empty($lang) ) {
    $query = sprintf("SELECT * FROM users WHERE name='%s' and surname='%s' and lang='%s'",
            mysqli_real_escape_string($connection, $name),
            mysqli_real_escape_string($connection, $surname),
            mysqli_real_escape_string($connection, $lang));
    }
    else if (!empty($name) && !empty($surname) && empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE name='%s' and surname='%s'",
            mysqli_real_escape_string($connection, $name),
            mysqli_real_escape_string($connection, $surname));
    }
    else if (!empty($name) && empty($surname) && !empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE name='%s' and lang='%s'",
            mysqli_real_escape_string($connection, $name),
            mysqli_real_escape_string($connection, $lang));
    }
    else if (empty($name) && !empty($surname) && !empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE surname='%s' and lang='%s'",
            mysqli_real_escape_string($connection, $surname),
            mysqli_real_escape_string($connection, $lang));
    }
    else if (!empty($name) && empty($surname) && empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE name='%s'",
            mysqli_real_escape_string($connection, $name));
    }
    else if (empty($name) && !empty($surname) && empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE surname='%s'",
            mysqli_real_escape_string($connection, $surname));
    }
    else if (empty($name) && empty($surname) && !empty($lang)) {
        $query = sprintf("SELECT * FROM users WHERE lang='%s'",
            mysqli_real_escape_string($connection, $lang));
    }
    

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

$data = array();
while ($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}
echo json_encode($data);
?>