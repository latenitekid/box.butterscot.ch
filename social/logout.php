<?php
session_start();
session_destroy();
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
	Logged out succesfully. <a href="index.php">Back to the index</a>.
</body>
</html>