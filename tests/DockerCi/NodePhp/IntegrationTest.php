<?php
namespace DockerCiTest\NodePhp;

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
    public function testNodePhpConfig()
    {
        $facade = $this->getYamlConfigFacade();
        $config = $facade->getYamlConfig(
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
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     *
     * @expectedException \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function testNodePhpConfigFail()
    {
        $facade = $this->getYamlConfigFacade();
        $facade->getYamlConfig(
            $this->getFailFile()
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
    private function getFailFile()
    {
        $fileList = new YamlConfigFileListDataProvider();

        $file = new YamlConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/fail.yml');

        $fileList->addFile($file);

        return $fileList;
    }
}