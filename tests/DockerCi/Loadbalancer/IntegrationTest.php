<?php
namespace DockerCiTest\Loadbalancer;

use DataProvider\YamlConfigFileDataProvider;
use DataProvider\YamlConfigFileListDataProvider;
use Xervice\Core\Locator\Locator;
use Xervice\YamlConfig\YamlConfigFacade;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Loadbalancer
     * @group Integration
     */
    public function testLoadbalancerConfig()
    {
        $facade = $this->getYamlConfigFacade();
        $config = $facade->getYamlConfig(
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
     * @return \DockerCi\YamlConfig\YamlConfigFacade
     */
    private function getYamlConfigFacade(): YamlConfigFacade
    {
        return Locator::getInstance()->yamlConfig()->facade();
    }

    /**
     * @return \DataProvider\YamlConfigFileListDataProvider
     */
    private function getExampleFile()
    {
        $fileList = new YamlConfigFileListDataProvider();

        $file = new YamlConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/example.yml');

        $fileList->addFile($file);

        return $fileList;
    }
}