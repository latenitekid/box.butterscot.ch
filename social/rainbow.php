<?php

$string = "
Hello, my fellow homosapiens! How are you all doing today? This string is pretty long.
It's long so that I can test the colors the entire way, if that makes any sense.
It probably doesn't, but oh well. It just needs to be a bit longer. Just a few
more!!
";

for ($i = 0; $i <= strlen($string); $i++)
{
	$r = rand(125,200);
	$g = rand(125,200);
	$b = rand(125,200);
	echo "<b style='color: rgb($r,$g,$b);'>" . $string[$i] . "</b>";
}

echo "<br>";

for ($i = 0; $i <= strlen($string); $i++)
{
	$r = 0;
	$g = 0;
	$b = $i * 2;
	echo "<b style='color: rgb($r,$g,$b);'>" . $string[$i] . "</b>";
}

echo "<br>";

for ($i = 0; $i <= strlen($string); $i++)
{
	$r = 0;
	$g = $i * 2;
	$b = 0;
	echo "<b style='color: rgb($r,$g,$b);'>" . $string[$i] . "</b>";
}

echo "<br>";

for ($i = 0; $i <= strlen($string); $i++)
{
	$r = $i * 2;
	$g = 0;
	$b = 0;
	echo "<b style='color: rgb($r,$g,$b);'>" . $string[$i] . "</b>";
}

echo "<br>";

for ($i = 0; $i <= strlen($string); $i++)
{
	$r = $i + 50;
	$g = abs(25 - $i);
	$b = 0;
	echo "<b style='color: rgb($r,$g,$b);'>" . $string[$i] . "</b>";
}

?>