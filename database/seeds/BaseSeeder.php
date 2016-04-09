<?php

use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Seeder;
use Faker\Generator;
use Faker\Factory as Faker;

abstract class BaseSeeder extends Seeder
{
    protected static $pool = [];

    protected $total = 50;

    abstract public function getDummyData(Generator $faker, array $customvalues = []);

    abstract public function getModel();

    public function run()
    {
        $this->createMultiple($this->total);
    }

    protected function createMultiple($total, $customvalues = [])
    {
        for ($i = 1; $i <= $total; ++$i) {
            $this->create();
        }
    }

    protected function create(array $customvalues = [])
    {
        $values = $this->getDummyData(Faker::create(), $customvalues);
        $values = array_merge($values, $customvalues);

        return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customvalues = [])
    {
        $seeder = new $seeder();

        return $seeder->create($customvalues);
    }

    protected function getRandom($model)
    {
        if (!$this->collectionExit($model)) {
            throw new Exception("The $model collection does not exits");
        }

        return static::$pool[$model]->random();
    }

    protected function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);

        $class = $reflection->getShortName();
        if (!$this->collectionExit($class)) {
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($entity);

        return $entity;
    }

    /**
     * @param $class
     *
     * @return bool
     */
    protected function collectionExit($class)
    {
        return isset(static::$pool[$class]);
    }
}
