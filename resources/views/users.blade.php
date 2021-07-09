@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " role="button" data-bs-toggle="button" href="home" role="button">Главная</a>


      </div>
    </div>  
    
    
    <div class="col-10">
      
              <h1 class="display-8">Данные пользователей</h1>
              
                @foreach ($users as $user)
               
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Имя пользователя</th>
                      <th scope="col">Роль</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td class="col-md-5">{{ $user->username }}</td>
                      <td class="col-md-5">{{ $user->name }}</td>

                    </tr>
                    
                </tbody>
                
              </table>
              <a href="users/{{$user->id}}" class="btn btn-primary btn-sm ">Открыть</a>
              <a href="destroyuser/{{$user->id}}" class="btn btn-danger btn-sm ">Удалить</a>
                @endforeach
    </div>
      

          
@endsection
