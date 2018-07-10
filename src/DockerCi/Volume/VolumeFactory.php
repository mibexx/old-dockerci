<?php


namespace DockerCi\Volume;


use DataProvider\DockerConfigDataProvider;
use DockerCi\Volume\Business\Hydrator\VolumeConfigHydrator;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Volume\VolumeConfig getConfig()
 */
class VolumeFactory extends AbstractFactory
{
    /**
     * @param array $configData
     * @param \DataProvider\DockerConfigDataProvider $configDataProvider
     *
     * @return \DockerCi\Volume\Business\Hydrator\VolumeConfigHydrator
     */
    public function getVolumeConfigHydrator(
        array $configData,
        DockerConfigDataProvider $configDataProvider
    )
    {
        return new VolumeConfigHydrator(
            $configData,
            $configDataProvider
        );
    }
}