<?php


namespace DockerCi\DockerConfig;


use DataProvider\DockerConfigFileListDataProvider;
use DockerCi\DockerConfig\Business\Loader\ConfigLoader;
use DockerCi\DockerConfig\Business\Reader\YamlReader;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\DockerConfig\DockerConfigConfig getConfig()
 */
class DockerConfigFactory extends AbstractFactory
{
    /**
     * @param \DataProvider\DockerConfigFileListDataProvider $fileListDataProvider
     *
     * @return \DockerCi\DockerConfig\Business\Loader\ConfigLoader
     */
    public function createConfigLoader(DockerConfigFileListDataProvider $fileListDataProvider)
    {
        return new ConfigLoader(
            $fileListDataProvider,
            $this->createReader(),
            $this->getHydratorCollection()
        );
    }

    /**
     * @return \DockerCi\DockerConfig\Business\Reader\YamlReader
     */
    public function createReader()
    {
        return new YamlReader();
    }

    /**
     * @return \DockerCi\DockerConfig\Business\Hydrator\HydratorCollection
     */
    public function getHydratorCollection()
    {
        return $this->getDependency(DockerConfigDependencyProvider::HYDRATOR_COLLECTION);
    }
}