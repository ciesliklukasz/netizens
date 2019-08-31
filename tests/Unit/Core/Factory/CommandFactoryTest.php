<?php

namespace Tests\Unit\Core\Factory;

use App\Console\Core\Factory\CommandFactory;
use App\Console\Core\Registry\CommandRegistry;
use App\Console\Core\Repository\DatabaseRepository;
use App\Console\PictureImport\Builder\PictureBuilder;
use App\Console\PictureImport\Command\DefaultCommand;
use App\Console\PictureImport\Command\OnlyNewCommand;
use App\Console\PictureImport\Command\OverwriteCommand;
use App\Console\PictureImport\Service\AlbumService;
use Tests\TestCase;

class CommandFactoryTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                OverwriteCommand::class,
                [
                    'overwrite' => true,
                    'only_new'  => false,
                ],
            ],
            [
                OnlyNewCommand::class,
                [
                    'overwrite' => false,
                    'only_new'  => true,
                ],
            ],
            [
                DefaultCommand::class,
                [
                    'overwrite' => false,
                    'only_new'  => false,
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetCommand(string $expectedCommand, array $options): void
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
        $factory = new CommandFactory($commandRegistry);
        $command = $factory->getCommand($options);

        $this->assertInstanceOf($expectedCommand, $command);
    }

    /**
     * @expectedException App\Console\Core\Exception\TooManyArgumentsException
     */
    public function testFailedGetCommandTooManyArguments(): void
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
        $factory = new CommandFactory($commandRegistry);
        $factory->getCommand([
            'overwrite' => true,
            'only_new'  => true,
        ]);

        $this->expectException(App\Console\Core\Exception\TooManyArgumentsException::class);
    }
}
