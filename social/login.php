<?php
session_start();

$email = $_POST["email"];

mysql_connect('localhost','box','password');
mysql_select_db('box');
$qry = mysql_query("SELECT userid, email, first_name, last_name, salt FROM userdata WHERE email = '$email'");

$row = mysql_fetch_assoc($qry);

$userid = $row['userid'];
$email = $row['email'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$salt = $row['salt'];

$_SESSION["loggedIn"] = 1;
$_SESSION["userid"] = $userid;
$_SESSION["email"] = $email;
$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;

?>

<?php

$con = mysql_connect('localhost','box','password');

if (!$con)
  {
  die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
  }

mysql_select_db('box');

$email = mysql_real_escape_string($_POST['email']);
$password = $_POST['password'];
$password = $password . $salt;
$password = sha1($password);

$qry = mysql_query("SELECT email, password FROM userdata WHERE email = '$email' AND password = '$password'");

$count = mysql_num_rows($qry);

if ($count > 0)
  {
  echo "Thank you for logging in, <b>" . $_SESSION["first_name"] . "</b>. <a href='index.php'>Back to the index</a>.";
  }
else
  {
  echo "Sorry, your email and password combination is incorrect. <a href='index.php'>Back to the index</a>.";
  session_destroy();
  }

?>

<?php
mysql_close($con);
?>