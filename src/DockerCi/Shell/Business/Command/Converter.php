<?php
declare(strict_types=1);


namespace DockerCi\Shell\Business\Command;


class Converter implements ConverterInterface
{
    /**
     * @param $command
     * @param string ...$params
     *
     * @return string
     */
    public function convert($command, ...$params): string
    {
        return sprintf($command, ...$params);
    }
}