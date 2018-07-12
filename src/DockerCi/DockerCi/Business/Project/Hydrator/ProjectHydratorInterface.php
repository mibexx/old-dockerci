<?php

namespace DockerCi\DockerCi\Business\Project\Hydrator;

use DataProvider\ProjectDataProvider;

interface ProjectHydratorInterface
{
    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @return \DataProvider\ProjectDataProvider
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function hydrateProject(ProjectDataProvider $projectDataProvider): ProjectDataProvider;
}