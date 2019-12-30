#!/usr/bin/php
<?php
if ($argc < 2)
	exit();
$tmp = trim($argv[1]);
$parts = preg_split('/ +/', $tmp);
$first = $parts[0];

foreach($parts as $key => $val)
{
	if ($key == 0)
	{
		continue;
	}
	echo $val;
	echo " ";
}
echo $first;
echo "\n";
?>