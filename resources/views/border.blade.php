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
      
              <h1 class="display-8">Пересечение границы</h1>
              
                @foreach ($borders as $border)
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Гражданин</th>
                      <th scope="col">Гражданство</th>
                      {{-- <th scope="col">Полное имя</th> --}}
                      <th scope="col">Дата рождения</th>
                      <th scope="col">Паспорт</th>
                      <th scope="col">Дата пересечения</th>
                      {{-- <th scope="col">Время пересечения</th> --}}
                      <th scope="col">Способ передвижения</th>
                      <th scope="col">КПП</th>
                      <th scope="col">Направление</th>
                      {{-- <th scope="col">Место рожения</th>
                      <th scope="col">Место регистрации</th> --}}
 
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{ $border->id }}</th>
                      <td class="col-md-3">{{ $border->full_name }}</td>
                      <td class="col-md-3">{{ $border->citizenship }}</td>
                      <td class="col-md-3">{{ $border->date_birth }}</td>
                      <td class="col-md-3">{{ $border->passport }}</td>
                      <td class="col-md-3">{{ $border->crossing_date }}</td>
                      <td class="col-md-3">{{ $border->brand_avto }}</td>
                      <td class="col-md-3">{{ $border->checkpoint }}</td>
                      <td class="col-md-3">{{ $border->route }}</td>
                      
                    </tr>
                    
                </tbody>
                
              </table>
              <a href="border/{{$border->id}}" class="btn btn-primary btn-sm ">Открыть</a>
              <a href="destroyborder/{{$border->id}}" class="btn btn-danger btn-sm ">Удалить</a>
                @endforeach
    </div>
      

          
@endsection
