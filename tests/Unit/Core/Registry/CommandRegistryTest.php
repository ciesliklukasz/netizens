<?php

namespace Tests\Unit\Core\Registry;

use App\Console\Core\Registry\CommandRegistry;
use App\Console\Core\Repository\DatabaseRepository;
use App\Console\PictureImport\Builder\PictureBuilder;
use App\Console\PictureImport\Command\DefaultCommand;
use App\Console\PictureImport\Command\OnlyNewCommand;
use App\Console\PictureImport\Command\OverwriteCommand;
use App\Console\PictureImport\Service\AlbumService;
use Tests\TestCase;

class CommandRegistryTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [OverwriteCommand::class, 'overwrite'],
            [OnlyNewCommand::class, 'only_new'],
            [DefaultCommand::class, 'default'],
        ];
    }

    public function testCreateNeRegistry(): void
    {
        $repositry = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $builder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service = $this->getMockBuilder(AlbumService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandRegistry = new CommandRegistry(
            new DefaultCommand($builder, $repositry, $service),
            new OnlyNewCommand($builder, $repositry, $service),
            new OverwriteCommand($builder, $repositry, $service)
        );

        $count = count($commandRegistry->getAll());
        $this->assertEquals(3, $count);
    }

    public function testAddToRegistryTheSameCommands(): void
    {
        $repositry = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $builder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service = $this->getMockBuilder(AlbumService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandRegistry = new CommandRegistry(
            new DefaultCommand($builder, $repositry, $service),
            new DefaultCommand($builder, $repositry, $service),
            new DefaultCommand($builder, $repositry, $service)
        );

        $count = count($commandRegistry->getAll());
        $this->assertEquals(1, $count);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetCommand(string $expected, string $commandType): void
    {
        $repositry = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $builder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service = $this->getMockBuilder(AlbumService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandRegistry = new CommandRegistry(
            new DefaultCommand($builder, $repositry, $service),
            new OnlyNewCommand($builder, $repositry, $service),
            new OverwriteCommand($builder, $repositry, $service)
        );

        $command = $commandRegistry->getCommand($commandType);
        $this->assertInstanceOf($expected, $command);
    }

    /**
     * @expectedException App\Console\Core\Exception\InvalidCommandException
     */
    public function testFailedGetCommand()
    {
        $repositry = $this->getMockBuilder(DatabaseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $builder = $this->getMockBuilder(PictureBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service = $this->getMockBuilder(AlbumService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandRegistry = new CommandRegistry(
            new DefaultCommand($builder, $repositry, $service),
            new OnlyNewCommand($builder, $repositry, $service),
            new OverwriteCommand($builder, $repositry, $service)
        );

        $command = $commandRegistry->getCommand('test');
        $this->expectException(App\Console\Core\Exception\InvalidCommandException::class);
    }
}
