<?php

namespace App\Console\PictureImport\Builder;

use App\Album;
use App\Console\Core\Builder\BuilderInterface;
use Illuminate\Database\Eloquent\Model;

class AlbumBuilder implements BuilderInterface
{
    public function build(array $data): Model
    {
        $album = new Album();
        $album->source_id = $data['albumId'];

        return $album;
    }
}
