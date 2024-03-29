<?php
declare(strict_types=1);


namespace DockerCi\Nodes;


use DataProvider\YamlConfigDataProvider;
use DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorCollection;
use DockerCi\Nodes\Business\Hydrator\NodeHydrator;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Nodes\NodesConfig getConfig()
 */
class NodesFactory extends AbstractFactory
{
    public function createNodeHydrator(array $data, YamlConfigDataProvider $nodeDataProvider)
    {
        return new NodeHydrator(
            $data,
            $nodeDataProvider,
            $this->getNodeHydratorCollection()
        );
    }

    /**
     * @return \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorCollection
     */
    public function getNodeHydratorCollection(): NodeHydratorCollection
    {
        return $this->getDependency(NodesDependencyProvider::NODE_HYDRATOR_COLLECTION);
    }
}