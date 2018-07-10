<?php


namespace DockerCi\Environment\Business\Plugin;


use DataProvider\DockerConfigDataProvider;
use DockerCi\DockerConfig\Business\Hydrator\HydratorInterface;
use DockerCi\Environment\EnvironmentConfig;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\Environment\EnvironmentFacade getFacade()
 * @method \DockerCi\Environment\EnvironmentFactory getFactory()
 */
class EnvironmentHydratorPlugin extends AbstractWithLocator implements HydratorInterface
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
        if (isset($data[EnvironmentConfig::CONFIG_IDENTIFIER])) {
            $dataProvider = $this->getFactory()->getEnvironmentConfigHydrator(
                $data[EnvironmentConfig::CONFIG_IDENTIFIER],
                $dataProvider
            )->hydrate();
        }

        return $dataProvider;
    }

}