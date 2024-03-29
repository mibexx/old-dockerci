<?php
declare(strict_types=1);


namespace DockerCi\Git;


use DockerCi\Git\Business\Functions\GitClone;
use DockerCi\Git\Business\Functions\GitCloneInterface;
use DockerCi\Git\Business\Functions\GitPull;
use DockerCi\Git\Business\Functions\GitPullInterface;
use DockerCi\Git\Business\Functions\GitReset;
use DockerCi\Git\Business\Functions\GitResetInterface;
use DockerCi\Git\Business\Git\GitShell;
use DockerCi\Git\Business\Git\GitShellInterface;
use Xervice\Shell\ShellFacade;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Git\GitConfig getConfig()
 */
class GitFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\Git\Business\Functions\GitReset
     */
    public function createReset(): GitResetInterface
    {
        return new GitReset(
            $this->createGitShell()
        );
    }

    /**
     * @return \DockerCi\Git\Business\Functions\GitPullInterface
     */
    public function createPull(): GitPullInterface
    {
        return new GitPull(
            $this->createGitShell()
        );
    }

    /**
     * @return \DockerCi\Git\Business\Functions\GitClone
     */
    public function createClone(): GitCloneInterface
    {
        return new GitClone(
            $this->createGitShell()
        );
    }

    /**
     * @return \DockerCi\Git\Business\Git\GitShell
     */
    public function createGitShell(): GitShellInterface
    {
        return new GitShell(
            $this->getShellFacade(),
            $this->getConfig()->getGitCommand()
        );
    }

    /**
     * @return \Xervice\Shell\ShellFacade
     */
    public function getShellFacade(): ShellFacade
    {
        return $this->getDependency(GitDependencyProvider::SHELL_FACADE);
    }
}