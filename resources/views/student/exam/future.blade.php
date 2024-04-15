@extends('student.layouts.app')
@section('css')
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Future Exam List</h3>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg {{ count($future_exams) == 0 ? 'bg-gray-800' : null }}">
                @if(count($future_exams) > 0)
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
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
                                See Exam Results
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($future_exams as $index => $exam)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index+1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $exam->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $exam->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $exam->date }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('student.create.exam.request') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                        <button type="submit"
                                                class="text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-600">
                                            Send Request To Join
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="my-5 px-6 text-white">
                        <h5>There is no future exams for now.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
