<?php

$process = new Swoole\Process(function (Swoole\Process $process) {
    $process->write("I'm a child process. PID: " . $process->pid . "\n");
}, true);

$process->start();
echo $process->read();
Swoole\Process::wait();
