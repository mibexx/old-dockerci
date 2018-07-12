<?php


namespace DockerCi\DockerCi;


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

    public const STEP_COLLECTION = 'step.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $container[self::GIT_CLIENT] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->git()->client();
        };

        $container[self::STEP_ENGINE_FACADE] = function(DependencyProviderInterface $container) {
            return $container->getLocator()->stepEngine()->facade();
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
        return [];
    }
}