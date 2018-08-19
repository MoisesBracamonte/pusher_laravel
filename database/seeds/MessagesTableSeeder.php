<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'content' => 'Hola como estas' 
        ]);
        App\Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'content' => 'Bien y tu' 
        ]);
        App\Message::create([
            'from_id' => 1,
            'to_id' => 3,
            'content' => 'Hola. nuevo' 
        ]);
        App\Message::create([
            'from_id' => 3,
            'to_id' => 1,
            'content' => 'Hola. Viejo' 
        ]);
    }
}
