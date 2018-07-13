<?php
declare(strict_types=1);

namespace DockerCi\Git\Business\Git;

interface GitShellInterface
{
    /**
     * @param string $command
     * @param string ...$params
     *
     * @return string
     */
    public function runGit(string $command, ...$params): string;
}