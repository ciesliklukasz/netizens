<?php

namespace App\Console\Core\Builder;

use App\Console\Core\Exception\InvalidDataException;

abstract class AbstractBuilder implements BuilderInterface
{
    protected $requiredFields = [];

    /**
     * @throws InvalidDataException
     */
    protected function validData(array $data): void
    {
        $diffExists = array_diff($this->requiredFields, array_keys($data));

        if (empty($data) || $diffExists)
        {
            throw new InvalidDataException('Invalid data!');
        }
    }
}
