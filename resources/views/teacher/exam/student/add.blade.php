@extends('teacher.layouts.app')
@section('header', 'Add New Exam Result')
@section('css')
@endsection
@section('content')

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('teacher.exam.student.create', $exam->id) }}">
                @csrf
                <input type="hidden" name="examId" value="{{ $exam->id }}">

                <!-- Student -->
                <div>
                    <x-input-label for="student_id" :value="__('Student')"/>
                    <select id="student_id" name="student_id" onchange="studentControl()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="selectOne" selected>Not Eklemek İçin Öğrenci Seçiniz</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="studentControl" style="display: none;">
                    <br>
                    <hr class="border-gray-700">

                    <!-- Türkçe -->
                    <div>
                        <x-input-label for="turkce" :value="__('Türkçe')" class="mb-1 mt-4 text-xl"/>
                        <div class="grid md:grid-cols-2 md:gap-6" id="turkce">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="turkce_dogru" :value="__('Doğru')"/>
                                <x-text-input id="turkce_dogru" class="block mt-1 w-full" type="text"
                                              name="turkce_dogru"/>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="turkce_yanlis" :value="__('Yanlış')"/>
                                <x-text-input id="turkce_yanlis" class="block mt-1 w-full" type="text"
                                              name="turkce_yanlis"/>
                            </div>
                        </div>
                    </div>
                    <hr class="border-gray-700">
                    <br>

                    <!-- Matematik -->
                    <div>
                        <x-input-label for="matematik" :value="__('Matematik')" class="text-xl"/>
                        <div class="grid md:grid-cols-2 md:gap-6" id="matematik">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="matematik_dogru" :value="__('Doğru')"/>
                                <x-text-input id="matematik_dogru" class="block mt-1 w-full" type="text"
                                              name="matematik_dogru"/>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="matematik_yanlis" :value="__('Yanlış')"/>
                                <x-text-input id="matematik_yanlis" class="block mt-1 w-full" type="text"
                                              name="matematik_yanlis"/>
                            </div>
                        </div>
                    </div>
                    <hr class="border-gray-700">
                    <br>

                    <!-- İnkılap Tarihi -->
                    <div>
                        <x-input-label for="inkilap" :value="__('İnkılap Tarihi')" class="text-xl"/>
                        <div class="grid md:grid-cols-2 md:gap-6" id="inkilap">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="inkilap_dogru" :value="__('Doğru')"/>
                                <x-text-input id="inkilap_dogru" class="block mt-1 w-full" type="text"
                                              name="inkilap_dogru"/>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="inkilap_yanlis" :value="__('Yanlış')"/>
                                <x-text-input id="inkilap_yanlis" class="block mt-1 w-full" type="text"
                                              name="inkilap_yanlis"/>
                            </div>
                        </div>
                    </div>
                    <hr class="border-gray-700">
                    <br>

                    <!-- Fen Bilimleri -->
                    <div>
                        <x-input-label for="fenbilimleri" :value="__('Fen Bilimleri')" class="text-xl"/>
                        <div class="grid md:grid-cols-2 md:gap-6" id="fenbilimleri">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="fenbilimleri_dogru" :value="__('Doğru')"/>
                                <x-text-input id="fenbilimleri_dogru" class="block mt-1 w-full" type="text"
                                              name="fenbilimleri_dogru"/>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="fenbilimleri_yanlis" :value="__('Yanlış')"/>
                                <x-text-input id="fenbilimleri_yanlis" class="block mt-1 w-full" type="text"
                                              name="fenbilimleri_yanlis"/>
                            </div>
                        </div>
                    </div>

                    <div class="w-full text-right">
                        <button type="submit"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            studentControl();
        })

        function studentControl() {
            const container = document.getElementById('studentControl');
            const selectbox = document.getElementById('student_id');

            if(selectbox.value != 'selectOne'){
                container.style.display = "block";
            }
            else {
                container.style.display = "none";
            }
            console.log(selectbox.value);
        }
    </script>
@endsection
