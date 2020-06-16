<?php

require "db.php";

$query = "SELECT * FROM users";
$req = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
</head>
<body>
<?php if($user->isAdmin() or $user->isManager()): ?>
	<?php if ($req): ?>
			<?php while( $resp = mysqli_fetch_assoc($req) ): ?>
				<hr>
					<h3>
						Пользователь №<?php echo $resp['id']; ?>		
					</h3>

					<p>
						Name: <?php echo $resp['name']; ?>	
					</p>

					<p>
						Surname: <?php echo $resp['surname']; ?>
					</p>

					<p>
						Login: <?php echo $resp['login']; ?>
					</p>

					<p>
						Language: <?php echo $resp['lang']; ?>
					</p>

					<p>
						Role: <?php echo $resp['role']; ?>
					</p>
				<hr>

				<?php if ( $_SESSION['role'] == "1")  : ?>
					<a href="../edit.php?id=<?php echo $resp['id']; ?>">Edit</a>&nbsp;&nbsp;
					<a href="../delete.php?id=<?php echo $resp['id']; ?>">Delete</a>
				<?php endif; ?>

				<hr>
			<?php endwhile; ?>
		<?php else: ?>
			<p>Sorry none products</p>
		<?php endif; ?>
		<?php endif; ?>
</body>
</html>
