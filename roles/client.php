<?php
session_start();

require "../check.php";

if (!isset($user)){
    exit(header("Location: /error404/"));
}
if ($_POST["to_edit"]){
    header("Location: ../edit_user.php");
}
require "../change_lang.php";
?>
<html>
    <form method="POST">
        <input type="submit" name="to_edit" value="Edit my profile">
    </form>
</html>

