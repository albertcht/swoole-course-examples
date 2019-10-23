<?php

$cid = go(function () {
    $context = co::getContext();
    $context['a'] = 'b';
    co::yield();
    var_dump($context);
});

go(function () use ($cid) {
    $context = co::getContext();
    $context['a'] = 'c';
    co::resume($cid);
    var_dump($context);
});
