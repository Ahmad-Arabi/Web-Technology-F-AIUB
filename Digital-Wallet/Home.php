<?php
	if($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$name = $_POST['name'];
		$phone = $_POST['phone'];

		$handle = fopen("users.json", "r");
		$data = fread($handle, filesize("users.json"));
		$exp = explode("\n", $data);

		$arr1 = array();
		for($i=0;$i<count($exp)-1;$i++)
		{
			$json = json_decode($exp[$i]);
			array_push($arr1, $json);
		}
	}	
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h1>Page 1 [Home]</h1>
		<h3>Digital Wallet</h3>
		1. <a href="home.php">Home</a> 2. <a href="add_beneficiary.php">Add Beneficiary</a> 3. <a href="transaction_history.php">Transaction History</a>
		<h3>Fund Transfer:</h3>

		<label>Select Category: </label>
		<select name="category[]">
			<option value="emp" selected>Select a value</option>
			<option value="sm">Send Money</option>
			<option value="mr">Mobile Recharge</option>
			<option value="mp">Merchant Pay</option>
		</select>
		<br><br>

		<label>To: </label>

		<?php		
			echo "<select name=recipient[]>";
			echo "<option value=".emp." selected>Select a value</option>";
			for($i=0;$i<count($exp)-1;$i++)
			{
				echo "<option value=". $arr1[$i]->name.">".$_POST['$jason[i]']."</option>";
			}
			echo "</select>";
		?>
		

		<label>Amount: </label>
		<input type="number" name="amount">
		<br><br>

		<input type="submit" name="submit">
		<br><br>
	</form>

</body>
</html>