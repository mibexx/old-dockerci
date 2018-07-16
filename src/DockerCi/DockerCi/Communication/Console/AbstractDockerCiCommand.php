<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Communication\Console;


use Xervice\Console\Command\AbstractCommand;
use Xervice\Core\Locator\Locator;
use Xervice\Database\DatabaseFacade;

abstract class AbstractDockerCiCommand extends AbstractCommand
{
    /**
     */
    public function initDatabase(): void
    {
        $this->getDatabaseFacade()->initDatabase();
    }

    /**
     * @return \Xervice\Database\DatabaseFacade
     */
    private function getDatabaseFacade(): DatabaseFacade
    {
        return Locator::getInstance()->database()->facade();
    }
}