<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use DockerCi\Git\Business\Git\GitShellInterface;

class GitPull extends AbstractFunction implements GitPullInterface
{
    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function pull(string $gitDir): string
    {
        return $this->gitShell->runGit(
            '--git-dir=%s --work-tree=%s pull',
            $gitDir . '/.git',
            $gitDir
        );
    }


}