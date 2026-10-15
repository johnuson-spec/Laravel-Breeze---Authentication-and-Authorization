<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Course Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Course Code</p>
                    <p class="text-lg font-semibold">
                        {{ $course->course_code }}
                    </p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Course Title</p>
                    <p class="text-lg font-semibold">
                        {{ $course->title }}
                    </p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Description</p>
                    <p>
                        {{ $course->description ?: 'No description provided.' }}
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500">Instructor</p>
                    <p>
                        {{ $course->instructor->name ?? 'N/A' }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <a
                        href="{{ route('courses.index') }}"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded"
                    >
                        Back to Courses
                    </a>

                    @can('update', $course)
                        <a
                            href="{{ route('courses.edit', $course) }}"
                            class="bg-green-600 text-white px-4 py-2 rounded"
                        >
                            Edit Course
                        </a>
                    @endcan
                </div>

            </div>
        </div>
    </div>
</x-app-layout>