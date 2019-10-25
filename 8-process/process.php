<?php

$process = new Swoole\Process(function (Swoole\Process $process) {
    echo "I'm a child process. PID: " . $process->pid . "\n";
}, false);

$process->start();
Swoole\Process::wait();
