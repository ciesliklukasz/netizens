<?php

namespace App\Console\PictureImport\Builder;

use App\Album;
use App\Console\Core\Builder\AbstractBuilder;
use App\Console\Core\Builder\BuilderInterface;
use Illuminate\Database\Eloquent\Model;

class AlbumBuilder extends AbstractBuilder
{
    protected $requiredFields = ['albumId'];

    public function build(array $data): Model
    {
        $this->validData($data);
        $album = new Album();
        $album->source_id = $data['albumId'];

        return $album;
    }
}
