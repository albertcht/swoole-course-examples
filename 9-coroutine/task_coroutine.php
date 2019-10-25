<?php

$server = new Swoole\HTTP\Server('0.0.0.0', 9501);

$server->set([
    'worker_num' => 1,
    'task_worker_num' => 4
]);

$server->on('request', function ($request, $response) use ($server) {
    $result = $server->taskCo(['swoole'], 2);
    $response->end($result[0]);
});

$server->on('task', function ($server, $taskId, $fromId, $data) {
    sleep(1);
    return 'hello swoole!';
});

echo "Server is starting...\n";
$server->start();
