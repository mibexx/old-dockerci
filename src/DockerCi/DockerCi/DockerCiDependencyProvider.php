<?php
declare(strict_types=1);


namespace DockerCi\DockerCi;


use DockerCi\DockerCi\Business\Ci\Steps\CloneProject;
use DockerCi\DockerCi\Business\Ci\Steps\PrepareWorkdir;
use DockerCi\StepEngine\Business\Step\StepCollection;
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
    public const EXCEPTION_HANDLER_FACADE = 'exception.handler.facade';
    public const DOCKER_FACADE = 'docker.facade';

    public const STEP_COLLECTION = 'step.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::GIT_CLIENT] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->git()->client();
        };

        $dependencyProvider[self::STEP_ENGINE_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->stepEngine()->facade();
        };

        $dependencyProvider[self::SHELL_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->shell()->facade();
        };

        $dependencyProvider[self::DOCKER_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->docker()->facade();
        };

        $dependencyProvider[self::EXCEPTION_HANDLER_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->exceptionHandler()->facade();
        };

        $dependencyProvider[self::STEP_COLLECTION] = function () {
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
            new PrepareWorkdir(),
            new CloneProject()
        ];
    }
}