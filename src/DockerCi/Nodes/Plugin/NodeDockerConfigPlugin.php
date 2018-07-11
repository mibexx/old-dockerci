<?php


namespace DockerCi\Nodes\Plugin;


use DataProvider\DockerConfigDataProvider;
use DockerCi\DockerConfig\Business\Hydrator\HydratorInterface;
use DockerCi\Nodes\NodesConfig;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\Nodes\NodesFactory getFactory()
 */
class NodeDockerConfigPlugin extends AbstractWithLocator implements HydratorInterface
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
        if (isset($data[NodesConfig::CONFIG_NAME])) {
            $this->getFactory()->createNodeHydrator($data[NodesConfig::CONFIG_NAME], $dataProvider)->hydrate();
        }

        return $dataProvider;
    }

}