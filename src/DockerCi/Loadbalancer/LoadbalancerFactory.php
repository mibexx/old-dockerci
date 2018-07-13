<?php
declare(strict_types=1);


namespace DockerCi\Loadbalancer;


use DataProvider\DockerConfigDataProvider;
use DockerCi\Loadbalancer\Business\Hydrator\LoadbalancerHydrator;
use DockerCi\Loadbalancer\Business\Hydrator\LoadbalancerHydratorInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Loadbalancer\LoadbalancerConfig getConfig()
 */
class LoadbalancerFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @param \DataProvider\DockerConfigDataProvider $configDataProvider
     *
     * @return \DockerCi\Loadbalancer\Business\Hydrator\LoadbalancerHydrator
     */
    public function createLoadbalancerHydrator(array $data, DockerConfigDataProvider $configDataProvider): LoadbalancerHydratorInterface
    {
        return new LoadbalancerHydrator(
            $data,
            $configDataProvider
        );
    }
}