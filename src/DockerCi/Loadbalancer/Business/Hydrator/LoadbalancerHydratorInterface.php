<?php

namespace DockerCi\Loadbalancer\Business\Hydrator;

use DataProvider\DockerConfigDataProvider;

interface LoadbalancerHydratorInterface
{
    /**
     * @return \DataProvider\DockerConfigDataProvider
     */
    public function hydrate(): DockerConfigDataProvider;
}