<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Transaction History</title>
	<style>
		table,th, td, tr
		{
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<form name="js_his" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return isValid(this);">

		<h1>Page 3 [Transaction History]</h1>
		
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		<br><br>

		<label>From: </label>
		<input type="date" name="fromdate">
		<p id="error1" style="color: red;"></p>


		<label>To: </label>
		<input type="date" name="todate">
		<p id="error2" style="color: red;"></p>


		<input type="submit" value="Search">
		<br><br>

		<h4 id="msg"></h4>

	</form>
	<script src="transl.js"></script>


</body>
</html>


<?php
	if($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$fromdate = $_POST['fromdate'];
		$todate = $_POST['todate'];

		if (empty($fromdate))
		{
			echo "Please fill up the form properly";
		}
		else if(empty($todate))
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

			$sql = "SELECT * FROM thistory WHERE transfer_on between ? and ?";
			$sql2 = "SELECT COUNT(*) FROM thistory";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $fromdate, $todate);
			$res = $stmt->execute();

			
			echo "<table>";
				echo "<thead>";
					echo "<tr>";
						echo "<th>Category</th>";
						echo "<th>To</th>";
						echo "<th>Amount</th>";
						echo "<th>Transferred On</th>";
					echo "</tr>";	
				echo "</thead>";
				echo "<tbody>";
			if ($res)
			{
				$data = $stmt->get_result();
				
				if ($data->num_rows > 0)
				{
					echo "<script>";
						echo "document.getElementById('msg').innerHTML = 'Total Records: (".$data->num_rows.")'";
					echo "</script>";
					while ($row = $data->fetch_assoc())
					{
						echo "<tr>";
							echo "<td>".$row["tcategory"]."</td>";
							echo "<td>".$row["transfer_to"]."</td>";
							echo "<td>".$row["amount"]."</td>";
							echo "<td>".$row["transfer_on"]."</td>";
						echo "</tr>";
					}
				}
			}
			else
			{
				echo "Error while executing the statement";
			}
				echo "</tbody>";
			echo "</table>";

			$conn->close();
		}
	}
?>