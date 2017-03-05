#!/usr/bin/php
<?php
define('HEADER_BYTES', 2000);

$options = getopt("n");
$dryRun = false;
if($argv[1] == '-n') {
    $dryRun = true;
    $file = $argv[2];
} else {
    $file = $argv[1];
}

if(!$file) {
    die("File not provided\n");
}


$handle = fopen($file,'r+b');
if(!$handle) {
    die("Can't open file '{$argv[1]}'\n'");
}

// Read the header - 2k bytes is more than enough
$header = fread($handle, HEADER_BYTES);

// Find CREATE DATABASE ... line
removeLine($header, $handle, "CREATE DATABASE ", $dryRun);

echo "\n";
// Find USE ... line
removeLine($header, $handle, "USE ", $dryRun);

function removeLine($string, $file, $match, $dryRun) {
    $start = strpos($string, $match);
    if($start !== false) {
        $stop = strpos($string, ';', $start);

        fseek($file, $start);
        $createLine = fread($file, $stop - $start + 1);
        $overwrite = str_repeat(' ', $stop - $start + 1);

        if($dryRun) {
            echo "String to overwrite at position $start:\n";
            echo "-->$createLine<--\n";
        } else {
            fseek($file, $start);
            fwrite($file, $overwrite);
        }
    } else {
        echo "$match statement not found in first " . HEADER_BYTES . " bytes\n";
    }

}
//echo $header;