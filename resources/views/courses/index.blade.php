<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Courses
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Add Course Button --}}
                @can('create', App\Models\Course::class)
                    <a href="{{ route('courses.create') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4">
                        Add Course
                    </a>
                @endcan

                {{-- Courses Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3 text-left">
                                    Course Code
                                </th>

                                <th class="border p-3 text-left">
                                    Title
                                </th>

                                <th class="border p-3 text-left">
                                    Instructor
                                </th>

                                <th class="border p-3 text-left">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($courses as $course)
                                <tr>
                                    {{-- Course Code --}}
                                    <td class="border p-3">
                                        {{ $course->course_code }}
                                    </td>

                                    {{-- Course Title --}}
                                    <td class="border p-3">
                                        {{ $course->title }}
                                    </td>

                                    {{-- Instructor Name --}}
                                    <td class="border p-3">
                                        {{ $course->instructor->name ?? 'N/A' }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="border p-3 whitespace-nowrap">
                                        {{-- View Button --}}
                                        <a href="{{ route('courses.show', $course) }}"
                                           class="text-blue-600 hover:text-blue-800 underline">
                                            View
                                        </a>

                                        {{-- Edit Button --}}
                                        @can('update', $course)
                                            <a href="{{ route('courses.edit', $course) }}"
                                               class="ml-2 text-green-600 hover:text-green-800 underline">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Delete Button --}}
                                        @can('delete', $course)
                                            <form action="{{ route('courses.destroy', $course) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this course?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="ml-2 text-red-600 hover:text-red-800 underline">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="border p-4 text-center text-gray-500">
                                        No courses available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>