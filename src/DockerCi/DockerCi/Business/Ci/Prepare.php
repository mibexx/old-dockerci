<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Business\Ci;


use DataProvider\DockerCiDataProvider;
use DataProvider\DockerCiMessageDataProvider;
use DataProvider\ProjectDataProvider;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface;

class Prepare implements PrepareInterface
{
    /**
     * @var ProjectDataProvider
     */
    private $project;

    /**
     * @var \DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface
     */
    private $projectHydrator;

    /**
     * @var string
     */
    private $buildDir;

    /**
     * Prepare constructor.
     *
     * @param \DataProvider\ProjectDataProvider $project
     * @param \DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydratorInterface $projectHydrator
     */
    public function __construct(
        ProjectDataProvider $project,
        ProjectHydratorInterface $projectHydrator,
        string $builDir
    ) {
        $this->project = $project;
        $this->projectHydrator = $projectHydrator;
        $this->buildDir = $builDir;
    }


    /**
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function getDockerCi(): DockerCiDataProvider
    {
        $this->project = $this->projectHydrator->hydrateProject($this->project);
        $dockerDataProvider = $this->createDockerCiDataProvider();
        $this->addMessageToDataProvider($dockerDataProvider);

        return $dockerDataProvider;
    }

    /**
     * @return \DataProvider\DockerCiDataProvider
     */
    protected function createDockerCiDataProvider(): DockerCiDataProvider
    {
        $dockerDataProvider = new DockerCiDataProvider();
        $dockerDataProvider->setProject($this->project);
        $dockerDataProvider->setBuilddir(
            sprintf(
                '%s/project_%s',
                $this->buildDir,
                $this->project->getProjectId()
            )
        );
        return $dockerDataProvider;
    }

    /**
     * @param \DataProvider\DockerCiDataProvider $dockerDataProvider
     */
    protected function addMessageToDataProvider(DockerCiDataProvider $dockerDataProvider): void
    {
        $message = new DockerCiMessageDataProvider();
        $message
            ->setGroup('Prepare')
            ->setMessage(
                sprintf(
                    'Build directory is %s',
                    $dockerDataProvider->getBuilddir()
                )
            );
        $dockerDataProvider->addMessage($message);
    }

}