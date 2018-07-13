<?php
declare(strict_types=1);


namespace DockerCi\DockerCi;


use DataProvider\DockerCiDataProvider;
use DataProvider\ProjectDataProvider;
use Xervice\Core\Facade\AbstractFacade;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

/**
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 * @method \DockerCi\DockerCi\DockerCiConfig getConfig()
 */
class DockerCiFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\DockerCiDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function runCi(DockerCiDataProvider $dataProvider): DataProviderInterface
    {
        return $this->getFactory()->createrCiRunner()->run($dataProvider);
    }

    /**
     * @param \DataProvider\ProjectDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function prepareCi(ProjectDataProvider $dataProvider): DockerCiDataProvider
    {
        return $this->getFactory()->createCiPrepare($dataProvider)->getDockerCi();
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @return \DataProvider\ProjectDataProvider
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function getProject(ProjectDataProvider $projectDataProvider): ProjectDataProvider
    {
        return $this->getFactory()->createProjectHydrator()->hydrateProject($projectDataProvider);
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addProject(ProjectDataProvider $projectDataProvider): void
    {
        $this->getFactory()->createProjectWriter()->add($projectDataProvider);
    }
}