<?php

namespace DockerCiTest\DockerConfig\Business\Loader;

use DataProvider\DockerConfigDataProvider;
use DataProvider\DockerConfigFileDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use DockerCi\DockerConfig\Business\Hydrator\HydratorCollection;
use DockerCi\DockerConfig\Business\Hydrator\HydratorInterface;
use DockerCi\DockerConfig\Business\Loader\ConfigLoader;
use DockerCi\DockerConfig\Business\Reader\ReaderInterface;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\DockerConfig\DockerConfigFacade getFacade()
 */
class ConfigLoaderTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group DockerConfig
     * @group Business
     * @group Loader
     * @group ConfigLoader
     * @group Integration
     */
    public function testGetConfig()
    {
        $testFile = new DockerConfigFileDataProvider();
        $testFile->setPath('test/test');

        $testHydrator = $this->getTestHydrator();
        $testReader = $this->getTestFileReader($testFile);


        $fileList = new DockerConfigFileListDataProvider();
        $fileList->addFile($testFile);

        $collection = new HydratorCollection(
            [
                $testHydrator
            ]
        );

        $configLoader = new ConfigLoader(
            $fileList,
            $testReader,
            $collection
        );

        $this->assertInstanceOf(
            DockerConfigDataProvider::class,
            $configLoader->getConfig()
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getTestHydrator(): \PHPUnit\Framework\MockObject\MockObject
    {
        $testHydrator = $this->getMockBuilder(HydratorInterface::class)
                             ->setMethods(['hydrateConfig'])
                             ->getMock();

        $testHydrator->expects($this->once())
                     ->method('hydrateConfig')
                     ->with(
                         $this->equalTo(['test' => ['test']]),
                         $this->isInstanceOf(DockerConfigDataProvider::class)
                     )
                     ->willReturn(new DockerConfigDataProvider())
        ;
        return $testHydrator;
    }

    /**
     * @param $testFile
     *
     * @return \DockerCi\DockerConfig\Business\Reader\ReaderInterface
     */
    private function getTestFileReader($testFile): ReaderInterface
    {
        $testFileReader = $this->getMockBuilder(ReaderInterface::class)
                               ->setMethods(['getArrayFromFile'])
                               ->getMock();

        $testFileReader->expects($this->once())
                       ->method('getArrayFromFile')
                       ->with($this->equalTo($testFile))
                       ->willReturn(['test' => ['test']]);

        return $testFileReader;
    }
}