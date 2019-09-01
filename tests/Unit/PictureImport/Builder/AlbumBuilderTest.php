<?php

namespace Tests\Unit\PictureImport\Builder;

use App\Album;
use App\Console\Core\Builder\BuilderInterface;
use App\Console\PictureImport\Builder\AlbumBuilder;
use Tests\TestCase;

class AlbumBuilderTest extends TestCase
{
    /** @var AlbumBuilder */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new AlbumBuilder();
    }

    public function testIsCorrectInstance(): void
    {
        $this->assertInstanceOf(BuilderInterface::class, $this->builder);
    }

    public function testBuildPicture(): void
    {
        $data = [
            'albumId' => 1,
        ];
        $album = $this->builder->build($data);

        $this->assertInstanceOf(Album::class, $album);
        $this->assertEquals(1, $album->getSourceId());
    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidDataException
     */
    public function testFailedBuildPictureWithEmptyData(): void
    {
        $this->builder->build([]);

        $this->expectException(App\Console\Core\Exception\InvalidDataException::class);
    }
}
