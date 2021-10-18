<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Beneficiary</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<h1>Page 2 [Add Beneficiary]</h1>
		
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		
		<h3>Add Beneficiary:</h3>

		<label>Beneficiary Name: </label>
		<input type="text" name="name">

		<label>Mobile No: </label>
		<input type="text" name="phone">

		<input type="submit" name="submit">
		<br><br>

	</form>

</body>
</html>


<?php
	if($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$name = $_POST['name'];
		$phone = $_POST['phone'];		

		if (empty($name))
		{
			echo "Please fill up the form properly";
		}
		else if(empty($phone))
		{
			echo "Please fill up the form properly";
		}
		else
		{
			$handle = fopen("users.json", "a");
			$response = fwrite($handle, json_encode(array('name' => $name, 'phone' => $phone)). "\n");

			if($response)
			{
				$handle = fopen("users.json", "r");
				$data = fread($handle, filesize("users.json"));
				$exp = explode("\n", $data);

				$arr1 = array();
				for($i=0;$i<count($exp)-1;$i++)
				{
					$json = json_decode($exp[$i]);
					array_push($arr1, $json);
				}
				echo "<table border="."1".">";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Name</th>";
								echo "<th>Phone</th>";
							echo "</tr>";	
						echo "</thead>";
						echo "<tbody>";
				for($i=0;$i<count($exp)-1;$i++)
				{
							echo "<tr>";
								echo "<td>".$arr1[$i]->name."</td>";
								echo "<td>".$arr1[$i]->phone."</td>";
							echo "</tr>";
				}
						echo "</tbody>";
						echo "</table>";
			}
			else
			{
				echo "Registration failed";
			}
		}
	}
?>