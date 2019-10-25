<?php

go(function () {
    $waitgroup = new Swoole\Coroutine\WaitGroup;
    $waitgroup->add(2);

    $result = [];

    go(function () use ($waitgroup, &$result) {
        co::sleep(2);
        $result[] = 'hello';
        $waitgroup->done();
    });

    go(function () use ($waitgroup, &$result) {
        co::sleep(1);
        $result[] = 'swoole';
        $waitgroup->done();
    });

    $waitgroup->wait();

    var_dump($result);
});
