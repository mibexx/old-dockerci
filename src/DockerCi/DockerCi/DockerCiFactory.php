<?php


namespace DockerCi\DockerCi;


use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydrator;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriter;
use DockerCi\DockerCi\Business\Project\Persistor\ProjectWriterInterface;
use DockerCi\Git\GitClient;
use Orm\Xervice\DockerCi\Persistence\ProjectQuery;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\DockerCi\DockerCiConfig getConfig()
 */
class DockerCiFactory extends AbstractFactory
{
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