@extends('layouts.appShow')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" aria-orientation="vertical">
                <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Главная</a>
                <a class="btn btn-primary btn-sm mb-2 " href="peopleuser" role="button">Доступные мне</a>
                <a class="btn btn-primary btn-sm mb-2 " href="/addpeoples" role="button">Добавление людей</a>
            </div>
        </div>  
        <div class="col-10">
          <h1 class="display-8">Люди</h1>
            <form method="GET" action="{{ route('searchPeople') }}">
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
                @foreach ($peoples as $people)
                <tbody>
                  <tr>
                    <td class="col-md-2">{{ $people->id }}</td>
                    @role('admin')
                      <td class="col-md-5"><a href="/people/{{$people->id}}">{{ $people->full_name }}</td>
                      @else
                      <td class="col-md-5">
                        <span  class="mail" style="color: blue" data-toId="" data-Id="" data-ctisenname = "" >{{ $people->full_name }} </span>
                      </td>

                      @endrole
                    {{-- <td class="col-md-2">{{ $people->full_name }}</td> --}}
                    <td class="col-md-2">{{ $people->date_birth }}</td>
                    <td class="col-md-2">{{ $people->id_user }}</td>
                    <td class="col-md-2">{{ $people->user }}</td>

                    @role('admin')
                    <td class="col-md-2"><a href="destroyPeople/{{$people->id}}" class="btn btn-danger btn-sm mb-2">Удалить</a></td>
                    @endrole
                  </tr>
                </tbody>
                @endforeach
            </table>
            {{ $peoples->appends(['s'=>request()->s])->onEachSide(5)->links() }}
    </div>   
</div>

@endsection