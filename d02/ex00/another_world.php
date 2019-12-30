#!/usr/bin/php
<?php
if ($argc != 2)
	exit();
$tmp = trim($argv[1]);
$parts = preg_split('/ +/', $tmp);

foreach ($parts as $key => $val)
{
	if ($key == 0)
	{
		echo $val;
	}
	else
	{
		echo " ";
		echo $val;
	}
}
echo "\n"

?>