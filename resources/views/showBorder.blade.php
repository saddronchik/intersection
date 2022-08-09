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
                <div class="alert alert-success messages" role="alert" style="display: none"></div>  
                <form action="/border/{id}" method="post" class="form" id="formUpdate" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $border->id }}">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th> Поле</th>
                                <th> Значение </th>
                            </tr>

                            <tr>
                                <td>Гражданин</td>
                                <td><input id="id_citisen" name="id_citisen" class="form-control"
                                        style="border: none;" value="{{ $border->id_citisen}}"></td>
                            </tr>
                            <tr>
                                <td>Гражданство</td>
                                <td><input id="citizenship" name="citizenship" class="form-control" style="border: none;"
                                        value="{{ $border->citizenship }}"></td>
                            </tr>

                            <tr>
                                <td>ФИО</td>
                                <td><input id="full_name" name="full_name" class="form-control" style="border: none;"
                                        value="{{ $border->full_name }}"></td>

                            </tr>
                            <tr>
                                <td>Дата рождения</td>
                                <td><input type="date" id="date_birth" name="date_birth" class="form-control"
                                        style="border: none;" value="{{ $border->date_birth }}"> </td>
                            </tr>
                            <tr>
                                <td>Паспорт</td>
                                <td><textarea id="passport" name="passport" class="form-control"
                                        style="border: none;">{{ $border->passport }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Дата пересечения</td>
                                <td><input type="date"  id="crossing_date" name="crossing_date" class="form-control"
                                        style="border: none;" value="{{ $border->crossing_date }}"> </td>
                            </tr>
                            <tr>
                                <td>Время пересечения</td>
                                <td><input type="time" id="crossing_time" name="crossing_time" class="form-control"
                                        style="border: none;" value="{{ $border->crossing_time }}"> </td>
                            </tr>
                            <tr>
                                <td>Средство передвижения</td>
                                <td><textarea id="way_crossing" name="way_crossing" class="form-control"
                                        style="border: none;">{{ $border->way_crossing }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>КПП</td>
                                <td><textarea id="checkpoint" name="checkpoint" class="form-control"
                                        style="border: none;">{{ $border->checkpoint }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Маршрут</td>
                                <td><textarea id="route" name="route" class="form-control"
                                        style="border: none;">{{ $border->route }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Место рождения</td>
                                <td><textarea id="place_birth" name="place_birth" class="form-control"
                                        style="border: none;">{{ $border->place_birth }}</textarea> </td>
                            </tr>
                            <tr>
                                <td>Место регистрации</td>
                                <td><textarea id="place_regis" name="place_regis" class="form-control"
                                        style="border: none;">{{ $border->place_regis }}</textarea> </td>
                            </tr>
                            <tr>
                             
                                <td>Доступ к просмотру записи</td>
                          
                                <td>  <div class="form-group" style="width:200px; height:100px; overflow:auto; border:solid 1px #C3E4FE;">
                                      <fieldset id="shest">
                                        <label><input type="checkbox" id="checkall"> Выбрать всех</label>
                                      @foreach ( $users as $user)
                                      <li class="list-group-item"><input type="checkbox" class="thing" name="user[]" id="user" value="{{ $user->id}}" >{{' '.$user->username }}</li>
                                      @endforeach
                                    </fieldset>
                                </td>
                            </tr>    
                        </tbody>

                    </table>
                    <a href="/borderslist" class="btn btn-primary">Назад</a>
                    <button id="update" name="update" type="submit" class="btn btn-success">
                        Обновить данные </button>
            </div>
            </form>
            <script>
                
                
                const formUpdate = document.getElementById('formUpdate');
                const messageBlock = document.querySelector('.messages');

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
            </script> 

@endsection
