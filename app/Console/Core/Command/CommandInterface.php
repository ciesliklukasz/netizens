<?php

namespace App\Console\Core\Command;

interface CommandInterface
{
    public function execute(array $data): void;
    public function getType(): string;
    public function getResult(): array;
}
