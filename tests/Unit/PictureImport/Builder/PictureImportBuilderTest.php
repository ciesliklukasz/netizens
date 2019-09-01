<?php

namespace Tests\Unit\PictureImport\Builder;

use App\Console\Core\Builder\BuilderInterface;
use App\Console\Core\Utils\Fingerprint;
use App\Console\PictureImport\Builder\PictureBuilder;
use App\Picture;
use Tests\TestCase;

class PictureImportBuilderTest extends TestCase
{
    /** @var PictureBuilder */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new PictureBuilder();
    }

    public function testIsCorrectInstance(): void
    {
        $this->assertInstanceOf(BuilderInterface::class, $this->builder);
    }

    public function testBuildPicture(): void
    {
        $data = [
            'id'           => 1,
            'albumId'      => 1,
            'title'        => 'test',
            'url'          => 'https://test.pl/picture.jpg',
            'thumbnailUrl' => 'https://test.pl/thumbnail/picture.jpg',
        ];
        $picture = $this->builder->build($data);


        $this->assertInstanceOf(Picture::class, $picture);
        $this->assertEquals(1, $picture->getSourceId());
        $this->assertEquals(1, $picture->getAlbumId());
        $this->assertEquals('test', $picture->getTitle());
        $this->assertEquals('https://test.pl/picture.jpg', $picture->getUrl());
        $this->assertEquals('https://test.pl/thumbnail/picture.jpg', $picture->getThumbnailUrl());
        $this->assertEquals(Fingerprint::make($data), $picture->getFingerprint());

    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidDataException
     */
    public function testFailedBuildPictureWithEmptyData(): void
    {
        $this->builder->build([]);

        $this->expectException(App\Console\Core\Exception\InvalidDataException::class);
    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidDataException
     */
    public function testFailedBuildPictureWithMissingData(): void
    {
        $data = [
            'id'           => 1,
            'albumId'      => 1,
            'title'        => 'test',
            'url'          => 'https://test.pl/picture.jpg',
        ];
        $this->builder->build($data);

        $this->expectException(App\Console\Core\Exception\InvalidDataException::class);
    }
}
