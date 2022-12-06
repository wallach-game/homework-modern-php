<?php

$data = [
    "[2018-03-13 12:16:10] test.DEBUG: Test message [] []",
    "[2018-03-13 12:16:10] test.ERROR: Test message [] []",
    "[2018-03-13 12:16:10] test.WARNING: Test message [] []",
    "[2018-03-13 12:16:10] test.WARNING: Test message [] []",
    "[2018-03-13 12:16:10] test.INFO: Test message [] []",
    "[2018-03-13 12:16:10] test.NOTICE: Test message [] []",
    "[2018-03-13 12:16:10] test.EMERGENCY: Test message [] []",
    "[2018-03-13 12:16:10] test.ALERT: Test message [] []",
    "[2018-03-13 12:16:10] test.ERROR: Test message [] []",
    "[2018-03-13 12:16:10] test.NOTICE: Test message [] []"
];

$file = fopen("input.txt","a");
for ($i=0; $i < $argv[1]; $i++) { 
    fwrite($file,$data[random_int(0,9)].PHP_EOL);
}
fclose($file);