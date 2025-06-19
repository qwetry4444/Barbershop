
@extends('layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
    <input type="datetime" id="start_at" name="start_at" class="datetime" value="{{ old('start_at') }}">
    @error('start_at')
    <div class="is-invalid">{{$message}}</div>
    @enderror

    <br>
    <button type="submit">Добавить</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection


<script>
    flatpickr(".datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "ru"
    });
</script>
