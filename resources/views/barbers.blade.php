<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barbers</title>
</head>
<body>
    <h2>Список барберов</h2>
    <table border="1">
        <thead>
            <td>id</td>
            <td>Имя</td>
            <td>Фафмилия</td>
            <td>Опыт</td>
            <td>Номер телефона</td>
        </thead>
        @foreach($barbers as $barber)
            <tr>
                <td>{{$barber->id}}</td>
                <td>{{$barber->first_name}}</td>
                <td>{{$barber->last_name}}</td>
                <td>{{$barber->experience}}</td>
                <td>{{$barber->phone_number}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
