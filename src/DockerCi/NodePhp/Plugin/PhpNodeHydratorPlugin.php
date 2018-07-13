<?php
declare(strict_types=1);


namespace DockerCi\NodePhp\Plugin;


use DataProvider\NodeDataProvider;
use DockerCi\NodePhp\NodePhpConfig;
use DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \DockerCi\NodePhp\NodePhpFactory getFactory()
 */
class PhpNodeHydratorPlugin extends AbstractWithLocator implements NodeHydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\NodeDataProvider $nodeDataProvider
     *
     * @return \DataProvider\NodeDataProvider
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function hydrate(array $data, NodeDataProvider $nodeDataProvider): NodeDataProvider
    {
        if (isset($data[NodePhpConfig::CONFIG_NAME])) {
            $nodeDataProvider = $this->getFactory()->createPhpHydrator(
                $data[NodePhpConfig::CONFIG_NAME],
                $nodeDataProvider
            )->hydrate();
        }

        return $nodeDataProvider;
    }

}