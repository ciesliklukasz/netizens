<?php

namespace App\Console\Commands\Album;

use App\Album;
use App\Console\PictureImport\Updater\AlbumUpdater;
use Exception;
use Illuminate\Console\Command;

class AlbumUpdate extends Command
{
    protected $signature = 'album:update {albumSourceId} {--name=}';
    protected $description = 'Album update';

    /** @var AlbumUpdater */
    private $updater;

    public function __construct(AlbumUpdater $updater)
    {
        parent::__construct();
        $this->updater = $updater;
    }

    public function handle(): void
    {
        try
        {
            $albumId = $this->argument('albumSourceId');
            $album = Album::findBySourceId($albumId);

            if (null === $album)
            {
                $this->alert('Cannot find album source id: ' . $albumId);
                return;
            }

            $this->updater->update($album, $this->options());
            $changes = $album->getChanges();

            if (false === empty($changes))
            {
                $this->info('Picture id: ' . $albumId . ' updated');
                $this->table([array_keys($changes)], [array_values($changes)]);
            }
        }
        catch (Exception $e)
        {
            $this->alert($e->getMessage());
        }
    }
}
