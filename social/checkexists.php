<?php

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
	echo "<b>E-mail okay!</b>";
}
else
{
	echo "<b>E-mail previously taken!</b>";
}