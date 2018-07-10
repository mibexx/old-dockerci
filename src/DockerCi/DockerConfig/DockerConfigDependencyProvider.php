<?php


namespace DockerCi\DockerConfig;


use DockerCi\DockerConfig\Business\Hydrator\HydratorCollection;
use DockerCi\Environment\Business\Plugin\EnvironmentHydratorPlugin;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class DockerConfigDependencyProvider extends AbstractProvider
{
    public const HYDRATOR_COLLECTION = 'hydrator.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $container[self::HYDRATOR_COLLECTION] = function(DependencyProviderInterface $container) {
            return new HydratorCollection(
                $this->getHydratorList()
            );
        };
    }

    /**
     * @return \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface[]
     */
    protected function getHydratorList()
    {
        return [
            new EnvironmentHydratorPlugin()
        ];
    }
}