@extends('layouts.appShow')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success messages" role="alert" style="display: none"></div>
                
                <form action="/border/{id}" method="post" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $border->id }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>

                            <tr>
                                <td>Гражданин</td>
                                <td><input id="id_citisen" name="id_citisen" class="form-control"
                                        style="border: none;" value="{{ $border->id_citisen}}"></td>
                            </tr>
                            <tr>
                                <td>Гражданство</td>
                                <td><input id="citizenship" name="citizenship" class="form-control" style="border: none;"
                                        value="{{ $border->citizenship }}"></td>
                            </tr>

                            <tr>
                                <td>ФИО</td>
                                <td><input id="full_name" name="full_name" class="form-control" style="border: none;"
                                        value="{{ $border->full_name }}"></td>

                            </tr>
                            <tr>
                                <td>Дата рождения</td>
                                <td><input id="date_birth" name="date_birth" class="form-control"
                                        style="border: none;" value="{{ $border->date_birth }}"></td>
                            </tr>
                            <tr>
                                <td>Паспорт</td>
                                <td><textarea id="passport" name="passport" class="form-control"
                                        style="border: none;">{{ $border->passport }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Дата пересечения</td>
                                <td><textarea id="crossing_date" name="crossing_date" class="form-control"
                                        style="border: none;">{{ $border->crossing_date }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Время пересечения</td>
                                <td><textarea id="crossing_time" name="crossing_time" class="form-control"
                                        style="border: none;">{{ $border->crossing_time }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Средство передвижения</td>
                                <td><textarea id="way_crossing" name="way_crossing" class="form-control"
                                        style="border: none;">{{ $border->way_crossing }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>КПП</td>
                                <td><textarea id="checkpoint" name="checkpoint" class="form-control"
                                        style="border: none;">{{ $border->checkpoint }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Маршрут</td>
                                <td><textarea id="route" name="route" class="form-control"
                                        style="border: none;">{{ $border->route }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Место рождения</td>
                                <td><textarea id="place_birth" name="place_birth" class="form-control"
                                        style="border: none;">{{ $border->place_birth }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Место регистрации</td>
                                <td><textarea id="place_regis" name="place_regis" class="form-control"
                                        style="border: none;">{{ $border->place_regis }}</textarea> </td>
                            </tr>

                            

                        </tbody>



                    </table>
                    <a href="/borderslist" class="btn btn-primary">Назад</a>
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
                    fetch('/border/{id}', {
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
