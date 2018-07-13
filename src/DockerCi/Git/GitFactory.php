<?php
declare(strict_types=1);


namespace DockerCi\Git;


use DockerCi\Git\Business\Functions\GitClone;
use DockerCi\Git\Business\Functions\GitCloneInterface;
use DockerCi\Git\Business\Git\GitShell;
use DockerCi\Git\Business\Git\GitShellInterface;
use DockerCi\Shell\ShellFacade;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Git\GitConfig getConfig()
 */
class GitFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\Git\Business\Functions\GitClone
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createClone(): GitCloneInterface
    {
        return new GitClone(
            $this->createGitShell()
        );
    }

    /**
     * @return \DockerCi\Git\Business\Git\GitShell
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createGitShell(): GitShellInterface
    {
        return new GitShell(
            $this->getShellFacade(),
            $this->getConfig()->getGitCommand()
        );
    }

    /**
     * @return \DockerCi\Shell\ShellFacade
     */
    public function getShellFacade(): ShellFacade
    {
        return $this->getDependency(GitDependencyProvider::SHELL_FACADE);
    }
}