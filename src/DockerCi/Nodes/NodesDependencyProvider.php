<?php


namespace DockerCi\Nodes;


use DockerCi\NodePhp\Plugin\PhpNodeHydratorPlugin;
use DockerCi\NodeRedis\Plugin\RedisNodeHydratorPlugin;
use DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorCollection;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class NodesDependencyProvider extends AbstractProvider
{
    public const NODE_HYDRATOR_COLLECTION = 'node.hydrator.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $container[self::NODE_HYDRATOR_COLLECTION] = function() {
            return new NodeHydratorCollection(
                $this->getNodeHydratorList()
            );
        };
    }

    /**
     * @return \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface[]
     */
    protected function getNodeHydratorList(): array
    {
        return [
            new PhpNodeHydratorPlugin(),
            new RedisNodeHydratorPlugin()
        ];
    }
}