<?php

$lock = new Swoole\Lock(SWOOLE_MUTEX);
echo "[Master] create lock\n";
$lock->lock();

if (pcntl_fork() > 0) {
    sleep(1);
    $lock->unlock();
} else {
    echo "[Child] wait lock\n";
    $lock->lock();
    echo "[Child] get lock\n";
    $lock->unlock();
    exit("[Child] exit\n");
}

echo "[Master] release lock\n";
unset($lock);
sleep(1);
echo "[Master] exit\n";
