@extends('layout')
@section('content')
    <div class="container my-4">
        <h2 class="mb-4">Список услуг</h2>

        <form method="post" action="{{ url('booking/service') }}">
            @csrf
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Описание</th>
                    <th>Выбрать</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            <input class="form-check-input" type="radio" name="service_id" value="{{ $service->id }}" required>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    Подтвердить выбор
                </button>
            </div>
        </form>
    </div>

@endsection
