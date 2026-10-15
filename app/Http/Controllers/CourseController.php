<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Course::class);

        $courses = Course::with('instructor')->latest()->get();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        Gate::authorize('create', Course::class);

        return view('courses.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Course::class);

        $validated = $request->validate([
            'course_code' => ['required', 'string', 'max:50', 'unique:courses,course_code'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $request->user()->courses()->create($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        Gate::authorize('view', $course);

        $course->load('instructor');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        Gate::authorize('update', $course);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        Gate::authorize('update', $course);

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('courses', 'course_code')->ignore($course->id),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        Gate::authorize('delete', $course);

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}