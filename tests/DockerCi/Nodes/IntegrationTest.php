<?php
namespace DockerCiTest\Nodes;

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
    public function testNodeConfig()
    {
        $facade = $this->getYamlConfigFacade();
        $config = $facade->getYamlConfig(
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
     * @return \Xervice\YamlConfig\YamlConfigFacade
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