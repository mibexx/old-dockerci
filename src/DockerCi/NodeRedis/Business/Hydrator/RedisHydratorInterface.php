<?php
declare(strict_types=1);

namespace DockerCi\NodeRedis\Business\Hydrator;

use DataProvider\NodeDataProvider;

interface RedisHydratorInterface
{
    /**
     * @return \DataProvider\NodeDataProvider
     */
    public function hydrate(): NodeDataProvider;
}