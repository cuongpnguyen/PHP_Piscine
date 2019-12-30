#!/usr/bin/php
<?php

function ft_is_sort($tab)
{
	$result = $tab;
	sort($tab);
	$arraysAreEqual = ($result == $tab);
	if ($arraysAreEqual)
		return True;
	return False;
}
?>
