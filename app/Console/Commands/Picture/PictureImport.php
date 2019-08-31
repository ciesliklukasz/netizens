<?php

namespace App\Console\Commands\Picture;

use App\Console\PictureImport\Service\ImportService;
use Illuminate\Console\Command;

class PictureImport extends Command
{
    protected $signature = 'picture:import {--overwrite} {--only_new}';
    protected $description = 'Import pictures';

    /** @var ImportService */
    private $service;

    public function __construct(ImportService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle(): void
    {
        $result = $this->service->import($this);

        foreach ($result as $key => $value)
        {
            if (is_string($value))
            {
                $this->info($value);
            }
            else
            {
                $this->table([$key], [$value]);
            }
        }
    }
}
