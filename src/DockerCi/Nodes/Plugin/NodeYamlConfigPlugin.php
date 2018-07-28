<?php
declare(strict_types=1);


namespace DockerCi\Nodes\Plugin;


use DataProvider\YamlConfigDataProvider;
use DockerCi\Nodes\NodesConfig;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\YamlConfig\Business\Hydrator\HydratorInterface;

/**
 * @method \DockerCi\Nodes\NodesFactory getFactory()
 */
class NodeYamlConfigPlugin extends AbstractWithLocator implements HydratorInterface
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
        if (isset($data[NodesConfig::CONFIG_NAME])) {
            $this->getFactory()->createNodeHydrator(
                \is_array($data[NodesConfig::CONFIG_NAME]) ? $data[NodesConfig::CONFIG_NAME] : [],
                $dataProvider
            )->hydrate();
        }

        return $dataProvider;
    }
}