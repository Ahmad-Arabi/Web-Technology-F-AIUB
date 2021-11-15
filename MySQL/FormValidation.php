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

			$pres = $_POST['presadd'];
			$perm = $_POST['permadd'];
			$phone = $_POST['phone'];
			$em = $_POST['email'];
			$web = $_POST['github'];
			
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
			else if ($relig=='emp')
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
				$fname = sanitize($_POST['firstname']);
				$lname = sanitize($_POST['lastname']);
				$gender = sanitize($_POST['gender']);
				$em = sanitize($_POST["email"]);
				$username = sanitize($_POST['username']);

				if (!filter_var($em, FILTER_VALIDATE_EMAIL))
				{
				  $emailErr = "Invalid email format";
				  echo $emailErr;
				}
				else
				{

					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "test";

					$conn = new mysqli($servername, $username, $password, $dbname);

					if ($conn->connect_error)
					{
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "INSERT INTO Users (firstname, lastname,gender,dob,religion,presadd,permadd,phone,email,github,username,password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ssssssssssss", $fname, $lname, $gender, $dob, $relig, $pres, $perm, $phone, $em, $web, $username, $pw);
					$res = $stmt->execute();
					
					if ($res)
					{
						echo "Data insertion successful";
					}
					else
					{
						echo "Failed to insert data";
					}

					$conn->close();
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
	<br><br>
	<a href="Registration.html">Registration</a>  ||  <a href="Login.php">Sign-in</a>
	<br><br>
</body>
</html>