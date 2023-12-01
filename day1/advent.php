<?php

$raw = file_get_contents('data.txt');
// $data = str_replace("\n\n"," ",$raw);
$data = explode("\n", $raw);


//= Part One =========================================

$i = 0;
foreach ($data as $string) {
    
    $tab[$i] = "";
    preg_match('/\d/', $string, $matches);
    $tab[$i] .= $matches[0];

    $string = strrev($string);
    
    preg_match('/\d/', $string, $matches);
    $tab[$i] .= $matches[0];

    $i++;
}

$result = array_sum($tab);

echo "<pre>";
print_r($result);
echo "</pre>";

