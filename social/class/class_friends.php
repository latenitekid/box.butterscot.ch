<?php

class friend
{
	function sendRequest($senduserid, $recipuserid)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
		{
		  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		}

		mysql_select_db('box');

		mysql_query("INSERT INTO friends (senduserid, recipuserid, pending)
			VALUES ('$senduserid', '$recipuserid', 'true')");

		mysql_close($aaa);
	}

	function acceptRequest($senduserid, $recipuserid)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
		{
		  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		}

		mysql_select_db('box');

		mysql_query("UPDATE friends SET pending = 'false' WHERE senduserid = '$senduserid' AND recipuserid = '$recipuserid'");

		mysql_close($aaa);
	}

	function denyRequest($senduserid, $recipuserid)
	{
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
		{
		  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		}

		mysql_select_db('box');

		mysql_query("DELETE FROM friends WHERE senduserid = '$senduserid' AND recipuserid = '$recipuserid'");

		mysql_close($aaa);
	}

	function listFriends($this_userid, $userid)
	{
		mysql_close($con);
		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
		{
		  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		}

		mysql_select_db('box');

		$qry = mysql_query("SELECT * FROM friends WHERE recipuserid = '$this_userid' AND pending = 'false' OR senduserid = '$this_userid' AND pending = 'false'");

		return $qry;
	}

	function isFriend($this_userid, $userid)
	{

		$aaa = mysql_connect('localhost','box','password');

		if (!$aaa)
		{
		  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
		}

		mysql_select_db('box');

		$qry = mysql_query("SELECT pending FROM friends WHERE recipuserid = '$this_userid' AND senduserid = '$userid' OR recipuserid = '$userid' AND senduserid = '$this_userid'");

		return $qry;
	}
}