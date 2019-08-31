<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $fillable = [
        'source_id',
        'fingerprint',
        'album_id',
        'title',
        'url',
        'thumbnail_url',
        'author',
        'description',
    ];

    public function getSourceId(): ?int
    {
        return $this->source_id;
    }

    public static function findBySourceId(int $id): ?Picture
    {
        $query = self::query();
        /** @var Picture $picture */
        $picture = $query->select()
            ->where('source_id', '=', $id)
            ->first();

        return $picture;
    }

    public static function getFingerprints(): array
    {
        $query = self::query();
        $result = $query->select('fingerprint')->get()->toArray();

        $data = [];
        foreach ($result as $item)
        {
            $data[] = $item['fingerprint'];
        }

        return $data;
    }
}
