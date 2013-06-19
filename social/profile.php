<?php
session_start();

$userid     = $_SESSION["userid"];
$first_name = $_SESSION["first_name"];
$last_name  = $_SESSION["last_name"];
include_once("isloggedin.php");
?>

<!DOCTYPE html>

<?php
include_once('config.php');
include_once('class/class_profile.php');
include_once('class/class_friends.php');
?>

<html>
<head>
      <?php
      echo "<title>$site_name</title>";
      ?>
      <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="index.php">Home</a>
<br><br>
<?php
$this_userid = intval($_GET["userid"]);

if ($userid == $this_userid)
  {
    $mode = "own";
  }
else
  {
    $mode = "others";
  }

$con = mysql_connect('localhost', 'box', 'password');

if (!$con)
  {
    die("Oops! Couldn't connect to database.\n\r Technical details: " . mysql_error());
  }

mysql_select_db('box');

$qry = mysql_query("SELECT first_name, last_name, email, about_me FROM userdata WHERE userid = '$this_userid'");
$profile_pic = mysql_query("SELECT timestamp, extension FROM photos WHERE ownerid='$this_userid' AND isprofilepic=1");

$row = mysql_fetch_assoc($qry);
$profile_pic = mysql_fetch_assoc($profile_pic);

$this_email      = $row['email'];
$this_first_name = $row['first_name'];
$this_last_name  = $row['last_name'];
$this_about_me   = $row['about_me'];
$this_timestamp  = $profile_pic['timestamp'];
$this_extension  = $profile_pic['extension'];

$friend = new friend;

$friends = $friend->isFriend($this_userid, $userid);

$num_rows = mysql_num_rows($friends);

if ($num_rows > 0)
  {
    $row     = mysql_fetch_assoc($friends);
    $pending = $row["pending"];
  }
else
  {
    $pending = "notsent";
  }

if (file_exists("images/$this_userid/$this_timestamp.$this_extension"))
  {
    $img = "images/$this_userid/$this_timestamp.$this_extension";
  }
else
  {
    $img = "images/default.jpg";
  }

if ($mode == "own")
  {
    $option = "<a href='upload.php'>Upload new profile picture</a>";
    $this_about_me = "<a href='edit_profile.php'>About me</a>:<br>$this_about_me";
  }

else
  {
    if ($pending == "true")
      {
        $option = "Friend request sent.";
      }
    elseif ($pending == "false")
      {
        $option = "<a href='messaging.php'>Send a message</a>";
      }
    elseif ($pending == "notsent")
      {
        $option = "<form action='friend_request.php' method='POST' name='friend_request'><input type='hidden' name='this_userid' value='$this_userid'><input type='submit' name='send_friend_request' value='Send friend request.'></form>";
      }
      $this_about_me = "<b>About me:</b><br>$this_about_me";
  }

echo "<table id='profilebox' bordercolor='blue'><tr><td rowspan='4'><img id='profilepicture' height=150 src='$img'></img></td></tr><tr><td><b>$this_first_name $this_last_name</b></td></tr><tr><td>Email: $this_email</td></tr><tr><td>$option</td></tr><tr><td id='userinformation' colspan='2'>$this_about_me</td></tr></table>";
mysql_close($con);
?>
<form action="post_update.php" method="POST" name="postUpdate">
  <input type="text" id="update" name="update">
  <input type="submit" name="submit" value="Post">
  <input type="hidden" name="this_userid" value="<?php echo $this_userid; ?>">
</form>
<?php

$profile = new profile;

$posts = $profile->getMessages($this_userid, 0);

while ($row = mysql_fetch_assoc($posts))
{
  $pmid = $row["pmid"];
  $senduserid = $row["senduserid"];
  $recipuserid = $row["recipuserid"];
  $subject = $row["subject"];
  $message = $row["message"];
  $read = $row["read"];
  $timestamp = $row["timestamp"];
  $time = date("d/m/Y H:i", $timestamp);

  $aaa = mysql_connect("localhost", "box", "password");

  mysql_select_db("box");

  $postdata = mysql_query("SELECT userid, first_name, last_name FROM userdata WHERE userid = $senduserid") or die(mysql_error());

  $sendername = mysql_fetch_assoc($postdata);

  $send_userid = $sendername["userid"];

  $posterimage = mysql_query("SELECT * FROM photos WHERE ownerid = '$send_userid' AND isprofilepic = 1");

  $posterimage = mysql_fetch_assoc($posterimage);

  $send_first_name = $sendername["first_name"];
  $send_last_name = $sendername["last_name"];
  $send_profpic = $posterimage["picid"];
  $send_timestamp = $posterimage["timestamp"];
  $send_extension = $posterimage["extension"];

  if ($send_profpic == "")
    {
      $icon = "images/default.jpg";
    }
    else
    {
      $icon = "images/$send_userid/$send_timestamp.$send_extension";
    }
    

  mysql_close($aaa);

  echo "<table id='posts'><tr><td><img src=$icon height=32 width=32></img></td><td><a href='profile.php?userid=$send_userid'>$send_first_name $send_last_name</a> $time</td></tr><tr><td></td><td>$message</td></tr></table>";
}

$friendslist = $friend->listFriends($this_userid, $userid);

echo "<table id='friends'><tr><td>Friends:</td></tr>";

while ($row = mysql_fetch_assoc($friendslist))
  {
    $friendid = $row["senduserid"];
    
    if ($friendid == $this_userid)
      {
        $friendid = $row["recipuserid"];
      }
    
    $getnames = mysql_query("SELECT first_name, last_name FROM userdata WHERE userid = '$friendid'");
    $getpics  = mysql_query("SELECT * FROM photos WHERE ownerid = '$friendid' AND isprofilepic = 1");

    $name = mysql_fetch_assoc($getnames);
    $pic  = mysql_fetch_assoc($getpics);
    
    $friend_first_name = $name["first_name"];
    $friend_last_name  = $name["last_name"];
    $friend_picid      = $pic["picid"];
    $friend_timestamp  = $pic["timestamp"];
    $friend_extension  = $pic["extension"];

    if ($friend_picid == "")
    {
      $icon = "images/default.jpg";
    }
    else
    {
      $icon = "images/$friendid/$friend_timestamp.$friend_extension";
    }
    
    echo "<tr><td><img height=32 width=32 src='$icon'></td><td><a href='profile.php?userid=$friendid'>$friend_first_name $friend_last_name</a></td></tr>";
  }

  echo "</table>";
?>
<br>
</body>
</html>