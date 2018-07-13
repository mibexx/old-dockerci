<?php
declare(strict_types=1);

namespace DockerCi\DockerCi\Business\Ci;

use Xervice\DataProvider\DataProvider\AbstractDataProvider;

interface RunnerInterface
{
    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     */
    public function run(AbstractDataProvider $dataProvider): AbstractDataProvider;
}