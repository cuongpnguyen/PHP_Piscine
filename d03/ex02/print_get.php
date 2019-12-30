<?php
if ($_GET) 
{
	foreach ($_GET as $key => $value)
	{
		echo $key;
		echo ": ";
		echo $value;
		//echo "<br>"; 
		echo "\n";
	}
}
?>
