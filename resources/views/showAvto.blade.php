@extends('layouts.appShow')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success messages" role="alert" style="display: none"></div>
                
                <form action="/avto/{id}" method="post" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $avto->id }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>

                            <tr>
                                <td>ID владельца</td>
                                <td><input id="id_citisen" name="id_citisen" class="form-control"
                                        style="border: none;" value="{{ $avto->id_citisen}}"></td>
                            </tr>
                            <tr>
                                <td>Марка автомобиля</td>
                                <td><input id="brand_avto" name="brand_avto" class="form-control" style="border: none;"
                                        value="{{ $avto->brand_avto }}"></td>
                            </tr>

                            <tr>
                                <td>Регистрационный номер</td>
                                <td><input id="regis_num" name="regis_num" class="form-control" style="border: none;"
                                        value="{{ $avto->regis_num }}"></td>

                            </tr>
                            <tr>
                                <td>Цвет</td>
                                <td><input id="color" name="color" class="form-control"
                                        style="border: none;" value="{{ $avto->color }}"></td>
                            </tr>
                            <tr>
                                <td>Доп. информация</td>
                                <td><textarea id="addit_inf" name="addit_inf" class="form-control"
                                        style="border: none;">{{ $avto->addit_inf }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Фото</td>
                                <td><img src="{{ asset(Illuminate\Support\Facades\Storage::url($avto->photo)) }}" height="240px"></td>
                            </tr>

                        </tbody>



                    </table>
                    <a href="/avtoslist" class="btn btn-primary">Назад</a>
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
                    fetch('/avto/{id}', {
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
                            if (response.status == 500) {
                                  messageBlock.textContent = 'Ошибка данных!';
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
