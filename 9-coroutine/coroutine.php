<?php

go(function () {
    co::sleep(2);
    echo "Hello world!\n";
});

go(function () {
    co::sleep(1);
    echo "Swoole is awesome!\n";
});

echo "PHP is the best!\n";
