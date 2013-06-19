<?php
session_start();

$userid = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
$site_name = "Social Networking Website";
?>

<html>
<head>
	<?php echo "<title>$site_name</title>"; ?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form action="uploadImage.php" method="POST" name="upload" enctype="multipart/form-data">
	<label for="file">Image path: </label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="Upload">
</form>

</body>
</html>