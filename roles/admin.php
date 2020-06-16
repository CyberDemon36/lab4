<?php
session_start();

require "../check.php";

if (!($user->isAdmin())){
    exit(header("Location: /error404/"));
}
if ($_POST["to_search"]){
    header("Location: ../search.php");
}
?>
<?php if ($_SESSION["deletion"] == true) : ?>
    <p style="color: green;"> <?php echo "User №". $_SESSION["id_deleted"] ." successfully deleted! "; ?> </p>
<?php endif;?>

<?php
require "../change_lang.php";
?>
<html>
    <form method="POST">
        <input type="submit" name="to_search" value="Go to search">
    </form>
</html>
<?php
require "../create.php";
require "../read.php";
?>

