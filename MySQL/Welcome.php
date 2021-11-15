<?php
	session_start();
	if(count($_SESSION) === 0)
	{
		header("Location: Logout.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome</title>
</head>
<body>
	<h1>Welcome, <?php echo $_SESSION['name']?></h1><br><br>
	<hr>
	<a href="Logout.php">Logout</a>
</body>
</html>