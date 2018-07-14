<?php
// source: http://pl.php.net/manual/en/function.date.php 

// default timezone
date_default_timezone_set('Europe/Brussels');

// today
$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$today = date("d-m-Y");
echo $today;

?>