<?php

namespace DockerCi\Git\Business\Functions;

interface GitResetInterface
{
    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function resetHard(string $gitDir): string;
}