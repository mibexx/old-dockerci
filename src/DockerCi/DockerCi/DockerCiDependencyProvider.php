<?php


namespace DockerCi\DockerCi;


use function foo\func;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class DockerCiDependencyProvider extends AbstractProvider
{
    const GIT_CLIENT = 'git.client';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $container[self::GIT_CLIENT] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->git()->client();
        };
    }
}