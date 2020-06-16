<?php
session_start();
require_once "db.php";

if($_SESSION["role"] != "3") {
    header("Location: /error404/");
}
if ( isset($_SESSION["id"]) && !empty($_SESSION["id"]) ) {

	$current_user_id = mysqli_real_escape_string($connection, $_SESSION["id"]);

	$query = "SELECT * FROM users WHERE id=" . $current_user_id;
	$req = mysqli_query($connection, $query);
	$user_data = mysqli_fetch_assoc($req);

	if (empty($user_data)) {
		header("Location: 404.php");
	}
}
if ( isset($_POST['submit']) ) {

	$id = mysqli_real_escape_string($connection, $_SESSION["id"]);

	$name = $_POST['name'];
	$surname = $_POST['surname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
	$lang = $_POST['lang'];
	

	$query = "UPDATE users SET" . " ";
	$query .= "name = '{$name}', ";
	$query .= "surname = '{$surname}', ";
    $query .= "login = '{$login}', ";
    $query .= "password = '{$password}', ";
    $query .= "lang = '{$lang}'";
	$query .= " ". "WHERE id=" . $id;
   

	if ( mysqli_query($connection, $query) ) {
        // header("Location: roles/client.php");
        session_destroy();
        header("Location: authorization.php");
        
	}else {
		die("Error. Not creating");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
</head>
<body>

	<h1>Edit (after the change, you need to log in again!)</h1>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo isset($user_data) ? $user_data['id'] : ""; ?>" method="post">
		<input name="name" 
			   type="text" 
			   placeholder="name" 
			   required 
			   value="<?php echo isset($user_data) ? $user_data['name'] : ""; ?>">

		<input
			name="surname" 
			type="text" 
			placeholder="surname" 
			required
			value="<?php echo isset($user_data) ? $user_data['surname'] : ""; ?>">
            
        <input
			name="login" 
			type="text" 
			placeholder="login" 
			required
			value="<?php echo isset($user_data) ? $user_data['login'] : ""; ?>"> 

        <input
			name="password" 
			type="text" 
			placeholder="password" 
			required
			value="<?php echo isset($user_data) ? $user_data['password'] : ""; ?>">
        
        <select name="lang" value="<?php echo isset($user_data) ? $user_data['lang'] : ""; ?>">
            <option value="ru">Русский</option>
            <option value="ua">Українська</option>
            <option value="en">English</option>
            <option value="it">Italiano</option>
        </select>


		<input name="submit" type="submit" value="Create">
	</form>
	
</body>
</html>