<?php

use Phinx\Seed\AbstractSeed;

class ThreadSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 1,
                'title' => '今日のご飯'
            ],
            [
                'category_id' => 1,
                'title' => 'チラ裏'
            ]
        ];

        $threads = $this->table('threads');
        $threads->insert($data)->save();
    }
}
