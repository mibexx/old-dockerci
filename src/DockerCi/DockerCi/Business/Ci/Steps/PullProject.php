<?php


namespace DockerCi\DockerCi\Business\Ci\Steps;


use DataProvider\GitCloneDataProvider;
use DockerCi\DockerCi\Business\Ci\Exception\CiException;

/**
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 */
class PullProject extends AbstractStep
{
    /**
     * @return bool
     */
    public function isNeeded(): bool
    {
        return true;
    }

    /**
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function preCheck(): void
    {
        if (!is_dir($this->getData()->getBuilddir() . '/.git')) {
            throw new CiException('Project could not be cloned');
        }
    }

    /**
    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function execute(): void
    {
        $this->getFactory()->getGitClient()->resetHard($this->getData()->getBuilddir());
        $this->getFactory()->getGitClient()->pull($this->getData()->getBuilddir());
        $this->addMessage(
            'Project was pulled',
            'Prepare'
        );
    }
}
