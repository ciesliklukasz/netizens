<?php

namespace App\Console\Commands\Picture;

use App\Console\PictureImport\Updater\PictureUpdater;
use App\Picture;
use Exception;
use Illuminate\Console\Command;

class PictureUpdate extends Command
{
    protected $signature = 'picture:update {pictureId} {--title=} {--author=} {--description=}';
    protected $description = 'Picture update';

    /** @var PictureUpdater */
    private $updater;

    public function __construct(PictureUpdater $updater)
    {
        parent::__construct();
        $this->updater = $updater;
    }

    public function handle(): void
    {
        try
        {
            $pictureId = $this->argument('pictureId');
            $picture = Picture::findBySourceId($pictureId);

            if (null === $picture)
            {
                $this->alert('Cannot find picture id: ' . $pictureId);
                return;
            }

            $this->updater->update($picture, $this->options());
            $changes = $picture->getChanges();

            if (false === empty($changes))
            {
                $this->info('Picture id: ' . $pictureId . ' updated');
                $this->table([array_keys($changes)], [array_values($changes)]);
            }
        }
        catch (Exception $e)
        {
            $this->alert($e->getMessage());
        }
    }
}
