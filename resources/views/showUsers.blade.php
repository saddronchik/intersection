@extends('layouts.appShow')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success messages" role="alert" style="display: none"></div>
                <h1>Данные пользователя</h1>
                <form action="/users/{id}" method="post" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <table class="table table-hover">
                    <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>

                            <tr>
                                <td>Имя пользователя</td>
                                <td><input id="username" name="username" class="form-control"
                                        style="border: none;" value="{{ $user->username }}"></td>
                            </tr>
                            <tr>
                                <td>Роль пользователя</td>
                                <td><div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="role_citisen" name="role_citisen" value="user_сitisen" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Разрешение на просмотр граждан
                                    </label>
                                  </div>
                                  <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="role_avto" name="role_avto" value="user_avto">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Разрешение на просмотр автомобилей
                                    </label>
                                  </div>
                                  <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="role_border" name="role_border" value="user_border" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Разрешение на просмотр пересечения границ
                                    </label>
                                  </div>
                                  <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="role_admin" name="role_admin" value="admin" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Разрешение на просмотр всего
                                    </label>
                                  </div></td>
                            </tr>
                            

                        </tbody>



                    </table>
                    <a href="/usersList" class="btn btn-primary">Назад</a>
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
                    fetch('/users/{id}', {
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
