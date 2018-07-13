<?php
declare(strict_types=1);


namespace DockerCi\Git;


use DataProvider\GitArchiveDataProvider;
use Xervice\Core\Client\AbstractClient;

/**
 * @method \DockerCi\Git\GitFactory getFactory()
 * @method \DockerCi\Git\GitConfig getConfig()
 */
class GitClient extends AbstractClient
{
    /**
     * @param \DataProvider\GitArchiveDataProvider $archiveDataProvider
     *
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function archive(GitArchiveDataProvider $archiveDataProvider): string
    {
        return $this->getFactory()->createArchive()->archive($archiveDataProvider);
    }
}