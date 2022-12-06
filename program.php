<?php
declare(strict_types=1);

$stats = array(
    (object)["filter"=>'/test\.N/',"count"=>0,"key"=>"notice"],
    (object)["filter"=>'/test\.I/',"count"=>0,"key"=>"info"],
    (object)["filter"=>'/test\.EM/',"count"=>0,"key"=>"energency"],
    (object)["filter"=>'/test\.W/',"count"=>0,"key"=>"warning"],
    (object)["filter"=>'/test\.ER/',"count"=>0,"key"=>"error"],
    (object)["filter"=>'/test\.A/',"count"=>0,"key"=>"alert"],
);

$file_lines = function(string $filename) {
    $file = fopen($filename, 'r');
    while (($line = fgets($file)) !== false) {
        yield $line;
    }
    fclose($file);
};

foreach($file_lines($argv[1]) as $line)
{
    foreach($stats as $stat)
    {
        if(preg_match($stat->filter,$line))
        {
            $stat->count++;
        }
        
    }
    call_user_func('writeOutputCall',$stats);
}

function writeOutputCall($stats)
{
    foreach($stats as $stat){
        echo $stat->key . $stat->count . PHP_EOL;
    }
    system("clear");
}

