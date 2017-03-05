#!/usr/bin/php
<?php

$handle = fopen($argv[1],'c+b');
if(!$handle) {

}
// Read the header - 2k bytes is more than enough
$header = fread($handle,2000);

// Find CREATE DATABASE ... line
$start = strpos($header,"CREATE DATABASE ");
$stop = strpos($header,';',$start);

fseek($handle,$start);
$createLine = fread($handle, $stop-$start+1);
$overwrite = str_repeat(' ',$stop-$start+1);
fseek($handle,$start);
fwrite($handle,$overwrite);

var_dump($createLine);

// Find USE ... line

//echo $header;