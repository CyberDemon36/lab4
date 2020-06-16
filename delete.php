<?php
session_start();
require_once "db.php";

if($_SESSION["role"] != "1") {
    header("Location: /error404/");
}
if ( isset($_GET['id']) and !empty($_GET['id']) ) {

	$id = mysqli_real_escape_string($connection, $_GET['id']);

	$query = "DELETE FROM users WHERE id=" . $id;

	if ( mysqli_query($connection, $query) ) {
		$_SESSION["deletion"] = true;
		$_SESSION["id_deleted"] = $_GET['id'];
		header("Location: roles/admin.php");
	}else {
		die("Error. Not deleting");
	}
}
?>