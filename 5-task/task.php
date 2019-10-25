<?php

$server = new Swoole\HTTP\Server('0.0.0.0', 9501);

$server->set([
    'worker_num' => 2,
    'task_worker_num' => 4
]);

$server->on('request', function ($request, $response) use ($server) {
    $taskId = $server->task('data');
    echo "task id: {$taskId}.\n";

    $response->end('Hello Swoole!');
});

$server->on('task', function ($server, $taskId, $fromId, $data) {
    sleep(3);
    $server->finish('ok');
});

$server->on('finish', function ($server, $taskId, $data) {
    echo "receive: `{$data}` from task id: {$taskId}.\n";
});

echo "Server is starting...\n";
$server->start();
