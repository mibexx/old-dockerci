<?php


namespace DockerCi\DockerCi\Business\Ci\Steps;


use DataProvider\GitCloneDataProvider;
use DockerCi\DockerCi\Business\Ci\Exception\CiException;

/**
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 */
class CloneProject extends AbstractStep
{
    /**
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function preCheck(): void
    {
        if (!is_dir($this->getData()->getBuilddir())) {
            throw new CiException('Build dir does not exist');
        }
    }

    /**
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function postCheck(): void
    {
        if (!is_dir($this->getData()->getBuilddir() . '/.git')) {
            throw new CiException('Project could not be cloned');
        }

        if (!is_file($this->getData()->getBuilddir() . '/.dockerci.yml')) {
            throw new CiException('No config file found');
        }
    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function execute(): void
    {
        $gitClone = new GitCloneDataProvider();
        $gitClone
            ->setRemote($this->getData()->getProject()->getRepository())
            ->setTarget($this->getData()->getBuilddir());

        $this->getFactory()->getGitClient()->clone($gitClone);
        $this->addMessage(
            'Project was cloned',
            'Prepare'
        );
    }
}
