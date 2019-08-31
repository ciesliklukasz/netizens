<?php

namespace App\Console\PictureImport\Updater;

use App\Album;
use App\Console\Core\Updater\AbstractUpdater;
use Illuminate\Database\Eloquent\Model;
use Webmozart\Assert\Assert;

class AlbumUpdater extends AbstractUpdater
{
    protected $fieldsToUpdate = [
        'name' => ''
    ];

    protected function isValid(Model $model): void
    {
        Assert::isInstanceOf($model, Album::class);
    }
}
