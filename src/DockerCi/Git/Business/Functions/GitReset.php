<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use DockerCi\Git\Business\Git\GitShellInterface;

class GitReset extends AbstractFunction implements GitResetInterface
{
    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function resetHard(string $gitDir): string
    {
        return $this->gitShell->runGit(
            'reset --hard HEAD %s',
            $gitDir
        );
    }


}