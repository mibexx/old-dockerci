<?php
declare(strict_types=1);


namespace DockerCi\Docker;


use Xervice\Core\Config\AbstractConfig;

class DockerConfig extends AbstractConfig
{
    const DOCKER_COMMAND = 'docker.command';

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getDockerCommand()
    {
        return $this->get(self::DOCKER_COMMAND, 'docker');
    }
}