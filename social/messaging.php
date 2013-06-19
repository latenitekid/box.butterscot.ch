<?php
session_start();

$userid     = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name  = $_SESSION["last_name"];
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
include_once('config.php');
?>

<html>
<head>
	<?php
	echo "<title>$site_name</title>";
	?>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="charCountDown.js"></script>
</head>
<body>

<form action="" method="POST" name="pm">
	<input type="text" name="subject" id="subject" onKeyDown="checkCharsLeft(pm, subject, 15, subject_notifier)"><br>
	<input readonly type="text" id="message_notifier" value=15><br>
	<input type="text" name="message" id="message" onInput="checkCharsLeft(pm, message, 65536, message_notifier)"><br>
	<input readonly type="text" id="message_notifier" value=65536><br>
</form>