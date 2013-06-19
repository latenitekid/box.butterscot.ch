function validate()
{
	var emailvalidate = document.forms["register"]["remail"].value;
	var atpos = emailvalidate.indexOf("@");
	var dotpos = emailvalidate.lastIndexOf(".");

	var emailfield = document.getElementById("remail");
	var f_namefield = document.getElementById("first_name");
	var l_namefield = document.getElementById("last_name");
	var pass1field = document.getElementById("pass1");
	var pass2field = document.getElementById("pass2");

	if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= emailvalidate.length)
	{
		emailfield.style.backgroundColor="red";
		document.getElementById("error_remail").innerHTML="Invalid e-mail address.";
		return false;
	}

	var fname_validate = document.forms["register"]["first_name"].value;
	var lname_validate = document.forms["register"]["last_name"].value;

	if (fname_validate.length < 1 || !(isNaN(fname_validate)))
	{
		document.getElementById("error_first_name").innerHTML="Invalid first name.";
		f_namefield.style.backgroundColor="red";
		return false;
	}

	if (lname_validate.length < 1 || !(isNaN(lname_validate)))
	{
		document.getElementById("error_last_name").innerHTML="Invalid last name.";
		l_namefield.style.backgroundColor="red";
		return false;
	}

	var passwordvalidate = document.forms["register"]["pass1"].value;
	var passwordconfirmvalidate = document.forms["register"]["pass2"].value;

	if (passwordvalidate.length < 6)
	{
		document.getElementById("error_pass1").innerHTML="Password must be at least six characters.";
		pass1field.style.backgroundColor="red";
		return false;
	}

	if (passwordvalidate != passwordconfirmvalidate)
	{
		document.getElementById("error_pass2").innerHTML="Password must be at least six characters.";
		pass2field.style.backgroundColor="red";
		return false;
	}
}

function makeNormal(fieldid)
{
	var field = document.getElementById(fieldid);

	field.style.backgroundColor="white";

	field = document.getElementById("error_" + fieldid);

	field.innerHTML="";
}