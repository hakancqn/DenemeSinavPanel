@extends('teacher.layouts.app')
@section('header', 'Add New Grade')
@section('content')

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('teacher.grade.edit', $grade->id) }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <input type="hidden" name="id" value="{{ $grade->id }}">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$grade->name"
                                  required autofocus autocomplete="name"/>
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
