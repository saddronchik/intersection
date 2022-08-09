
                <table >
                  <thead>
                    <tr>
                      <th><b>#</b> </th>
                      <th style="width:35px"><b>Гражданин</b></th>
                      <th style="width:20px"><b>Гражданство</b> </th>
                      <th style="width:20px"><b>Дата рождения</b></th>
                      <th style="width:18px"><b>Паспорт</b></th>
                      <th style="width:18px"><b>Дата пересечения</b></th>
                      <th style="width:40px"><b>Время пересечения</b> </th>
                      <th style="width:40px"><b>Средство передвижения</b> </th>
                      <th style="width:40px"><b>КПП</b> </th>
                      <th style="width:40px"><b>Маршрут</b> </th>
                      <th style="width:40px"><b>Место рождения</b> </th>
                      <th style="width:40px"><b>Место регистрации</b> </th>
                      <th style="width:40px"><b>Сделал запись</b> </th>
                      <th style="width:40px"><b>Id пользователя</b> </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($borders as $border)
                    <tr>
                      <th>{{ $border->id_citisen }}</th>
                      <td>{{ $border->full_name }}</td>
                      <td>{{ $border->citizenship }}</td>
                      <td>{{ $border->date_birth }}</td>
                      <td>{{ $border->passport }}</td>
                      <td>{{ $border->crossing_date }}</td>
                      <td>{{ $border->crossing_time }}</td>
                      <td>{{ $border->way_crossing }}</td>
                      <td>{{ $border->checkpoint }}</td>
                      <td>{{ $border->route }}</td>
                      <td>{{ $border->place_birth }}</td>
                      <td>{{ $border->place_regis }}</td>
                      <td>{{ $border->user }}</td>
                      <td>{{ $border->id_user }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>