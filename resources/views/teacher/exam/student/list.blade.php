@extends('teacher.layouts.app')
@section('css')
@endsection
@section('header')
    <div class="w-100 flex justify-between">
        <h3 class="py-2.5">Exam Student List</h3>
        <div>
            <a href="{{ route('teacher.exam.student.create', $exams->first()->exam->id) }}"
                    class="me-3 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add
            </a>
            <button type="button" onclick="updateExamStudent()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </div>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" colspan="2" class="px-6 py-3 border-b-2 border-gray-600">
                            Öğrenciler
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 border-l-2 border-b-2 border-gray-600">
                            Türkçe
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 border-l-2 border-b-2 border-gray-600">
                            Matematik
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 border-l-2 border-b-2 border-gray-600">
                            İnkılap Tarihi
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 border-l-2 border-b-2 border-gray-600">
                            Fen Bilimleri
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3">Adı</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Sınıfı</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Doğru</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Yanlış</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Doğru</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Yanlış</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Doğru</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Yanlış</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Doğru</th>
                        <th scope="col" class="px-6 py-3 border-l-2 border-gray-600">Yanlış</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $exam->student->name }}
                            </th>
                            <td class="px-6 py-3 border-l-2 border-gray-700">
                                {{ $exam->student->getGrade->name }}
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="turkce_dogru{{$exam->id}}" class="block mt-1 w-full" type="text" name="turkce_dogru{{$exam->id}}" value="{{ $exam->turkce_dogru }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="turkce_yanlis{{$exam->id}}" class="block mt-1 w-full" type="text" name="turkce_yanlis{{$exam->id}}" value="{{ $exam->turkce_yanlis }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="matematik_dogru{{$exam->id}}" class="block mt-1 w-full" type="text" name="matematik_dogru{{$exam->id}}" value="{{ $exam->matematik_dogru }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="matematik_yanlis{{$exam->id}}" class="block mt-1 w-full" type="text" name="matematik_yanlis{{$exam->id}}" value="{{ $exam->matematik_yanlis }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="inkilap_dogru{{$exam->id}}" class="block mt-1 w-full" type="text" name="inkilap_dogru{{$exam->id}}" value="{{ $exam->inkilap_dogru }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="inkilap_yanlis{{$exam->id}}" class="block mt-1 w-full" type="text" name="inkilap_yanlis{{$exam->id}}" value="{{ $exam->inkilap_yanlis }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="fenbilimleri_dogru{{$exam->id}}" class="block mt-1 w-full" type="text" name="fenbilimleri_dogru{{$exam->id}}" value="{{ $exam->fenbilimleri_dogru }}" />
                            </td>
                            <td class="p-2 border-l-2 border-gray-700">
                                <x-text-input id="fenbilimleri_yanlis{{$exam->id}}" class="block mt-1 w-full" type="text" name="fenbilimleri_yanlis{{$exam->id}}" value="{{ $exam->fenbilimleri_yanlis }}" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateExamStudent() {
            Swal.fire({
                title: "Are you sure?",
                text: "You are going to update all of the students notes.",
                showCancelButton: true,
                confirmButtonText: "Yes, update",
                icon: "question",
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        method: 'POST',
                        url: '{{ route("teacher.exam.student.edit", $exams[0]->exam_id) }}',
                        data: getVeri(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            // Başarılı bir yanıt alındığında burası çalışır
                            if (response.message) {
                                Swal.fire({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success"
                                }).then((response) =>{
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Hata oluştuğunda burası çalışır
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                alert(xhr.responseJSON.error);
                            } else {
                                alert('Error occurred while updating exam student list.blade.php: ' + error);
                            }
                        },
                    });
                }
            });
        }

        function getVeri() {
            var veriler = {};

            // Her bir sınav için input verilerini al
            @foreach($exams as $exam)
            var examstudentId = {{$exam->id}};
            veriler[examstudentId] = {
                id:examstudentId,
                turkce_dogru: document.getElementById("turkce_dogru" + examstudentId).value,
                turkce_yanlis: document.getElementById("turkce_yanlis" + examstudentId).value,
                matematik_dogru: document.getElementById("matematik_dogru" + examstudentId).value,
                matematik_yanlis: document.getElementById("matematik_yanlis" + examstudentId).value,
                inkilap_dogru: document.getElementById("inkilap_dogru" + examstudentId).value,
                inkilap_yanlis: document.getElementById("inkilap_yanlis" + examstudentId).value,
                fenbilimleri_dogru: document.getElementById("fenbilimleri_dogru" + examstudentId).value,
                fenbilimleri_yanlis: document.getElementById("fenbilimleri_yanlis" + examstudentId).value,
            };
            @endforeach

            return veriler;
        }
    </script>
@endsection
