<?php
declare(strict_types=1);


namespace DockerCi\NodeRedis\Business\Hydrator;


use DataProvider\NodeDataProvider;
use DataProvider\RedisConfigDataProvider;

class RedisHydrator implements RedisHydratorInterface
{
    /**
     * @var bool
     */
    private $data;

    /**
     * @var \DataProvider\NodeDataProvider
     */
    private $node;

    /**
     * RedisHydrator constructor.
     *
     * @param bool $data
     * @param \DataProvider\NodeDataProvider $node
     */
    public function __construct(bool $data, NodeDataProvider $node)
    {
        $this->data = $data;
        $this->node = $node;
    }

    /**
     * @return \DataProvider\NodeDataProvider
     */
    public function hydrate(): NodeDataProvider
    {
        $redisConf = new RedisConfigDataProvider();
        $redisConf->setActive($this->data);

        $this->node->setRedis($redisConf);
        return $this->node;
    }

}