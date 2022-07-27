@extends('layouts.appShow')

@section('content')

<div style="margin-left:8%; margin-right:8% ">
  <a href="/home" class="btn btn-primary mb-2" style="margin-left: 10px">Назад</a>

  <table class="table table-sm" style="width: 60%; margin-left:20%">
    <thead>
      <tr>
        <th scope="col-md-2">#</th>
        <th scope="col-md-1">От кого</th>
        <th scope="col-md-4">Сообщение</th>
        <th scope="col-md-3">Когда отправленно</th>
      </tr>
    </thead>
    <tbody class="tbody">

    </tbody>
    
  </table>
  
              <input type="hidden" name="from" id="from" value="{{ $authUser->id }}">
</div>
<script>
  
 function updateContent(){
    let authUserId = document.querySelector('#from').value;
  const response =  fetch("/listmessage/"+authUserId,{
    method:"GET",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
     'content')
    }})

  .then(function (response) {
    return response.json()
  })
 .then(function(data){
   let lists = document.querySelector('.tbody');
   lists.innerHTML = '';

   for (let key in data.messages) {
     lists.innerHTML +=`
                <tbody>
                      <tr>
                        <th scope="col-md-2" style="padding:0"><div class="alert alert-primary" role="alert" style="margin:0">${data.messages[key].id}</div></th>
                        <td scope="col-md-1" style="padding:0"><div class="alert alert-primary" role="alert" style="margin:0">${data.messages[key].from_user}</div></td>
                        <td scope="col-md-4" style="padding:0"><div class="alert alert-primary" role="alert" style="margin:0">${data.messages[key].message}</div></td>
                        <td scope="col-md-3" style="padding:0"><div class="alert alert-primary" role="alert" style="margin:0">${data.messages[key].created_at}</div></td>
                      </tr>
                 </tbody>
              `
   }
 })}
 setInterval(function(){
  updateContent() // this will run after every 5 seconds
}, 1000);

  
</script>

@endsection