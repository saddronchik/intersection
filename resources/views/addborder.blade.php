@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" aria-orientation="vertical">
        
        <a class="btn btn-primary btn-sm mb-2 " role="button" data-bs-toggle="button" href="home" role="button">Главная</a>

      </div>
    </div>
 
    
                <div class="col-8">
                    <form method="POST" enctype="multipart/form-data" action="/borders" id="formAdd">
                        @csrf
                        <h1> Пересечение границы </h1>
                        <div class="alert alert-success messages" role="alert" style="display: none"></div>
                        <div class="form-group">
                          <label for="id_citisen">ID Гражданина</label>
                          {{-- <input type="number" class="form-control" name="id_citisen" id="id_citisen" > --}}
                         
                        
                          <select name="id_citisen" id="id_citisen" class="selectpicker" data-live-search="true">
                            <option data-tokens="ketchup mustard">Выберите гражданина</option>
                            @foreach($borders as $border)
                            <option name="id_citisen" id="id_citisen" value="{{$border->id}}">{{$border->full_name}}</option>
                            
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
                          <input type="number" class="form-control" name="passport" id="passport" >
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
                          <select name="way_crossing" id="way_crossing" class="selectpicker" data-live-search="true">
                            <option data-tokens="ketchup mustard">Выберите автомобиль</option>
                          
                            @foreach($avtos as $avto)
                            <option name="way_crossing" id="way_crossing" value="{{$avto->id}}">{{$avto->brand_avto}}</option>
                            
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

                        <button type="submit" class="btn btn-primary">Добавить запись</button>
                      </form>
                </div>


@endsection
<script type="application/javascript">


  const formAdd = document.getElementById('formAdd');
  const messageBlock = document.querySelector('.messages');

  formAdd.addEventListener('submit' , function(e){
      e.preventDefault();

      const formData = new FormData(this);
      fetch('/borders', {
              method: "POST",
              // enctype="multipart/form-data",
              headers: {
                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                      'content')
              },
              body: formData
          })
          .then(function(response) {
              if (response.status == 200) {
                  messageBlock.textContent = 'Данные успешно добавленны!';
                  messageBlock.style.display = 'block';
              }
              if (response.status == 500) {
                  messageBlock.textContent = 'Ошибка данных!';
                  messageBlock.style.display = 'block';
              }
            })

              
              // console.log(response)
          //    return response.text();

          .then(function(text)  {
              console.log('Success ' + text);

          })
          .catch(function(error){
              console.error(error);

          })

  });

</script>