<?php


namespace DockerCi\DockerCi;


use DockerCi\DockerCi\Business\Ci\Runner;
use DockerCi\DockerCi\Business\Ci\RunnerInterface;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydrator;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriter;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriterInterface;
use DockerCi\Git\GitClient;
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
     * @return \DockerCi\Git\GitClient
     */
    public function getGitClient(): GitClient
    {
        return $this->getDependency(DockerCiDependencyProvider::GIT_CLIENT);
    }
    
    /**
     * @return \Orm\Xervice\DockerCi\Persistence\ProjectQuery
     */
    public function getProjectQuery()
    {
        return ProjectQuery::create();
    }
}