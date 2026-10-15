<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Admin can do anything before other policy checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null; // Fall through to standard policy checks
    }

    /**
     * Anyone logged in can view the list of courses.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Active courses can be viewed by anyone; inactive courses only by the owner.
     */
    public function view(User $user, Course $course): bool
    {
        if ($course->is_active) {
            return true;
        }

        return $user->id === $course->user_id;
    }

    /**
     * Only instructors and admins can create courses.
     */
    public function create(User $user): bool
    {
        return $user->isInstructor();
    }

    /**
     * Only the owner can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    /**
     * Owner can delete the course, ONLY IF no students are enrolled in it.
     */
    public function delete(User $user, Course $course): bool
    {
        if ($user->id !== $course->user_id) {
            return false;
        }

        return $course->students()->count() === 0;
    }
}