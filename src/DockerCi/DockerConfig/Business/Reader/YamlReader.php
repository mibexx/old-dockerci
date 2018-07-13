<?php
declare(strict_types=1);


namespace DockerCi\DockerConfig\Business\Reader;


use DataProvider\DockerConfigFileDataProvider;
use Symfony\Component\Yaml\Yaml;

class YamlReader implements ReaderInterface
{
    /**
     * @param \DataProvider\DockerConfigFileDataProvider $dataProvider
     *
     * @return array
     * @throws \Symfony\Component\Yaml\Exception\ParseException
     */
    public function getArrayFromFile(DockerConfigFileDataProvider $dataProvider): array
    {
        return (array) Yaml::parse(
            file_get_contents(
                $dataProvider->getPath()
            )
        );
    }
}