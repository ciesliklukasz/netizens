<?php

namespace App\Console\PictureImport\Builder;

use App\Console\Core\Builder\AbstractBuilder;
use App\Console\Core\Exception\InvalidDataException;
use App\Console\Core\Utils\Fingerprint;
use App\Picture;
use Illuminate\Database\Eloquent\Model;

class PictureBuilder extends AbstractBuilder
{
    protected $requiredFields = [
        'id',
        'albumId',
        'title',
        'url',
        'thumbnailUrl',
    ];

    /**
     * @throws InvalidDataException
     */
    public function build(array $data): Model
    {
        $this->validData($data);
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
