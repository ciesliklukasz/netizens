<?php

namespace App\Console\PictureImport\Builder;

use App\Console\Core\Builder\BuilderInterface;
use App\Console\Core\Utils\Fingerprint;
use App\Picture;
use Illuminate\Database\Eloquent\Model;

class PictureBuilder implements BuilderInterface
{
    public function build(array $data): Model
    {
        $picture = new Picture();
        $picture->source_id = $data['id'];
        $picture->album_id = $data['albumId'];
        $picture->title = $data['title'];
        $picture->url = $data['url'];
        $picture->thumbnail_url = $data['thumbnailUrl'];
        $picture->fingerprint = Fingerprint::make($data);

        return $picture;
    }
}
