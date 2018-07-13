<?php
declare(strict_types=1);


namespace DockerCi\Console;


use DockerCi\DockerCi\Communication\Console\AddProjectCommand;
use DockerCi\DockerCi\Communication\Console\RunProjectCommand;
use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\Database\Command\ConfigGenerateCommand;
use Xervice\Database\Command\MigrateCommand;
use Xervice\Database\Command\ModelBuildCommand;
use Xervice\DataProvider\Console\GenerateCommand;
use Xervice\Development\Command\GenerateAutoCompleteCommand;

class ConsoleDependencyProvider extends XerviceConsoleDependencyProvider
{
    /**
     * @return array
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    protected function getCommandList(): array
    {
        return $this->addDevCommands([
            new GenerateCommand(),
            new ConfigGenerateCommand(),
            new MigrateCommand(),
            new ModelBuildCommand(),
            new AddProjectCommand(),
            new RunProjectCommand()
        ]);
    }

    /**
     * @param array $commands
     *
     * @return array
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    private function addDevCommands(array $commands): array
    {
        if (class_exists(GenerateAutoCompleteCommand::class)) {
            $commands[] = new GenerateAutoCompleteCommand();
        }

        return $commands;
    }

}