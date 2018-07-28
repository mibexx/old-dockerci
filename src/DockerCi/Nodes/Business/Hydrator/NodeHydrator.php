<?php
declare(strict_types=1);


namespace DockerCi\Nodes\Business\Hydrator;


use DataProvider\NodeDataProvider;
use DataProvider\YamlConfigDataProvider;
use DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorCollection;

class NodeHydrator
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var \DataProvider\YamlConfigDataProvider
     */
    private $config;

    /**
     * @var Collector\NodeHydratorCollection
     */
    private $nodeHydratorCollection;

    /**
     * NodeHydrator constructor.
     *
     * @param array $data
     * @param \DataProvider\YamlConfigDataProvider $config
     * @param \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorCollection $nodeHydratorCollection
     */
    public function __construct(
        array $data,
        YamlConfigDataProvider $config,
        NodeHydratorCollection $nodeHydratorCollection
    ) {
        $this->data = $data;
        $this->config = $config;
        $this->nodeHydratorCollection = $nodeHydratorCollection;
    }

    /**
     * @return \DataProvider\YamlConfigDataProvider
     */
    public function hydrate(): YamlConfigDataProvider
    {
        foreach ($this->data as $name => $nodeConfig) {
            $node = new NodeDataProvider();
            $node->setName($name);

            $node = $this->hydrateNodeFromCollection(
                \is_array($nodeConfig) ? $nodeConfig : [],
                $node
            );

            $this->config->addNode($node);
        }

        return $this->config;
    }

    /**
     * @param $nodeConfig
     * @param $node
     *
     * @return \DataProvider\NodeDataProvider
     */
    private function hydrateNodeFromCollection(array $nodeConfig, $node): \DataProvider\NodeDataProvider
    {
        foreach ($this->nodeHydratorCollection as $hydrator) {
            $node = $hydrator->hydrate($nodeConfig, $node);
        }
        return $node;
    }
}