<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


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
            '--git-dir=%s --work-tree=%s reset --hard HEAD',
            $gitDir . '/.git',
            $gitDir
        );
    }
}