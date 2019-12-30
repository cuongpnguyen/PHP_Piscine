#!/usr/bin/php
<?php

function strsplit($str)
{
	$tmp = trim($str);
	$parts = preg_split('/ +/', $tmp);
	return $parts;
}

function get_val($c)
{
	$lettersnumbers = "abcdefghijklmnopqrstuvwxyz0123456789 !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	$size = strlen($lettersnumbers);
	$i = 0;
	while ($i < $size)
	{
		if ($c == $lettersnumbers[$i])
			return ($i);
		$i++;
	}
	return (0);
}
function my_sort($str_a, $str_b)
{
	$str_a = strtolower($str_a);
	$str_b = strtolower($str_b);
	$size_a = strlen($str_a);
	$size_b = strlen($str_b);
	$i = 0;
	while ($i <= $size_a)
	{
		if ($i >= $size_b)
			return (1);
		$val_a = get_val($str_a[$i]);
		$val_b = get_val($str_b[$i]);
		if ($val_a != $val_b)
			return ($val_a - $val_b);
		$i++;
	}
	return (0);
}

$result = [];
foreach ($argv as $index => $val)
{
	if ($index == 0)
	{
		continue;
	}
	$arr = strsplit($val);
	$result = array_merge($result, $arr);
}
 usort($result, "my_sort");

foreach ($result as $index => $val)
{
	echo $val;
	echo "\n";
}
?>