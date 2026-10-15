<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
            ]
        );

        $instructor = User::updateOrCreate(
            ['email' => 'instructor@example.com'],
            [
                'name' => 'Instructor User',
                'password' => Hash::make('Password123!'),
                'role' => 'instructor',
            ]
        );

        $student = User::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('Password123!'),
                'role' => 'student',
            ]
        );

        Course::firstOrCreate(
            ['course_code' => 'WEBDEV101'],
            [
                'user_id' => $instructor->id,
                'title' => 'Web Development',
                'description' => 'Introduction to web development.',
            ]
        );

        Course::firstOrCreate(
            ['course_code' => 'LARAVEL101'],
            [
                'user_id' => $instructor->id,
                'title' => 'Laravel Fundamentals',
                'description' => 'Introduction to Laravel framework.',
            ]
        );
    }
}