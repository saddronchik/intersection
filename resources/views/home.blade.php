@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " role="button" data-bs-toggle="button" href="home" role="button">Главная</a>
        <a class="btn btn-primary btn-sm mb-2 " href="addcitisens" role="button">Добавление граждан</a>
        <a class="btn btn-primary btn-sm mb-2 " href="/citisens/exports" role="button">Экпорт граждан в Excel</a>
        {{-- <a class="btn btn-primary btn-sm mb-2 " href="" role="button">Ипорт граждан из Excel</a> --}}
       
        <a class="btn btn-primary btn-sm mb-2 " href="avtoslist" role="button">Автомобили</a>
        <a class="btn btn-primary btn-sm mb-2 " href="addavtos" role="button">Добавление автомобилей</a>

        <a class="btn btn-primary btn-sm mb-2 " href="borderslist" role="button">Пересечение границы</a>
        <a class="btn btn-primary btn-sm mb-2 " href="addborder" role="button">Добавить запись пересечения</a>

        <a class="btn btn-success btn-sm mb-2 " href="addusers" role="button">Добавить пользователя</a>
        <a class="btn btn-success btn-sm mb-2 " href="usersList" role="button">Работа с пользователями</a>




      </div>
    </div>  
    
    
    <div class="col-10">
      
              <h1 class="display-8">Граждане</h1>
              <p> Импорт Файла .xls .xlsx</p>
            
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
          
              <form action="/citisens/import" method="POST" enctype="multipart/form-data"> 
                @csrf
               
                <input type="file" name="files" > 
                <input class="btn btn-primary btn-sm mb-2" type="checkbox" value="true" name="haveHead"  id="haveHead">
                <label class="form-check-label  mb-2" for="defaultCheck1" >
                  Есть шапка
                </label>
                <button class="btn btn-primary btn-sm mb-2" type="submit">Импорт </button>
              </form>
              {{-- <form action="/citisens/importNoHead" method="POST" enctype="multipart/form-data"> 
                @csrf
               
                <input type="file" name="files" > 

                <button class="btn btn-primary btn-sm mb-2" type="submit">Импорт без шапки </button>
              </form> --}}
              
                @foreach ($citisens as $citisen)
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">ФИО</th>
                      <th scope="col">Паспортные данные</th>
                      <th scope="col">Дата рождения</th>
                      {{-- <th scope="col">Место проживания</th>
                      <th scope="col">Телефон</th>
                      <th scope="col">Соц. аккаунты</th>
                      <th scope="col">Доп. информация</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{ $citisen['id'] }}</th>
                      <td class="col-md-5">{{ $citisen['full_name'] }}</td>
                      <td class="col-md-3">{{ $citisen['passport_data'] }}</td>
                      <td class="col-md-2">{{ $citisen['date_birth'] }}</td>
                      {{-- <td class="col-md-2">{{ $citisen['place_residence'] }}</td>
                      <td class="col-md-2">{{ $citisen['phone_number'] }}</td>
                      <td class="col-md-2">{{ $citisen['social_account'] }}</td>
                      <td class="col-md-2">{{ Str::words($citisen['addit_inf'], 5) }}</td> --}}
                    </tr>
                    
                </tbody>
                
              </table>
              <a href="citisen/{{$citisen['id']}}" class="btn btn-primary btn-sm ">Открыть</a>
              <a href="destroyCitisen/{{$citisen['id']}}" class="btn btn-danger btn-sm ">Удалить</a>
                @endforeach
    </div>
      

          
@endsection
