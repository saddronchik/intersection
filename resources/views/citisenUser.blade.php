@extends('layouts.appShow')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Назад</a>

      </div>
    </div>  
    
    
    <div class="col-10">
      <h1 class="display-8">Граждане</h1>


              <form method="GET" action="{{ route('searchUsers') }}">
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
                    <th scope="col">Кто заметил</th>
                    <th scope="col">Где заметил</th>
                    <th scope="col">Время обнаружения</th>
                    <th scope="col">Сделал запись пользователь</th>
                  </tr>
                </thead>
                @foreach ($citisens as $citisen)
                
                  <tbody>
                    <tr>
                      <th scope="row">{{ $citisen->id }}</th>
                      <td class="col-md-5"><a href="citisen/{{$citisen->id}}">{{ $citisen->full_name }}</td>
                      <td class="col-md-2">{{ $citisen->date_birth }}</td>
                      <td class="col-md-2">{{ $citisen->who_noticed }}</td>
                      <td class="col-md-2">{{ $citisen->where_notice }}</td>
                      <td class="col-md-2">{{ $citisen->detection_time }}</td>
                      <td class="col-md-2">{{ $citisen->user }}</td>
                      <td class="col-md-2"><a href="destroyCitisen/{{$citisen->id}}" class="btn btn-danger btn-sm mb-2">Удалить</a></td>
                    </tr>
                    

                @endforeach
              </tbody>
            </table>

{{-- 
                {{ $citisens->appends(['s'=>request()->s])->onEachSide(5)->links() }} --}}
    </div>
      

          
@endsection
