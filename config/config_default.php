<?php

use Xervice\Config\XerviceConfig;
use Xervice\Core\CoreConfig;
use Xervice\Database\DatabaseConfig;
use Xervice\DataProvider\DataProviderConfig;
use Xervice\Redis\RedisConfig;

$config[CoreConfig::PROJECT_LAYER_NAMESPACE] = 'DockerCi';

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = dirname(__DIR__) . '/src/Generated';
$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    dirname(__DIR__) . '/src/DockerCi/*/Schema',
    dirname(__DIR__) . '/vendor/xervice/*/src/Xervice/*/Schema',
];

$config[RedisConfig::REDIS_HOST] = '127.0.0.1';
$config[RedisConfig::REDIS_PORT] = 6379;
$config[RedisConfig::REDIS_PASSWORD] = '';
$config[RedisConfig::REDIS_DATABASE] = 0;

$config[DatabaseConfig::PROPEL_CONF_DIR] = __DIR__ . '/propel';
$config[DatabaseConfig::PROPEL_CONF_ADAPTER] = 'pgsql';
$config[DatabaseConfig::PROPEL_CONF_HOST] = '127.0.0.1';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '5432';
$config[DatabaseConfig::PROPEL_CONF_DBNAME] = 'dockerci';
$config[DatabaseConfig::PROPEL_CONF_USER] = '';
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = '';

$config[XerviceConfig::ADDITIONAL_CONFIG_FILES] = [
    __DIR__ . '/static/config_propel.php',
    __DIR__ . '/static/config_redis.php',
];