<?php
declare(strict_types=1);


namespace DockerCi\StepEngine\Business\Step;


use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

abstract class AbstractStep extends AbstractWithLocator implements StepInterface
{
    /**
     * @var DataProviderInterface
     */
    protected $dataProvider;

    /**
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function setData(DataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

}