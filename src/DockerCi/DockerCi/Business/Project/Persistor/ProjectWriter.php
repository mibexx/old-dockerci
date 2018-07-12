<?php


namespace DockerCi\DockerCi\Business\Project\Persistor;


use DataProvider\ProjectDataProvider;
use DockerCi\DockerCi\Business\Project\Exception\ProjectException;
use Orm\Xervice\DockerCi\Persistence\Project;
use Orm\Xervice\DockerCi\Persistence\ProjectQuery;

class ProjectWriter implements ProjectWriterInterface
{
    /**
     * @var \Orm\Xervice\DockerCi\Persistence\ProjectQuery
     */
    private $query;

    /**
     * AddProjectCommand constructor.
     *
     * @param \Orm\Xervice\DockerCi\Persistence\ProjectQuery $query
     */
    public function __construct(ProjectQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function add(ProjectDataProvider $projectDataProvider)
    {
        $this->validateProject($projectDataProvider);

        $project = new Project();
        $project->fromArray($projectDataProvider->toArray());
        $project->save();
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    private function validateProject(ProjectDataProvider $projectDataProvider): void
    {
        if (!$projectDataProvider->hasName()) {
            throw new ProjectException('Project name is required');
        }

        if (!$projectDataProvider->hasRepository()) {
            throw new ProjectException('Project repository is required');
        }

        $project = $this->query->findOneByName($projectDataProvider->getName());
        if ($project) {
            throw new ProjectException(
                sprintf(
                    'Project %s already exists',
                    $projectDataProvider->getName()
                )
            );
        }
    }
}