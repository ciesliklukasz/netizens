<?php

namespace App\Console\Core\Updater;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

abstract class AbstractUpdater implements UpdaterInterface
{
    protected $fieldsToUpdate = [];

    public function update(Model $model, array $data): bool
    {
        $this->isValid($model);

        $diff = array_filter(array_intersect_key($data, $this->fieldsToUpdate), function($value) {
            return null !== $value;
        });

        $model->fill($diff);
        return $model->save();
    }

    /**
     * @throws InvalidArgumentException
     */
    abstract protected function isValid(Model $model): void;
}
