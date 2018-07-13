<?php
declare(strict_types=1);


namespace DockerCi\Git;


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
     */
    public function clone(GitCloneDataProvider $dataProvider): string
    {
        return $this->getFactory()->createClone()->clone($dataProvider);
    }

    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function resetHard(string $gitDir): string
    {
        return $this->getFactory()->createReset()->resetHard($gitDir);
    }

    /**
     * @param string $gitDir
     *
     * @return string
     */
    public function pull(string $gitDir): string
    {
        return $this->getFactory()->createPull()->pull($gitDir);
    }
}