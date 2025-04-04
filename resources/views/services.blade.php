<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Услуги</title>
</head>
<body>
    <h2>Список услуг</h2>
    <table border="1">
        <thead>
            <td>id</td>
            <td>Название</td>
            <td>Тип</td>
            <td>Цена</td>
            <td>Описание</td>
        </thead>
    @foreach($services as $service)
        <tr>
            <td>{{$service->id}}</td>
            <td>{{$service->name}}</td>
            <td>{{$service->type}}</td>
            <td>{{$service->price}}</td>
            <td>{{$service->description}}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>
