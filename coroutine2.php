<?php

go(function () {
    $client = new Swoole\Coroutine\Http\Client('ifconfig.co', 80);
    $client->get('/ip');

    echo $client->body;
});

echo "Hello Swoole!\n";
