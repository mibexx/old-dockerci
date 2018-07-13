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
            'reset --hard HEAD %s',
            $gitDir
        );
    }


}