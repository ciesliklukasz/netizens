<?php

namespace App\Console\Commands\Album;

use App\Album;
use Exception;
use Illuminate\Console\Command;

class AlbumDelete extends Command
{
    protected $signature = 'album:delete {albumSourceId}';
    protected $description = 'Delete album with pictures';

    public function handle(): void
    {
        $albumId = $this->argument('albumSourceId');
        $album = Album::findBySourceId($albumId);

        if (null === $album)
        {
            $this->alert('Cannot find album source id: ' . $albumId);
            return;
        }

        try
        {
            $album->delete();
            $this->info('Album id: ' . $albumId . ' was deleted');
        }
        catch (Exception $e)
        {
            $this->alert($e->getMessage());
        }
    }
}
