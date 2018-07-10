<?php


namespace DockerCi\Volume\Business\Hydrator;


use DataProvider\DockerConfigDataProvider;
use DataProvider\VolumeConfigDataProvider;

class VolumeConfigHydrator
{
    /**
     * @var array
     */
    private $configData;

    /**
     * @var \DataProvider\DockerConfigDataProvider
     */
    private $configDataProvider;

    /**
     * VolumeConfigHydrator constructor.
     *
     * @param array $configData
     * @param \DataProvider\DockerConfigDataProvider $configDataProvider
     */
    public function __construct(array $configData, DockerConfigDataProvider $configDataProvider)
    {
        $this->configData = $configData;
        $this->configDataProvider = $configDataProvider;
    }

    /**
     * @return \DataProvider\DockerConfigDataProvider
     */
    public function hydrate(): DockerConfigDataProvider
    {
        foreach ($this->configData as $name => $data) {
            $conf = $this->getVolumeConfigFromData($name, $data);
            $this->configDataProvider->addVolume($conf);
        }

        return $this->configDataProvider;
    }

    /**
     * @param $name
     * @param $data
     *
     * @return \DataProvider\VolumeConfigDataProvider
     */
    private function getVolumeConfigFromData($name, $data): VolumeConfigDataProvider
    {
        $conf = new VolumeConfigDataProvider();
        $conf->setName($name);
        $conf->setType($data['type']);
        $conf->setLocalPath($data['localPath'] ?: '');
        $conf->setRemotePath($data['remotePath'] ?: '');

        return $conf;
}
}