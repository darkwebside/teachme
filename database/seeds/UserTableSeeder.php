<?php

use TeachMe\Entities\User;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Model;
use \Faker\Generator;

/**
 * User: dws
 * Date: 2/4/16
 * Time: 22:01.
 */
class UserTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new User();
    }

    public function getDummyData(Generator $faker, array $customvalues = [])
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
        ];
    }

    public function run()
    {
        Model::unguard();
        $this->checkConstrains(0);
        $this->truncateTables([
            'users',
            'ticket_votes',
            'ticket_comments',
            'tickets',
            'password_resets',
        ]);
        $this->checkConstrains(1);
        $this->createAdmin();
        $this->createMultiple(50);
    }

    private function createAdmin()
    {
        User::create([
            'name' => 'Manuel Glez',
            'email' => 'darkwebside@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }

    protected function checkConstrains($val)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS='.$val);
    }

    protected function truncateTables(array $tables)
    {
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
