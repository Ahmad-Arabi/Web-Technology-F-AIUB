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
				echo "Registration Successful!";
			}
			else
			{
				echo "Registration failed";
			}
		}
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Transaction History</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<h1>Page 3 [Transaction History]</h1>
		
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		
		<h3>Add Beneficiary:</h3>

		<label>From: </label>
		<input type="date" name="fromdate">

		<label>To: </label>
		<input type="date" name="todate">

		<input type="submit" name="Search">
		<br><br>

		<h4>Total Records: ()</h2>

	</form>

</body>
</html>