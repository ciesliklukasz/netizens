<?php

namespace Tests\Unit\PictureImport\Command;

use App\Album;
use App\Console\Core\Repository\DatabaseRepository;
use App\Console\PictureImport\Builder\AlbumBuilder;
use App\Console\PictureImport\Builder\PictureBuilder;
use App\Console\PictureImport\Command\OverwriteCommand;
use App\Console\PictureImport\Service\AlbumService;
use App\Picture;
use Tests\TestCase;

class OverwriteCommandTest extends TestCase
{
    public function testExecute()
    {
        $repository = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $album = $this->getMockBuilder(Album::class)
            ->disableOriginalConstructor()
            ->getMock();
        $picture = $this->getMockBuilder(Picture::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumBuilder = $this->getMockBuilder(AlbumBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumBuilder->method('build')->willReturn($album);
        $pictureBuilder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pictureBuilder->method('build')->willReturn($picture);

        $albumService = new AlbumService($albumBuilder, $repository);
        $command = new OverwriteCommand(
            $pictureBuilder,
            $repository,
            $albumService);

        $data = [
            1 => [
                'id'           => 1,
                'albumId'      => 1,
                'title'        => 'test',
                'url'          => 'https://test.pl/picture.jpg',
                'thumbnailUrl' => 'https://test.pl/thumbnail/picture.jpg',
            ],
        ];

        $repository->expects($this->once())->method('deleteAll');
        $album->expects($this->once())->method('save');
        $picture->expects($this->once())->method('save');

        $command->execute($data);
    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidDataException
     */
    public function testExecuteFailedBuildAlbum(): void
    {
        $repository = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumBuilder = $this->getMockBuilder(AlbumBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pictureBuilder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $albumService = new AlbumService($albumBuilder, $repository);

        $command = new OverwriteCommand(
            $pictureBuilder,
            $repository,
            $albumService);

        $albumBuilder->expects($this->once())->method('build')->willThrowException(new \App\Console\Core\Exception\InvalidDataException());

        $command->execute([1 => []]);

        $this->expectException(App\Console\Core\Exception\InvalidDataException::class);
    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidDataException
     */
    public function testExecuteFailedBuildPicture(): void
    {
        $repository = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumBuilder = $this->getMockBuilder(AlbumBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pictureBuilder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumService = $this->getMockBuilder(AlbumService::class)
            ->disableOriginalConstructor()
            ->setConstructorArgs([$albumBuilder, $repository])
            ->getMock();

        $command = new OverwriteCommand(
            $pictureBuilder,
            $repository,
            $albumService);

        $albumService->expects($this->once())->method('buildAlbum');
        $pictureBuilder->expects($this->once())->method('build')->willThrowException(new \App\Console\Core\Exception\InvalidDataException());

        $command->execute([
            1 => [
                'id'      => 1,
                'albumId' => 1,
                'title'   => 'test',
                'url'     => 'https://test.pl/picture.jpg',
            ],
        ]);

        $this->expectException(App\Console\Core\Exception\InvalidDataException::class);
    }
}
