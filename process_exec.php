<?php

$process = new Swoole\Process(function (Swoole\Process $process) {
    $process->exec('/usr/local/bin/php', [
        __DIR__ . '/echo.php'
    ]);
}, true);

$process->start();

$process->write("Hello Swoole\n");
echo $process->read();

Swoole\Process::wait();
