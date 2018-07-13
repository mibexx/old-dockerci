<?php
declare(strict_types=1);


namespace DockerCi\Docker;


use DockerCi\Docker\Business\Shell\DockerShell;
use DockerCi\Docker\Business\Shell\DockerShellInterface;
use DockerCi\Shell\ShellFacade;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Docker\DockerConfig getConfig()
 */
class DockerFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\Docker\Business\Shell\DockerShell
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createDockerShell(): DockerShellInterface
    {
        return new DockerShell(
            $this->getShellFacade(),
            $this->getConfig()->getDockerCommand()
        );
    }
    
    /**
     * @return \DockerCi\Shell\ShellFacade
     */
    public function getShellFacade(): ShellFacade
    {
        return $this->getDependency(DockerDependencyProvider::SHELL_FACADE);
    }
}