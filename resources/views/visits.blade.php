@extends('layout')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary">Информация о посещениях / записях</h2>

    @if(session('success_delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif

    @if(session('error_delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error_delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif

    {{-- Таблица посещений --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light text-center">
            <tr>
                <th>ID</th>
                <th>ID клиента</th>
                <th>ID барбера</th>
                <th>Начало</th>
                <th>Окончание</th>
                <th>Услуги</th>
                <th>Стоимость</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($visits as $visit)
                <tr>
                    <td class="text-center">{{ $visit->id }}</td>
                    <td class="text-center">{{ $visit->user_id }}</td>
                    <td class="text-center">{{ $visit->barber_id }}</td>
                    <td>{{ Carbon::parse($visit->start_at)->format('d.m.Y H:i') }}</td>
                    <td>{{ Carbon::parse($visit->end_at)->format('d.m.Y H:i') }}</td>
                    <td>
                        @foreach($visit->service as $service)
                            <div>{{ $service->name }} — {{ $service->price }}₽</div>
                        @endforeach
                    </td>
                    <td>{{ $visit->service->sum('price') }}₽</td>
                    <td>
                        @if($user->role->name === 'admin' || ($user->role->name === 'barber' && $visit->barber_id === $user->id))
                            <a href="{{ url('visit/edit/'.$visit->id) }}" class="btn btn-outline-primary  m-1">Редактировать</a>
                        @endif
                        @if($user->role->name === 'admin')
                            <a href="{{ url('visit/destroy/'.$visit->id) }}" class="btn btn-outline-primary "
                               onclick="return confirm('Вы уверены, что хотите удалить запись?')">Удалить</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
