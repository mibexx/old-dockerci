<?php

namespace DockerCiTest\DockerConfig;

use DataProvider\DockerConfigDataProvider;
use DataProvider\DockerConfigEnvironmentDataProvider;
use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\DockerConfig\DockerConfigFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group DockerConfig
     * @group Facade
     * @group Integration
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function testGetConfig()
    {
        $this->assertEquals(
            $this->getExpectedConfigForFile(),
            $this->getFacade()->getDockerConfig($this->getExampleFileDTO())
        );
    }

    /**
     * @return \DataProvider\DockerConfigFileListDataProvider
     */
    private function getExampleFileDTO()
    {
        $configFile = new DockerConfigFileDataProvider();
        $configFile->setPath(__DIR__ . '/data/example.yml');

        $fileList = new DockerConfigFileListDataProvider();
        $fileList->addFile($configFile);

        return $fileList;
    }

    /**
     * @return \DataProvider\DockerConfigDataProvider
     */
    private function getExpectedConfigForFile()
    {
        $config = new DockerConfigDataProvider();
        return $config;
    }
}