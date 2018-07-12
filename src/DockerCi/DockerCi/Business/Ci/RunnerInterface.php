<?php

namespace DockerCi\DockerCi\Business\Ci;

use DataProvider\DockerCiDataProvider;

interface RunnerInterface
{
    /**
     * @param \DataProvider\DockerCiDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function run(DockerCiDataProvider $dataProvider): DockerCiDataProvider;
}