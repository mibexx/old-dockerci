<?php
declare(strict_types=1);


namespace DockerCi\Docker;


use Xervice\Core\Config\AbstractConfig;

class DockerConfig extends AbstractConfig
{
    public const DOCKER_COMMAND = 'docker.command';

    /**
     * @return string
     */
    public function getDockerCommand(): string
    {
        return $this->get(self::DOCKER_COMMAND, 'docker');
    }
}