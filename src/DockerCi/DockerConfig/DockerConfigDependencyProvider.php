<?php
declare(strict_types=1);


namespace DockerCi\DockerConfig;


use DockerCi\DockerConfig\Business\Hydrator\HydratorCollection;
use DockerCi\Environment\Business\Plugin\EnvironmentHydratorPlugin;
use DockerCi\Loadbalancer\Plugin\LoadbalancerDockerConfigPlugin;
use DockerCi\Nodes\Plugin\NodeDockerConfigPlugin;
use DockerCi\Volume\Business\Plugin\VolumeHydratorPlugin;
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
    public function handleDependencies(DependencyProviderInterface $container): void
    {
        $container[self::HYDRATOR_COLLECTION] = function() {
            return new HydratorCollection(
                $this->getHydratorList()
            );
        };
    }

    /**
     * @return \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface[]
     */
    protected function getHydratorList(): array
    {
        return [
            new LoadbalancerDockerConfigPlugin(),
            new NodeDockerConfigPlugin()
        ];
    }
}