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
    $results[] = $result;
    if (count($results) === count($requests)) {
        break;
    }
}

while (Swoole\Process::wait()) {
    // do nothing
}

var_dump($results);
