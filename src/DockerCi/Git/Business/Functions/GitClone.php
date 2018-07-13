<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use DockerCi\Git\Business\Git\GitShellInterface;

class GitClone extends AbstractFunction implements GitCloneInterface
{
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