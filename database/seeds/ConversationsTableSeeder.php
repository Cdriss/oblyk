<?php

use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lucien(1) + léna(3)
        DB::table('conversations')->insert([
            'label' => 'Conversation avec Léna',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // Lucien(1) + Oblyk(2)
        DB::table('conversations')->insert([
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //Lucien(1) + Oblyk(2) + Léna(3)
        DB::table('conversations')->insert([
            'label' => 'Lucien, Oblyk et Léna',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
