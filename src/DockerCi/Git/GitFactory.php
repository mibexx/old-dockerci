<?php


namespace DockerCi\Git;


use DockerCi\Git\Business\Functions\Archive;
use DockerCi\Git\Business\Functions\ArchiveInterface;
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
     * @return \DockerCi\Git\Business\Functions\Archive
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createArchive(): ArchiveInterface
    {
        return new Archive(
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