<?php

namespace DockerCi\Docker\Business\Shell;

interface DockerShellInterface
{
    /**
     * @param string $command
     * @param string ...$params
     *
     * @return string
     */
    public function runDockerShell(string $command, ...$params): string;
}