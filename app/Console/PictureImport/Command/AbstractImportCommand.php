<?php

namespace App\Console\PictureImport\Command;

use App\Console\Core\Command\CommandInterface;
use App\Console\Core\Repository\DatabaseRepository;
use App\Console\PictureImport\Builder\PictureBuilder;
use App\Console\PictureImport\Service\AlbumService;

abstract class AbstractImportCommand implements CommandInterface
{
    protected const TYPE = '';

    /** @var PictureBuilder */
    protected $builder;
    /** @var DatabaseRepository */
    protected $repository;
    /** @var AlbumService */
    protected $service;

    private $result = [];

    public function __construct(
        PictureBuilder $builder,
        DatabaseRepository $repository,
        AlbumService $service
    )
    {
        $this->builder = $builder;
        $this->repository = $repository;
        $this->service = $service;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getType(): string
    {
        return static::TYPE;
    }

    protected function addResult(array $data): void
    {
        $this->result = array_merge($this->result, $data);
    }
}
