@extends('layouts.appShow')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Главная</a>
        <a class="btn btn-primary btn-sm mb-2 " href="avtoslistusers" role="button">Доступные мне</a>
        <a class="btn btn-primary btn-sm mb-2 " href="addavtos" role="button">Добавление автомобилей</a>
      </div>
    </div>  
    
    
    <div class="col-10">
  
              <h1 class="display-8">Автомобили</h1>
              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Импорт/экспорт
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Импорт/экспорт автомобилей</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a class="btn btn-primary btn-sm mb-2 " href="/avtos/exports" role="button">Экпорт автомобилей в Excel</a>
        <p> Импорт файла .xls .xlsx</p>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
      
          <form action="/avtos/import" method="POST" enctype="multipart/form-data"> 
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
             

          <form method="GET" action="{{ route('searchAvto') }}">
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
                <th scope="col">Марка автомобиля</th>
                <th scope="col">Номер</th>
                <th scope="col">Владелец</th>                      
                <th scope="col">Кто заметил</th>
                <th scope="col">Где заметил</th>
                <th scope="col">Время обнаружения</th>
                <th scope="col">Сделал запись пользователь</th>
                <th scope="col">Доп. информация</th>

              </tr>
            </thead>
                @foreach ($avtos as $avto)
                
               
                  <tbody>
                    <tr>
                      <th scope="row">{{ $avto->id }}</th>
                      @role('admin')
                      <td class="col-md-3">  <a href="avto/{{$avto->id}}"> {{ $avto->brand_avto }}</td>
                      @else
                      <td class="mail" style="color: blue" data-toId="{{ $avto->id_user}}" data-Id="{{ $avto->id }}" data-name="{{ $avto->brand_avto }}" class="col-md-3">{{ $avto->brand_avto }}</td>
                      @endrole
                      <td class="col-md-3">{{ $avto->regis_num }}</td>
                      <td class="col-md-5">{{ $avto->id_citisen }}</td>
                      <td class="col-md-3">{{ $avto->who_noticed }}</td>
                      <td class="col-md-3">{{ $avto->where_notice }}</td>
                      <td class="col-md-3">{{ $avto->detection_time }}</td>
                      <td class="col-md-3">{{ $avto->user }}</td>

                      <td class="col-md-2">{{ Str::words($avto->addit_inf, 5) }}</td>
                      @role('admin')
                      <td class="col-md-2"><a href="destroy/{{$avto->id}}" class="btn btn-danger btn-sm mb-2 ">Удалить</a></td>
                      @endrole
                    </tr>
              
                @endforeach                                   
              </tbody>                
            </table>
                {{ $avtos->appends(['s'=>request()->s])->links() }}
    </div>
    <input type="hidden" name="from" id="from" value="{{ $authUser}}">
    <input type="hidden" name="username" id="username" value="{{ $authUsername}}">
    <script>

      const links = document.querySelectorAll('.mail');
      
      
      links.forEach(function(item, i, links) {
        let authUserId = document.querySelector('#from').value;
        let authUsername = document.querySelector('#username').value;
        
      
        item.addEventListener("click", function(event) {
          event.preventDefault();
          let toUserId = this.getAttribute('data-toId');
          let avtoId = this.getAttribute('data-Id');
          let avtoName = this.getAttribute('data-name');
       
           const data = JSON.stringify({
            from: authUserId,
            to:toUserId,
            message: "Пользователь "+authUsername + " пытался зайти на вашу запись автомобиля " +avtoName+ " под id " +avtoId
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
