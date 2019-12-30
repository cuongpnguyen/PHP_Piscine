#!/usr/bin/php
<?php
function ft_split($string)
{
	$word = explode(" ", $string);
	sort($word);
	return $word;
}
?>