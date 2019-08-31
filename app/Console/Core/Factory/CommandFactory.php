<?php

namespace App\Console\Core\Factory;

use App\Console\Core\Command\CommandInterface;
use App\Console\Core\Exception\InvalidCommandException;
use App\Console\Core\Exception\TooManyArgumentsException;
use App\Console\Core\Registry\CommandRegistry;

class CommandFactory
{
    /** @var CommandRegistry */
    private $registry;

    /**
     * @param CommandRegistry $registry
     */
    public function __construct(CommandRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @throws TooManyArgumentsException
     * @throws InvalidCommandException
     */
    public function getCommand(array $options): CommandInterface
    {
        $count = count(array_filter(array_values($options), function($value) {
            return $value === true;
        }));

        if ($count > 1)
        {
            throw new TooManyArgumentsException('Too many argument passed to command!');
        }

        foreach ($options as $option => $value)
        {
            if ($value)
            {
                return $this->registry->getCommand($option);
            }
        }

        return $this->registry->getCommand('default');
    }
}
