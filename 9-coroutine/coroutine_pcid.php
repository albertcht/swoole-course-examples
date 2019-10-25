<?php

echo co::getPcid() . "\n";

go(function () {
    echo co::getPcid() . "\n";
    go(function () {
        echo co::getPcid() . "\n";
        go(function () {
            echo co::getPcid() . "\n";
            go(function () {
                echo co::getPcid() . "\n";
            });
            go(function () {
                echo co::getPcid() . "\n";
            });
            go(function () {
                echo co::getPcid() . "\n";
            });
        });
        echo co::getPcid() . "\n";
    });
    echo co::getPcid() . "\n";
});

echo co::getPcid() . "\n";
