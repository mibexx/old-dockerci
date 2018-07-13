<?php


namespace DockerCiTest\DockerCi\Business\Ci\Steps;


use DataProvider\DockerCiDataProvider;
use DataProvider\ProjectDataProvider;

class StepTestCase extends \Codeception\Test\Unit
{
    /**
     * @return \DataProvider\DockerCiDataProvider
     */
    protected function createDockerCiDataProvider(): DockerCiDataProvider
    {
        $dataProvider = new DockerCiDataProvider();
        $dataProvider->setProject(
            $this->createProjectDataProvider()
        );
        $dataProvider->setBuilddir(__DIR__ . '/Workdir/project_1');

        return $dataProvider;
    }

    /**
     * @return \DataProvider\ProjectDataProvider
     */
    protected function createProjectDataProvider(): ProjectDataProvider
    {
        $project = new ProjectDataProvider();
        $project
            ->setProjectId(1)
            ->setName('Test')
            ->setRepository('Repo');

        return $project;
    }
}