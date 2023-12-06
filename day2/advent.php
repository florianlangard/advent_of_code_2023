<?php

$raw = file_get_contents('./data.txt');
// $data = str_replace("\n\n"," ",$raw);
$data = explode("\n", $raw);


//= Part One =========================================

$base = [
    "red" => 12,
    "green" => 13,
    "blue" => 14
];

$inputs = [];

foreach ($data as $key => $value) {
    // split string at ":"
    $expl = explode(":", $value);
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
        $tab[] = explode(",", $draws);
    }
    $filteredInputs[$index] = $tab;
}

$idsTab = [];

function trimNSplit(string $item) {
    $item = trim($item);
    $arr = explode(" ", $item);
    return $arr;
}

$gameVals = [];

foreach ($filteredInputs as $index => $gameDraws) {

    $highRed = 0;
    $highGreen = 0;
    $highBlue = 0;

    foreach ($gameDraws as $key => $draw) {
        // var_dump($draw);
        
        foreach ($draw as $k => $v) {
            
            $test = trimNSplit($v);

            //= Part Two ====================
            if ($test[1] === "red") {
                if ($test[0] > $highRed) {
                    $highRed = $test[0];
                }
            }
            if ($test[1] === "green") {
                if ($test[0] > $highGreen) {
                    $highGreen = $test[0];
                }
            }
            if ($test[1] === "blue") {
                if ($test[0] > $highBlue) {
                    $highBlue = $test[0];
                }
            }
            
            $gameVals[$index]["red"] = $highRed;
            $gameVals[$index]["green"] = $highGreen;
            $gameVals[$index]["blue"] = $highBlue;
            
            //= Part One =================
            // if ($test[0] > $base[$test[1]]) {
            //     unset($idsTab[$index]);
            //     break 2;
            // }
            // else {
                
            //     $idsTab[$index] = $index;
            // }   
        }
    }
}

$res = array_sum($idsTab);

//= Part Two =========================================

function multi($arr) {
    $totalPower = 0;
    foreach ($arr as $game) {
        $gamepower = array_product($game);
        $totalPower += $gamepower;
    }
    return $totalPower;
}

$res2 = multi($gameVals);

echo "<pre>";
print_r($res2);
echo "</pre>";

