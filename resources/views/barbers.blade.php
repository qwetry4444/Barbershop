<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Барберы</title>
</head>
<body>
    <h2>Список барберов</h2>
    <table border="1">
        <tr>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Номер телефона</td>
            <td>Стаж</td>
        </tr>
        @foreach($barbers as $barber)
            <tr>
                <td>{{$barber->name}}</td>
                <td>{{$barber->last_name}}</td>
                <td>{{$barber->phone_number}}</td>
                <td>{{now()->diff($barber->start_work_at)->format('%y лет, %m мес')}}</td>
            </tr>
        @endforeach
    </table>
    {{ $barbers->links() }}
</body>
</html>
