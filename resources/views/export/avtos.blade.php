
                <table >
                  <thead>
                    <tr>
                      <th><b>#</b> </th>
                      <th style="width:35px"><b>Владелец</b></th>
                      <th style="width:20px"><b>Марка автомобиля</b> </th>
                      <th style="width:20px"><b>Регистрационный номер</b></th>
                      <th style="width:18px"><b>Цвет</b></th>
                      <th style="width:40px"><b>Доп. информация</b> </th>
                      <th style="width:20px"><b>Кто заметил</b> </th>
                      <th style="width:20px"><b>Где заметил	</b> </th>
                      <th style="width:20px"><b>Время обнаружения</b> </th>
                      <th style="width:20px"><b>id пользователя</b> </th>
                      <th style="width:20px"><b>Сделал запись</b> </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($avtos as $avto)
                    <tr>
                      <th>{{ $avto->id }}</th>
                      <td>{{ $avto->id_citisen}}</td>
                      <td>{{ $avto->brand_avto }}</td>
                      <td>{{ $avto->regis_num }}</td>
                      <td>{{ $avto->color }}</td>
                      <td>{{ $avto->addit_inf }}</td>
                      <td>{{ $avto->who_noticed }}</td>
                      <td>{{ $avto->where_notice }}</td>
                      <td>{{ $avto->detection_time }}</td>
                      <td>{{ $avto->id_user }}</td>
                      <td>{{ $avto->user }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>