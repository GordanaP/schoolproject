<?php

use App\Classroom;
use App\User;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classroom_count = Classroom::count();

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'student');
        })->get();

        foreach ($students as $student)
        {
            factory(App\Student::class)->create([
                'user_id' => $student->id,
                'classroom_id' => rand(1, $classroom_count),
            ]);
        }
    }
}
