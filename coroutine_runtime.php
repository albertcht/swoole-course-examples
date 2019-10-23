<?php

Swoole\Runtime::enableCoroutine();

go(function () {
    echo file_get_contents('http://ifconfig.co/ip');
});

echo "Hello Swoole!\n";
