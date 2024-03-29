<?php
declare(strict_types=1);

namespace DockerCi\DockerCi\Business\Ci;

use DataProvider\DockerCiDataProvider;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

interface RunnerInterface
{
    /**
     * @param \DataProvider\DockerCiDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function run(DockerCiDataProvider $dataProvider): DataProviderInterface;
}