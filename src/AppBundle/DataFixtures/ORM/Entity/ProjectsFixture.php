<?php

namespace AppBundle\DataFixtures\ORM\Entity;

use AppBundle\DataFixtures\ORM\BaseFixture;
use AppBundle\Entity\Project;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectsFixture extends BaseFixture {

    public function getFileName()
    {
        return "Projects.csv";
    }

    public function getObject()
    {
        return Project::class;
    }

    public function create($object, ObjectManager $manager, $value = array(), $header = array())
    {
        $object->setName($value[$header['name']]);
        $manager->persist($object);
    }
}