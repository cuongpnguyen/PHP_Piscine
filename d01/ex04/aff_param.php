#!/usr/bin/php
<?php
foreach ($argv as $index => $val)
{
	if ($index == 0)
	{
		continue;
	}
	echo $val;
	echo "\n";
}
?>