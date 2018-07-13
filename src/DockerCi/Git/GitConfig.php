<?php
declare(strict_types=1);


namespace DockerCi\Git;


use Xervice\Core\Config\AbstractConfig;

class GitConfig extends AbstractConfig
{
    public const GIT_COMMAND = 'git.command';

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getGitCommand(): string
    {
        return $this->get(self::GIT_COMMAND, 'git');
    }
}