
                <table >
                  <thead>
                    <tr>
                      <th><b>#</b> </th>
                      <th style="width:35px"><b>ФИО</b></th>
                      <th style="width:20px"><b>Паспортные данные</b> </th>
                      <th style="width:20px"><b>Дата рождения</b> </th>
                      <th style="width:20px"><b>Место проживания</b></th>
                      <th style="width:18px"><b>Телефон</b></th>
                      <th style="width:15px"><b>Соц. аккаунты</b></th>
                      <th style="width:40px"><b>Доп. информация</b> </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($citisens as $citisen)
                    <tr>
                      <th>{{ $citisen['id'] }}</th>
                      <td>{{ $citisen['full_name'] }}</td>
                      <td>{{ $citisen['passport_data'] }}</td>
                      <td>{{ $citisen['date_birth'] }}</td>
                      <td>{{ $citisen['place_residence'] }}</td>
                      <td>{{ $citisen['phone_number'] }}</td>
                      <td>{{ $citisen['social_account'] }}</td>
                      <td>{{ $citisen['addit_inf'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>