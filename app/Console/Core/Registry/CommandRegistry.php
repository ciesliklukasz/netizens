<?php

namespace App\Console\Core\Registry;

use App\Console\Core\Command\CommandInterface;
use App\Console\Core\Exception\InvalidCommandException;

class CommandRegistry
{
    private $commands = [];

    public function __construct(CommandInterface ...$commands)
    {
        foreach ($commands as $command)
        {
            $this->add($command);
        }
    }

    /**
     * @param string $type
     * @return CommandInterface
     * @throws InvalidCommandException
     */
    public function getCommand(string $type): CommandInterface
    {
        if (array_key_exists($type, $this->commands))
        {
            return $this->commands[$type];
        }

        throw new InvalidCommandException('Command ' . $type . ' not exists! ');
    }

    /** Only for tests */
    public function getAll(): array
    {
        return $this->commands;
    }

    private function add(CommandInterface $command): void
    {
        $this->commands[$command->getType()] = $command;
    }
}
