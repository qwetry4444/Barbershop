<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Изменение записи</title>

</head>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<body>
    <h2>Изменение записи</h2>
    <p>Мастер - {{$visit->barber?->name." ".$visit->barber?->last_name ?? "Мастер не указан"}}</p>

    <form method="post" action="{{url("visit/update/".$visit->id)}}">
        @csrf
        <label>Клиент</label>
        <select name="client_id" id="users" class="form-control" style="width: 100%" value="{{old("client_id")}}">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->first_name }} {{ $user->last_name }} ({{$user->phone_number}})
                    </option>
                @endforeach
        </select>
        @error('client_id')
        <div class="is-invalid">{{ $message }}</div>
        @enderror

        <label>Время начала</label>
        <input type="text" id="start_at" name="start_at" class="datetime" value="@if(old('start_at')) {{old("start_at")}} @else {{$visit->start_at}} @endif">
        @error('start_at')
        <div class="is-invalid">{{ $message }}</div>
        @enderror

        <br>
        <label>Время окончания</label>
        <input type="text" id="end_at" name="end_at" class="datetime" value="@if(old('end_at')) {{old("end_at")}} @else {{$visit->start_at}} @endif">
        @error('end_at')
        <div class="is-invalid">{{ $message }}</div>
        @enderror

        <br>
        <label>Предоставленные услуги</label>
        <select name="services[]" id="services" multiple="multiple" class="form-control" value="{{old("services[]")}}">
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                        @if($visit->service->contains($service->id)) selected @endif>
                    {{ $service->name }} ({{ $service->price }}₽)
                </option>
            @endforeach
        </select>
        @error('services[]')
        <div class="is-invalid">{{ $message }}</div>
        @enderror

        <button type="submit">Подтвердить</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>

<script>
    flatpickr(".datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "ru"
    });
</script>

<script>
    $(document).ready(function() {
        $('#services').select2({
            placeholder: "Выберите услуги",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#users').select2({
            placeholder: "Выберите клиента",
            allowClear: true,
            width: '100%'
        });
    });
</script>

