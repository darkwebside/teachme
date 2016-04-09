<?php

use Faker\Generator;
use TeachMe\Entities\Ticket;

/**
 * User: dws
 * Date: 3/4/16
 * Time: 21:10.
 */
class TicketTableSeeder extends BaseSeeder
{
    public function getDummyData(Generator $faker, array $customvalues = [])
    {
        return [
            'title' => $faker->sentence(),
            'Status' => $faker->randomElement(['open', 'open', 'closed']),
            'user_id' => $this->getRandom('User')->id,
        ];
    }

    public function getModel()
    {
        return new Ticket();
    }
}
