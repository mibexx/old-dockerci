<?php
namespace DockerCiTest\NodePhp;

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
    public function testNodePhpConfig()
    {
        $facade = $this->getDockerConfigFacade();
        $config = $facade->getDockerConfig(
            $this->getExampleFile()
        );

        $this->assertEquals(
            'testNode',
            $config->getNodes()[0]->getName()
        );

        $this->assertEquals(
            '7.1',
            $config->getNodes()[0]->getPhp()->getVersion()
        );

        $this->assertEquals(
            [
                'intl',
                'curl'
            ],
            $config->getNodes()[0]->getPhp()->getExtensions()
        );

        $this->assertEquals(
            [
                'redis'
            ],
            $config->getNodes()[0]->getPhp()->getPecl()
        );
    }

    /**
     * @group DockerCi
     * @group Loadbalancer
     * @group Integration
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     *
     * @expectedException \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function testNodePhpConfigFail()
    {
        $facade = $this->getDockerConfigFacade();
        $facade->getDockerConfig(
            $this->getFailFile()
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
    private function getFailFile()
    {
        $fileList = new DockerConfigFileListDataProvider();

        $file = new DockerConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/fail.yml');

        $fileList->addFile($file);

        return $fileList;
    }
}