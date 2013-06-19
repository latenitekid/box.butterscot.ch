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

$profile = new profile;

$prof = $profile->grabData($userid);

$prof = mysql_fetch_assoc($prof);

$this_aboutme = $prof["about_me"];

?>

<form action="edit_profile_submit.php" method="POST">
	<table>
		<tr>
			<td>
				<label for="about_me">About Me:</label>
			</td>
			<td>
				<textarea name="about_me" rows=8 cols=40><?php echo $this_aboutme; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<input type="submit" name="submit" value="Submit">
			</td>
		</tr>
	</table>
</form>