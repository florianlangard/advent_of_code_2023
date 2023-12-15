<?php

$raw = file_get_contents('./data.txt');
// $data = str_replace("\n\n"," ",$raw);
$data = explode("\n", $raw);

$res = "oh";

//= Part One =========================================

$timeInter = explode(":", $data[0]);
$trim = preg_replace('/\s+/', " ", $timeInter[1]);
$timeTab = explode(" ", $trim);
$timeTab = array_filter($timeTab);

$distanceInter = explode(":", $data[1]);
$trim = preg_replace('/\s+/', " ", $distanceInter[1]);
$distanceTab = explode(" ", $trim);
$distanceTab = array_filter($distanceTab);



for ($j=1; $j <= count($timeTab) ; $j++) { 

    $nbWays[$j] = 0;

    for ($i=0; $i < $timeTab[$j]; $i++) { 
        $speed = $timeHold = $i;
        $raceTime = $timeTab[$j] - $i;
        $distance = $raceTime * $speed;
        
        if ($distance > $distanceTab[$j]) {
            $nbWays[$j]++;
        }
    }
}

$res = array_product($nbWays);

//= Part Two =========================================



echo "<pre>";
print_r($res);
echo "</pre>";

