@extends('teacher.layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="row mt-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="col-md-6 p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="py-2 text-gray-900 dark:text-gray-100">Welcome !!</h4>
                    <h4 class="py-2 text-gray-900 dark:text-gray-100">{{$teacher->id}}</h4>
                    <h4 class="py-2 text-gray-900 dark:text-gray-100">{{$teacher->id_no}}</h4>
                    <h4 class="py-2 text-gray-900 dark:text-gray-100">{{$teacher->name}}</h4>
                    <h4 class="py-2 text-gray-900 dark:text-gray-100">{{$teacher->email}}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
