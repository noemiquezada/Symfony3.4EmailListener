<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

abstract class BaseFixture extends Fixture {

    /**
     * CSV filepath
     * @var string $csv
     */
    private $csv;

    /**
     * Create object from a row of values
     * @param mixed $object
     * @param ObjectManager $manager
     * @param array $value
     * @param array $header
     */
    abstract public function create($object, ObjectManager $manager, $value = array(), $header = array());

    /**
     * Set FileName of CSV file
     * @return string
     */
    abstract public function getFileName();

    /**
     * Get class of Object being persisted
     * @return \stdClass
     */
    abstract public function getObject();

    /**
     * Set CSV filepath
     * @param $filepath
     */
    public function setCSV($filepath) {
        $this->csv = $filepath;
    }

    /**
     * Get CSV filepath
     * @return string
     */
    public function getCSV() {
        return $this->csv;
    }

    public function getBasePath() {
        return __DIR__ . '/../CSV/';
    }

    public function load(ObjectManager $manager) {
        $this->setCSV($this->getBasePath() . $this->getFileName());
        if ($this->getCSV()) {
            $file = file($this->getCSV());
            $values = array_map('str_getcsv', $file);
            $header = array_shift($values);
            $header = array_flip($header);
            $this->createObjects($manager, $header, $values);
        }
    }

    /**
     * Create objects based on the values and header values of the CSV
     * @param ObjectManager $manager
     * @param array $header
     * @param array $values
     */
    private function createObjects(ObjectManager $manager, $header = array(), $values = array()) {
        foreach ($values as $key => $value) {
            $r = new \ReflectionClass($this->getObject());
            $object = $r->newInstance();
            $this->create($object, $manager, $value, $header);
        }
        $manager->flush();
    }
}