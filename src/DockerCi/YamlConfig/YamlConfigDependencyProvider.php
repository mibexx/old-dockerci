<?php


namespace DockerCi\YamlConfig;


use DockerCi\Loadbalancer\Plugin\LoadbalancerYamlConfigPlugin;
use DockerCi\Nodes\Plugin\NodeYamlConfigPlugin;
use Xervice\YamlConfig\YamlConfigDependencyProvider as XerviceYamlConfigDependencyProvider;

class YamlConfigDependencyProvider extends XerviceYamlConfigDependencyProvider
{
    /**
     * @return \Xervice\YamlConfig\Business\Hydrator\HydratorInterface[]
     */
    protected function getHydratorList(): array
    {
        return [
            new LoadbalancerYamlConfigPlugin(),
            new NodeYamlConfigPlugin()
        ];
    }
}