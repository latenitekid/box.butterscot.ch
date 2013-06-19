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

	$mode = $_POST["action"];

	if ($mode == "accept")
	{
		$friend->acceptRequest($this_userid, $userid);
		echo "This user is now your friend. <a href='index.php'>Back to the index</a>.";
	}
	else
	{
		$friend->denyRequest($this_userid, $userid);
		echo "You've denied this user's friend request. <a href='index.php'>Back to the index</a>.";
	}

?>