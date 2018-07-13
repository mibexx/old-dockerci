<?php
declare(strict_types=1);

namespace DockerCi\DockerCi\Business\Ci;

use Xervice\DataProvider\DataProvider\AbstractDataProvider;

interface RunnerInterface
{
    /**
     * @param \DockerCi\DockerCi\Business\Ci\DockerCiDataProvider $dataProvider
     *
     * @return \Xervice\DataProvider\DataProvider\AbstractDataProvider
     */
    public function run(AbstractDataProvider $dataProvider): AbstractDataProvider;
}