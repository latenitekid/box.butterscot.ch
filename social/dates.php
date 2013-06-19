<?php

$today = date("l, F jS g:i:sA e");
$newtime = time() + (24 * 60 * 60);
$tomorrow = date("l, F jS g:i:sA e", $newtime);

echo "It is $today.";
echo "<br>";
echo "In 24 hours, it will be $tomorrow.";

?>