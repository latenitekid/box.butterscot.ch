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
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
include_once('config.php');
include_once('class_search.php');
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

$search = $_POST["search"];
$search = mysql_real_escape_string($search);
$search = explode(" ", $search);

$con = mysql_connect('localhost','box','password');

if (!$con)
	{
	die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
	}

mysql_select_db('box');

$idarray = array();

for ($i = 0; $i < count($search); $i++)
{
	$term = $search[$i];
	$qry = mysql_query("SELECT email, first_name, last_name, userid FROM userdata WHERE first_name = '$term' OR last_name = '$term' OR email = '$term'");

	while ($row = mysql_fetch_assoc($qry))
	{
		$this_userid = $row["userid"];

		$profile_pic = mysql_query("SELECT timestamp, extension FROM photos WHERE ownerid='$this_userid' AND isprofilepic=1");

		$profile_pic = mysql_fetch_assoc($profile_pic);

		$this_first_name = $row["first_name"];
		$this_last_name = $row["last_name"];
		$this_timestamp  = $profile_pic['timestamp'];
		$this_extension  = $profile_pic['extension'];

		echo "<table>";

		if (file_exists("images/$this_userid/$this_timestamp.$this_extension"))
		  {
		    $img = "images/$this_userid/$this_timestamp.$this_extension";
		  }
		else
		  {
		    $img = "images/default.jpg";
		  }

		if (!in_array($this_userid, $idarray))
		{
			echo "<tr><td><img src='$img' height=32 width=32></td><td><a href='profile.php?userid=$this_userid'>$this_first_name $this_last_name</a></td></tr>";
			array_push($idarray, $this_userid);
		}
	}
}

?>