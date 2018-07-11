<?php

namespace DockerCi\Shell\Business\Provider;

interface ProviderInterface
{
    /**
     * @param string $command
     * @param mixed ...$params
     *
     * @return string
     */
    public function execute(string $command, ...$params): string;
}