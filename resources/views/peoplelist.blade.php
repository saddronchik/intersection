@extends('layouts.appShow')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" aria-orientation="vertical">
                <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Главная</a>
                <a class="btn btn-primary btn-sm mb-2 " href="" role="button">Доступные мне</a>
                <a class="btn btn-primary btn-sm mb-2 " href="" role="button">Добавление людей</a>
            </div>
        </div>  
        <div class="col-10">
          <h1 class="display-8">Люди</h1>
            <form method="GET" action="{{ route('search') }}">
                <div class="form-row">
                  <div class="form-group col-md-10">
                    <input type="text" class="form-control" id="s" name="s" placeholder="Поиск..."  value="{{request()->s}}">
                  </div>
                  <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Поиск</button>
                  </div>
                </div>
            </form>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col-md-2">#</th>
                    <th scope="col-md-5">ФИО</a></th>
                    <th scope="col-md-2">Дата рождения</th>
                    <th scope="col-md-2">id</th>
                    <th scope="col-md-2">Сделал запись пользователь</th>
                  </tr>
                </thead>

    </div>   
</div>

@endsection