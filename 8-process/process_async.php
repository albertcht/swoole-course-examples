<?php

$process = new Swoole\Process(function (Swoole\Process $process) {
    sleep(3);
    $process->write("I'm a child process. PID: " . $process->pid . "\n");
}, true);

$process->start();

Swoole\Event::add($process->pipe, function (int $pipe) use ($process) {
    echo $process->read();
    Swoole\Event::del($pipe);
    Swoole\Process::wait();
});

echo "I'm a parent process. PID: " . getmypid() . "\n";
