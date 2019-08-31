<?php

namespace App\Console\PictureImport\Service;

use App\Album;
use App\Console\Core\Repository\DatabaseRepository;
use App\Console\PictureImport\Builder\AlbumBuilder;

class AlbumService
{
    /** @var AlbumBuilder */
    private $builder;
    /** @var DatabaseRepository */
    private $repository;
    /** @var Album */
    private $album;

    public function __construct(AlbumBuilder $builder, DatabaseRepository $repository)
    {
        $this->builder = $builder;
        $this->repository = $repository;
    }

    public function buildAlbum(array $data): void
    {
        $album = null;
        $isNull = null === $this->getAlbum();
        $isOther = false === $isNull && false === $this->getAlbum()->isTheSame($data['albumId']);

        if ($isNull)
        {
            /** @var Album $album */
            $album = $this->builder->build($data);
        }
        elseif ($isOther)
        {
            /** @var Album $album */
            $album = $this->builder->build($data);
        }

        if (null !== $album)
        {
            if (false === $this->repository->exists($album))
            {
                $album->save();
            }

            $this->cacheAlbum($album);
        }
    }

    /**
     * @return Album
     */
    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    private function cacheAlbum(Album $album): void
    {
        $this->album = $album;
    }
}
