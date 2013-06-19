<?php
session_start();

$userid = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
include('SimpleImage.php');

$site_name = "Social Networking Website";
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$allowedExts = array("jpg", "jpeg", "png", "gif");
$extension = end(explode(".", $_FILES["file"]["name"]));

if (in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		$time = time();
		
		if (!is_dir("/home/box/www/box.butterscot.ch/social/images/$userid"))
		{
			$mkdir = mkdir("/home/box/www/box.butterscot.ch/social/images/$userid/", 0700);

			if (!$mkdir)
			{
				echo "Error occured when trying to create a directory. Please contact administration.";
			}
		}

		move_uploaded_file($_FILES["file"]["tmp_name"], "images/$userid/$time.$extension");

		$con = mysql_connect('localhost', 'box', 'password');

		if (!$con)
		  {
		    die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		  }

		mysql_select_db('box');

		mysql_query("UPDATE photos SET isprofilepic = 0 WHERE isprofilepic = 1 AND ownerid = $userid");

		mysql_query("INSERT INTO photos (ownerid, isprofilepic, timestamp, extension)
			VALUES ($userid, 1, '$time', '$extension')");

		mysql_close($con);
		
		echo "Uploaded " . $_FILES["file"]["name"] . ". <a href='index.php'>Back to the index</a>.<br>";
	}
}
else
{
	echo "Invalid file.";
}
?>