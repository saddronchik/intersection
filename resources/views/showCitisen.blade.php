@extends('layouts.appShow')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success messages" role="alert" style="display: none"></div>
                <h1>{{ $citizen->full_name }}</h1>
                <form action="/citisen/{id}" method="post" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $citizen->id }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>

                            <tr>
                                <td>Данные пасспорта</td>
                                <td><input id="passport_data" name="passport_data" class="form-control"
                                        style="border: none;" value="{{ $citizen->passport_data }}"></td>
                            </tr>
                            <tr>
                                <td>Дата рождения</td>
                                <td><input id="date_birth" name="date_birth" class="form-control" style="border: none;"
                                        value="{{ $citizen->date_birth }}"></td>
                            </tr>
                            <tr>
                                <td>Место жительства</td>
                                <td><input id="place_residence" name="place_residence" class="form-control"
                                        style="border: none;" value="{{ $citizen->place_residence }}"></td>
                            </tr>
                            <tr>
                                <td>Телефонный номер</td>
                                <td><input id="phone_number" name="phone_number" class="form-control" style="border: none;"
                                        value="{{ $citizen->phone_number }}"></td>

                            </tr>
                            <tr>
                                <td>Социальный аккаутн</td>
                                <td><input id="social_account" name="social_account" class="form-control"
                                        style="border: none;" value="{{ $citizen->social_account }}"></td>
                            </tr>
                            <tr>
                                <td>Доп. информация</td>
                                <td><textarea id="addit_inf" name="addit_inf" class="form-control"
                                        style="border: none;">{{ $citizen->addit_inf }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Фото</td>
                                <td><img src="{{ asset(Illuminate\Support\Facades\Storage::url($citizen->photo)) }}" height="240px"></td>
                            </tr>

                        </tbody>



                    </table>
                    <a href="/home" class="btn btn-primary">Назад</a>
                    <button id="update" name="update" type="submit" class="btn btn-success">
                        Обновить данные </button>
            </div>
            </form>
            <script>


                const formUpdate = document.getElementById('formUpdate');
                const messageBlock = document.querySelector('.messages');

                formUpdate.addEventListener('submit' , function(e){
                    e.preventDefault();

                    const formData = new FormData(this);
                    fetch('/citisen/{id}', {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: formData
                        })
                        .then(function(response) {
                            if (response.status == 200) {
                                messageBlock.textContent = 'Данные обновлены успешно!';
                                messageBlock.style.display = 'block';
                            }
                            // console.log(response)
                        //    return response.text();
                        })

                        .then(function(text)  {
                            console.log('Success ' + text);

                        }).catch(function(error){
                            console.error(error);

                        })

                });

            </script>

        @endsection
