<?php


namespace DockerCi\DockerConfig\Business\Loader;


use DataProvider\DockerConfigDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use DockerCi\DockerConfig\Business\Exception\ConfigException;
use DockerCi\DockerConfig\Business\Hydrator\HydratorCollection;
use DockerCi\DockerConfig\Business\Reader\ReaderInterface;

class ConfigLoader implements ConfigLoaderInterface
{
    /**
     * @var DockerConfigFileListDataProvider
     */
    private $fileList;

    /**
     * @var \DockerCi\DockerConfig\Business\Reader\ReaderInterface
     */
    private $fileReader;

    /**
     * @var \DockerCi\DockerConfig\Business\Hydrator\HydratorCollection
     */
    private $hydratorCollection;

    /**
     * ConfigLoader constructor.
     *
     * @param DockerConfigFileListDataProvider $fileList
     * @param \DockerCi\DockerConfig\Business\Reader\ReaderInterface $fileReader
     * @param \DockerCi\DockerConfig\Business\Hydrator\HydratorCollection $hydratorCollection
     */
    public function __construct(
        DockerConfigFileListDataProvider $fileList,
        ReaderInterface $fileReader,
        HydratorCollection $hydratorCollection
    ) {
        $this->fileList = $fileList;
        $this->fileReader = $fileReader;
        $this->hydratorCollection = $hydratorCollection;
    }


    /**
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function getConfig(): DockerConfigDataProvider
    {
        $config = new DockerConfigDataProvider();

        foreach ($this->fileList->getFiles() as $file) {
            $configData = $this->fileReader->getArrayFromFile($file);
            $config = $this->hydrateConfigs($configData, $config);
        }

        return $config;
    }

    /**
     * @param $configData
     * @param $config
     *
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    private function hydrateConfigs($configData, $config): \DataProvider\DockerConfigDataProvider
    {
        foreach ($this->hydratorCollection as $hydrator) {
            $config = $hydrator->hydrateConfig($configData, $config);
        }
        return $config;
    }

}