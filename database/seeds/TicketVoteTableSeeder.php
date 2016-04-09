<?php


use Faker\Generator;
use TeachMe\Entities\TicketVote;

class TicketVoteTableSeeder extends BaseSeeder
{
    protected $total = 250;

    public function getDummyData(Generator $faker, array $customvalues = [])
    {
        // Cuidado un usuario podría votar varias veces en el mismo ticket si coinciden

        return [
            'user_id' => $this->getRandom('User')->id,
            'ticket_id' => $this->getRandom('Ticket')->id,
        ];
    }

    public function getModel()
    {
        return new TicketVote();
    }
}
