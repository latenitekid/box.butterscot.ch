function abc()
{
    return false;

	var xmlhttp = new XMLHttpRequest();

	var data = "postuserid=lolcontent=aa";

	xmlhttp.open("POST", "profile_ajax.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");

	xmlhttp.onreadystatechange = function ()
	{
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    	{
    		alert('xmlhttp.responseText');
    	}
	}

	xmlhttp.send(data);
}