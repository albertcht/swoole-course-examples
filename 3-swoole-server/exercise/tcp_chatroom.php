<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$server->on('connect', function ($server, $fd){
    echo "Client {$fd} connected.\n";
});

$server->on('receive', function ($server, $fd, $reactorId, $data) {
    if (trim($data) === 'exit') {
        $server->close($fd);
        return;
    }

    broadcast($server, $fd, $data);
});

$server->on('close', function ($server, $fd) {
    echo "Client {$fd} closed.\n";
});

echo "Server is starting...\n";
$server->start();

function broadcast($server, $from, $message)
{
    $i = 0;
    while (true) {
        if (! $fds = $server->getClientList($i, 100)) {
            break;
        }
        $i = end($fds);

        foreach ($fds as $fd) {
            $server->send($fd, "Message from {$from}: {$message}");
        }
    }
}
