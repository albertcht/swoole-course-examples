<?php

$variable = null;

$cid = go(function () {
    global $variable;
    $variable = 'a';
    co::yield();
    echo $variable . "\n";
});

go(function () use ($cid) {
    global $variable;
    $variable = 'b';
    co::resume($cid);
    echo $variable . "\n";
});
