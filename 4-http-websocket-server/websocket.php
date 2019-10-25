<?php

$server = new Swoole\WebSocket\Server('0.0.0.0', 9501);

$server->on('open', function ($server, $request) {
    echo "handshake succeeded with fd {$request->fd}\n";
});

$server->on('message', function ($server, $frame) {
    if ($frame->data === 'exit') {
        $server->disconnect($frame->fd);
        return;
    }

    echo "received from {$frame->fd}:{$frame->data}, opcode:{$frame->opcode}, fin:{$frame->finish}\n";
    $server->push($frame->fd, $frame->data);
});

$server->on('close', function ($server, $fd) {
    echo "client {$fd} closed\n";
});

echo "Server is starting...\n";
$server->start();
