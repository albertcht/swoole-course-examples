<?php

$timerId = Swoole\Timer::tick(1000, function() {
    echo "tick 1000ms\n";
});

Swoole\Timer::after(3000, function() {
    echo "after 3000ms\n";
});

// var_dump(Swoole\Timer::info($timerId));
// var_dump(Swoole\Timer::stats());
