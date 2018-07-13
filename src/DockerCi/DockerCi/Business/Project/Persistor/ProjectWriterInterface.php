<?php
declare(strict_types=1);

namespace DockerCi\DockerCi\Business\Project\Persistor;

use DataProvider\ProjectDataProvider;

interface ProjectWriterInterface
{
    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     *
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function add(ProjectDataProvider $projectDataProvider);
}