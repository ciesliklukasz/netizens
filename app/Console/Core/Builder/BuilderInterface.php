<?php

namespace App\Console\Core\Builder;

use Illuminate\Database\Eloquent\Model;

interface BuilderInterface
{
    public function build(array $data): Model;
}
