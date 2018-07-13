<?php
declare(strict_types=1);


namespace DockerCi\Docker;


use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \DockerCi\Docker\DockerFactory getFactory()
 * @method \DockerCi\Docker\DockerConfig getConfig()
 */
class DockerFacade extends AbstractFacade
{
    /**
     * @param $command
     * @param string ...$params
     *
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function runDockerCommand($command, ...$params): string
    {
        return $this->getFactory()->createDockerShell()->runDockerShell(
            $command,
            ...$params
        );
    }
}