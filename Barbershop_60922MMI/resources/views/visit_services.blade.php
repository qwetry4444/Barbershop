<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Services of visit</title>
</head>
<body>
    <h2>{{$visit ? "Услуги оказанные при посещении № ".$visit->id : "Неправильный номер посещения"}}</h2>
    @if($visit)
        <table border="1">
            <thead>
                <td>id</td>
                <td>Название</td>
                <td>Тип</td>
                <td>Цена</td>
            </thead>
            @foreach($visit->services as $service)
                <tbody>
                    <td>{{$service->id}}</td>
                    <td>{{$service->name}}</td>
                    <td>{{$service->type}}</td>
                    <td>{{$service->price}}</td>
                </tbody>

            @endforeach
        </table>
    @endif
</body>
</html>
