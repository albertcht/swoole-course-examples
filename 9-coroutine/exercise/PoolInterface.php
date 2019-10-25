<?php

namespace SwooleCourse;

interface PoolInterface
{
    public function __construct($size = 100);

    public function makeResource();

    public function get();

    public function put($resource): bool;
}
