<?php

$atomic = new Swoole\Atomic(1);

$atomic->add(2);

var_dump($atomic->get());
