<?php
declare(strict_types=1);


namespace DockerCi\Loadbalancer\Plugin;


use DataProvider\YamlConfigDataProvider;
use DockerCi\Loadbalancer\LoadbalancerConfig;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\YamlConfig\Business\Hydrator\HydratorInterface;

/**
 * @method \DockerCi\Loadbalancer\LoadbalancerFactory getFactory()
 */
class LoadbalancerYamlConfigPlugin extends AbstractWithLocator implements HydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\YamlConfigDataProvider $dataProvider
     *
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function hydrateConfig(array $data, YamlConfigDataProvider $dataProvider): YamlConfigDataProvider
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