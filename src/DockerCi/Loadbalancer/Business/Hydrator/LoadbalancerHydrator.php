<?php
declare(strict_types=1);

namespace DockerCi\Loadbalancer\Business\Hydrator;

use DataProvider\LoadbalancerDataProvider;
use DataProvider\LoadBalancerEntryDataProvider;
use DataProvider\YamlConfigDataProvider;

class LoadbalancerHydrator implements LoadbalancerHydratorInterface
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
     * LoadbalancerHydrator constructor.
     *
     * @param array $data
     * @param \DataProvider\YamlConfigDataProvider $config
     */
    public function __construct(array $data, YamlConfigDataProvider $config)
    {
        $this->data = $data;
        $this->config = $config;
    }

    /**
     * @return \DataProvider\YamlConfigDataProvider
     */
    public function hydrate(): YamlConfigDataProvider
    {
        $loadbalancerList = new LoadbalancerDataProvider();

        foreach ($this->data as $lb) {
            $lb = $this->upperFirstKeySign($lb);

            $lbEntry = new LoadBalancerEntryDataProvider();
            $lbEntry->fromArray($lb);

            $loadbalancerList->addLoadbalancer($lbEntry);
        }

        $this->config->setLoadbalancer($loadbalancerList);

        return $this->config;
    }

    /**
     * @param $lb
     *
     * @return array
     */
    private function upperFirstKeySign($lb): array
    {
        return array_combine(
            array_map('ucfirst', array_keys($lb)),
            array_values($lb)
        );
    }
}