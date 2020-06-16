<?php
session_start();

require "../check.php";

if ($user->isClient()){
    exit(header("Location: /error404/"));
}
if ($_POST["to_search"]){
    header("Location: ../search.php");
}
require "../change_lang.php";
?>
<html>
    <form method="POST">
        <input type="submit" name="to_search" value="Go to search">
    </form>
</html>
<?php
require "../read.php";
?>
