<?php

$raw = file_get_contents('./data.txt');
// $data = str_replace("\n\n"," ",$raw);
$data = explode("\n", $raw);

$res = "oh";

//= Part One =========================================
$inputs = [];

foreach ($data as $key => $value) {
    // split string at ":"
    $expl = explode(": ", $value);
    // keep the id Game 1 :=> 1
    $gameId = preg_replace("/[^0-9]+/", "", $expl[0]);
    // get draws
    $inputs[$gameId] = explode(";", $expl[1]);
}

$filteredInputs = [];
// 
foreach ($inputs as $index => &$val) {
    $tab = [];
    foreach ($val as &$draws) {
        $tab[] = explode(" | ", $draws);
    }
    $filteredInputs[$index] = $tab;
}

$inter = [];

foreach ($filteredInputs as $index => $val) {
    
    $winningNb = [];
    $myNb = [];
    $winningNb = explode(" ", $val[0][0]);
    $myNb = explode(" ", $val[0][1]);

    foreach ($winningNb as $k => $array) {
        if ($array == " " || $array === "") {
            unset($winningNb[$k]);
        }
    }
    foreach ($myNb as $k => $array) {
        if ($array == " " || $array === "") {
            unset($myNb[$k]);
        }
    }

    $inter[$index] = array_intersect($winningNb, $myNb);

    $pts = 0;

    if (!empty($inter[$index])) {
        $pts = 1;
    }

    for ($i=1; $i < count($inter[$index]); $i++) { 
        $pts *= 2;
    }
    $totalPts[$index] = $pts;
}

$res = array_sum($totalPts);


//= Part Two =========================================

$nbInstances = [];

foreach ($inter as $index => $value) {
    $nbInstances[$index] = 1;
}



foreach ($inter as $index => $match) {
    
    $count = count($inter[$index]);
    
    for ($j = 0; $j < $nbInstances[$index]; $j++) {

        for ($i=1; $i <= $count; $i++) { 
            $nbInstances[$index+$i] += 1;
            
            
        }
    }
    
}

$res = array_sum($nbInstances);

echo "<pre>";
print_r($res);
echo "</pre>";

