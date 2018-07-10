<?php
namespace DockerCiTest\Environment;

use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Core\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group Environment
     * @group Integration
     */
    public function testGetConfigWithEnvironment()
    {
        $file = new DockerConfigFileDataProvider();
        $file->setPath(__DIR__ . '/data/example.yml');

        $fileList = new DockerConfigFileListDataProvider();
        $fileList->addFile($file);

        $config = $this->getDockerConfigFacade()->getDockerConfig($fileList);
        $environment = $config->getEnvironments()[0];

        $this->assertEquals(
            'php71',
            $environment->getName()
        );

        $this->assertEquals(
            'PHP',
            $environment->getType()
        );

        $this->assertEquals(
            [
                'version' => '7.1',
                'extensions' => [
                    'intl',
                    'curl'
                ],
                'pecl' => [
                    'redis'
                ]
            ],
            $environment->getContext()
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