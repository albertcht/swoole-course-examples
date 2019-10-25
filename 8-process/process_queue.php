<?php

$process = new Swoole\Process(function (Swoole\Process $process) {
    echo "I'm a child process. PID: " . $process->pid . "\n";

    while ($message = $process->pop()) {
        if ($message === 'exit') {
            break;
        }
        echo "Message from parent process: {$message}\n";
    }
}, false);

$process->useQueue();
$process->start();

$messages = [
    'Hello world',
    'Swoole is awesome',
    'I love PHP',
    'exit'
];

foreach ($messages as $message) {
    $process->push($message);
}

Swoole\Process::wait();
$process->freeQueue();
