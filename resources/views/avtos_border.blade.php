@extends('layouts.app')

@section('content')

@foreach ($avtos as $avto)
<a href="/avto/{{  $avto->id }}" class="btn btn-primary mb-2" style="margin-left: 10px">Назад</a>

<table class="table table-hover">
    
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Марка машины</th>
      <th scope="col">Регистрационый номер</th>
      <th scope="col">Имя водителя</th>
      <th scope="col">Паспорт</th>
      <th scope="col">Дата пересечения</th>
      <th scope="col">КПП</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ $avto->id }}</th>
      <td class="col-md-3">{{ $avto->brand_avto }}</td>
      <td class="col-md-2">{{ $avto->regis_num  }}</td>
      <td class="col-md-2">{{ $avto->full_name }}</td>
      <td class="col-md-2">{{ $avto->passport }}</td>
      <td class="col-md-2">{{ $avto->crossing_date }}</td>
      <td class="col-md-2">{{ $avto->checkpoint }}</td>

    </tr>
    
</tbody>

</table>

@endforeach





@endsection