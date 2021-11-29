function isValid(js_home)
{
	const category = js_home.category.value;
	const recipient = js_home.recipient.value;
	const amount = js_home.amount.value;

	if(category === "emp")
	{
		document.getElementById("error2").innerHTML = "";
		document.getElementById("error3").innerHTML = "";
		document.getElementById("error1").innerHTML = "Please select a category";
		return false;
	}
	else if(recipient === "emp")
	{
		document.getElementById("error1").innerHTML = "";
		document.getElementById("error3").innerHTML = "";
		document.getElementById("error2").innerHTML = "Please select a recipient";
		return false;
	}
	else if(amount === "")
	{
		document.getElementById("error1").innerHTML = "";
		document.getElementById("error2").innerHTML = "";
		document.getElementById("error3").innerHTML = "Please enter an amount";
		return false;
	}
	else if (amount<0)
	{
		document.getElementById("error3").innerHTML = "Amount must be greater than 0";
		return false;
	}
	else
	{
		return true;
	}
}