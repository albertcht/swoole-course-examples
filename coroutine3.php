<?php

// Swoole\Runtime::enableCoroutine();

for ($count = 10; $count > 0; $count--) {
    go(function () {
        echo file_get_contents('http://ifconfig.co/ip');
    });
}

echo "Hello Swoole!\n";
