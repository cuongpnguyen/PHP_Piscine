#!/usr/bin/php
<?php
$date =  "Mardi 12 Novembre 2013 12:02:21";
$date .= " CET";
      $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
	  $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	  $french_days = array('lundi', 'mardi','mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
	  $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	  $date = str_replace($french_months, $months, strtolower($date));
	  $date = str_replace($french_days, $days, strtolower($date));

	  $parsed = date_parse($date);
	 // print_r(date_parse($date));
	  if (empty($parsed['empty']))
	  {
		  echo strtotime($date);
	  }
	  else
	  {
		  echo "Wrong Format";
	  }
	  echo "\n";	  
	  /*
	  echo $date;
	  echo strtotime($date);
*/
	  /* pull out each part of the date and check to see if valid... do so by converting the dates into respective numbers */
     /* echo $date = date('d-m-Y', strtotime($date));
      echo "</br>";
	  echo $date = date('d-m', strtotime($date))
	  */
?>