@extends('teacher.layouts.app')
@section('header', 'Add New Exam')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('teacher.exam.add') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  required autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Date -->
                <div class="mt-2">
                    <x-input-label for="date" :value="__('Date')"/>
                    <input id="date" name="date" class=" w-full bg-gray-900 border-gray-700 rounded-md text-gray-300">
                    <x-input-error :messages="$errors->get('date')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", {
            enableTime: true,
            altInput: true,
            time_24hr: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: "d/m/Y H:i",
            defaultDate: "today",
            minDate: "today",
        });
    </script>
@endsection
