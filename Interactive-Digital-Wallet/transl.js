function isValid(js_trans)
{
	const fdate = js_trans.fromdate.value;
	const tdate = js_trans.todate.value;

	if(fdate === "")
	{
		document.getElementById("error2").innerHTML = "";
		document.getElementById("error1").innerHTML = "Please enter the starting date";
		return false;
	}
	else if(tdate === "")
	{
		document.getElementById("error1").innerHTML = "";
		document.getElementById("error2").innerHTML = "Please select the ending date";
		return false;
	}
	else
	{
		return true;
	}
}