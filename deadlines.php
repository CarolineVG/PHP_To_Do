
<?php

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 

/** SESSION */
session_start(); 

// show tasks for 7 days
$task = new Task();
echo "--- deadlines ---";

/** header */
include_once("header.php");
?>

    <div class="chart">
        
        <?php $task->showChartInfo(); ?>
        <div class="bar day1"></div>
        <div class="bar day2"></div>
        <div class="bar day3"></div>
        <div class="bar day4"></div>
        <div class="bar day5"></div>
        <div class="bar day6"></div>
        <div class="bar day7"></div>
    </div>


<?php
/** header */
include_once("header.php");
?>