<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use DockerCi\Git\Business\Git\GitShellInterface;

class GitClone implements GitCloneInterface
{
    /**
     * @var \DockerCi\Git\Business\Git\GitShellInterface
     */
    private $gitShell;

    /**
     * Checkout constructor.
     *
     * @param \DockerCi\Git\Business\Git\GitShellInterface $gitShell
     */
    public function __construct(GitShellInterface $gitShell)
    {
        $this->gitShell = $gitShell;
    }

    /**
     * @param \DataProvider\GitCloneDataProvider $dataProvider
     *
     * @return string
     */
    public function clone(GitCloneDataProvider $dataProvider): string
    {
        return $this->gitShell->runGit(
            'clone %s %s',
            $dataProvider->getRemote(),
            $dataProvider->getTarget()
        );
    }


}