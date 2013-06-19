<?php

session_start();

if (!isset($_SESSION["loggedIn"]))
{
	die("Please log in. <a href='index.php'>Click here to log in.</a>");
}

?>