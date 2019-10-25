<?php

require 'PoolInterface.php';
require 'ResourcePool.php';

$pool = null;
go(function () use (&$pool) {
    $pool = new SwooleCourse\ResourcePool(2);
});

for ($i = 0; $i < 3; $i++) {
    go(function () use ($pool) {
        var_dump($resource = $pool->get());
        co::sleep(3);
        var_dump($pool->put($resource));
    });
}
