<?php

require 'CacheInterface.php';
require 'CacheTtl.php';

$cache = new SwooleCourse\CacheTtl;
$cache->put('foo', 'bar', 1);

var_dump($cache->get('foo'));

sleep(1);

var_dump($cache->get('foo'));
