<?php

namespace DockerCi\Git\Business\Functions;

interface GitPullInterface
{
    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function pull(string $gitDir): string;
}