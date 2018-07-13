<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Functions;


use DataProvider\GitArchiveDataProvider;
use DockerCi\Git\Business\Git\GitShellInterface;

class Archive implements ArchiveInterface
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
     * @param \DataProvider\GitArchiveDataProvider $archiveDataProvider
     *
     * @return string
     */
    public function archive(GitArchiveDataProvider $archiveDataProvider): string
    {
        return $this->gitShell->runGit(
            'archive --remote=%s HEAD:%s %s | tar -x -C %s',
            $archiveDataProvider->getRemote(),
            $archiveDataProvider->getPath(),
            $archiveDataProvider->getFilename(),
            $archiveDataProvider->getTarget()
        );
    }


}