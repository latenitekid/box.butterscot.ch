<?php

class profile
{
	function grabData($userid)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
			{
				die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
			}

		mysql_select_db('box');

		$qry = mysql_query("SELECT first_name, last_name, email, about_me FROM userdata WHERE userid = '$userid'");

		mysql_close($aaa);

		return $qry;
	}

	function grabProfPic($userid)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
			{
				die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
			}

		mysql_select_db('box');

		$profile_pic = mysql_query("SELECT timestamp, extension FROM photos WHERE ownerid='$userid' AND isprofilepic=1");

		$profpic = mysql_fetch_assoc($profile_pic);

		mysql_close($aaa);

		return $profipic;
	}

	function updateData($userid, $about_me)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
			{
				die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
			}

		mysql_select_db('box');

		$about_me = mysql_real_escape_string($about_me);

		mysql_query("UPDATE userdata SET about_me = '$about_me' WHERE userid = '$userid'");

		mysql_close($aaa);
	}

	function getMessages($userid, $private)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
			{
				die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
			}

		mysql_select_db('box');

		$qry = mysql_query("SELECT * FROM messages WHERE recipuserid = $userid AND priv = $private ORDER BY timestamp DESC");

		mysql_close($aaa);

		return $qry;
	}

	function postMessage($senduserid, $recipuserid, $subject, $message, $read, $private)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
			{
				die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
			}

		mysql_select_db('box');

		$message = mysql_real_escape_string($message);

		$timestamp = time();

		echo $timestamp . "<br><br>";

		mysql_query("INSERT INTO messages (senduserid, recipuserid, subject, message, readyet, priv, timestamp)
			VALUES ('$senduserid', '$recipuserid', '$subject', '$message', '$read', '$private', $timestamp)") or die(mysql_error());

		mysql_close($aaa);
	}
}

?>