#!/usr/bin/php
<?php

if ($argc != 2)
{
		echo "Incorrect Parameters\n";
		exit();
}
$stripped = preg_replace('/\s/', '', $argv[1]);
$array = preg_split('/[\+\-\*\/\%]/', $stripped, -1, PREG_SPLIT_NO_EMPTY);
/* if the string contains more than 1 of the +-*etc then needto syntax error*/ 
$counter = 0;
$stripped_array = str_split($stripped);
$op = '';
foreach ($stripped_array as $character)
{
	if ($character == '+' || $character == '-' ||$character == '*' ||$character == '/' ||$character == '%')
	{
		$op = $character;
		$counter++;
	}
}
if ($counter > 1)
{
	echo "Syntax Error\n";
	exit();
}

if (count($array) != 2)
{
	echo "Syntax Error\n";
	exit();
}

$a = $array[0];
$b = $array[1];
if (!is_numeric($a) or !is_numeric($b))
{
	echo "Syntax Error\n";
	exit();
}

/* Check if $a and $b are both numbers*/ 

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