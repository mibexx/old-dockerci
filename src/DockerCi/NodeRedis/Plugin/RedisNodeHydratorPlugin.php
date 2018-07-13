<?php
declare(strict_types=1);


namespace DockerCi\NodeRedis\Plugin;


use DataProvider\NodeDataProvider;
use DockerCi\NodeRedis\NodeRedisConfig;
use DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\NodeRedis\NodeRedisFactory getFactory()
 */
class RedisNodeHydratorPlugin extends AbstractWithLocator implements NodeHydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\NodeDataProvider $nodeDataProvider
     *
     * @return \DataProvider\NodeDataProvider
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function hydrate(array $data, NodeDataProvider $nodeDataProvider): NodeDataProvider
    {
        $nodeDataProvider = $this->getFactory()->createRedisHydrator(
            $data[NodeRedisConfig::CONFIG_NAME] ?? false,
            $nodeDataProvider
        )->hydrate();

        return $nodeDataProvider;
    }

}