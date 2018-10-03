<?php

namespace AppBundle\DataFixtures\ORM\Entity;

use AppBundle\DataFixtures\ORM\BaseFixture;
use AppBundle\Entity\Assignee;
use AppBundle\Entity\Project;
use Doctrine\Common\Persistence\ObjectManager;

class AssigneesFixture extends BaseFixture {

    public function getFileName()
    {
        return "Assignees.csv";
    }

    public function getObject()
    {
        return Assignee::class;
    }

    public function create($object, ObjectManager $manager, $value = array(), $header = array())
    {
        $object->setName($value[$header['name']]);
        $object->setEmail($value[$header['email']]);
        $manager->persist($object);
    }
}