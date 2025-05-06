<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Записи</title>
</head>
<body>
    <h2>Информация о посещениях/записях</h2>

    <table border="1">
        <thead>
            <td>Id</td>
            <td>Id клиента</td>
            <td>Id барбера</td>
            <td>Время начала</td>
            <td>Время окончания</td>
            <td>Предоставленные услуги</td>
            <td>Стоимость</td>
            <td>Действия</td>
        </thead>
        @foreach($visits as $visit)
            <tr>
                <td>{{$visit->id}}</td>
                <td>{{$visit->user_id}}</td>
                <td>{{$visit->barber_id}}</td>
                <td>{{$visit->start_at}}</td>
                <td>{{$visit->end_at}}</td>
                <td>
                    @foreach($visit->service as $service)
                        {{$service->name}} - {{$service->price}}₽ <br>
                    @endforeach
                </td>
                <td>{{$visit->service->sum('price')}}</td>
                <td>
                    @if($user->role->name == "admin" || ($user->role->name == "barber" && $visit->barber_id == $user->id))
                        <a href="{{url('visit/edit/'.$visit->id)}}">Редактировать</a>
                    @endif
                    @if($user->role->name == "admin")
                        <a href="{{url('visit/destroy/'.$visit->id)}}">Удалить</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @if(session('success_delete'))
        <div style="color: green; font-weight: bold; margin-bottom: 10px;">
            {{ session('success_delete') }}
        </div>
    @endif

    @if(session('error_delete'))
        <div style="color: red; font-weight: bold; margin-bottom: 10px;">
            {{ session('error_delete') }}
        </div>
    @endif
</body>
</html>
