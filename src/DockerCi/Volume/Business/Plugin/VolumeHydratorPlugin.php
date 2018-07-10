<?php


namespace DockerCi\Volume\Business\Plugin;


use DataProvider\DockerConfigDataProvider;
use DockerCi\DockerConfig\Business\Hydrator\HydratorInterface;
use DockerCi\Volume\VolumeConfig;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\Volume\VolumeFacade getFacade()
 * @method \DockerCi\Volume\VolumeFactory getFactory()
 */
class VolumeHydratorPlugin extends AbstractWithLocator implements HydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\DockerConfigDataProvider $dataProvider
     *
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function hydrateConfig(array $data, DockerConfigDataProvider $dataProvider): DockerConfigDataProvider
    {
        if (isset($data[VolumeConfig::CONFIG_IDENTIFIER])) {
            $dataProvider = $this->getFactory()->getVolumeConfigHydrator(
                $data[VolumeConfig::CONFIG_IDENTIFIER],
                $dataProvider
            )->hydrate();
        }

        return $dataProvider;
    }

}