<?php

use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
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
                'thread_id' => 1,
                'name' => '名無しさん',
                'message' => 'お米',
                'user_hash_id' => 'diek43',
                'ip_addr' => '192.168.10.10'
            ],
            [
                'thread_id' => 1,
                'name' => '名無しさん',
                'message' => 'カレー',
                'user_hash_id' => 'df4euf4',
                'ip_addr' => '10.10.10.10'
            ],
            [
                'thread_id' => 2,
                'name' => '愛の戦士',
                'message' => 'あああああ',
                'user_hash_id' => 'sadfie',
                'ip_addr' => '255.255.255.0'
            ]
        ];

        $posts = $this->table('posts');
        $posts->insert($data)->save();
    }
}
