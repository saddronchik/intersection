@extends('layouts.appShow')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="peoplelist" role="button">Назад</a>

      </div>
    </div>  
    
    
    <div class="col-10">
      <h1 class="display-8">Люди</h1>


              <form method="GET" action="{{ route('searchPeopleUser') }}">
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
                    <th scope="col">#</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Дата рождения</th>
                    <th scope="col">id</th>
                    <th scope="col">Сделал запись пользователь</th>
                  </tr>
                </thead>
                @foreach ($peoples as $people)
                
                  <tbody>
                    <tr>
                      <th scope="row">{{ $people->id }}</th>
                      <td class="col-md-5"><a href="people/{{$people->id}}">{{ $people->full_name }}</td>
                      <td class="col-md-2">{{ $people->date_birth }}</td>
                      <td class="col-md-2">{{ $people->id_user }}</td>
                      <td class="col-md-2">{{ $people->user }}</td>
                      <td class="col-md-2"><a href="destroyPeople/{{$people->id}}" class="btn btn-danger btn-sm mb-2">Удалить</a></td>
                    </tr>          

                @endforeach
              </tbody>
            </table>

{{-- {{ $citisens->appends(['s'=>request()->s])->onEachSide(5)->links() }} --}}
    </div>
      
@endsection
