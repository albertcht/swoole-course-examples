<?php

namespace SwooleCourse;

use Swoole\Table;
use Swoole\Http\Server;

class CacheTtl implements CacheInterface
{
    protected static $timerEnabled = false;

    protected $table;

    // approximately 5.29986 mb
    protected $tableSize = 4096;
    protected $checkPeriod = 60;

    public function __construct(array $options = [])
    {
        if ($options['table_size'] ?? null) {
            $this->tableSize = $options['table_size'];
        }
        if ($options['check_period'] ?? null) {
            $this->checkPeriod = $options['check_period'];
        }

        $this->createTable();
    }

    public function createTable(): void
    {
        $this->table = new Table($this->tableSize);
        $this->table->column('value', Table::TYPE_STRING, 1024);
        $this->table->column('ttl', Table::TYPE_INT, 4);
        $this->table->create();
    }

    public function setCleaner(Server $server, int $workerId): void
    {
        if ($workerId !== 0 || static::$timerEnabled) {
            return;
        }

        swoole_timer_tick($this->checkPeriod * 1000, function () {
            $this->recycle();
        });

        static::$timerEnabled = true;
    }

    public function isExpired(array $result): bool
    {
        return $result['ttl'] <= time();
    }

    public function put(string $key, string $value, int $ttl = 600): void
    {
        $this->table->set($key, [
            'value' => $value,
            'ttl' => time() + $ttl
        ]);
    }

    public function get(string $key): ?string
    {
        $result = $this->table->get($key);

        // clean expired cache
        if ($this->isExpired($result)) {
            $this->table->del($key);
            return null;
        }

        return $result['value'];
    }

    public function forget(string $key): void
    {
        $this->table->del($key);
    }

    public function flush(): void
    {
        foreach ($this->table as $key => $value) {
            $this->table->del($key);
        }
    }

    public function recycle(): void
    {
        $now = time();
        foreach ($this->table as $key => $value) {
            if ($value['ttl'] < $now) {
                $this->table->del($key);
            }
        }
    }
}
