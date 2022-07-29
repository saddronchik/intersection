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
                <h1>{{ $citizen->full_name }}</h1>
                <form action="" method="post" class="form" id="formUpdate"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $citizen->id }}">
                    <input type="hidden" name="full_name" value="{{ $citizen->full_name }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>
                            <tr>
                                <td>Фото</td>
                                <td><img src="{{ asset(Illuminate\Support\Facades\Storage::url($citizen->photo)) }}" height="240px">
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
                                            <input id="passport_data" name="passport_data" class="form-control" value="{{ $citizen->passport_data }}">
                                            <input id="passport_data" name="passport_data1" class="form-control" value="{{ $citizen->passport_data1 }}">
                                            <input id="passport_data" name="passport_data2" class="form-control" value="{{ $citizen->passport_data2 }}">
                                        </div>
                                      </div>   
                                </td>     
                            </tr>
                            <tr>
                                <td>Дата рождения</td>
                                <td><input type="date" id="date_birth" name="date_birth" class="form-control" style="border: none;"
                                        value="{{ $citizen->date_birth }}"></td>
                            </tr>
                            <tr>
                                <td>Место регистрации</td>
                                <td><input id="place_registration" name="place_registration" class="form-control"
                                        style="border: none;" value="{{ $citizen->place_registration }}"></td>
                            </tr>
                            <tr>
                                <td>Место жительства</td>
                                <td><input id="place_residence" name="place_residence" class="form-control"
                                        style="border: none;" value="{{ $citizen->place_residence }}"></td>
                            </tr>
                            
                            <tr>
                                <td>Телефонный номер</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          +
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <input id="phone_number" name="phone_number" class="form-control"value="{{ $citizen->phone_number }}">
                                            <input id="phone_number1" name="phone_number1" class="form-control" value="{{ $citizen->phone_number1 }}">
                                            <input id="phone_number2" name="phone_number2" class="form-control"value="{{ $citizen->phone_number2 }}">
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
                                            <input id="social_account" name="social_account" class="form-control" value="{{ $citizen->social_account }}">
                                            <input id="social_account1" name="social_account1" class="form-control" value="{{ $citizen->social_account1 }}">
                                            <input id="social_account2" name="social_account2" class="form-control" value="{{ $citizen->social_account2}}">
                                            <input id="social_account3" name="social_account3" class="form-control"value="{{ $citizen->social_account3 }}">
                                            <input id="social_account4" name="social_account4" class="form-control" value="{{ $citizen->social_account4 }}">
                                        </div>
                                      </div> 

                                </td>
                            </tr>
                            <tr>
                                <td>Доп. информация</td>
                                <td><textarea id="addit_inf" name="addit_inf" class="form-control"
                                        style="border: none;">{{ $citizen->addit_inf }}</textarea> 
                                </td>
                            </tr>
                            <tr>
                                <td>Кто заметил</td>
                                <td><textarea id="who_noticed" name="who_noticed" class="form-control"
                                        style="border: none;">{{ $citizen->who_noticed }}</textarea> 
                                </td>
                            </tr>
                            <tr>
                                <td>Где заметил</td>
                                <td><textarea id="where_notice" name="where_notice" class="form-control"
                                        style="border: none;">{{ $citizen->where_notice }}</textarea> 
                                </td>
                            </tr>
                            <tr>
                                <td>Время обнаружения</td>
                                <td><input id="detection_time" name="detection_time" class="form-control" type="datetime-local" style="border: none;"
                                    value="{{ $citizen->detection_time }}">
                                </td>
                            </tr>
                           
                                <tr>
                                    <td>Сделал запись пользователь</td>
                                    <td>{{ $citizen->user }}</td>
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
                    <div class="alert alert-success messages" role="alert" style="display: none"></div>
                    <a href="/home" class="btn btn-primary">Назад</a>
                    <button id="update" name="update" type="submit" class="btn btn-success"> Обновить данные </button>

                        <a href="citisenBorder/{{$citizen->id}}" class="btn btn-primary" style="margin-left: 50%">Пересечение границ</a>
            </div>
           
            </form>

            <script>


                const formUpdate = document.getElementById('formUpdate');
                const messageBlock = document.querySelector('.messages');

                // formUpdate.addEventListener('submit' , function(e){
                //     e.preventDefault();

                //     const formData = new FormData(this);
                //     const checkbox = document.querySelectorAll('.thing');
                //     let validateCHeckbox = false;

            
                //     for (let i =0; i < checkbox.length; i++) {
                //         if (checkbox[i].checked) {
                //             validateCHeckbox = true;
                //             break;
                //         }
                //     }

                //     if (!validateCHeckbox) {
                //         alert('Выберите хотя бы один доступ к просмотру записи!');
                //         return;
                //     }
                //     fetch('/citisen/{id}', {
                //             method: "POST",
                //             headers: {
                //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                //                     'content')},
                //             body: formData
                //         })
                //         .then(function(response) {
                //             if (response.status == 200) {
                //                 messageBlock.textContent = 'Данные обновлены успешно!';
                //                 messageBlock.style.display = 'block';
                //             }
                //             if (response.status == 403) {
                //                   messageBlock.textContent = 'Ошибка доступа!';
                //                   messageBlock.style.display = 'block';
                //               }
                //             console.log(response)
                //            return response.text();
                //         })

                //         .then(function(text)  {
                //             console.log('Success ' + text);

                //         }).catch(function(error){
                //             console.error(error);

                //         })

                // });

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
                    $('#passport_data').append(` <input id="passport_data" name="passport_data${namePass++}" class="form-control" style="border: none;" value="{{$citizen->passport_data1}}">`);
                    $('#passport_data').append(` <input id="passport_data" name="passport_data${namePass++}" class="form-control" style="border: none;" value="{{$citizen->passport_data2}}">`);
                    } else {
                    return;
                    }
                });

    </script>

@endsection
