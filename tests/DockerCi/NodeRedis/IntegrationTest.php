<?php
namespace DockerCiTest\NodeRedis;

use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Loadbalancer
     * @group Integration
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function testNodeRedisConfig()
    {
        $facade = $this->getDockerConfigFacade();
        $config = $facade->getDockerConfig(
            $this->getExampleFile()
        );

        $this->assertEquals(
            'testNode',
            $config->getNodes()[0]->getName()
        );

        $this->assertTrue(
            $config->getNodes()[0]->getRedis()->getActive()
        );
    }

    /**
     * @group DockerCi
     * @group Loadbalancer
     * @group Integration
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function testNodeRedisConfigDefault()
    {
        $facade = $this->getDockerConfigFacade();
        $config = $facade->getDockerConfig(
            $this->getDefaultFile()
        );

        $this->assertEquals(
            'testNode',
            $config->getNodes()[0]->getName()
        );

        $this->assertFalse(
            $config->getNodes()[0]->getRedis()->getActive()
        );
    }

    /**
     * @return \DockerCi\DockerConfig\DockerConfigFacade
     */
    private function getDockerConfigFacade()
    {
        return Locator::getInstance()->dockerConfig()->facade();
    }

    /**
     * @return \DataProvider\DockerConfigFileListDataProvider
     */
    private function getExampleFile()
    {
        $fileList = new DockerConfigFileListDataProvider();

        $file = new DockerConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/example.yml');

        $fileList->addFile($file);

        return $fileList;
    }

    /**
     * @return \DataProvider\DockerConfigFileListDataProvider
     */
    private function getDefaultFile()
    {
        $fileList = new DockerConfigFileListDataProvider();

        $file = new DockerConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/default.yml');

        $fileList->addFile($file);

        return $fileList;
    }
}