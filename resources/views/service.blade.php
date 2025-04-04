<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Услуга</title>
</head>
<body>
    <h2>{{$service ? "Услуга - ".$service->name : "Неверный ID услуги"}}</h2>


    @if($service)
        <table border="1">
            <tr>
                <td>ID Изображения</td>
                <td>Изображение</td>
            </tr>
            @foreach($service->images as $image)
                <tr>
                    <td>{{$image->id}}</td>
                    <td>
                        <img src="{{ asset($image->image_path) }}" alt="Изображение" style="max-width: 300px; max-height: 160px">
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>
