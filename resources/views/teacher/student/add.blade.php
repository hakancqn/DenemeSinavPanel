@extends('teacher.layouts.app')
@section('header', 'Add New Grade')
@section('content')

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('teacher.student.add') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                  required autofocus autocomplete="name"/>

                    <x-input-label for="email" class="mt-2" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                  required autofocus autocomplete="email"/>

                    <x-input-label for="id_no" class="mt-2" :value="__('ID Number')"/>
                    <x-text-input id="id_no" class="block mt-1 w-full" type="text" name="id_no" :value="old('id_no')"
                                  required autofocus autocomplete="id_no"/>

                    <x-input-label for="school_no" class="mt-2" :value="__('School Number')"/>
                    <x-text-input id="school_no" class="block mt-1 w-full" type="text" name="school_no"
                                  :value="old('school_no')"
                                  required autofocus autocomplete="school_no"/>

                    <x-input-label for="grade" class="mt-2" :value="__('Grade')"/>
                    <select id="grade" name="grade"
                            class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
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
