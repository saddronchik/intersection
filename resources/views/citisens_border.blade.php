@extends('layouts.app')

@section('content')

    @foreach ($citisens as $citisen)
    <a href="/citisen/{{ $citisen->id }}" class="btn btn-primary mb-2" style="margin-left: 10px">Назад</a>
                <table class="table table-hover">
                    
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">ФИО</th>
                      <th scope="col">Паспорт</th>
                      <th scope="col">Дата пересечения</th>
                      <th scope="col">Время пересечения</th>
                      <th scope="col">КПП</th>
                      <th scope="col">Маршрут</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{ $citisen->id }}</th>
                      <td class="col-md-3">{{ $citisen->full_name }}</td>
                      <td class="col-md-2">{{ $citisen->passport_data  }}</td>
                      <td class="col-md-2">{{ $citisen->crossing_date }}</td>
                      <td class="col-md-2">{{ $citisen->crossing_time }}</td>
                      <td class="col-md-2">{{ $citisen->checkpoint }}</td>
                      <td class="col-md-2">{{ $citisen->route }}</td>

                    </tr>
                    
                </tbody>

              </table>

              @endforeach

          
@endsection