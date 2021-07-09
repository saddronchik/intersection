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
                    <form method="POST" enctype="multipart/form-data" action="/citisens">
                        @csrf
                        <div class="form-group">
                          <label for="full_name">ФИО</label>
                          <input type="text" class="form-control" name="full_name" id="full_name" >
                        </div>
                        <div class="form-group">
                          <label for="passport_data">Пасспортные данные</label>
                          <input type="text" class="form-control" name="passport_data" id="passport_data" >
                        </div>
                        <div class="form-group">
                          <label for="date_birth">Дата рождения</label>
                          <input type="date" class="form-control" name="date_birth" id="date_birth" >
                        </div>
                        <div class="form-group">
                          <label for="photo">Фото</label>
                          <input type="file" class="form-control" name="photo" id="photo" aria-describedby="emailHelp" >
                          {{-- accept=".jpg" --}}
                        </div>
                        <div class="form-group">
                          <label for="place_residence">Место жительства</label>
                          <input type="text" class="form-control" name="place_residence" id="place_residence" >
                        </div>
                        <div class="form-group">
                          <label for="phone_number">Телефонный номер</label>
                          <input type="number" class="form-control" name="phone_number" id="phone_number" >
                        </div>
                        <div class="form-group">
                          <label for="social_account">Соц аккаунт</label>
                          <input type="text" class="form-control" name="social_account" id="social_account">
                        </div>
                        <div class="form-group">
                          <label for="addit_inf">Доп информация</label>         
                          <textarea class="form-control" name="addit_inf" id="addit_inf" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить запись</button>
                      </form>
                </div>
@endsection
