
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<form name="js_home" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return isValid(this);">

		<h1>Page 1 [Home]</h1>
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		<h3>Fund Transfer:</h3>

		<label>Select Category: </label>
		<select name="category">
			<option value="emp" selected>Select a value</option>
			<option value="Send Money">Send Money</option>
			<option value="Mobile Recharge">Mobile Recharge</option>
			<option value="Merchant Pay">Merchant Pay</option>
		</select>
		<br>
		<p id="error1" style="color: red;"></p>
		<label>To: </label>

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

			echo "<select name='recipient'>";
			echo "<option value='emp' selected>Select a value</option>";
			if ($data->num_rows > 0) {
				
				while ($row = $data->fetch_assoc())
				{
					echo "<option value=". $row["name"].">".$row["name"]."</option>";
				}
				echo "</select>";
			}

			$conn->close();
		?>
		<p id="error2" style="color: red;"></p>

		<label>Amount: </label>
		<input type="number" name="amount">
		<p id="error3" style="color: red;"></p>
		<br><br>

		<input type="submit" value="Send" name="submit">
		<br><br>
	</form>
	<script src="homel.js"></script>

</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$category = $_POST['category'];
		$recipient = $_POST['recipient'];
		$amount = $_POST['amount'];
		$dates = date('Y/m/d');

		if($category == 'emp')
		{
			echo "Please fill up the form properly";
		}
		else if($recipient == 'emp')
		{
			echo "Please fill up the form properly";
		}
		else if(empty($amount))
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

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "INSERT INTO thistory (tcategory, transfer_to, amount, transfer_on) VALUES (?, ?, ?, ?)";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssis", $category, $recipient, $amount, $dates);
			$res = $stmt->execute();
			if ($res)
			{
				echo "<center><b>";
					echo "Data insertion successful";
				echo "</b></center>";
			}
			else
			{
				echo "<center><b>";
					echo "Failed to insert data";
				echo "</b></center>";			
			}
		}		
	}	
?>