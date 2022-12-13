<?php

declare(strict_types=1);
$counter = 0;

class Stat
{
    public static $stats = [];

    public $count;
    public $patern;
    public $identifier;

    function __construct(string $patern, string $identifier)
    {
        $this->count = 1;
        $this->pattern = $patern;
        $this->identifier = $identifier;
    }

    public static function lineCheck(string $line)
    {

        foreach (Stat::$stats as $stat) {
            if (preg_match($stat->pattern, $line)) {
                $stat->increment();
                if (!preg_match("/test.DEBUG/", $line)) {
                    return $line;
                }
            }
        }
        //not found add a new stat
        $pattern = '/test.' . substr($line, 27, 4) . "/";
        $id = substr($line, 27, 6);
        array_push(Stat::$stats, new Stat($pattern, $id));
        if (!preg_match("/test.DEBUG/", $line)) {
            return $line;
        }
    }

    public function increment()
    {
        $this->count++;
    }
}


$file_lines = function (string $filename) {
    $file = fopen($filename, 'r');
    while (($line = fgets($file)) !== false) {
        usleep(30000);
        yield $line;
    }
    fclose($file);
};

foreach ($file_lines($argv[1]) as $line) {
    echo (Stat::lineCheck($line));
    $counter++;
    if ($counter > 30) {
        call_user_func('writeOutputCall', Stat::$stats);
        $counter = 0;
    }
}


function writeOutputCall($stats)
{
    foreach ($stats as $stat) {
        echo $stat->identifier . " " . $stat->pattern . " "  . $stat->count . PHP_EOL;
    }
}
