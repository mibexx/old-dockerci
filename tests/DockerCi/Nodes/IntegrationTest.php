<?php
namespace DockerCiTest\Nodes;

use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Loadbalancer
     * @group Integration
     */
    public function testNodeConfig()
    {
        $facade = $this->getDockerConfigFacade();
        $config = $facade->getDockerConfig(
            $this->getExampleFile()
        );

        $this->assertEquals(
            'test1',
            $config->getNodes()[0]->getName()
        );

        $this->assertEquals(
            'test2',
            $config->getNodes()[1]->getName()
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
}