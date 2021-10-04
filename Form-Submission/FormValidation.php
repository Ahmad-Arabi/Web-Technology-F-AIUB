<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form in HTML</title>
</head>
<body>

	<?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$fname = $_POST['firstname'];
			$lname = $_POST['lastname'];
			$dob = $_POST['dob'];
			$relig = $_POST['religion'];
			$em = $_POST['email'];
			$username = $_POST['username'];
			$pw = $_POST['password'];

			if (empty($fname))
			{
				echo "Please enter your first name";
			}
			else if (empty($lname))
			{
				echo "Please enter your last name";
			}
			else if(!isset($_POST['gender']))
			{
				echo "Please enter your gender"; 
			}
			else if (empty($dob))
			{
				echo "Please enter date of birth";
			}
			else if ($relig[0]=='emp')
			{
				echo "Please enter your religion";
			}
			else if (empty($em))
			{
				echo "Please enter your email";
			}
			else if (empty($username))
			{
				echo "Please enter your username";
			}
			else if (empty($pw))
			{
				echo "Please enter your password";
			}
			else
			{
				$em = sanitize($_POST["email"]);
				if (!filter_var($em, FILTER_VALIDATE_EMAIL))
				{
				  $emailErr = "Invalid email format";
				  echo $emailErr;
				}
				else
				{
					echo "Successful!!";
				}
			}
		} 

		function sanitize($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>

</body>
</html>