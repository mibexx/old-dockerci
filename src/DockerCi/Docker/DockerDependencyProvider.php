<?php


namespace DockerCi\Docker;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class DockerDependencyProvider extends AbstractProvider
{
    const SHELL_FACADE = 'shell.facade';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $container[self::SHELL_FACADE] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->shell()->facade();
        };
    }
}