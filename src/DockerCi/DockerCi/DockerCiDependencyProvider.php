<?php
declare(strict_types=1);


namespace DockerCi\DockerCi;


use DockerCi\DockerCi\Business\Ci\Steps\PrepareWorkdir;
use DockerCi\StepEngine\Business\Step\StepCollection;
use function foo\func;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class DockerCiDependencyProvider extends AbstractProvider
{
    public const GIT_CLIENT = 'git.client';

    public const STEP_ENGINE_FACADE = 'step.engine.facade';

    public const SHELL_FACADE = 'shell.facade';
    public const DOCKER_FACADE = 'docker.facade';

    public const STEP_COLLECTION = 'step.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container): void
    {
        $container[self::GIT_CLIENT] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->git()->client();
        };

        $container[self::STEP_ENGINE_FACADE] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->stepEngine()->facade();
        };

        $container[self::SHELL_FACADE] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->shell()->facade();
        };

        $container[self::DOCKER_FACADE] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->docker()->facade();
        };

        $container[self::STEP_COLLECTION] = function() {
            return new StepCollection(
                $this->getSteps()
            );
        };
    }

    /**
     * @return \DockerCi\StepEngine\Business\Step\StepInterface[]s
     */
    protected function getSteps(): array
    {
        return [
            new PrepareWorkdir()
        ];
    }
}