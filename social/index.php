<?php
session_start();

$userid = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

	$con = mysql_connect('localhost','box','password');

	if (!$con)
	  {
	  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
	  }

	mysql_select_db('box');
?>

<!DOCTYPE html>

<?php
include_once('config.php');
include_once('class/class_search.php');
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="validate.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<?php 
	echo "Welcome to <b>$site_name</b>!<br><br>";

	if (isset($_SESSION['loggedIn']))
	{
		echo "Logged in as: <b><a href='profile.php?userid=$userid'>$first_name $last_name</a></b>. Not $first_name? <a href='logout.php'>Log out</a>.<br>";

		$qry = mysql_query("SELECT * FROM friends WHERE recipuserid = '$userid' AND pending='true'");

		$num_rows = mysql_num_rows($qry);

		if ($num_rows > 0)
		{
			while ($row = mysql_fetch_assoc($qry))
			{
				$friend_userid = $row["senduserid"];

				$getname = mysql_query("SELECT first_name, last_name FROM userdata WHERE userid = $friend_userid");

				$friendrow = mysql_fetch_assoc($getname);

				$friend_first_name = $friendrow["first_name"];
				$friend_last_name = $friendrow["last_name"];

				$accept = "<form action='friend_respond.php' method='POST'><input type='hidden' name='action' value='accept'><input type='hidden' name='this_userid' value='$friend_userid'><input type='submit' name='submit' value='Accept'></form>";
				$deny = "<form action='friend_respond.php' method='POST'><input type='hidden' name='action' value='deny'><input type='hidden' name='this_userid' value='$friend_userid'><input type='submit' name='submit' value='Deny'></form>";
				
				echo "<a href='profile.php?userid=$friend_userid'>$friend_first_name $friend_last_name</a> wants to be your friend. $accept $deny";
			}
		}
	}

	else
	{
	?>
	Please <b>sign in</b> or <b>create an account</b>.
	<form action="login.php" method="POST" name="login">
		<b>Sign in</b><br>
		<label for="email">E-mail:</label>
		<input type="text" name="email" id="email"><br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password"><br>
		<input type="submit" name="signin" value="Sign in"><br>
	</form>

	<form action="register.php" method="POST" name="register" id="register" onsubmit="return validate()">
		<b>Create an Account</b><br>
		<label for="email">E-mail:</label>
		<input type="text" name="email" id="remail"><div id="error_remail"></div><br>
		<label for="first_name">First name:</label>
		<input type="text" name="first_name" id="first_name" onkeydown="makeNormal('first_name')"><div id="error_first_name"></div><br>
		<label for="last_name">Last name:</label>
		<input type="text" name="last_name" id="last_name" onkeydown="makeNormal('last_name')"><div id="error_last_name"></div><br>
		<label for="pass1">Password:</label>
		<input type="password" name="pass1" id="pass1" onkeydown="makeNormal('pass1')"><div id="error_pass1"></div><br>
		<label for="pass2">Confirm password:</label>
		<input type="password" name="pass2" id="pass2" onkeydown="makeNormal('pass2')"><div id="error_pass2"></div><br>
		<input type="submit" name="register" value="Register">
	</form>
	<span id="exists"></span>
	<?php
	}

	$qry = mysql_query("SELECT userid, first_name, last_name FROM userdata ORDER BY userid DESC LIMIT 1");

	$row = mysql_fetch_assoc($qry);

	$this_userid = $row["userid"];
	$this_first_name = $row["first_name"];
	$this_last_name = $row["last_name"];

	echo "<br>Welcome our newest user, <b>$this_first_name $this_last_name</b>.";
	?>

</body>
</html>

<?php
mysql_close($con);
?>