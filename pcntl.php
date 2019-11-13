<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$start = microtime(true);

$nfork = 0;
$concurrency = 5;
$nums = range(1,10);

foreach($nums as $num){

    if ($nfork == $concurrency) {
        pcntl_wait($status);
        $nfork--;
    }

    $pid = pcntl_fork();
    if ($pid == -1) {
        die('could not fork');
    } else if ($pid) {
        $nfork++;
        continue;
    }
    print($num."\n");
    sleep(5);
    exit;
}
while ($nfork > 0) {
    pcntl_wait($status);
    $nfork--;
}

$secs = microtime(true) - $start;
print("Seconds taken: ".$secs);
