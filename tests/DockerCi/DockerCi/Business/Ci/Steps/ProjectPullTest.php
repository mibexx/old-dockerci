<?php
namespace DockerCiTest\DockerCi\Business\Ci\Steps;

use DockerCi\DockerCi\Business\Ci\Steps\PrepareWorkdir;
use DockerCi\DockerCi\Business\Ci\Steps\PullProject;

class ProjectPullTest extends StepTestCase
{
    protected function _before(): void
    {
        mkdir(__DIR__ . '/Workdir/.git');
    }

    protected function _after(): void
    {
        if (is_dir(__DIR__ . '/Workdir/.git')) {
            rmdir(__DIR__ . '/Workdir/.git');
        }
    }

    /**
     * @group DockerCi
     * @group Business
     * @group Steps
     * @group PullProject
     * @group Unit
     *
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function testPreCheck()
    {
        $prepareWorkdir = new PullProject();
        $prepareWorkdir->setData($this->createDockerCiDataProvider()->setBuilddir(__DIR__ . '/Workdir'));

        $prepareWorkdir->preCheck();
    }

    /**
     * @group DockerCi
     * @group Business
     * @group Steps
     * @group PrepareWorkdir
     * @group Unit
     *
     * @expectedException \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function testPreCheckFail()
    {
        rmdir(__DIR__ . '/Workdir/.git');

        $prepareWorkdir = new PullProject();
        $prepareWorkdir->setData($this->createDockerCiDataProvider()->setBuilddir(__DIR__ . '/Workdir'));

        $prepareWorkdir->preCheck();
    }
}