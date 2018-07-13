<?php
declare(strict_types=1);


namespace DockerCi\Shell\Business\Provider;


use DockerCi\Shell\Business\Command\ConverterInterface;
use DockerCi\Shell\Business\Executor\ExecutorInterface;

class Provider implements ProviderInterface
{
    /**
     * @var ExecutorInterface
     */
    private $executor;

    /**
     * @var \DockerCi\Shell\Business\Command\ConverterInterface
     */
    private $conveter;

    /**
     * Provider constructor.
     *
     * @param \DockerCi\Shell\Business\Executor\ExecutorInterface $executor
     * @param \DockerCi\Shell\Business\Command\ConverterInterface $conveter
     */
    public function __construct(
        ExecutorInterface $executor,
        ConverterInterface $conveter
    ) {
        $this->executor = $executor;
        $this->conveter = $conveter;
    }


    /**
     * @param string $command
     * @param mixed ...$params
     *
     * @return string
     */
    public function execute(string $command, ...$params): string
    {
        return $this->executor->execute(
            $this->conveter->convert($command, ...$params)
        );
    }
}