<?php
namespace DockerCiTest\Volume;

use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Core\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group Volume
     * @group Integration
     */
    public function testGetConfigWithVolume()
    {
        $file = new DockerConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/example.yml');

        $fileList = new DockerConfigFileListDataProvider();
        $fileList->addFile($file);

        $config = $this->getDockerConfigFacade()->getDockerConfig($fileList);
        $environment = $config->getVolumes()[0];

        $this->assertEquals(
            'test',
            $environment->getName()
        );

        $this->assertEquals(
            'dynamic',
            $environment->getType()
        );

        $this->assertEquals(
            './',
            $environment->getLocalPath()
        );

        $this->assertEquals(
            '/data',
            $environment->getRemotePath()
        );
    }

    /**
     * @return \DockerCi\DockerConfig\DockerConfigFacade
     */
    private function getDockerConfigFacade()
    {
        return Locator::getInstance()->dockerConfig()->facade();
    }
}