<?php

$timerId = Swoole\Timer::tick(1000, function() {
    echo "tick 1000ms\n";
});

Swoole\Timer::after(5000, function() use ($timerId) {
    Swoole\Timer::clear($timerId);
});
