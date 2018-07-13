<?php
declare(strict_types=1);


namespace DockerCi\DockerCi;


use DataProvider\DockerCiDataProvider;
use DataProvider\ProjectDataProvider;
use DockerCi\Docker\DockerFacade;
use DockerCi\DockerCi\Business\Ci\Prepare;
use DockerCi\DockerCi\Business\Ci\PrepareInterface;
use DockerCi\DockerCi\Business\Ci\Runner;
use DockerCi\DockerCi\Business\Ci\RunnerInterface;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydrator;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriter;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriterInterface;
use DockerCi\Git\GitClient;
use DockerCi\Shell\ShellFacade;
use DockerCi\StepEngine\Business\Step\StepCollection;
use DockerCi\StepEngine\StepEngineFacade;
use Orm\Xervice\DockerCi\Persistence\ProjectQuery;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\DockerCi\DockerCiConfig getConfig()
 */
class DockerCiFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\DockerCi\Business\Ci\Runner
     */
    public function createrCiRunner(): RunnerInterface
    {
        return new Runner(
            $this->getStepEngineFacade(),
            $this->getStepCollection()
        );
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @return \DockerCi\DockerCi\Business\Ci\Prepare
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createCiPrepare(ProjectDataProvider $projectDataProvider): PrepareInterface
    {
        return new Prepare(
            $projectDataProvider,
            $this->createProjectHydrator(),
            $this->getConfig()->getBuildDir()
        );
    }

    /**
     * @return \DockerCi\DockerCi\Business\Project\Persistor\ProjectWriterInterface
     */
    public function createProjectWriter(): ProjectWriterInterface
    {
        return new ProjectWriter(
            $this->getProjectQuery()
        );
    }

    /**
     * @return \DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface
     */
    public function createProjectHydrator(): ProjectHydratorInterface
    {
        return new ProjectHydrator(
            $this->getProjectQuery()
        );
    }

    /**
     * @return \DockerCi\StepEngine\Business\Step\StepCollection
     */
    public function getStepCollection(): StepCollection
    {
        return $this->getDependency(DockerCiDependencyProvider::STEP_COLLECTION);
    }

    /**
     * @return \DockerCi\StepEngine\StepEngineFacade
     */
    public function getStepEngineFacade(): StepEngineFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::STEP_ENGINE_FACADE);
    }

    /**
     * @return \DockerCi\Shell\ShellFacade
     */
    public function getShellFacade(): ShellFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::SHELL_FACADE);
    }

    /**
     * @return \DockerCi\Docker\DockerFacade
     */
    public function getDockerFacade(): DockerFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::DOCKER_FACADE);
    }
    
    /**
     * @return \DockerCi\Git\GitClient
     */
    public function getGitClient(): GitClient
    {
        return $this->getDependency(DockerCiDependencyProvider::GIT_CLIENT);
    }
    
    /**
     * @return \Orm\Xervice\DockerCi\Persistence\ProjectQuery
     */
    public function getProjectQuery(): ProjectQuery
    {
        return ProjectQuery::create();
    }
}