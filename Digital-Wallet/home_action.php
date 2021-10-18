<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
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
	<select name="[]">
		<option value="emp"> </option>
		<option value="islam">Islam</option>
		<option value="hindu">Hinduism</option>
		<option value="buddha">Buddhism</option>
		<option value="christ">Christianity</option>
	</select>
	<br><br>

	<label>Amount: </label>
	<input type="number" name="amount">
	<br><br>

	<input type="submit" name="submit">
	<br><br>

</body>
</html>