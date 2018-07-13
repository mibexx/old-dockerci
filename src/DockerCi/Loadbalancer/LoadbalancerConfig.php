<?php
declare(strict_types=1);


namespace DockerCi\Loadbalancer;


use Xervice\Core\Config\AbstractConfig;

class LoadbalancerConfig extends AbstractConfig
{
    public const CONFIG_NAME = 'loadbalancer';
}