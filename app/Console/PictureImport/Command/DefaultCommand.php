<?php

namespace App\Console\PictureImport\Command;

class DefaultCommand extends OverwriteCommand
{
    protected const TYPE = 'default';

    public function execute(array $data): void
    {
        $this->addResult(["You don't use any option. Use OverwriteCommand!"]);
        parent::execute($data);
    }
}
