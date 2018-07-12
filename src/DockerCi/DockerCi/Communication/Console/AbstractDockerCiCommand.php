<?php


namespace DockerCi\DockerCi\Communication\Console;


use Xervice\Console\Command\AbstractCommand;
use Xervice\Core\Locator\Locator;

abstract class AbstractDockerCiCommand extends AbstractCommand
{
    /**
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function initDatabase(): void
    {
        Locator::getInstance()->database()->facade()->initDatabase();
    }
}