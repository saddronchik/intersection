@extends('layouts.appShow')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Главная</a>
        <a class="btn btn-primary btn-sm mb-2 " href="borderslistUser" role="button">Доступные мне</a>
        <a class="btn btn-primary btn-sm mb-2 " href="addborder" role="button">Добавить запись пересечения</a>




      </div>
    </div>  
    
    
    <div class="col-10">
      
              <h1 class="display-8">Пересечение границы</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Импорт/экспорт
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Импорт/экспорт пересечений</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a class="btn btn-primary btn-sm mb-2 " href="/borders/exports" role="button">Экпорт пересечений в Excel</a>
        <p> Импорт Файла .xls .xlsx</p>
            
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
  
      <form action="/borders/import" method="POST" enctype="multipart/form-data"> 
        @csrf
       
        <input type="file" name="files" > 
        <input class="btn btn-primary btn-sm mb-2" type="checkbox" value="true" name="haveHead"  id="haveHead">
        <label class="form-check-label  mb-2" for="defaultCheck1" >
          Есть шапка
        </label>
        <button class="btn btn-primary btn-sm mb-2" type="submit">Импорт </button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
              

              <form method="GET" action="{{ route('searchBorders') }}">
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
                      @role('admin')
                      <td class="col-md-3"> <a href="border/{{$border->id}}">{{ $border->full_name}}</td>
                      @else
                      <td class="col-md-3">
                        <span  class="mail" style="color: blue" data-toId="{{ $border->id_user}}" data-Id="{{ $border->id }}" data-name="{{ $border->full_name }}">{{ $border->full_name }}</span>
                      </td>
                      @endrole
                      
                      <td class="col-md-3">{{ $border->citizenship }}</td>
                      <td class="col-md-3">{{ $border->date_birth }}</td>
                      <td class="col-md-3">{{ $border->passport }}</td>
                      <td class="col-md-3">{{ $border->crossing_date }}</td>
                      <td class="col-md-3">{{ $border->brand_avto }}</td>
                      <td class="col-md-3">{{ $border->checkpoint }}</td>
                      <td class="col-md-3">{{ $border->route }}</td>
                      @role('admin')
                      <td class="col-md-3"> <a href="destroyborder/{{$border->id}}" class="btn btn-danger btn-sm mb-2 ">Удалить</a></td>
                      @endrole
                    </tr>

                @endforeach
                                    
              </tbody>
            </table>
                {{ $borders->appends(['s'=>request()->s])->links() }}
    </div> 
    <input type="hidden" name="from" id="from" value="{{ $authUser}}">
    <input type="hidden" name="name" id="name" value="{{ $authUsername}}">
    <script>

      const links = document.querySelectorAll('.mail');
      
      
      links.forEach(function(item, i, links) {
        let authUserId = document.querySelector('#from').value;
        let authUsername = document.querySelector('#name').value;
        
      
        item.addEventListener("click", function(event) {
          event.preventDefault();
          let toUserId = this.getAttribute('data-toId');
          let borderId = this.getAttribute('data-Id');
          let borderName = this.getAttribute('data-name');
       
           const data = JSON.stringify({
            from: authUserId,
            to:toUserId,
            message: "Пользователь "+ authUsername + " пытался зайти на вашу  запись пересечений гражданина "+borderName+" под id " +borderId
          });
          
          
          const response = fetch('/message',{
          method: "POST",
          
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
           'content')
          },
            body:data
          })
          
          .then(function (response) {
            // console.log(data)
          return response.json()
        })
        .then(function (data) {
          console.log('data', data)
        })
        .catch(function (error) {
          console.log('error', error)
        })
        })
      })
        </script>
@endsection
