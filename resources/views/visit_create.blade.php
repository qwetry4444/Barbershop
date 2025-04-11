<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Создание записи</title>
</head>
<body>
<h2>Создание окна для записи</h2>
<form method="post" action="{{ url('visit') }}">
    @csrf
    <label for="barber">Барбер</label>
    <select name="barber_id" id="barber">
        @foreach($users as $barber)
            @if($barber->role->name == "barber")
                <option value="{{ $barber->id }}"
                        @if(old('barber_id') == $barber->id) selected @endif>
                    {{ $barber->name." ".$barber->last_name }}
                </option>
            @endif
        @endforeach
    </select>
    @error('barber_id')
    <div class="is-invalid">{{$message}}</div>
    @enderror

    <br>
    <label for="datetime">Время</label>
    <input type="datetime" id="datetime" name="datetime" class="datetime" value="{{ old('datetime') }}">
    @error('datetime')
    <div class="is-invalid">{{$message}}</div>
    @enderror

    <br>
    <button type="submit">Добавить</button>
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
