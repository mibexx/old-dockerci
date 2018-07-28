<?php
namespace DockerCiTest\NodeRedis;

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
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function testNodeRedisConfig()
    {
        $facade = $this->getYamlConfigFacade();
        $config = $facade->getYamlConfig(
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
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function testNodeRedisConfigDefault()
    {
        $facade = $this->getYamlConfigFacade();
        $config = $facade->getYamlConfig(
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

    /**
     * @return \DataProvider\YamlConfigFileListDataProvider
     */
    private function getDefaultFile()
    {
        $fileList = new YamlConfigFileListDataProvider();

        $file = new YamlConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/default.yml');

        $fileList->addFile($file);

        return $fileList;
    }
}