<?php
namespace DockerCiTest\DockerCi;

use DataProvider\ProjectDataProvider;
use Orm\Xervice\DockerCi\Persistence\Project;
use Orm\Xervice\DockerCi\Persistence\ProjectQuery;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    private const EXAMPLE_PROJECT_NAME = 'mbxAutoTestmbx';

    /**
     * @var \DockerCiTest\DockerCiTester
     */
    protected $tester;

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    protected function _before()
    {
        $this->tester->initDatabase();
        $this->addExampleProject();
    }


    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function _after()
    {
        $this->removeExampleProject();
    }

    /**
     * @group DockerCi
     * @group Facade
     * @group Integration
     * @group Database
     */
    public function testAddedProject()
    {
        $projectEntity = $this->getExampleProject();
        $projectDataProvider = new ProjectDataProvider();
        $projectDataProvider->fromArray($projectEntity->toArray());

        $this->assertProjectData($projectDataProvider);
    }

    /**
     * @group DockerCi
     * @group Facade
     * @group Integration
     * @group Database
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     */
    public function testGetProject()
    {
        $projectId = $this->getExampleProject()->getProjectId();

        $projectDataProvider = new ProjectDataProvider();
        $projectDataProvider->setProjectId($projectId);

        $projectDataProvider = $this->getFacade()->getProject($projectDataProvider);
        $this->assertProjectData($projectDataProvider);
    }

    /**
     * @return \Orm\Xervice\DockerCi\Persistence\ProjectQuery
     */
    private function getProjectQuery()
    {
        return ProjectQuery::create();
    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \DockerCi\DockerCi\Business\Project\Exception\ProjectException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function addExampleProject(): void
    {
        $project = new ProjectDataProvider();
        $project->setName(self::EXAMPLE_PROJECT_NAME);
        $project->setRepository('TestRepository');

        $this->getFacade()->addProject($project);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function removeExampleProject(): void
    {
        $this->getProjectQuery()->findOneByName(self::EXAMPLE_PROJECT_NAME)->delete();
    }

    /**
     * @return \Orm\Xervice\DockerCi\Persistence\Project
     */
    private function getExampleProject(): Project
    {
        return $this->getProjectQuery()->findOneByName(self::EXAMPLE_PROJECT_NAME);
    }

    /**
     * @param \DataProvider\ProjectDataProvider $projectDataProvider
     */
    private function assertProjectData(ProjectDataProvider $projectDataProvider): void
    {
        $this->assertEquals(
            self::EXAMPLE_PROJECT_NAME,
            $projectDataProvider->getName()
        );
        $this->assertEquals(
            'TestRepository',
            $projectDataProvider->getRepository()
        );
    }
}