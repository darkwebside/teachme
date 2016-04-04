<?php

use  \Illuminate\Database\Seeder;

use Faker\Generator;

use Faker\Factory as Faker;

abstract class BaseSeeder extends Seeder
{

    abstract function getDummyData(Generator $faker, array $customvalues = [ ]);


    abstract public function getModel();


    protected function createMultiple($total, $customvalues = [ ])
    {

        for ($i = 1; $i <= $total; $i++) {
            $this->create();
        }
    }


    protected function create(array $customvalues = [ ])
    {

        $values = $this->getDummyData(Faker::create(), $customvalues);
        $values = array_merge($values, $customvalues);
        $this->getModel()->create($values);
    }

}