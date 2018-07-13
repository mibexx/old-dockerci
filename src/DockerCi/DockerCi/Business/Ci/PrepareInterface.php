<?php
declare(strict_types=1);

namespace DockerCi\DockerCi\Business\Ci;

use DataProvider\DockerCiDataProvider;

interface PrepareInterface
{
    /**
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function getDockerCi(): DockerCiDataProvider;
}