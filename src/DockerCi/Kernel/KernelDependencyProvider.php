<?php


namespace DockerCi\Kernel;


use Xervice\Database\Kernel\DatabaseService;
use Xervice\Kernel\KernelDependencyProvider as XerviceKernelDependencyProvider;

class KernelDependencyProvider extends XerviceKernelDependencyProvider
{
    /**
     * @return array
     */
    protected function getServiceList(): array
    {
        return [
            DatabaseService::class
        ];
    }
}