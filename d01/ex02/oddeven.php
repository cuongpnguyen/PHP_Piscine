#!/usr/bin/php
<?php
while(1)
{
echo "Enter a number: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
if($line == NULL)
	exit();
$number = trim($line);
fclose($handle);
if (is_numeric($number))
{
	if ($number % 2 == 0)
	{
		echo 'The number '.$number;
		echo " is even\n";
	}
	else
	{
		echo 'The number '.$number;
		echo " is odd\n";
	}
}
else
{
	echo "'";
	echo $number;
	echo "' is not a number\n";
}
}
?>
