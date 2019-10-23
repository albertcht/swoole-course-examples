<?php

$requests = [
    'https://ifconfig.co/ip',
    'https://ifconfig.co/ip',
    'https://ifconfig.co/ip',
    'https://ifconfig.co/ip',
    'https://ifconfig.co/ip'
];

foreach ($requests as $request) {
    $process = new Swoole\Process(function (Swoole\Process $process) use ($request) {
        $process->push(trim(file_get_contents($request)));
    });
    $process->useQueue();
    $process->start();
}

$results = [];
while ($result = $process->pop()) {
    if (count($results) === count($requests) - 1) {
        break;
    }
    $results[] = $result;
}


while (Swoole\Process::wait()) {
    // do nothing
}

var_dump($results);
