@extends('layouts.appShow')

@section('content')
<div class="container">
<div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="home" role="button">Главная</a>
        
        <a class="btn btn-primary btn-sm mb-2 " href="citisenuser" role="button">Доступные мне</a>
      
        <a class="btn btn-primary btn-sm mb-2 " href="addcitisens" role="button">Добавление граждан</a>
        
        <a class="btn btn-primary btn-sm mb-2 " href="peoplelist" role="button">Люди</a>

        <a class="btn btn-primary btn-sm mb-2 " href="avtoslist" role="button">Автомобили</a>

        <a class="btn btn-primary btn-sm mb-2 " href="borderslist" role="button">Пересечение границы</a>

        <a class="btn btn-success btn-sm mb-2 " href="logs" role="button">Логи</a>
        
        <a class="btn btn-success btn-sm mb-2 " href="addusers" role="button">Добавить пользователя</a>
        <a class="btn btn-success btn-sm mb-2 " href="usersList" role="button">Работа с пользователями</a>

      </div>
    </div>  
    
    
    <div class="col-10">
        <h1 class="display-8">Граждане</h1>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Импорт/экспорт
          </button>

              <a href="/viewMessages" class="btn btn-primary  mb-2" style="margin-left: 80%" >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
              </svg></a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Импорт/экспорт граждан</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <a class="btn btn-primary btn-sm mb-2 " href="/citisens/exports" role="button">Экпорт граждан в Excel</a>
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
                    <label class="form-check-label  mb-2" for="defaultCheck1">Есть шапка</label>
                    <button class="btn btn-primary btn-sm mb-2" type="submit">Импорт </button>
                  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- EndModal -->

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
                    <th scope="col-md-2">Кто заметил</th>
                    <th scope="col-md-2">Где заметил</th>
                    <th scope="col-md-2">Время обнаружения</th>
                    <th scope="col-md-2">id</th>
                    <th scope="col-md-2">Сделал запись пользователь</th>
                  </tr>
                </thead>
              
                @foreach ($citisens as $citisen)
                  <tbody>
                    <tr>

                      <th scope="row" id="idcitisen" name="idcitisen"  value="{{ $citisen->id }}">{{ $citisen->id }}</th>
                      @role('admin')
                      <td class="col-md-2"><a href="citisen/{{$citisen->id}}">{{ $citisen->full_name }}</td>
                      @else
                      <td class="col-md-2">
                        <span  class="mail" style="color: blue" data-toId="{{ $citisen->id_user}}" data-Id="{{ $citisen->id }}" data-ctisenname = "{{ $citisen->full_name }}" >{{ $citisen->full_name }} </span>
                      </td>

                      @endrole
                      {{-- <td class="col-md-3">{{ $citisen->passport_data }}</td> --}}
                      <td class="col-md-2">{{ $citisen->date_birth }}</td>
                      <td class="col-md-2">{{ $citisen->who_noticed }}</td>
                      <td class="col-md-2">{{ $citisen->where_notice }}</td>
                      <td class="col-md-2">{{ $citisen->detection_time }}</td>
                      <td class="col-md-2">{{ $citisen->id_user }}</td>
                      
                      <td class="col-md-2">{{ $citisen->user }}</td>
                      @role('admin')
                      <td class="col-md-2"><a href="destroyCitisen/{{$citisen->id}}" class="btn btn-danger btn-sm mb-2">Удалить</a></td>
                      @endrole
                      
                    </tr>
                @endforeach
              </tbody>
            </table>
  
  {{ $citisens->appends(['s'=>request()->s])->onEachSide(5)->links() }}

    </div>
    <input type="hidden" name="from" id="from" value="{{ $authUser}}">
    <input type="hidden" name="fromname" id="fromname" value="{{ $authUsername}}">

    <script>
    const links = document.querySelectorAll('.mail');

    links.forEach(function(item, i, links) {
      let authUserId = document.querySelector('#from').value;
      let authUsername = document.querySelector('#fromname').value;

      item.addEventListener("click", function(event) {
        event.preventDefault();
        let toUserId = this.getAttribute('data-toId');
        let citisenId = this.getAttribute('data-Id');
        let citisenname = this.getAttribute('data-ctisenname');
    
        const data = JSON.stringify({
          from: authUserId,
          to:toUserId,
          message: "Пользователь "+authUsername + " пытался зайти на вашу запись гражданина "+citisenname+ " находящаяся под id " +citisenId
        });

        console.log(data);
        
        const response = fetch('/message', {
        method: "POST",
        
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
          body:data
        })
        
        .then(function (response) {
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
