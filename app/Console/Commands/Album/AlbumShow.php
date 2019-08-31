<?php

namespace App\Console\Commands\Album;

use App\Album;
use Illuminate\Console\Command;

class AlbumShow extends Command
{
    protected $signature = 'album:show {albumSourceId}';
    protected $description = 'Show update';

    public function handle(): void
    {
        $albumId = $this->argument('albumSourceId');
        $album = Album::findBySourceId($albumId);

        if (null === $album)
        {
            $this->alert('Cannot find album source id: ' . $albumId);
            return;
        }

        $this->info(
            sprintf('Album ID: %s, name: %s', $album->getSourceId(), $album->getName())
        );
        $pictures = $album->getPictures();
        $this->table(
            [], $pictures->toArray()
        );
    }
}
