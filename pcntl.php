<?php

$pid = pcntl_fork();

if ($pid === -1) {
    die('fork failed');
} elseif ($pid === 0) {
    // child process
    echo "I'm a child process. PID: " . getmypid() . "\n";
} elseif ($pid > 0) {
    // parent process
    echo "I'm a parent process. PID: " . getmypid() . "\n";
}
