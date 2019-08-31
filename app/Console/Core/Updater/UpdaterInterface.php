<?php

namespace App\Console\Core\Updater;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

interface UpdaterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function update(Model $model, array $data): bool;
}
