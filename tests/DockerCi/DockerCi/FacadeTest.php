<?php
namespace DockerCiTest\DockerCi;

use DataProvider\ProjectDataProvider;
use Orm\Xervice\Database\Persistence\ProjectQuery;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function _after()
    {
        $this->getProjectQuery()->findOneByName('AutoTest')->delete();
    }

    /**
     * @group DockerCi
     * @group Facade
     * @group Integration
     * @group Database
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function testAddProject()
    {
        $project = new ProjectDataProvider();
        $project->setName('AutoTest');
        $project->setRepository('TestRepository');

        $this->getFacade()->addProject($project);

        $assertProject = $this->getProjectQuery()->findOneByName('AutoTest');
        $this->assertEquals(
            'AutoTest',
            $assertProject->getName()
        );
        $this->assertEquals(
            'TestRepository',
            $assertProject->getRepository()
        );
    }

    /**
     * @return \Orm\Xervice\Database\Persistence\ProjectQuery
     */
    private function getProjectQuery()
    {
        return ProjectQuery::create();
    }
}