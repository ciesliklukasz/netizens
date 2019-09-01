<?php

namespace App\Console\Core\Builder;

use App\Console\Core\Exception\InvalidDataException;
use Illuminate\Database\Eloquent\Model;

interface BuilderInterface
{
    /**
     * @throws InvalidDataException
     */
    public function build(array $data): Model;
}
