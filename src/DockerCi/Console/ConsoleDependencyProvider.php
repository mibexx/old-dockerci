<?php


namespace DockerCi\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\DataProvider\Console\GenerateCommand;
use Xervice\Development\Command\GenerateAutoCompleteCommand;

class ConsoleDependencyProvider extends XerviceConsoleDependencyProvider
{
    /**
     * @return array
     */
    protected function getCommandList(): array
    {
        return $this->addDevCommands([
            new GenerateCommand()
        ]);
    }

    /**
     * @param array $commands
     *
     * @return array
     */
    private function addDevCommands(array $commands): array
    {
        if (class_exists(GenerateAutoCompleteCommand::class)) {
            $commands[] = new GenerateAutoCompleteCommand();
        }

        return $commands;
    }

}