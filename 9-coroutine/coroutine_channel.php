<?php

$channel = new Swoole\Coroutine\Channel;

go(function () use ($channel) {
    for ($i = 1; $i <= 5; $i++) {
        echo "push {$i}\n";
        $channel->push($i);
        Swoole\Coroutine::sleep(1);
    }
});

go(function () use ($channel) {
    while ($result = $channel->pop()) {
        echo "pop {$result}\n";
    }
});
