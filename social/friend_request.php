<?php
session_start();

$userid = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
include_once('config.php');
include_once('class/class_friends.php');
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php

	$this_userid = $_POST["this_userid"];

	$friend = new friend;

	$friend->sendRequest($userid, $this_userid);

	echo "Friend request sent! <a href='index.php'>Back to the index</a>.";
	?>
</body>
</html>