<?php


namespace DockerCi\DockerCi\Business\Project\Hydrator;


use DataProvider\ProjectDataProvider;
use DockerCi\DockerCi\Business\Project\Exception\ProjectException;
use Orm\Xervice\DockerCi\Persistence\ProjectQuery;

class ProjectHydrator implements ProjectHydratorInterface
{
    /**
     * @var \Orm\Xervice\DockerCi\Persistence\ProjectQuery
     */
    private $projectQuery;

    /**
     * ProjectExecutor constructor.
     *
     * @param \Orm\Xervice\DockerCi\Persistence\ProjectQuery $projectQuery
     */
    public function __construct(ProjectQuery $projectQuery)
    {
        $this->projectQuery = $projectQuery;
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @return \DataProvider\ProjectDataProvider
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function hydrateProject(ProjectDataProvider $projectDataProvider): ProjectDataProvider
    {
        $projectEntity = $this->projectQuery->findOneByProjectId(
            $projectDataProvider->getProjectId()
        );

        if (!$projectEntity) {
            throw new ProjectException(
                sprintf(
                    'Project with id %s doesn\'t exist',
                    $projectDataProvider->getProjectId()
                )
            );
        }

        $projectDataProvider->fromArray($projectEntity->toArray());

        return $projectDataProvider;
    }
}