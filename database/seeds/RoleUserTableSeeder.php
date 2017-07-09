<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = User::all()->pluck('id')->toArray();

        $students = User::whereIn('id', array_slice($ids, 0, 2, true))->get();
        $student_role = Role::whereName('student')->first();

        $teachers = User::whereIn('id', array_slice($ids, 2, 2, true))->get();
        $teacher_role = Role::whereName('teacher')->first();

        $admins = User::whereIn('id', array_slice($ids, 3, 2, true))->get();
        $admin_role = Role::whereName('admin')->first();

        $superadmin = User::whereId(5)->first();
        $superadmin_role = Role::whereName('superadmin')->first();

        foreach ($students as $student)
        {
            $student->roles()->attach($student_role);
        }

        foreach ($teachers as $teacher)
        {
            $teacher->roles()->attach($teacher_role);
        }

        foreach ($admins as $admin)
        {
            $admin->roles()->attach($admin_role);
        }

        $superadmin->roles()->attach($superadmin_role);
    }
}
