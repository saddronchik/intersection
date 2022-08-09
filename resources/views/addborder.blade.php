@extends('layouts.appShow')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " href="borderslist" role="button">Назад</a>

      </div>
    </div>
                <div class="col-8">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                    <form method="POST" enctype="multipart/form-data" action="/borders" id="formAdd">
                        @csrf
                        <h1> Пересечение границы </h1>
                        
                        <div class="form-group">
                          <label for="id_citisen">ID Гражданина</label>
                          {{-- <input type="number" class="form-control" name="id_citisen" id="id_citisen" > --}}
                         
                        
                          <select name="id_citisen" id="id_citisen" class="selectpicker" data-style="btn-info" data-live-search="true">
                            <option data-tokens="ketchup mustard">Выберите гражданина</option>
                            @foreach($borders as $border)
                            <option name="id_citisen" id="id_citisen" value="{{$border->id}}"data-subtext="{{$border->id}}">{{$border->full_name}}</option>
                            
                              @endforeach
                          </select>
                          
                        </div>
                        <div class="form-group">
                          <label for="citizenship">Гражданство</label>
                          <input type="text" class="form-control" name="citizenship" id="citizenship" >
                        </div>
                        <div class="form-group">
                          <label for="full_name">Полное имя</label>
                          <input type="text" class="form-control" name="full_name" id="full_name" >
                        </div>
                        <div class="form-group">
                          <label for="date_birth">Дата рождения</label>
                          <input type="date" class="form-control" name="date_birth" id="date_birth" >
                        </div>
                        <div class="form-group">
                          <label for="passport">Паспорт</label>
                          <input type="text" class="form-control" name="passport" id="passport" >
                        </div>
                        <div class="form-group">
                          <label for="crossing_date">Дата пересечения</label>
                          <input type="date" class="form-control" name="crossing_date" id="crossing_date" >
                        </div>
                        <div class="form-group">
                          <label for="crossing_time">Время пересечения</label>
                          <input type="time" class="form-control" name="crossing_time" id="crossing_time" >
                        </div>
                        <div class="form-group">
                          <label for="way_crossing">ID машины</label>
                          {{-- <input type="number" class="form-control" name="way_crossing" id="way_crossing" > --}}
                          <select name="way_crossing" id="way_crossing" class="selectpicker" data-style="btn-info" data-live-search="true">
                            <option data-tokens="ketchup mustard">Выберите автомобиль</option>
                          
                            @foreach($avtos as $avto)
                            <option name="way_crossing" id="way_crossing" value="{{$avto->id}}" data-subtext="{{$avto->id}}">{{$avto->brand_avto}}</option>
                            
                              @endforeach
                          </select>
                          
                        </div>
                        <div class="form-group">
                          <label for="checkpoint">КПП</label>
                          <input type="text" class="form-control" name="checkpoint" id="checkpoint" >
                        </div>
                        <div class="form-group">
                          <label for="route">Направление</label>
                          <input type="text" class="form-control" name="route" id="route" >
                        </div>
                        <div class="form-group">
                          <label for="place_birth">Место рожения</label>
                          <input type="text" class="form-control" name="place_birth" id="place_birth" >
                        </div>
                        <div class="form-group">
                          <label for="place_regis">Место регистрации</label>
                          <input type="text" class="form-control" name="place_regis" id="place_regis" >
                        </div>
                        <div class="form-group">
                          <label for="">Доступ к просмотру записи</label>
                
                          <div class="form-group" style="width:200px; height:100px; overflow:auto; border:solid 1px #C3E4FE;">
                            <fieldset id="shest">
                              <label><input type="checkbox" id="checkall"> Выбрать всех</label>
                            @foreach ( $users as $user)
                            <li class="list-group-item"><input type="checkbox" class="thing" name="user[]" id="user" value="{{ $user->id}}" >{{' '.$user->username }}</li>
                            @endforeach
                          </fieldset>
                        </div>
                        <div class="alert alert-success messages" role="alert" style="display: none"></div>
                        <button type="submit" class="btn btn-primary">Добавить запись</button>
                      </form>
                </div>

<script>
  
  let addCitizen = document.querySelector('#citisAdd');

var checkboxes = document.querySelectorAll('input.thing'),
   checkall = document.getElementById('checkall');
for(var i=0; i<checkboxes.length; i++) {
   checkboxes[i].onclick = function() {
       var checkedCount = document.querySelectorAll('input.thing:checked').length;
       checkall.checked = checkedCount > 0;
       checkall.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
   }
}
checkall.onclick = function() {
   for(var i=0; i<checkboxes.length; i++) {
       checkboxes[i].checked = this.checked;
   }
}

  const formAdd = document.getElementById('formAdd');
  const messageBlock = document.querySelector('.messages');


</script>
@endsection