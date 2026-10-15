<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Course
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="course_code" class="block font-medium mb-1">
                            Course Code
                        </label>

                        <input
                            type="text"
                            id="course_code"
                            name="course_code"
                            value="{{ old('course_code') }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block font-medium mb-1">
                            Course Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium mb-1">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded"
                        >
                            Save Course
                        </button>

                        <a
                            href="{{ route('courses.index') }}"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded"
                        >
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>