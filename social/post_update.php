<?php
session_start();

$userid     = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name  = $_SESSION["last_name"];
?>

<!DOCTYPE html>

<?php
include_once('config.php');
include_once('class/class_profile.php');
?>

<html>
<head>
      <?php
      echo "<title>$site_name</title>";
      ?>
      <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$this_userid = $_POST["this_userid"];
$message = $_POST["update"];

$profile = new profile;

$profile->postMessage($userid, $this_userid, "no subject", $message, -1, 0);

echo "Status posted! <a href='index.php'>Back to the index</a>."

?>