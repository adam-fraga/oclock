<?php
require_once 'App/db.php';
require_once 'Models/Tools.php';
//Fetch Alarms From DB
$Tools = new Tools();
$alarms = $Tools->displayAlarms();
//display db content to json
echo json_encode($alarms);
