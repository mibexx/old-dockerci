<?php


namespace DockerCi\DockerCi;


use DataProvider\ProjectDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 * @method \DockerCi\DockerCi\DockerCiConfig getConfig()
 * @method \DockerCi\DockerCi\DockerCiClient getClient()
 */
class DockerCiFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addProject(ProjectDataProvider $projectDataProvider)
    {
        $this->getFactory()->createProjectWriter()->add($projectDataProvider);
    }
}