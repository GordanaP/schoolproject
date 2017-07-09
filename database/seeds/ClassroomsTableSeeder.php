<?php

use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = [
            'I-1',
            'I-2',
            'II-1',
            'II-2',
        ];

        foreach ($labels as $label) {
            factory(App\Classroom::class)->create([
                'label' => $label
            ]);
        }
    }
}
