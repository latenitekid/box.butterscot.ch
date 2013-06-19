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
include_once('class/class_profile.php');
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

$this_about_me = $_POST["about_me"];

$profile = new profile;

$profile->updateData($userid, $this_about_me);

echo "Updated profile successfully. <a href='profile.php?userid=$userid'>Back to your profile</a>.";

?>