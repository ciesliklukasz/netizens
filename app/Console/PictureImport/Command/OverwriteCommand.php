<?php

namespace App\Console\PictureImport\Command;

use App\Album;
use App\Picture;

class OverwriteCommand extends AbstractImportCommand
{
    protected const TYPE = 'overwrite';

    public function execute(array $data): void
    {
        $this->repository->deleteAll(new Album());
        $this->addResult(['Remove all pictures!']);

        $i = 0;
        foreach ($data as $element)
        {
            $this->service->buildAlbum($element);
            /** @var Picture $picture */
            $picture = $this->builder->build($element);
            $picture->save();
            $i++;
        }

        $this->addResult(['Add ' . $i . ' pictures']);
    }
}
