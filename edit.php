<?php
session_start();
require_once "db.php";

if($_SESSION["role"] != "1") {
    header("Location: /error404/");
}
if ( isset($_GET['id']) && !empty($_GET['id']) ) {

	$current_course_id = mysqli_real_escape_string($connection, $_GET['id']);

	$query = "SELECT * FROM users WHERE id=" . $current_course_id;
	$req = mysqli_query($connection, $query);
	$course_data = mysqli_fetch_assoc($req);

	if (empty($course_data)) {
		header("Location: 404.php");
	}
}
if ( isset($_POST['submit']) ) {

	$id = mysqli_real_escape_string($connection, $_GET['id']);

	$name = $_POST['name'];
	$surname = $_POST['surname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
	$lang = $_POST['lang'];
	$role = $_POST['role'];

	$query = "UPDATE users SET" . " ";
	$query .= "name = '{$name}', ";
	$query .= "surname = '{$surname}', ";
    $query .= "login = '{$login}', ";
    $query .= "password = '{$password}', ";
    $query .= "lang = '{$lang}', ";
    $query .= "role = {$role}";
	$query .= " ". "WHERE id=" . $id;
   

	if ( mysqli_query($connection, $query) ) {
		header("Location: roles/admin.php");
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

	<h1>Edit </h1>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo isset($course_data) ? $course_data['id'] : ""; ?>" method="post">
		<input name="name" 
			   type="text" 
			   placeholder="name" 
			   required 
			   value="<?php echo isset($course_data) ? $course_data['name'] : ""; ?>">

		<input
			name="surname" 
			type="text" 
			placeholder="surname" 
			required
			value="<?php echo isset($course_data) ? $course_data['surname'] : ""; ?>">
            
        <input
			name="login" 
			type="text" 
			placeholder="login" 
			required
			value="<?php echo isset($course_data) ? $course_data['login'] : ""; ?>"> 

        <input
			name="password" 
			type="text" 
			placeholder="password" 
			required
			value="<?php echo isset($course_data) ? $course_data['password'] : ""; ?>">
        
        <select name="lang" value="<?php echo isset($course_data) ? $course_data['lang'] : ""; ?>">
            <option value="ru">Русский</option>
            <option value="ua">Українська</option>
            <option value="en">English</option>
            <option value="it">Italiano</option>
        </select>

        <select name="role" value="<?php echo isset($course_data) ? $course_data['role'] : ""; ?>">
            <option value="1">Admin</option>
            <option value="2">Manager</option>
            <option value="3">Client</option>
        </select>

		<input name="submit" type="submit" value="Create">
	</form>
	
</body>
</html>