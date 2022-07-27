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
                                <td class="flex-inner" >
                                    <div class="mb-2">
                                      <div class="form-check form-check-inline">
                                        <label >Граждане: </label>
                                      </div>
                                      <div class="mb-2">
                                        <div class="form-check form-check-inline">
                                          
                                          <label >Автомобили: </label>
                                        </div>
                                        <div class="mb-2">
                                          <div class="form-check form-check-inline">
                                            <label >Пересечение границ: </label>
                                          </div>
                                          <div class="mb-2">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="checkbox" name="role_admin" id="role_admin" value="admin">
                                              <label class="form-check-label" for="inlineRadio3" style="color: rgb(13, 187, 13)">Администратор</label>
                                            </div>
                                          </div>
                                      <td>
                                          <div class="form-check form-check mb-2">
                                              <input class="form-check-input" type="checkbox" name="role_citisen" id="role_citisen" value="user_сitisen">
                                              <label class="form-check-label" for="inlineCheckbox1">Просмотр</label>
                                            </div>
                                            <div class="form-check form-check mb-2">
                                              <input class="form-check-input" type="checkbox" name="role_avto" id="role_avto" value="user_avto">
                                              <label class="form-check-label" for="inlineCheckbox1">Просмотр</label>
                                            </div>
                                            <div class="form-check form-check mb-2">
                                              <input class="form-check-input" type="checkbox" name="role_border" id="role_border" value="user_border">
                                              <label class="form-check-label" for="inlineCheckbox1">Просмотр</label>
                                            </div>
                                      </td> 
                                      <td>     
                                        <div class="form-check form-check mb-2">
                                          <input class="form-check-input" type="checkbox" name="role_citisen_add" id="role_citisen_add" value="user_сitisen_add">
                                          <label class="form-check-label" for="inlineCheckbox2">Добавление</label>
                                        </div>
                                        <div class="form-check form-check mb-2">
                                          <input class="form-check-input" type="checkbox" name="role_avto_add" id="role_avto_add" value="user_avto_add">
                                          <label class="form-check-label" for="inlineCheckbox2">Добавление</label>
                                        </div>
                                        <div class="form-check form-check mb-2">
                                          <input class="form-check-input" type="checkbox" name="role_border_add" id="role_border_add" value="user_border_add">
                                          <label class="form-check-label" for="inlineCheckbox2">Добавление</label>
                                        </div>


                                      </td>
                                      <td>
                                          <div class="form-check form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="role_citisen_upd" id="role_citisen_upd" value="user_сitisen_upd">
                                            <label class="form-check-label" for="inlineCheckbox3">Редактирование</label>
                                          </div>
                                          <div class="form-check form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="role_avto_upd" id="role_avto_upd" value="user_avto_upd">
                                            <label class="form-check-label" for="inlineCheckbox3">Редактирование</label>
                                          </div>
                                          <div class="form-check form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="role_border_upd" id="role_border_upd" value="user_border_upd">
                                            <label class="form-check-label" for="inlineCheckbox3">Редактирование</label>
                                          </div>
                                      </td>
          
            
                                      <td>
                                    
                                      </td>
                                </td>
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
