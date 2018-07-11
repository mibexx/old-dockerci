<?php


namespace DockerCi\Nodes;


use DataProvider\DockerConfigDataProvider;
use DockerCi\Nodes\Business\Hydrator\NodeHydrator;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Nodes\NodesConfig getConfig()
 */
class NodesFactory extends AbstractFactory
{
    public function createNodeHydrator(array $data, DockerConfigDataProvider $nodeDataProvider)
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
    public function getNodeHydratorCollection()
    {
        return $this->getDependency(NodesDependencyProvider::NODE_HYDRATOR_COLLECTION);
    }
}