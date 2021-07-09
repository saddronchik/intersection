@extends('layouts.appShow')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " role="button" data-bs-toggle="button" href="home" role="button">Главная</a>

      </div>
    </div>
    
   
                <div class="col-8">
                    <form method="POST" enctype="multipart/form-data" action="/users" id="formAdd">
                      <h1> Добавление пользователей </h1>
                      <div class="alert alert-success messages" role="alert" style="display: none"></div>
                        @csrf
                        <div class="form-group">
                          <label for="username">Логин</label>
                          <input type="text" class="form-control" name="username" id="username" >
                        </div>
                        <div class="form-group">
                          <label for="password">Пароль</label>
                          <input type="password" class="form-control" name="password" id="password" >
                        </div>
                        <div class="form-check mb-2">
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
                        </div>
                        
                        <a href="/home" class="btn btn-primary">Назад</a>
                        <button type="submit" id="add" name="add" class="btn btn-primary">Добавить пользователя</button>
                      </form>
                </div>
                <script>


                  const formAdd = document.getElementById('formAdd');
                  const messageBlock = document.querySelector('.messages');
  
                  formAdd.addEventListener('submit' , function(e){
                      e.preventDefault();
  
                      const formData = new FormData(this);
                      fetch('/users', {
                              method: "POST",
                              headers: {
                                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                      'content')
                              },
                              body: formData
                          })
                          .then(function(response) {
                              if (response.status == 200) {
                                  messageBlock.textContent = 'Данные успешно добавленны!';
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
