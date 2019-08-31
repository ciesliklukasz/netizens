<?php

namespace App\Console\PictureImport\Updater;

use App\Console\Core\Updater\AbstractUpdater;
use App\Picture;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

class PictureUpdater extends AbstractUpdater
{
    protected $fieldsToUpdate = [
        'author' => '',
        'description' => ''
    ];

    /**
     * @throws InvalidArgumentException
     */
    protected function isValid(Model $model): void
    {
        Assert::isInstanceOf($model, Picture::class);
    }
}
