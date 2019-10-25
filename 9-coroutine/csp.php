<?php

$chan = new Swoole\Coroutine\Channel(1);

go(function () use ($chan) {
    for ($i = 1; $i <= 5; $i++) {
        echo "push: $i\n";
        $chan->push($i);
        co::sleep(1);
    }
});

go(function () use ($chan) {
    while (true) {
        echo "pop: {$chan->pop()}\n";
    }
});

Swoole\Event::wait();
