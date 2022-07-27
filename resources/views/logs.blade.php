@extends ('layouts.app')


@section('content')

<div class="columns is-multiline">
    <div class="column">
        <table class="table table-hover">
            <thead>
                <a href="/home" class="btn btn-primary mb-2" style="margin-left: 10px">Назад</a>
                <tr class="table table-hover">
                    <th scope="col-md-3">time</th>
                    <th scope="col-md-3">duration</th>
                    <th scope="col-md-3">ip</th>
                    <th scope="col-md-3">user</th>
                    <th scope="col-md-3">url</th>
                    <th scope="col-md-3">actions</th>
                    <th scope="col-md-3">method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td class="col-md-3">{{ $log->time }}</td>
                    <td class="col-md-3">{{ $log->duration .' '.'sec'}}</td>
                    <td class="col-md-3">{{ $log->ip }}</td>
                    <td class="col-md-3">{{ $log->id_user }}</td>
                    <td class="col-md-3">{{ $log->url }}</td>
                    <td class="col-md-3">{{ $log->actions }}
                    <td class="col-md-3">{{ $log->method }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $logs->onEachSide(5)->links() }}
    </div>
</div>

@endsection
