@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " role="button" data-bs-toggle="button" href="borderslist" role="button">Назад</a>

      </div>
    </div>  
    
    <div class="col-10">
      
              <h1 class="display-8">Пересечение границы</h1>

              <form method="GET" action="{{ route('searchBordersUser') }}">
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
                    <th scope="col">Гражданин</th>
                    <th scope="col">Гражданство</th>
                    <th scope="col">Дата рождения</th>
                    <th scope="col">Паспорт</th>
                    <th scope="col">Дата пересечения</th>
                    <th scope="col">Способ передвижения</th>
                    <th scope="col">КПП</th>
                    <th scope="col">Направление</th>
                  </tr>
                </thead>
                @foreach ($borders as $border)
              
                  <tbody>
                    <tr>
                      <th scope="row">{{ $border->id }}</th>
                      <td class="col-md-3"><a href="border/{{$border->id}}">{{ $border->full_name }}</td>
                      <td class="col-md-3">{{ $border->citizenship }}</td>
                      <td class="col-md-3">{{ $border->date_birth }}</td>
                      <td class="col-md-3">{{ $border->passport }}</td>
                      <td class="col-md-3">{{ $border->crossing_date }}</td>
                      <td class="col-md-3">{{ $border->brand_avto }}</td>
                      <td class="col-md-3">{{ $border->checkpoint }}</td>
                      <td class="col-md-3">{{ $border->route }}</td>
                      <td class="col-md-3"><a href="destroyborder/{{$border->id}}" class="btn btn-danger btn-sm mb-2 ">Удалить</a></td>
                      
                    </tr>

              {{-- <a href="border/{{$border->id}}" class="btn btn-primary btn-sm mb-2 ">Открыть</a> --}}
              
                @endforeach
                                    
              </tbody>
                
            </table>
                {{-- {{ $borders->appends(['s'=>request()->s])->links() }} --}}
    </div>
      

          
@endsection
