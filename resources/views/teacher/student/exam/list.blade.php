@extends('teacher.layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Students Exams List</h3>
        {{--<a href="{{ route('teacher.exam.add') }}"
           class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Create
        </a>--}}
        <h4 class="py-2.5">{{ $student->name }}</h4>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg {{ count($examstudents) == 0 ? 'bg-gray-800' : null }}">
                @if(count($examstudents) > 0)
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($examstudents as $examstudent)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-bn dark:border-gray-700">
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $examstudent->exam->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $examstudent->exam->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($examstudent->date)->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <div class="my-5 px-6 text-white">
                        <h5>There is no exams for now.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
