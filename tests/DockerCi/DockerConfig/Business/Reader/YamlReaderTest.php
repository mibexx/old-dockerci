<?php
namespace DockerCiTest\DockerConfig\Business\Reader;

use DataProvider\DockerConfigFileDataProvider;
use DockerCi\DockerConfig\Business\Reader\YamlReader;

class YamlReaderTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group DockerConfig
     * @group Business
     * @group Reader
     * @group YamlReader
     * @group Integration
     */
    public function testGetArrayFromYaml()
    {
        $file = new DockerConfigFileDataProvider();
        $file->setPath(
            dirname(dirname(__DIR__)) . '/data/example.yml'
        );

        $yamlReader = new YamlReader();

        $this->assertEquals(
            [
                'example_not_existing_conf' => [
                    'php71' => [
                        'type' => 'PHP',
                        'version' => '7.1',
                        'extensions' => [
                            'intl',
                            'curl'
                        ],
                        'pecl' => [
                            'redis'
                        ]
                    ]
                ]
            ],
            $yamlReader->getArrayFromFile($file)
        );
    }
}