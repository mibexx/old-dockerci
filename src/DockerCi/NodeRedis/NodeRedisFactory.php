<?php
declare(strict_types=1);


namespace DockerCi\NodeRedis;


use DataProvider\NodeDataProvider;
use DockerCi\NodeRedis\Business\Hydrator\RedisHydrator;
use DockerCi\NodeRedis\Business\Hydrator\RedisHydratorInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\NodeRedis\NodeRedisConfig getConfig()
 */
class NodeRedisFactory extends AbstractFactory
{
    /**
     * @param string $data
     * @param \DataProvider\NodeDataProvider $nodeDataProvider
     *
     * @return \DockerCi\NodeRedis\Business\Hydrator\RedisHydrator
     */
    public function createRedisHydrator(bool $data, NodeDataProvider $nodeDataProvider): RedisHydratorInterface
    {
        return new RedisHydrator(
            $data,
            $nodeDataProvider
        );
    }
}