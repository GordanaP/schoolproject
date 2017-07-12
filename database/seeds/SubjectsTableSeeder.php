<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['math', 'art & culture', 'geography', 'history', 'biology'];

        foreach ($subjects as $subject)
        {
            factory(App\Subject::class)->create([
                'name' => $subject
            ]);
        }
    }
}
