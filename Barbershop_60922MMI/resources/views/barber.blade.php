<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barber</title>
</head>
<body>
    <h2>{{$barber ? "Барбер ".$barber->first_name." и его работы" : 'Неверный id барбера'}}</h2>
    @if($barber)
    <table border="1">
        <thead>
            <td>id</td>
            <td>image_id</td>
        </thead>
        @foreach($barber->works as $work)
            <tr>
                <td>{{$work->id}}</td>
                <td>{{$work->image_id}}</td>
            </tr>
        @endforeach
    </table>
    @endif
</body>
</html>
