@extends('student.layouts.app')
@section('css')
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Exam Student List</h3>
        <h3 class="py-2.5">{{ $exam->exam->name }}</h3>
    </div>
@endsection
@section('content')
    <div">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-600"></th>
                        <th class="px-3 py-3 border-b-2 border-gray-600">
                            Dogru
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-600">
                            Yanlis
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-6 py-3">Turkce</th>
                        <td class="px-3 py-3">{{ $exam->turkce_dogru }}</td>
                        <td class="px-3 py-3">{{ $exam->turkce_yanlis }}</td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-6 py-3">Matematik</th>
                        <td class="px-3 py-3">{{ $exam->matematik_dogru }}</td>
                        <td class="px-3 py-3">{{ $exam->matematik_yanlis }}</td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-6 py-3">Inkilap Tarihi</th>
                        <td class="px-3 py-3">{{ $exam->inkilap_dogru }}</td>
                        <td class="px-3 py-3">{{ $exam->inkilap_yanlis }}</td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-6 py-3">Fen Bilimleri</th>
                        <td class="px-3 py-3">{{ $exam->fenbilimleri_dogru }}</td>
                        <td class="px-3 py-3">{{ $exam->fenbilimleri_yanlis }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
