<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Beneficiary</title>
	<style>
		table,th, td, tr
		{
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<form name="js_add" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return isValid(this);">

		<h1>Page 2 [Add Beneficiary]</h1>
		
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		
		<h3>Add Beneficiary:</h3>

		<label>Beneficiary Name: </label>
		<input type="text" name="name">
		<p id="error1" style="color: red;"></p>

		<label>Mobile No: </label>
		<input type="text" name="phone">
		<p id="error2" style="color: red;"></p>

		<input type="submit" value="Add" name="submit">
		<br><br><br>

		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dwallet";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM beneficiaries";
			$data = $conn->query($sql);


			echo "<table>";
				echo "<thead>";
					echo "<tr>";
						echo "<th>Name</th>";
						echo "<th>Phone</th>";
					echo "</tr>";	
				echo "</thead>";
				echo "<tbody>";
			if ($data->num_rows > 0) {
				
				while ($row = $data->fetch_assoc())
				{
					echo "<tr>";
						echo "<td>".$row["name"]."</td>";
						echo "<td>".$row["phone"]."</td>";
					echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
			}

			$conn->close();				
		?>

	</form>
	<script src="addl.js"></script>

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
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dwallet";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "INSERT INTO beneficiaries (name, phone) VALUES (?, ?)";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $name, $phone);
			$res = $stmt->execute();
			if ($res)
			{
				header("Location: add_beneficiary.php");
			}
			else
			{
				echo "Failed to insert data";
			}
		}
	}
?>