<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Communication\Console;


use Xervice\Console\Command\AbstractCommand;
use Xervice\Core\Locator\Locator;
use Xervice\Database\DatabaseFacade;
use Xervice\Kernel\KernelFacade;

abstract class AbstractDockerCiCommand extends AbstractCommand
{
    public function initApplication(): void
    {
        $this->getKernelFacade()->boot();
    }

    /**
     * @return \Xervice\Kernel\KernelFacade
     */
    private function getKernelFacade(): KernelFacade
    {
        return Locator::getInstance()->kernel()->facade();
    }
}