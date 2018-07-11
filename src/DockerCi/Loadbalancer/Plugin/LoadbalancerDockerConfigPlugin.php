<?php


namespace DockerCi\Loadbalancer\Plugin;


use DataProvider\DockerConfigDataProvider;
use DockerCi\DockerConfig\Business\Hydrator\HydratorInterface;
use DockerCi\Loadbalancer\LoadbalancerConfig;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\Loadbalancer\LoadbalancerFactory getFactory()
 */
class LoadbalancerDockerConfigPlugin extends AbstractWithLocator implements HydratorInterface
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
        if (isset($data[LoadbalancerConfig::CONFIG_NAME])) {
            $dataProvider = $this->getFactory()->createLoadbalancerHydrator(
                $data[LoadbalancerConfig::CONFIG_NAME],
                $dataProvider
            )->hydrate();
        }

        return $dataProvider;
    }

}