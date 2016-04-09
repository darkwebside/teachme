<?php

use Faker\Generator;
use TeachMe\Entities\TicketComment;

/**
 * User: dws
 * Date: 4/4/16
 * Time: 19:33.
 */
class TicketCommentTableSeeder extends BaseSeeder
{
    public function getDummyData(Generator $faker, array $customvalues = [])
    {
        return [
           'comment' => $faker->paragraph(3, true),
           'link' => $faker->randomElement(['', '', $faker->url]),
           'user_id' => $this->getRandom('User')->id,
           'ticket_id' => $this->getRandom('Ticket')->id,
       ];
    }

    public function getModel()
    {
        return new TicketComment();
    }
}
