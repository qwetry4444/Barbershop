<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Посещение</title>
</head>
<body>
<h2>{{$visit ? "Услуги предоставленные при посещении №".$visit->id : "Неверный ID посещения"}}</h2>

@if($visit)
    <table border="1">
        <tr>
            <td>id</td>
            <td>Название</td>
            <td>Цена</td>
        </tr>
        @foreach($visit->service as $service)
            <tr>
                <td>{{$service->id}}</td>
                <td>{{$service->name}}</td>
                <td>{{$service->price}}</td>
            </tr>
        @endforeach
    </table>
@endif
</body>
</html>
