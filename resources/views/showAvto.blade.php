@extends('layouts.appShow')
@section('content')

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div class="row">
            <div class="col-md-10"> 
                <form action="/avto/{id}" method="post" enctype="multipart/form-data" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $avto->id }}">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>
                            <tr>
                                <td>Фото</td>
                                <td><img src="{{ asset(Illuminate\Support\Facades\Storage::url($avto->photo)) }}" height="240px">
                                    <input type="file" class="form-control mt-2" name="photo" id="photo" aria-describedby="emailHelp" style="border: none" ></td>
                                
                            </tr>
                            <tr>
                                <td>ID владельца</td>
                                <td><input id="id_citisen" name="id_citisen" class="form-control"
                                        style="border: none;" value="{{ $avto->id_citisen}}"></td>
                            </tr>
                            <tr>
                                <td>Марка автомобиля</td>
                                <td><input id="brand_avto" name="brand_avto" class="form-control" style="border: none;"
                                        value="{{ $avto->brand_avto }}"></td>
                            </tr>

                            <tr>
                                <td>Регистрационный номер</td>
                                <td><input id="regis_num" name="regis_num" class="form-control" style="border: none;"
                                        value="{{ $avto->regis_num }}"></td>

                            </tr>
                            <tr>
                                <td>Цвет</td>
                                <td><input id="color" name="color" class="form-control"
                                        style="border: none;" value="{{ $avto->color }}"></td>
                            </tr>
                            <tr>
                                <td>Доп. информация</td>
                                <td><textarea id="addit_inf" name="addit_inf" class="form-control"
                                        style="border: none;">{{ $avto->addit_inf }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Кто заметил</td>
                                <td><input id="who_noticed" name="who_noticed" class="form-control"
                                        style="border: none;" value="{{ $avto->who_noticed }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Где заметил</td>
                                <td><input id="where_notice" name="where_notice" class="form-control"
                                        style="border: none;" value= "{{ $avto->where_notice }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Время обнаружения</td>
                                <td><input type="datetime-local" id="detection_time" name="detection_time" class="form-control"
                                        style="border: none;" value="{{ $avto->detection_time }}">
                                </td>
                            </tr>
                           
                                <tr>
                                    <td>Сделал запись пользователь</td>
                                    <td>{{ $avto->user }}</td>
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
                        <div class="alert alert-success messages" role="alert" style="display: none"></div>


                    </table>
                    <a href="/avtoslist" class="btn btn-primary">Назад</a>
                    
                    <button id="update" name="update" type="submit" class="btn btn-success"> Обновить данные </button>
                    <a href="avtoBorder/{{$avto->id}}" class="btn btn-primary" style="margin-left: 50%">Пересечение границ</a>
                    
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
                //     fetch('/avto/{id}', {
                //             method: "POST",
                //             headers: {
                //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                //                     'content')
                //             },
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
                //             if (response.status == 500) {
                //                   messageBlock.textContent = 'Ошибка данных!';
                //                   messageBlock.style.display = 'block';
                //               }
                //         })
                //         .then(function(text)  {
                //             console.log('Success ' + text);

                //         }).catch(function(error){
                //             console.error(error);
                //         })
                // });

                // let addCitizen = document.querySelector('#citisAdd');

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
</script> 

@endsection
