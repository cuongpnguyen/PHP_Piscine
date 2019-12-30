#!/usr/bin/php
<?php
function strsplit($str)
{
	$tmp = trim($str);
	$parts = preg_split('/\s+/', $tmp);
	return $parts;
}

if ($argc != 4)
{
		echo "Incorrect Parameters\n";
		exit();
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

$a = (int)$result[0];
$b = (int)$result[2];
$op = $result[1];

if ($op == "+")
	echo $a + $b;
else if ($op == "-")
	echo $a - $b;
else if ($op == "*")
	echo $a * $b;
else if ($op == "/")
	echo $a / $b;
else if ($op == "%")
	echo $a % $b;
echo "\n";
?>