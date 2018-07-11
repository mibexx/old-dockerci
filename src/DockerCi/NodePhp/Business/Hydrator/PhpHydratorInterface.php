<?php

namespace DockerCi\NodePhp\Business\Hydrator;

use DataProvider\NodeDataProvider;

interface PhpHydratorInterface
{
    /**
     * @return \DataProvider\NodeDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function hydrate(): NodeDataProvider;
}