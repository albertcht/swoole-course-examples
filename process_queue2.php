<?php

$callback = function (Swoole\Process $process) {
    echo "I'm a child process. PID: " . $process->pid . "\n";
    echo "Message from parent process: {$process->pop()}\n";
    sleep(1);
};

$workerNumber = 3;
for ($i = 0; $i < $workerNumber; $i++) {
    $process = new Swoole\Process($callback);
    $process->useQueue();
    $process->start();
}

$messages = [
    'Hello world',
    'Swoole is awesome',
    'I love PHP'
];

foreach ($messages as $message) {
    $process->push($message);
}

Swoole\Process::wait();
Swoole\Process::wait();
Swoole\Process::wait();

$process->freeQueue();
