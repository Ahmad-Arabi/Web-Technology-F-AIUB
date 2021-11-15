<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
	</head>
	<body>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

			<center>
				<h1>Sign-in</h1>
				<br>


				<fieldset>

					<legend align=center><b>Login</b></legend>
						<br>
					    <label>Username: </label>
						<input type="text" name="username">
						<br><br>

						<label>Password: </label>
						<input type="password" name="password">
						<br>

				</fieldset>
				<br>
				<a href="Registration.html">Registration</a>
				<br><br>
				<input type="submit" name="Login" value="Login">
				<br><br>
			</center>
		</form>

		<?php
			if($_SERVER['REQUEST_METHOD'] === "POST")
			{
				$username = $_POST['username'];
				$pw = $_POST['password'];

				if (empty($username))
				{
					echo "Please enter your username";
				}
				else if (empty($pw))
				{
					echo "Please enter your password";
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
					$un = $_POST['username'];
					$pw = $_POST['password'];

					$sql = "SELECT * FROM users WHERE username = ? and password = ?";

					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ss", $un, $pw);
					
					$res = $stmt->execute();

					if ($res)
					{
						$data = $stmt->get_result();

						if ($data->num_rows > 0)
						{
							session_start();
							$row = $data->fetch_assoc();
							$_SESSION['name'] = $row["firstname"]." ".$row["lastname"];
							header("Location: Welcome.php");
						}
						else
						{
							echo "User not found!";
						}
					}
					else
					{
						echo "Error while executing the statement";
					}

					$conn->close();
				}
			}
		?>


	</body>
</html>