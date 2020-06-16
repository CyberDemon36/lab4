<?php
session_start();
require "db.php";

if( $_SESSION["role"] == "1" ){
   
    if ($_POST['submit']){
        $query = "INSERT INTO `users`(`login`, `password`, `name`, `surname`, `lang`, `role`) VALUES ('{$_POST["login"]}','{$_POST["password"]}'
        ,'{$_POST["name"]}','{$_POST["surname"]}','{$_POST["lang"]}','{$_POST["role"]}')";

        if(mysqli_query($connection,$query)){
            
            echo "Successful user creation";
        }
        else {
            echo "User creation error!";
        }
    }
}
else {
    header("Location: /error404/");
}

?>
<form method="post">
    <input type="submit" name="create" value="Create button">
</form>

<?php if ($_POST['create']) :?>

<form method="post">
    <h2>Create user</h2>
    <p><input type="text" name="login" placeholder="Login" required></p>
    <p><input type="text" name="password" placeholder="Password" required></p>
    <p><input type="text" name="name" placeholder="Name" required></p>
    <p><input type="text" name="surname" placeholder="Surname" required></p>
    <p><select name="lang" >
        <option value="ru">Русский</option>
        <option value="ua">Українська</option>
        <option value="en">English</option>
        <option value="it">Italiano</option>
    </select></p>
    <p><input type="text" name="role" placeholder="Role" required></p>
    <p><input type="submit" name="submit" value="Submit" required></p>
</form>

<?php endif; ?>