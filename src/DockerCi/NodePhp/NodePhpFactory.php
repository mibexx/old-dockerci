<?php
declare(strict_types=1);


namespace DockerCi\NodePhp;


use DataProvider\NodeDataProvider;
use DockerCi\NodePhp\Business\Hydrator\PhpHydrator;
use DockerCi\NodePhp\Business\Hydrator\PhpHydratorInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\NodePhp\NodePhpConfig getConfig()
 */
class NodePhpFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @param \DataProvider\NodeDataProvider $nodeDataProvider
     *
     * @return \DockerCi\NodePhp\Business\Hydrator\PhpHydrator
     */
    public function createPhpHydrator(array $data, NodeDataProvider $nodeDataProvider): PhpHydratorInterface
    {
        return new PhpHydrator(
            $data,
            $nodeDataProvider
        );
    }
}