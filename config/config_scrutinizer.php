<?php

use Xervice\Database\DatabaseConfig;
use Xervice\Redis\RedisConfig;

$config[RedisConfig::REDIS_HOST] = '127.0.0.1';
$config[RedisConfig::REDIS_PORT] = 6379;
$config[RedisConfig::REDIS_PASSWORD] = '';
$config[RedisConfig::REDIS_DATABASE] = 0;

$config[DatabaseConfig::PROPEL_CONF_HOST] = '127.0.0.1';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '5432';
$config[DatabaseConfig::PROPEL_CONF_DBNAME] = 'dockerci';
$config[DatabaseConfig::PROPEL_CONF_USER] = 'scrutinizer';
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = 'scrutinizer';