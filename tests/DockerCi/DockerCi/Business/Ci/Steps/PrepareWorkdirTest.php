<?php
namespace DockerCiTest\DockerCi\Business\Ci\Steps;

use DockerCi\DockerCi\Business\Ci\Steps\PrepareWorkdir;

class PrepareWorkdirTest extends StepTestCase
{
    protected function _after()
    {
        if (is_dir(__DIR__ . '/Workdir/project_1')) {
            rmdir(__DIR__ . '/Workdir/project_1');
        }
    }


    /**
     * @group DockerCi
     * @group Business
     * @group Steps
     * @group PrepareWorkdir
     * @group Unit
     *
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function testPostCheck()
    {
        $prepareWorkdir = new PrepareWorkdir();
        $prepareWorkdir->setData($this->createDockerCiDataProvider()->setBuilddir(__DIR__));

        $prepareWorkdir->postCheck();
    }

    /**
     * @group DockerCi
     * @group Business
     * @group Steps
     * @group PrepareWorkdir
     * @group Unit
     *
     * @expectedException \DockerCi\DockerCi\Business\Ci\Exception\CiException
     *
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function testPostCheckFail()
    {
        $prepareWorkdir = new PrepareWorkdir();
        $prepareWorkdir->setData($this->createDockerCiDataProvider()->setBuilddir(__DIR__ . '/NotExisting'));

        $prepareWorkdir->postCheck();
    }

    /**
     * @group DockerCi
     * @group Business
     * @group Steps
     * @group PrepareWorkdir
     * @group Unit
     */
    public function testExecute()
    {
        $ciDataProvider = $this->createDockerCiDataProvider();

        $prepareWorkdir = new PrepareWorkdir();
        $prepareWorkdir->setData($ciDataProvider);

        $this->assertFalse(is_dir($ciDataProvider->getBuilddir()));

        $prepareWorkdir->execute();

        $this->assertTrue(is_dir($ciDataProvider->getBuilddir()));
    }
}