<?php
declare(strict_types=1);

namespace DockerCi\Loadbalancer\Business\Hydrator;

use DataProvider\YamlConfigDataProvider;

interface LoadbalancerHydratorInterface
{
    /**
     * @return \DataProvider\YamlConfigDataProvider
     */
    public function hydrate(): YamlConfigDataProvider;
}