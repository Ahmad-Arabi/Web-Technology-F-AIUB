<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
	</head>
	<body>
			
			<?php
				$handle = fopen("data.json", "r");
				$data = fread($handle, filesize("data.json"));

				$explode = explode("\n", $data);
				array_pop($explode);

				$arr1 = array();
				for($i = 0;$i<count($explode); $i++)
				{
					$json = json_decode($explode[$i]);
					array_push($arr1, $json);
				}
			?>



		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

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
					

			<input type="submit" name="submit">
			<br><br>
		</form>

		<?php
			if($_SERVER['REQUEST_METHOD'] === "GET" and count($_REQUEST)>0)
			{
				$username = $_GET['username'];
				$pw = $_GET['password'];

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
					$flag = 0;

					for($k = 0;$k<count($arr1);$k++)
					{
						if($_GET['username'] === $arr1[$k] -> username)
						{
							if($_GET['password'] === $arr1[$k] -> password)
							{
								$flag = 2;
								break;
							}
							else
							{
								$flag = 1;
								break;
							}
						}
					}
					if($flag==2)
					{
						header("Location: Welcome.php?firstname=" . $_GET['firstname']);
					}
					else if($flag==1)
					{
						echo "Password is incorrect!";
					}
					else
					{
						echo "User not found!";
					}
				}
			}
		?>


	</body>
</html>