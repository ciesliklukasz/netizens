<?php

namespace App\Console\Commands\Album;

use App\Album;
use Illuminate\Console\Command;

class AlbumDeletePictures extends Command
{
    protected $signature = 'album:delete_pictures {albumSourceId}';
    protected $description = 'Delete all pictures from album';

    public function handle(): void
    {
        $albumId = $this->argument('albumSourceId');
        $album = Album::findBySourceId($albumId);

        if (null === $album)
        {
            $this->alert('Cannot find album source id: ' . $albumId);
            return;
        }

        $result = $album->deleteAllPictures();

        $this->info($result . ' was deleted');
    }
}
