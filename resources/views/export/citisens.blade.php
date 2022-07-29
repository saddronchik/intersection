
                <table >
                  <thead>
                    <tr>
                      <th><b>#</b> </th>
                      <th style="width:35px"><b>ФИО</b></th>
                      <th style="width:20px"><b>Паспортные данные 1</b> </th>
                      <th style="width:20px"><b>Паспортные данные 2</b> </th>
                      <th style="width:20px"><b>Паспортные данные 3</b> </th>
                      <th style="width:20px"><b>Дата рождения</b> </th>
                      <th style="width:20px"><b>Место регистрации</b></th>
                      <th style="width:20px"><b>Место проживания</b></th>
                      <th style="width:18px"><b>Телефон 1</b></th>
                      <th style="width:18px"><b>Телефон 2</b></th>
                      <th style="width:18px"><b>Телефон 3</b></th>
                      <th style="width:15px"><b>Соц. аккаунт 1</b></th>
                      <th style="width:15px"><b>Соц. аккаунт 2</b></th>
                      <th style="width:15px"><b>Соц. аккаунт 3</b></th>
                      <th style="width:15px"><b>Соц. аккаунт 4</b></th>
                      <th style="width:15px"><b>Соц. аккаунт 5</b></th>
                      <th style="width:40px"><b>Доп. информация</b> </th>
                      <th style="width:15px"><b>Кто заметил</b> </th>
                      <th style="width:15px"><b>Где заметил</b> </th>
                      <th style="width:15px"><b>Время обнаружения</b> </th>
                      <th style="width:15px"><b>Id создателя</b> </th>
                      <th style="width:15px"><b>Создатель записи</b> </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach ($citisens as $citisen)
                    
                    <tr>
                      <th>{{ $citisen->id }}</th>
                      <td>{{ $citisen->full_name }}</td>
                      <td>{{ $citisen->passport_data }}</td>
                      <td>{{ $citisen->passport_data1}}</td>
                      <td>{{ $citisen->passport_data2 }}</td>
                      <td>{{ $citisen->date_birth}}</td>
                      <td>{{ $citisen->place_registration}}</td>
                      <td>{{ $citisen->place_residence}}</td>
                      <td>{{ $citisen->phone_number }}</td>
                      <td>{{ $citisen->phone_number1 }}</td>
                      <td>{{ $citisen->phone_number2 }}</td>
                      <td>{{ $citisen->social_account }}</td>
                      <td>{{ $citisen->social_account1 }}</td>
                      <td>{{ $citisen->social_account2 }}</td>
                      <td>{{ $citisen->social_account3 }}</td>
                      <td>{{ $citisen->social_account4 }}</td>
                      <td>{{ $citisen->addit_inf }}</td>
                      <td>{{ $citisen->who_noticed }}</td>
                      <td>{{ $citisen->where_notice }}</td>
                      <td>{{ $citisen->detection_time }}</td>
                      <td>{{ $citisen->id_user }}</td>
                      <td>{{ $citisen->user }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>