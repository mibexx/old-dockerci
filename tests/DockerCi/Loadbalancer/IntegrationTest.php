<?php
namespace DockerCiTest\Loadbalancer;

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
    public function testLoadbalancerConfig()
    {
        $facade = $this->getDockerConfigFacade();
        $config = $facade->getDockerConfig(
            $this->getExampleFile()
        );

        $this->assertEquals(
            'www.de.suite.local',
            $config->getLoadbalancer()->getLoadbalancers()[0]->getServerName()
        );

        $this->assertEquals(
            'spryker',
            $config->getLoadbalancer()->getLoadbalancers()[1]->getTarget()
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