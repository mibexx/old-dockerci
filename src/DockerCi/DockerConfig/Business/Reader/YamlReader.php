<?php


namespace DockerCi\DockerConfig\Business\Reader;


use DataProvider\DockerConfigFileDataProvider;
use Symfony\Component\Yaml\Yaml;

class YamlReader implements ReaderInterface
{
    /**
     * @param \DataProvider\DockerConfigFileDataProvider $dataProvider
     *
     * @return array
     */
    public function getArrayFromFile(DockerConfigFileDataProvider $dataProvider): array
    {
        return Yaml::parse(file_get_contents($dataProvider->getPath()));
    }
}