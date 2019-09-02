<?php

namespace App\Console\Core\Repository;

use App\Picture;
use Illuminate\Cache\DatabaseStore;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class DatabaseRepository extends DatabaseStore
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection, '');
    }

    public function deleteAll(Model $model): int
    {
        $this->table = $model->getTable();
        return $this->table()->delete();
    }

    public function findBySourceId(int $sourceId)
    {
        $this->table = 'picture';
        return $this->table()
            ->select()
            ->where('source_id', '=', $sourceId)
            ->first();
    }

    public function getAll(string $model): Collection
    {
        $collection = new Collection();
        try
        {
            $reflection = new ReflectionClass($model);
            if (class_exists($model) && $reflection->newInstance() instanceof Model)
            {
                $collection = $model::all();
            }
        }
        catch (\ReflectionException $e)
        {
        }

        return $collection;
    }

    public function exists(Model $model): bool
    {
        $this->table = $model->getTable();
        return null !== $this->table()->find($model->id);
    }
}
