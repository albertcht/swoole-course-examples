<?php

$lock = new Swoole\Lock(SWOOLE_RWLOCK);
echo "[Master] create read lock\n";
$lock->lock_read();

if (pcntl_fork() > 0) {
    sleep(1);
    $lock->unlock();
} else {
    echo "[Child] no wait for lock\n";
    $lock->lock_read();
    echo "[Child] get read lock\n";
    $lock->unlock();
    exit("[Child] exit\n");
}

echo "[Master] release lock\n";
unset($lock);
sleep(1);
echo "[Master] exit\n";
