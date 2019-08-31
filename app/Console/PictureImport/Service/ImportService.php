<?php

namespace App\Console\PictureImport\Service;

use App\Console\API\Client;
use App\Console\Core\Factory\CommandFactory;
use Exception;
use Illuminate\Console\Command;

class ImportService
{
    /** @var CommandFactory */
    private $factory;
    /** @var Client */
    private $client;

    public function __construct(CommandFactory $factory, Client $client)
    {
        $this->factory = $factory;
        $this->client = $client;
    }

    public function import(Command $command): array
    {
        $result = [];

        try
        {
            $response = $this->client->getResponse();
            $options = $command->options();
            $importCommand = $this->factory->getCommand($options);
            $importCommand->execute($response);

            $result = $importCommand->getResult();
        }
        catch (Exception $e)
        {
            $command->alert($e->getMessage());
        }

        return $result;
    }
}
