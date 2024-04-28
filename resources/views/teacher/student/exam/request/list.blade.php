@extends('teacher.layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Exam Request List</h3>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Student Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Exam Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Exam Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accept/Deny
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $index => $request)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index+1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $request->id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $request->student->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $request->exam->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $request->exam->date }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teacher.student.exam.request.accept', $request->id) }}"
                                   class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-green">
                                    Accept
                                </a>
                                <a href="{{ route('teacher.student.exam.request.deny', $request->id) }}"
                                   class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Deny
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
