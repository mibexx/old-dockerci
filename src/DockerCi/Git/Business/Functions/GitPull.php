<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


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