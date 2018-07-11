<?php


namespace DockerCi\DockerCi;


use DockerCi\DockerCi\Business\Project\ProjectWriter;
use Orm\Xervice\Database\Persistence\ProjectQuery;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\DockerCi\DockerCiConfig getConfig()
 */
class DockerCiFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\DockerCi\Business\Project\ProjectWriter
     */
    public function createProjectWriter()
    {
        return new ProjectWriter(
            $this->getProjectQuery()
        );
    }
    
    /**
     * @return \Orm\Xervice\Database\Persistence\ProjectQuery
     */
    public function getProjectQuery()
    {
        return ProjectQuery::create();
    }
}