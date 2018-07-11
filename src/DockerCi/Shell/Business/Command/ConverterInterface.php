<?php

namespace DockerCi\Shell\Business\Command;

interface ConverterInterface
{
    /**
     * @param $command
     * @param string ...$params
     *
     * @return string
     */
    public function convert($command, ...$params): string;
}