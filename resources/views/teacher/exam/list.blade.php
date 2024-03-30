@extends('teacher.layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Exam List</h3>
        <a href="{{ route('teacher.exam.add') }}"
           class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Create
        </a>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit/Delete
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $exam->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $exam->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($exam->date)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teacher.exam.edit', $exam->id) }}"
                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </a>
                                <a href="{{ route('teacher.exam.delete', $exam->id) }}"
                                   class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Delete
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('teacher.exam.student.list', $exam->id) }}"
                                   class="text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-600">
                                    See Students
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
