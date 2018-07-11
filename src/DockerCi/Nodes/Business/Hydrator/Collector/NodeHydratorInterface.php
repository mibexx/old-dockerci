<?php


namespace DockerCi\Nodes\Business\Hydrator\Collector;


use DataProvider\NodeDataProvider;

interface NodeHydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\NodeDataProvider $nodeDataProvider
     *
     * @return \DataProvider\NodeDataProvider
     */
    public function hydrate(array $data, NodeDataProvider $nodeDataProvider): NodeDataProvider;
}