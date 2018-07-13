<?php
namespace DockerCiTest\DockerCi\Business\Ci;


use DataProvider\ProjectDataProvider;
use DockerCi\DockerCi\Business\Ci\Prepare;
use DockerCi\DockerCi\Business\Project\Hydrator\ProjectHydrator;

class PrepareTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Business
     * @group Ci
     * @group Prepare
     * @group Unit
     */
    public function testGetDockerCi()
    {
        $project = new ProjectDataProvider();
        $project->setProjectId(1);

        $projectFull = new ProjectDataProvider();
        $projectFull
            ->setProjectId(1)
            ->setName('Test')
            ->setRepository('Repo');

        $hydrator = $this
            ->getMockBuilder(ProjectHydrator::class)
            ->disableOriginalConstructor()
            ->setMethods(['hydrateProject'])
            ->getMock();

        $hydrator
            ->expects($this->once())
            ->method('hydrateProject')
            ->with(
                $this->equalTo($project)
            )
            ->willReturn(
                $projectFull
            );

        $preparer = new Prepare(
            $project,
            $hydrator,
            'build/dir'
        );

        $dockerDataProvider = $preparer->getDockerCi();

        $this->assertEquals(
            1,
            $dockerDataProvider->getProject()->getProjectId()
        );

        $this->assertEquals(
            'Test',
            $dockerDataProvider->getProject()->getName()
        );

        $this->assertEquals(
            'Repo',
            $dockerDataProvider->getProject()->getRepository()
        );

        $this->assertEquals(
            'build/dir/project_1',
            $dockerDataProvider->getBuilddir()
        );
    }


}