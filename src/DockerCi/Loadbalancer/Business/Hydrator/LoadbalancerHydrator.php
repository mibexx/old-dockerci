<?php
declare(strict_types=1);


namespace DockerCi\Loadbalancer\Business\Hydrator;


use DataProvider\DockerConfigDataProvider;
use DataProvider\LoadbalancerDataProvider;
use DataProvider\LoadBalancerEntryDataProvider;

class LoadbalancerHydrator implements LoadbalancerHydratorInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var \DataProvider\DockerConfigDataProvider
     */
    private $config;

    /**
     * LoadbalancerHydrator constructor.
     *
     * @param array $data
     * @param \DataProvider\DockerConfigDataProvider $config
     */
    public function __construct(array $data, DockerConfigDataProvider $config)
    {
        $this->data = $data;
        $this->config = $config;
    }

    /**
     * @return \DataProvider\DockerConfigDataProvider
     */
    public function hydrate(): DockerConfigDataProvider
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