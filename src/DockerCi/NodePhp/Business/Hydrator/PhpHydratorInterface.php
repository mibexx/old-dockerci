<?php
declare(strict_types=1);

namespace DockerCi\NodePhp\Business\Hydrator;

use DataProvider\NodeDataProvider;

interface PhpHydratorInterface
{
    /**
     * @return \DataProvider\NodeDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function hydrate(): NodeDataProvider;
}