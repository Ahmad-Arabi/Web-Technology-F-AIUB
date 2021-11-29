function isValid(js_add)
{
	const ben = js_add.name.value;
	const phone = js_add.phone.value;

	if(ben === "")
	{
		document.getElementById("error1").innerHTML = "Please enter a name";
		document.getElementById("error2").innerHTML = "";
		return false;
	}
	else if(phone === "")
	{
		document.getElementById("error1").innerHTML = "";
		document.getElementById("error2").innerHTML = "Please enter a phone number";
		return false;
	}
	else
	{
		return true;
	}
}