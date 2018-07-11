<?php

namespace DockerCi\DockerConfig\Business\Loader;

use DataProvider\DockerConfigDataProvider;

interface ConfigLoaderInterface
{
    /**
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function getConfig(): DockerConfigDataProvider;
}