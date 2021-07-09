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
                    <form method="POST" enctype="multipart/form-data" action="/avtos" id="formAdd">
                        @csrf
                        <h1> Добавление автомобилей </h1>
                        <div class="alert alert-success messages" role="alert" style="display: none"></div>
                        <div class="form-group">
                          <label for="id_citisen">ID Владельца</label>
                          {{-- <input type="number" class="form-control" name="id_citisen" id="id_citisen" > --}}
                          <select name="id_citisen" id="id_citisen" class="selectpicker" data-live-search="true">
                            <option data-tokens="ketchup mustard">Выберите гражданина</option>
                            @foreach($citisens as $citisen)
                            <option name="id_citisen" id="id_citisen" value="{{$citisen->id}}">{{$citisen->full_name}}</option>
                            
                              @endforeach
                          </select>


                        </div>
                        <div class="form-group">
                          <label for="brand_avto">Марка машины</label>
                          <input type="text" class="form-control" name="brand_avto" id="brand_avto" >
                        </div>
                        <div class="form-group">
                          <label for="regis_num">Регистрационный номер</label>
                          <input type="number" class="form-control" name="regis_num" id="regis_num" >
                        </div>
                        <div class="form-group">
                          <label for="color">Цвет</label>
                          <input type="text" class="form-control" name="color" id="color" >
                        </div>
                        <div class="form-group">
                          <label for="photo">Фото</label>
                          <input type="file" class="form-control" name="photo" id="photo" aria-describedby="emailHelp" >
                          {{-- accept=".jpg" --}}
                        </div>

                        <div class="form-group">
                          <label for="addit_inf">Доп информация</label>         
                          <textarea class="form-control" name="addit_inf" id="addit_inf" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить запись</button>
                      </form>
                </div>
                <script type="application/javascript">


                  const formAdd = document.getElementById('formAdd');
                  const messageBlock = document.querySelector('.messages');
  
                  formAdd.addEventListener('submit' , function(e){
                      e.preventDefault();
  
                      const formData = new FormData(this);
                      fetch('/avtos', {
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
@endsection
