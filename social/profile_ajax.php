<?php

$userid = $_POST["postuserid"];
$this_userid = $_POST["recipuserid"];
$content = $_POST["content"];
$timestamp = date();
$time = date("Y-m-d H:i:s", $timestamp);

echo "Poster: $userid Recipient: $this_userid Content: $content Timestamp: $timestamp Time: $time";

?>