<?php

use Xervice\Core\CoreConfig;
use Xervice\DataProvider\DataProviderConfig;

$config[CoreConfig::PROJECT_LAYER_NAMESPACE] = 'DockerCi';

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = dirname(__DIR__) . '/src/Generated';
$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    dirname(__DIR__) . '/src/DockerCi/*/Schema',
    dirname(__DIR__) . '/vendor/xervice/*/src/Xervice/*/Schema',
];