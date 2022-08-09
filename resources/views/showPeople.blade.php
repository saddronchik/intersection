@extends('layouts.appShow')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1>{{ $peoples->full_name }}</h1>
                <form action="" method="post" class="form" id="formUpdate"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $peoples->id }}">
                    <input type="hidden" name="full_name" value="{{ $peoples->full_name }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>
                            <tr>
                                <td>Фото</td>
                                <td><img src="{{ asset(Illuminate\Support\Facades\Storage::url($peoples->photo)) }}" height="240px">
                                    <input type="file" class="form-control mt-2" name="photo" id="photo" aria-describedby="emailHelp" style="border: none" >
                                </td>
                            </tr>
                            <tr>
                                <td>Данные пасспорта</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          +
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <input id="passport_data" name="passport_data" class="form-control" value="{{ $peoples->passport_data }}">
                                            <input id="passport_data" name="passport_data1" class="form-control" value="{{ $peoples->passport_data1 }}">
                                            <input id="passport_data" name="passport_data2" class="form-control" value="{{ $peoples->passport_data2 }}">
                                        </div>
                                      </div>   
                                </td>     
                            </tr>
                            <tr>
                                <td>Дата рождения</td>
                                <td><input type="date" id="date_birth" name="date_birth" class="form-control" style="border: none;"
                                        value="{{ $peoples->date_birth }}"></td>
                            </tr>
                            <tr>
                                <td>Место регистрации</td>
                                <td><input id="place_registration" name="place_registration" class="form-control"
                                        style="border: none;" value="{{ $peoples->place_registration }}"></td>
                            </tr>
                            <tr>
                                <td>Место жительства</td>
                                <td><input id="place_residence" name="place_residence" class="form-control"
                                        style="border: none;" value="{{ $peoples->place_residence }}"></td>
                            </tr>
                            
                            <tr>
                                <td>Телефонный номер</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          +
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <input id="phone_number" name="phone_number" class="form-control"value="{{ $peoples->phone_number }}">
                                            <input id="phone_number1" name="phone_number1" class="form-control" value="{{ $peoples->phone_number1 }}">
                                            <input id="phone_number2" name="phone_number2" class="form-control"value="{{ $peoples->phone_number2 }}">
                                        </div>
                                      </div>            
                                </td>
                            </tr>
                            <tr>
                                <td>Социальный аккаутн</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          +
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <input id="social_account" name="social_account" class="form-control" value="{{ $peoples->social_account }}">
                                            <input id="social_account1" name="social_account1" class="form-control" value="{{ $peoples->social_account1 }}">
                                            <input id="social_account2" name="social_account2" class="form-control" value="{{ $peoples->social_account2}}">
                                            <input id="social_account3" name="social_account3" class="form-control"value="{{ $peoples->social_account3 }}">
                                            <input id="social_account4" name="social_account4" class="form-control" value="{{ $peoples->social_account4 }}">
                                        </div>
                                      </div> 

                                </td>
                            </tr>
                            <tr>
                                <td>Доп. информация</td>
                                <td><textarea id="addit_inf" name="addit_inf" class="form-control"
                                        style="border: none;">{{ $peoples->addit_inf }}</textarea> 
                                </td>
                            </tr>
                            <tr>
                           
                                <tr>
                                    <td>Сделал запись пользователь</td>
                                    <td>{{ $peoples->user }}</td>
                                </tr>
                            <tr>
                             
                                <td>Доступ к просмотру записи</td>
                                <td>  <div class="form-group" style="width:200px; height:100px; overflow:auto; border:solid 1px #C3E4FE;">
                                      <fieldset id="shest">
                                        <label><input type="checkbox" id="checkall"> Выбрать всех</label>
                                      @foreach ( $users as $user)
                                      <li class="list-group-item"><input type="checkbox" class="thing" name="user[]" id="user" value="{{ $user->id}}">{{' '.$user->username }}</li>
                                      @endforeach
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>

                    </table>


                    <a href="/peoplelist" class="btn btn-primary">Назад</a>
                    <button id="update" name="update" type="submit" class="btn btn-success"> Обновить данные </button>

                        {{-- <a href="citisenBorder/{{$citizen->id}}" class="btn btn-primary" style="margin-left: 50%">Пересечение границ</a> --}}
            </div>
           
            </form>

            <script>

            const formUpdate = document.getElementById('formUpdate');


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

            let namePass= 1;
                $('#addInputsPass').click(function() {
                   
                    if (namePass < 3) {
                    $('#passport_data').append(` <input id="passport_data" name="passport_data${namePass++}" class="form-control" style="border: none;" value="{{$peoples->passport_data1}}">`);
                    $('#passport_data').append(` <input id="passport_data" name="passport_data${namePass++}" class="form-control" style="border: none;" value="{{$peoples->passport_data2}}">`);
                    } else {
                    return;
                    }
                });

    </script>

@endsection
