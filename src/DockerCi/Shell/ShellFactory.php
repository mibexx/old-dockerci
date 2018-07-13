<?php
declare(strict_types=1);


namespace DockerCi\Shell;


use DockerCi\Shell\Business\Command\Converter;
use DockerCi\Shell\Business\Command\ConverterInterface;
use DockerCi\Shell\Business\Executor\ExecExecutor;
use DockerCi\Shell\Business\Executor\ExecutorInterface;
use DockerCi\Shell\Business\Provider\Provider;
use DockerCi\Shell\Business\Provider\ProviderInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Shell\ShellConfig getConfig()
 */
class ShellFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\Shell\Business\Provider\ProviderInterface
     */
    public function createProvider(): ProviderInterface
    {
        return new Provider(
            $this->createExecutor(),
            $this->createConverter()
        );
    }

    /**
     * @return \DockerCi\Shell\Business\Executor\ExecExecutor
     */
    public function createExecutor(): ExecutorInterface
    {
        return new ExecExecutor();
    }

    /**
     * @return \DockerCi\Shell\Business\Command\Converter
     */
    public function createConverter(): ConverterInterface
    {
        return new Converter();
    }
}