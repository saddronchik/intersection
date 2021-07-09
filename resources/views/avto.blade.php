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
      
              <h1 class="display-8">Автомобили</h1>
              
                @foreach ($avtos as $avto)
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Владелец</th>
                      <th scope="col">Марка автомобиля</th>
                      <th scope="col">Регистрационный номер</th>
                      <th scope="col">Цвет</th>
                      <th scope="col">Доп. информация</th>
 
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{ $avto->id }}</th>
                      <td class="col-md-5">{{ $avto->full_name }}</td>
                      <td class="col-md-3">{{ $avto->brand_avto }}</td>
                      <td class="col-md-2">{{ $avto->regis_num}}</td>
                      <td class="col-md-2">{{ $avto->color }}</td>
                      <td class="col-md-2">{{ Str::words($avto->addit_inf, 5) }}</td>
                    </tr>
                    
                </tbody>
                
              </table>
              <a href="avto/{{$avto->id}}" class="btn btn-primary btn-sm ">Открыть</a>
              <a href="destroy/{{$avto->id}}" class="btn btn-danger btn-sm ">Удалить</a>
                @endforeach
    </div>
      

          
@endsection
