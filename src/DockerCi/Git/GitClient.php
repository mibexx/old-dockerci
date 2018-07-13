<?php
declare(strict_types=1);


namespace DockerCi\Git;


use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use Xervice\Core\Client\AbstractClient;

/**
 * @method \DockerCi\Git\GitFactory getFactory()
 * @method \DockerCi\Git\GitConfig getConfig()
 */
class GitClient extends AbstractClient
{
    /**
     * @param \DataProvider\GitCloneDataProvider $dataProvider
     *
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function clone(GitCloneDataProvider $dataProvider): string
    {
        return $this->getFactory()->createClone()->clone($dataProvider);
    }
}