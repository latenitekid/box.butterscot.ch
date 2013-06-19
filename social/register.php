<?php

$bytes = openssl_random_pseudo_bytes(16, $cstrong);
$salt = bin2hex($bytes);

$email = $_POST["email"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$password = $_POST["pass1"];
$password = $password . $salt; # append the 16-bit salt to the end of the password
$sha1password = sha1($password); # and hash it with sha1

$first_name = ucfirst(strtolower($first_name));
$last_name = ucfirst(strtolower($last_name));

$timestamp = time();
$ip = getenv("REMOTE_ADDR");

$con = mysql_connect("localhost", "box", "password");

if (!$con)
{
	die("<b>:(</b> Couldn't connect: " . mysql_error());
}

mysql_select_db("box");

$check = mysql_query("SELECT email FROM userdata WHERE email = '$email' LIMIT 1");

$numrows = mysql_num_rows($check);

if ($numrows == 0)
{
	$sql = "INSERT INTO userdata (email, password, first_name, last_name, salt, timestamp, ip)
	VALUES ('$email', '$sha1password', '$first_name', '$last_name', '$salt', $timestamp, '$ip')";
	mysql_query($sql);
	echo "Created account! <a href='index.php'>Back to the index</a>.";
}
else
{
	echo "An account has already been associated with this e-mail. Forgot password? <a href='index.php'>Back to the index</a>.";
}
?>

<?php
mysql_close($con);
?>