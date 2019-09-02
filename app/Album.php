<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Album extends Model
{
    protected $table = 'album';
    protected $fillable = ['source_id', 'name'];

    public function getSourceId(): ?int
    {
        return $this->source_id;
    }

    public function getName(): string
    {
        return $this->name ?? '---';
    }

    public function getPictures()
    {
        return $this->hasMany(Picture::class, 'album_id')
            ->getResults();
    }

    public function deleteAllPictures()
    {
        return $this->hasMany(Picture::class, 'album_id')
            ->delete();
    }

    public function isTheSame(int $id): bool
    {
        return $this->getSourceId() === $id;
    }

    public static function findBySourceId(int $id): ?Album
    {
        $query = self::query();
        /** @var Album $album */
        $album = $query->select()
            ->where('source_id', '=', $id)
            ->first();

        return $album;
    }
}
